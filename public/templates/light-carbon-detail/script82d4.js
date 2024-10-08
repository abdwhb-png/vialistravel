function isAdmin() {
	const ensoElement = document.querySelector("[enso]");
	const ensoElementAttribute = ensoElement.getAttribute("enso");
	return Boolean(ensoElementAttribute);
}

function showForAdmin() {
	if (!isAdmin()) return;

	if (window.matchMedia("(max-width : 768px)").matches) return;

	const elements = document.querySelectorAll("[js-show-for-admin]");
	for (const element of elements) {
		const getDisplayType = element.getAttribute("js-show-for-admin");
		element.classList.remove("hide");
		element.style.display = `${getDisplayType}`; // to pick up edge cases during migration
	}
}

function pushEvent(item, action, label) {
	try {
		dataLayer.push({
			event: item,
			action: action,
			label: label
		});
		console.log("Success: Pushed Event via data layer:", item, action, label);
	} catch (error) {
		console.log("Failed: Pushed Event:", item, action, label, "-", error);
	}
}

// Utility to copy text to clipboard
async function copyToClipboard(val) {
	try {
		await navigator.clipboard.writeText(val);
	} catch (err) {
		console.error("Failed to copy: ", err);
	}
}

//

// Is there a better way to handle this like [enso].js-enso-on?

// Function - Modernize Enso
function enso() {
	const ensoElements = [...document.querySelectorAll(".enso-overlay-link")];

	if (!ensoElements) return;
	for (const element of ensoElements) {
		let ensoOverlayContentElement = element.closest(".enso-overlay-content");
		let ensoElement = ensoOverlayContentElement.closest("[enso]");
		copyEnsoLinkToParentAttribute(element);
		element.remove();
		unWrap(ensoOverlayContentElement);
		ensoOverlayContentElement.remove();
		addTabKeyDownEvent(ensoElement);
	}
}

// FUNCTION - Move Enso Link to parent element with enso attribute
function copyEnsoLinkToParentAttribute(element) {
	let getLink = element.getAttribute("onclick");
	getLink = getLink.replace('self.location.href="', "").replace('"', "");
	let targetEnso = element.closest("[enso]");
	if (targetEnso) {
		targetEnso.setAttribute("enso", getLink);
	}
}

// Function - Upwrap element
function unWrap(element) {
	const parent = element.parentNode;
	while (element.firstChild) {
		parent.insertBefore(element.firstChild, element);
	}
}

// Function - Add in tab keydown event
function addTabKeyDownEvent(element) {
	let overlayVisible = false;
	document.addEventListener("keydown", (event) => {
		if (event.key === "Tab" && element) {
			event.preventDefault();
			overlayVisible = !overlayVisible;
			if (overlayVisible) {
				element.classList.add("js-enso-on");
				addEnsoClickListener(element);
			} else {
				element.classList.remove("js-enso-on");
				removeEnsoClickListener(element);
			}
		}
	});
}

// Function - Setup link href
function setupLink(e) {
	e.preventDefault();
	let goToUrl = this.getAttribute("enso"); // this was the key
	window.location.href = goToUrl;
}

// Function - Add click event listener
function addEnsoClickListener(element) {
	element.addEventListener("click", setupLink, false);
}

// Function - Remove click event listener
function removeEnsoClickListener(element) {
	element.removeEventListener("click", setupLink);
}

function toggleAmbientVideo(shouldPlay, videoElement = null) {
	// If a specific video element is provided, use it
	if (videoElement) {
		shouldPlay ? videoElement.play() : videoElement.pause();
		return;
	}
	// Otherwise, find the active video
	const activeVideo = document.querySelector("[js-ambient-video].active");

	if (activeVideo) shouldPlay ? activeVideo.play() : activeVideo.pause();
}

function buildCarbonModal() {
	const arrayOfHrefForLightboxes = document.querySelectorAll("[href*='/-lightboxes-carbon/']");
	const carbonSelector = document.querySelector(".js-carbon-modal");

	arrayOfHrefForLightboxes.forEach((selector) => {
		let selectorHrefValue = selector.getAttribute("href");
		if (selector.hasAttribute("carbon")) {
			return;
		}

		if (selectorHrefValue.startsWith("https://www.nathab.com")) {
			selectorHrefValue = selectorHrefValue.replace("https://www.nathab.com", "");
		}

		if (selectorHrefValue.includes("#")) {
			const splitIt = selectorHrefValue.split("#");
			selectorHrefValue = splitIt[0];
		}

		selector.addEventListener("click", function (event) {
			event.preventDefault();

			if (!this.hasAttribute("carbon")) {
				buildModal(selectorHrefValue);
				this.setAttribute("carbon", selectorHrefValue);
			} else {
				clickCarbonLabel(selectorHrefValue);
			}

			sessionStorage.setItem("modalOpen", true);

			// pause ambient video when modal is opened
			toggleAmbientVideo(false);
		});
	});

	function clickCarbonLabel(selectorHrefValue) {
		const targetLabel = `[for="modal-carbon-${selectorHrefValue}"]`;
		const targetLabelSelector = document.querySelector(targetLabel);
		if (targetLabelSelector) {
			targetLabelSelector.click();
		}
	}

	async function buildModal(selectorHrefValue) {
		let hrefValue = selectorHrefValue;
		await fetch(selectorHrefValue)
			.then(function (response) {
				return response.text();
			})
			.then(function (html) {
				let parser = new DOMParser();
				let doc = parser.parseFromString(html, "text/html");
				let modal = doc.querySelector(".js-payload-carbon").innerHTML;
				carbonSelector.insertAdjacentHTML("beforebegin", modal);
				enso();
				clickCarbonLabel(hrefValue);
			})
			.catch(function (err) {
				console.error("Something went wrong.", err);
			});

		carbonModalCloseListener();

		if (isAdmin()) {
			takeAdminToModalURL(hrefValue);
		}
	}

	function carbonModalCloseListener() {
		const carbonModalClose = document.querySelector("[js-click-toggle='carbon']");

		carbonModalClose.addEventListener("click", function () {
			sessionStorage.setItem("modalOpen", false);
			toggleAmbientVideo(true);
		});
	}

	// Function: for admin logged into CMS, go to lightbox url enso screen on tab
	function takeAdminToModalURL(modalURL) {
		document.addEventListener("keyup", openCMS);
		function openCMS(event) {
			if (event.keyCode == 9) {
				window.location.href = modalURL + "?ensoAction=group&name=group-modal-carbon";
			}
		}
	}
}

// Function: open lightbox if 'lightbox' in url
function openCarbonModal() {
	const urlPathname = window.location.pathname;

	let hiddenLabel = document.querySelector(".js-hidden-label");
	if (urlPathname.includes("/-lightboxes-carbon/")) {
		hiddenLabel.click();
	}
}

function isDialogSupported() {
	// Directly check for the existence of HTMLDialogElement in the window
	if (!window.HTMLDialogElement) return false;

	// Check if 'show' and 'close' methods are part of the HTMLDialogElement's prototype
	const dialogPrototype = window.HTMLDialogElement.prototype;

	// Return boolean
	return typeof dialogPrototype.show === "function" && typeof dialogPrototype.close === "function";
}

async function check_url_for_generic_modal() {
	let querySearch = window.location.search;
	const genericQueryPatterns = [/^\?lightbox=\/-lightboxes\/.+/, /^\?modal=\/-lightboxes\/.+/];

	// Check if the query string matches the generic patterns
	if (genericQueryPatterns.some((pattern) => pattern.test(querySearch))) {
		querySearch = normalize_generic_modal_path(querySearch);
		const targetModalSelector = `[js-modal-generic-url="${querySearch}"]`;
		let targetModal = document.querySelector(targetModalSelector);
		if (!targetModal) {
			targetModal = await fetch_generic_modal_dialog(querySearch, targetModalSelector);
		}
		showDialog(targetModal);
		add_event_close_modal_via_backdrop(targetModal);
		add_event_close_modal_via_button(targetModal);
		add_event_close_modal_via_esc(targetModal);
		enso();
	}
}

function check_links_for_generic_modal() {
	const genericLinks = document.querySelectorAll("a[href*='/-lightboxes/']"); // find all generic links
	for (const item of genericLinks) {
		if (item.hasAttribute("generic")) continue; // skip if generic attribute exists, it means it's already been processed
		item.setAttribute("generic", "");
		item.addEventListener("click", async (event) => {
			event.preventDefault();
			let genericURL = item.getAttribute("href");
			let querySearch = normalize_generic_modal_path(genericURL);
			let targetModalSelector = `[js-modal-generic-url="${querySearch}"]`;
			let targetModal = document.querySelector(targetModalSelector);

			if (event.shiftKey) {
				let shiftClickUrl = `https://${window.location.hostname}${window.location.pathname}?modal=${querySearch}`;
				copyToClipboard(shiftClickUrl);
			}

			if (!targetModal) {
				targetModal = await fetch_generic_modal_dialog(querySearch, targetModalSelector);
				targetModal = document.querySelector(targetModalSelector);
			}
			showDialog(targetModal);
			add_event_close_modal_via_backdrop(targetModal);
			add_event_close_modal_via_button(targetModal);
			add_event_close_modal_via_esc(targetModal);
			enso();
		});
	}
}

// Function to check the size of a single image in the browser and hide/show it if necessary
function check_generic_modal_image_size(modal) {
	const image = modal.querySelector("[js-util-check-img-size]");
	const imageURL = image.getAttribute("js-util-check-img-size");

	function evaluateImageSize() {
		image.classList.remove("hide");
		image.clientWidth < 400 ? image.classList.add("hide") : image.classList.remove("hide");
	}

	if (!imageURL.includes(".")) {
		image.remove();
		return;
	}

	image.src = imageURL;

	if (image.complete) {
		evaluateImageSize();
	}

	image.addEventListener("load", evaluateImageSize);
	window.addEventListener("resize", evaluateImageSize);

	evaluateImageSize();
}

function normalize_generic_modal_path(modalPath) {
	modalPath = modalPath.replace(/.*\?lightbox=/, "");
	modalPath = modalPath.replace(/.*\?modal=/, "");
	modalPath = modalPath.replace(/.*:\/\/[^\/]*\/-lightboxes\//, "/-lightboxes/");
	modalPath = modalPath.replace(/#.*/, "");
	return modalPath;
}

async function fetch_generic_modal_dialog(querySearch, targetModalSelector) {
	try {
		const response = await fetch(querySearch);
		const fetchedDialog = await response.text();
		document.body.insertAdjacentHTML("beforeend", fetchedDialog);
		const modal = document.querySelector(targetModalSelector);
		if (!modal) {
			throw new Error(`Modal with selector "${targetModalSelector}" not found in the inserted HTML.`);
		}
		cdnifyImages();
		return modal;
	} catch (err) {
		console.warn("Something went wrong.", err);
	}
}

function showDialog(modal) {
	if (isDialogSupported()) {
		document.body.classList.add("modal-open");
		modal.showModal();
	} else {
		pushEvent("Dev", "Dialog", "Not Supported");
	}
	sessionStorage.setItem("modalOpen", true);
	toggleAmbientVideo(false);
	check_generic_modal_image_size(modal);
}

function add_event_close_modal_via_backdrop(modal) {
	modal.addEventListener("click", (event) => {
		if (event.target === modal) {
			document.body.classList.remove("modal-open");
			modal.close();
		}
	});
}

function add_event_close_modal_via_button(modal) {
	const genericModalClose = modal.querySelector("[js-modal-generic-close]");
	genericModalClose.addEventListener("click", (event) => {
		event.preventDefault();
		document.body.classList.remove("modal-open");
		modal.close();
	});
}

// Event : if escape key is pressed (but captures all close events)
function add_event_close_modal_via_esc(modal) {
	modal.addEventListener("close", () => {
		document.body.classList.remove("modal-open");
		modal.close();
		sessionStorage.setItem("modalOpen", false);
		toggleAmbientVideo(true);
	});
}

// template components

// global components try/catch to run first
try {
	enso();
} catch (error) {
	console.error(error);
}

try {
	showForAdmin();
} catch (error) {
	console.error(error);
}

try {
	check_url_for_generic_modal();
	check_links_for_generic_modal();
} catch (error) {
	console.error(error);
}

// template components try/catch
try {
	buildCarbonModal();
} catch (error) {
	console.error(error);
}

try {
	openCarbonModal();
} catch (error) {
	console.error(error);
}

// global components try/catch
try {
	enso();
} catch (error) {
	console.error(error);
}
//# sourceMappingURL=script.js.map
