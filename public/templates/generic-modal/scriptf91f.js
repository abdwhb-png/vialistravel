function isDialogSupported() {
	// Directly check for the existence of HTMLDialogElement in the window
	if (!window.HTMLDialogElement) return false;

	// Check if 'show' and 'close' methods are part of the HTMLDialogElement's prototype
	const dialogPrototype = window.HTMLDialogElement.prototype;

	// Return boolean
	return typeof dialogPrototype.show === "function" && typeof dialogPrototype.close === "function";
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

function show_modal_if_url_matches_modal_attribute() {
	const currentPath = window.location.pathname;
	const modal = document.querySelector("[js-modal-generic-url]");
	if (modal && modal.getAttribute("js-modal-generic-url") === currentPath) {
		showDialog(modal);
		add_event_close_modal_via_backdrop(modal);
		add_event_close_modal_via_button(modal);
		add_event_close_modal_via_esc(modal);
		enso();
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

// template components try/catch
try {
	show_modal_if_url_matches_modal_attribute();
} catch (error) {
	console.error(error);
}
try {
	enso();
} catch (error) {
	console.error(error);
}
try {
	cdnifyImages();
} catch (error) {
	console.error(error);
}
//# sourceMappingURL=script.js.map
