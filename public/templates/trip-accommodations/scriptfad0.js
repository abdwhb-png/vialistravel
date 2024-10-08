function isWistiaVideoPlaying() {
	let isVideoPlaying = false;

	function wistiaVideo() {
		const videoID = document.querySelector(".js-wistia-video-id").textContent;
		const wistiaSrc = `https://fast.wistia.net/embed/iframe/${videoID}?videoFoam=true`;

		if (wistiaSrc === "https://fast.wistia.net/embed/iframe/?videoFoam=true") {
			return;
		}

		const wistiaIframe = document.querySelector(".js-wistia-video");
		wistiaIframe.setAttribute("src", wistiaSrc);

		window._wq = window._wq || [];
		const videoTitles = document.querySelector(".js-video");
		videoTitles.addEventListener("click", function (ev) {
			videoTitles.classList.add("hide");
			playVideo();
		});
		function playVideo() {
			let playStatus;
			_wq.push({
				id: "_all",
				onReady: function (video) {
					video.play();
					video.bind("play", function () {
						playStatus = true;
						videoPlayStatus(playStatus);
					});
					video.bind("pause", function () {
						playStatus = false;
						videoPlayStatus(playStatus);
					});
				}
			});
		}
	}
	wistiaVideo();

	function videoPlayStatus(status) {
		isVideoPlaying = status;
	}
	return isVideoPlaying;
}

function cleanupAnchorTags() {
	// Remove a tag if href is missing or undefined
	$("a").each(function () {
		if ($(this).attr("href") == "" || $(this).attr("href") == "undefined") {
			$(this).remove();
		}
	});
}

// Check all a links to find target = _blank    see above
function cleanupAnchorTagsBlankTarget() {
	document.querySelectorAll("a").forEach(function (link) {
		if (!link.hasAttribute("href")) link.remove();

		const linkHref = link.getAttribute("href");

		// Add _blank to all links that go to Monster Campaigns so they open on top of our pages instead of being redirected to Monsty
		if (linkHref && linkHref.includes("https://app.monstercampaigns.com/")) {
			link.setAttribute("target", "_blank");
			return;
		}

		// Remove all _blank from a tags on mobile and tablet
		if (document.documentElement.clientWidth < 1025) {
			link.setAttribute("target", "_self");
		}
	});
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

function pushEventFacebook() {
	try {
		fbq("track", "Lead");
	} catch (error) {
		console.log("Failed : pushEventFacebook");
	}
}

function pushEventBing() {
	try {
		window.uetq = window.uetq || [];
		window.uetq.push({
			ec: "Lead",
			ea: "Catalog_Request"
		});
	} catch (error) {
		// console.log("Failed : pushEventBing");
	}
}

// Function: get user's device size. This function is intentionally duplicated here to be available for global use. Second instance lives in resize-img.js
function getBrowserDevice() {
	if (window.matchMedia("(max-width : 767px)").matches) return "mobile";
	if (window.matchMedia("(min-width : 768px) AND (max-width : 1023px)").matches) return "tablet";
	if (window.matchMedia("(min-width : 1024px)").matches) return "desktop";
	return "unsure";
}

// EVENT - Check for country local storage, set if not already set
async function saveUserCountryToLocalStorage() {
	let userCountry = localStorage.getItem("country");
	if (userCountry === null) {
		userCountry = await setUserCountry();
	}
}

// set user country in local storage
async function setUserCountry() {
	try {
		let response = await fetch("https://ipinfo.io/json?token=5ddc6962f801d5");
		let data = await response.json();
		let userCountry = data.country || "unknown";
		localStorage.setItem("country", userCountry);
		return userCountry;
	} catch (err) {
		console.error("Failed to fetch user country.", err);
		return "unknown"; // Return a default value in case of an error
	}
}

// Function: check if any modal is open
function checkForOpenModals() {
	const isOpen = sessionStorage.getItem("modalOpen") === "true";
	return isOpen;
}

// Function: check if a wistia video is playing
function checkIfWistiaVideoPlaying() {
	const wistiaVideo = document.querySelector(".js-video");
	if (wistiaVideo && isWistiaVideoPlaying() !== undefined) {
		return true;
	} else {
		return false;
	}
}

// vanilla wrapper to get cookie value
function getCookie(name) {
	let value = `; ${document.cookie}`;
	let parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(";").shift();
}

// Utility to copy text to clipboard
async function copyToClipboard(val) {
	try {
		await navigator.clipboard.writeText(val);
	} catch (err) {
		console.error("Failed to copy: ", err);
	}
}

// Utility to track browser size for Google Analytics -- are we using this?
function browserSize() {
	let width = window.innerWidth || document.body.clientWidth;
	let height = window.innerHeight || document.body.clientHeight;
	let size = width + "x" + height;

	let browserSizeCookie = Cookies.get("browserSize");
	if (browserSizeCookie === "blocked" || browserSizeCookie == null || browserSizeCookie != size) {
		browserSizeCookie = size;
		Cookies.set("browserSize", size, {
			expires: 365
		});
		pushEvent("Browser Size", "Range", size);
	}
}

// Function: show hero photo credit if name has been entered in CMS
function showHeroPhotoCredit() {
	const photoCredit = document.querySelector("[js-hero-photo-credit]");
	if (photoCredit) {
		const creditText = photoCredit.textContent.trim();
		if (creditText.length > 2) {
			photoCredit.classList.remove("hide");
		} else {
			photoCredit.classList.add("hide");
		}
	}
}

//  Need to run on page load but not a huge priority
function setFavIcon() {
	const favicon = document.querySelector("[js-set-favicon]");
	const mediaQuery = window.matchMedia("(prefers-color-scheme: dark)");
	if (!favicon) return;
	function updateFavicon() {
		favicon.setAttribute("href", mediaQuery.matches ? "/assets/images/icons/favicon-dark-mode.png" : "/assets/images/icons/favicon-light-mode.png");
	}
	updateFavicon();
	mediaQuery.addEventListener("change", updateFavicon);
}

// Track social icon clicks for GA
function trackSocialClicks(links, area) {
	let socialLinks = document.querySelectorAll(`[${links}]`);
	socialLinks.forEach(function (link) {
		link.addEventListener("click", function () {
			let platform = link.getAttribute(`${links}`);
			pushEvent("Clicks", `Social ${area}`, `${platform}`);
		});
	});
}

// Functions: check if elements exist
const ensureElementExists = (elementSelector, limit) =>
	new Promise((resolve, reject) => {
		let count = 0;
		function waitForElement() {
			const element = document.querySelector(elementSelector);
			if (element) return resolve(element);
			if (limit && count > limit) return false;
			count += 1;
			setTimeout(waitForElement, 100);
		}
		waitForElement();
	});

const waitUntilElementExists = async (elementSelector, limit) => {
	const response = await ensureElementExists(elementSelector, limit);
	return response;
};

// Book NOW Button - Set URL
function bookNowButton() {
	let finalSegment = window.location.pathname.split("/");
	finalSegment.pop();
	finalSegment.shift();
	finalSegment.shift();
	finalSegment = `https://book.nathab.com/book-now/adventure/${finalSegment[0]}/`;

	const bookButtons = document.querySelectorAll(".js-book-init");
	for (const button of bookButtons) {
		button.setAttribute("href", finalSegment);
		button.addEventListener("click", function () {
			pushEvent("Misc", "Book Now", "Open");
		});
	}
}

// Auto-Scroll Trip Subpages
function autoScroll() {
	const mqSmall = window.matchMedia("(max-width : 767px)");
	const subpage = document.querySelector("[subpage~='autoscroll']");

	if (!mqSmall.matches && subpage) {
		const subpageTop = getOffsetTop(subpage);
		const offset = 150;

		window.scrollTo({
			top: subpageTop - offset,
			behavior: "smooth"
		});
	}
}

// helper function for autoScroll;
// If the element or any of its parents are positioned non-statically (relative, absolute, fixed, or sticky),
// you'll need to calculate the element's position manually by adding up the offsetTop values of the element
// and all of its offset parents.
function getOffsetTop(element) {
	let offsetTop = 0;
	while (element) {
		offsetTop += element.offsetTop;
		element = element.offsetParent;
	}
	return offsetTop;
}

// For sub sub itinereray nav links
function setTripItinerarySubSubClass() {
	const links = document.querySelectorAll("[tripnav='nav'] a");
	links.forEach(function (link) {
		if (link.href.includes("-itin")) {
			link.parentElement.classList.add("removeSubSub");
		}
	});
}

// remove .active form parent itinerary page if child itinerary has active
function removeActiveFromOtherLi() {
	let activeLiElements = document.querySelectorAll("[tripnav~='nav'] li.active");

	if (activeLiElements.length > 1) {
		activeLiElements[0].classList.remove("active");
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

function convertOldSlideshowToNew() {
	const imageContainers = document.querySelectorAll(".js-old-slideshow-images");
	if (!imageContainers.length) return;

	let slides = "";

	for (const imageContainer of imageContainers) {
		const images = imageContainer.querySelectorAll("img");
		if (!images.length) continue;

		for (const image of images) {
			const alt = image.getAttribute("alt") || " ";
			let src = image.getAttribute("src") || image.getAttribute("data-src");

			if (!src) continue;

			const domain = "https://www.nathab.com";
			const cdn = "https://cdn.filestackcontent.com/A6dTpd53SmIg0pBfJJhgAz/resize=width:1600,fit:max/quality=value:60/cache=expiry:31536000/compress/";
			const doubleDomain = domain + domain;

			src = domain + src;
			src = src.replace(doubleDomain, domain);
			src = cdn + src;

			slides += `
				<div slide-new="wrapper" tabindex="0">
					<img ignore-cdn slide="image" js-slide-img data-src="${src}" alt="${alt}" />
					<div slide="text-wrapper">
						<div slide="credit"></div>
						<div slide="caption">${alt}</div>
					</div>
				</div>
			`;
		}
		imageContainer.outerHTML = slides;
	}
}

function slideshow(arg) {
	let slideshows = document.querySelectorAll('[slideshow~="outer"]');

	for (const slideshow of slideshows) {
		const parent = slideshow.querySelector('[slideshow~="wrapper"]');
		const imageList = [...parent.querySelectorAll("[js-slide-img]")];
		const leftArrow = slideshow.querySelector('[js-arrow~="previous"]');
		const rightArrow = slideshow.querySelector('[js-arrow~="next"]');
		const navigation = slideshow.querySelector('[slideshow~="navigation"]');

		function resetSlideshow() {
			const firstThumb = slideshow.querySelector('[slideshow="thumbnail"]');
			// timeout is vital because the intersection observer will not run until it's on screen
			// and modal takes a moment to pop up while all of this code is already running
			setTimeout(() => {
				// autoscroll to first thumbnail in navigation
				navigation.scrollLeft = navigation.scrollWidth * -1;
				// click thumbnail to change active image & reset
				firstThumb.click();
				// covers
				rightArrow.classList.remove("disabled");
			}, [500]);
		}

		if (!imageList.length) continue;

		leftArrow.classList.add("disabled");
		if (imageList[0]) {
			imageList[0].classList.add("image-active");
		}

		if (arg === "reset") {
			resetSlideshow();
		}

		for (const image of imageList) {
			let original_src = image.getAttribute("data-src");
			const cdnString = "https://cdn.filestackcontent.com/A6dTpd53SmIg0pBfJJhgAz/resize=width:1600,fit:max/quality=value:75/cache=expiry:31536000/compress/";
			const nathabString = "https://www.nathab.com";
			if (!original_src.includes("cdn.filestackcontent.com")) {
				if (original_src.includes("nathab.com")) {
					original_src = cdnString + original_src;
				} else {
					original_src = cdnString + nathabString + original_src;
				}
			}
			if (!original_src) continue;
			image.setAttribute("src", original_src);
		}

		function buildThumbnails() {
			imageList.forEach((image, i) => {
				image.setAttribute("js-image", `image-${i}`);
				const newSrc = image.src.replace(1600, 300); // reliant on 1600 set in html
				const thumbnail = document.createElement("div");
				thumbnail.setAttribute("target", `image-${i}`);
				thumbnail.setAttribute("tabIndex", 0);
				thumbnail.setAttribute("slideshow", "thumbnail");
				thumbnail.addEventListener("click", function () {
					let activeImage = slideshow.querySelector(".image-active");
					if (activeImage) {
						activeImage.classList.remove("image-active");
					}
					const targetId = thumbnail.getAttribute("target");
					targetImg = slideshow.querySelector(`[js-image~="${targetId}"]`);
					targetImg.scrollIntoView({ behavior: "smooth", block: "nearest" });
					targetImg.classList.add("image-active");
					let thumbnailTarget = thumbnail.getAttribute("target");
					thumbnailTarget = thumbnailTarget.replace("image-", "");
					if (parseInt(thumbnailTarget) === 0) {
						leftArrow.classList.add("disabled");
					} else if (parseInt(thumbnailTarget) === imageList.length - 1) {
						rightArrow.classList.add("disabled");
					} else {
						leftArrow.classList.remove("disabled");
						rightArrow.classList.remove("disabled");
					}
				});
				const thumbnailImg = document.createElement("img");
				thumbnailImg.setAttribute("slideshow", "thumbnail-image");
				thumbnailImg.setAttribute("src", newSrc);
				thumbnail.appendChild(thumbnailImg);
				navigation.appendChild(thumbnail);
			});
		}

		buildThumbnails();

		let targetImg = parent.querySelector(".image-active");
		let previousImg = targetImg.getAttribute("js-image");
		previousImg = previousImg.replace("image-", "");

		function scrollThumbnailIntoView(entries) {
			entries.map((entry) => {
				const currentX = entry.target;
				let index = currentX.getAttribute("js-image");
				index = index.replace("image-", "");
				let scrollInt = 1;
				let targetThumbnail = slideshow.querySelector(`[target=image-${index}]`);
				if (entry.isIntersecting) {
					let scrollDirection = parseInt(index) + scrollInt;
					if (previousImg > index) {
						scrollDirection = parseInt(index) - scrollInt;
					}
					let targetScrollThumbnail = slideshow.querySelector(`[target="image-${scrollDirection}"]`);
					entry.target.classList.add("image-active");
					targetThumbnail.classList.add("image-active");

					if (targetScrollThumbnail) {
						// prevents whole page from scrolling thumbnail into view on load
						if (index > 0) {
							targetScrollThumbnail.scrollIntoView({ behavior: "smooth", block: "nearest" });
						}
						previousImg = index;
					}
				} else {
					entry.target.classList.remove("image-active");
					targetThumbnail.classList.remove("image-active");
				}
			});
		}

		// observer is used to keep thumbnails inline with active image and scroll them into view
		const observer = new IntersectionObserver(scrollThumbnailIntoView, {
			threshold: [0.988],
			trackVisibility: true,
			delay: 150,
			root: slideshow,
			rootMargin: "100px 0px 100px 0px"
		});

		//handles multiple instances of slideshow on a given page
		imageList.forEach((image) => observer.observe(image));

		function navLeft() {
			if (targetImg === imageList[0]) {
				return;
			}
			leftArrow.classList.remove("disabled");
			rightArrow.classList.remove("disabled");
			let index = targetImg.getAttribute("js-image");
			index = index.replace("image-", "");
			targetImg = slideshow.querySelector(`[js-image="image-${parseInt(index) - 1}"]`);
			if (!targetImg) {
				leftArrow.classList.add("disabled");
			} else {
				targetImg.scrollIntoView({ behavior: "smooth", block: "nearest" });
			}
			if (targetImg === imageList[0]) {
				leftArrow.classList.add("disabled");
			}
		}

		function navRight() {
			if (targetImg === imageList[imageList.length - 1]) {
				return;
			}
			leftArrow.classList.remove("disabled");
			rightArrow.classList.remove("disabled");
			let index = targetImg.getAttribute("js-image");
			index = index.replace("image-", "");
			targetImg = slideshow.querySelector(`[js-image="image-${parseInt(index) + 1}"]`);
			if (!targetImg) {
				rightArrow.classList.add("disabled");
			} else {
				targetImg.scrollIntoView({ behavior: "smooth", block: "nearest" });
			}
			if (targetImg === imageList[imageList.length - 1]) {
				rightArrow.classList.add("disabled");
			}
		}

		leftArrow.addEventListener("click", navLeft);
		rightArrow.addEventListener("click", navRight);

		window.addEventListener("keydown", triggerScroll, false);

		function triggerScroll(e) {
			const keyCode = e.key || e.keyCode;
			if (keyCode === "ArrowLeft") {
				navLeft();
			} else if (keyCode === "ArrowRight") {
				navRight();
			}
		}
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

function observeAmbientVideo() {
	sessionStorage.setItem("modalOpen", false);

	// select it
	const videos = document.querySelectorAll("[js-ambient-video]");

	// check it
	if (videos.length === 0) return;

	// func call to assign active video, return active video element
	let activeVideo = assignActiveAmbientVideo(videos);

	// resize event listener to call func to reassign active video
	window.addEventListener("resize", () => {
		activeVideo = assignActiveAmbientVideo(videos);
	});

	// visibility event listener to call func to pause video when tab is not active
	document.addEventListener("visibilitychange", () => {
		handleVisibilityChange(activeVideo);
	});

	// create an observer instance
	let observer = new IntersectionObserver(playOrPauseAmbientVideo, {
		threshold: 0.5 // Adjust as necessary
	});

	// observe active video
	if (activeVideo) observer.observe(activeVideo);
}

// play or pause based on tab visibility
function handleVisibilityChange(activeVideo) {
	if (checkForOpenModals()) return;

	toggleAmbientVideo(!document.hidden, activeVideo);
}

// find the active video
function assignActiveAmbientVideo(videos) {
	const isMobile = window.matchMedia("(orientation: portrait)").matches;

	const activeVideo = Array.from(videos).find((video) => {
		const deviceType = isMobile ? "mobile" : "desktop";
		const videoAttribute = video.getAttribute("js-ambient-video");

		if (videoAttribute !== deviceType) {
			toggleAmbientVideo(false, video); // Pause the video if it's not for the current device type
			return false;
		}

		return true;
	});

	if (activeVideo) activeVideo.classList.add("active");

	return activeVideo;
}

// play or pause based on intersection and tab visibility
function playOrPauseAmbientVideo(entries) {
	entries.forEach((entry) => {
		let isModalOpen = checkForOpenModals();
		if (entry.isIntersecting && !document.hidden && !isModalOpen) {
			toggleAmbientVideo(true, entry.target);
		} else {
			toggleAmbientVideo(false, entry.target);
		}
	});
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

// Function: add shift-click listener to accommodations repeaters
function buildAccommodationClipboardLinks(link) {
	const pageHref = window.location.href;
	let regex;

	// determine whether accommodations or ships and set regex
	if (pageHref.includes("/accommodations")) {
		regex = /\/accommodations.*$/;
	} else if (pageHref.includes("/ships")) {
		regex = /\/ships.*$/;
	}

	// what happens if neither? -CM

	// define urls for overview and dates/fees pages
	const tripOverviewPage = pageHref.replace(regex, "/");
	const tripDatesFeesPage = pageHref.replace(regex, "/dates-fees/");

	// build notes & links for all 3 pages
	let attributeValue = link.getAttribute("href");
	const text = `Options to open accommodation modal:
	
	To open accommodation on Accommodation page:
	${pageHref}${attributeValue}
	
	To open accommodation on Trip Overview page:
	${tripOverviewPage}${attributeValue}
	
	To open accommodation on Date/Fees page (for use in Dates accordion):
	${tripDatesFeesPage}${attributeValue}`;

	copyToClipboard(text);

	return;
}

function checkLinksForAccomodationModal() {
	const modalLinks = document.querySelectorAll(`a[href*="?modal=/accommodations/"]`);

	if (modalLinks.length === 0) return;

	for (const link of modalLinks) {
		link.addEventListener("click", async function (e) {
			e.preventDefault();

			const linkParams = new URLSearchParams(link.search);
			const url = linkParams.get("modal");

			if (e.shiftKey && url.includes("/accommodations/")) {
				buildAccommodationClipboardLinks(link);
			}

			let modal;

			if (isAccommodationModalFetched(url)) {
				modal = document.querySelector(`[js-modal~='${url}']`);
			} else {
				modal = await fetchAccommodationModal(url);
				enso();
				const isOldSlideshow = modal.querySelector(".show-old"); // specific to modals with slideshows
				if (isOldSlideshow) convertOldSlideshowToNew(); // specific to modals with slideshows
				slideshow(); // specific to modals with slideshows
			}
			openModal(modal);
		});
	}
}

function isAccommodationModalFetched(url) {
	return document.querySelector(`[js-modal~='${url}']`) ? true : false;
}

// Function: open accommodation modal from URL
async function checkUrlForAccommodationModal() {
	const urlParams = new URLSearchParams(window.location.search);
	const modalParam = urlParams.get("modal");

	if (!modalParam || !modalParam.includes("/accommodations/")) return;

	let modal = document.querySelector(`[js-modal~='${modalParam}']`);

	if (!modal) {
		modal = await fetchAccommodationModal(modalParam);
		enso();
		const isOldSlideshow = modal.querySelector(".show-old");
		if (isOldSlideshow) convertOldSlideshowToNew();
		slideshow();
	}
	openModal(modal);
}

async function fetchAccommodationModal(url) {
	try {
		const response = await fetch(url);
		const html = await response.text();

		const modalContent = document.createElement("div");
		modalContent.innerHTML = html;

		const getModal = modalContent.querySelector(`[js-modal~="${url}"]`);

		if (getModal.length === 0) return;

		document.body.insertAdjacentElement("afterbegin", getModal);
		const modal = document.querySelector(`[js-modal~="${url}"]`);
		return modal;
	} catch (error) {
		console.error("Error fetching modal:", error);
		return null; // or throw the error
	}
}

function initCloseModalButton(modal) {
	const closeModalButton = modal.querySelector("[js-close-modal]");
	closeModalButton.addEventListener("click", function () {
		closeModal(modal);
	});
}

function closeModalOnClickOutside(modal) {
	return function (event) {
		const wrapper = modal.querySelector("[modal-slideshow-wrapper]");
		if (!wrapper.contains(event.target)) {
			closeModal(modal);
		}
	};
}

function openModal(modal) {
	sessionStorage.setItem("modalOpen", true);
	toggleAmbientVideo(false);
	isDialogSupported() ? modal.showModal() : modal.setAttribute("open", "");
	window.scrollBy(0, -1);

	const firstImageOfSlideshow = modal.querySelector("[slideshow='thumbnail']");

	setTimeout(() => {
		firstImageOfSlideshow.click();
	}, 10);

	initCloseModalButton(modal);

	// Bind the modal to the closeModalOnClickOutside function and add it as an event listener
	modal.handleOutsideClick = closeModalOnClickOutside(modal).bind(modal);
	document.addEventListener("click", modal.handleOutsideClick, true);
}

function closeModal(modal) {
	isDialogSupported() ? modal.close() : modal.removeAttribute("open");
	document.removeEventListener("click", modal.handleOutsideClick, true);
	sessionStorage.setItem("modalOpen", false);
	toggleAmbientVideo(true);
}

// check for breadcrumbs up to 4 levels deep and animate sticky hero elements
function manageBreadcrumbs() {
	const breadcrumbsBar = document.querySelector("[js-breadcrumbs-bar]"); // desktop
	const breadcrumbsListItems = document.querySelectorAll("[js-breadcrumbs-item]"); // desktop and mobile

	breadcrumbsListItems.forEach((item) => {
		if (item.textContent === "") item.remove();
	});

	// hide home link if no breadcrumbs (ie. 404 page)
	if (document.querySelector("[js-breadcrumbs-mobile-list]") && document.querySelector("[js-breadcrumbs-mobile-list]").innerText === "") {
		document.querySelector("[js-breadcrumbs-mobile-home-link]").classList.add("hide");
	}

	if (getBrowserDevice() === "desktop" && breadcrumbsBar) {
		ScrollTrigger.create({
			trigger: breadcrumbsBar,
			onUpdate: (self) => scale_breadcrumbs_pagename(self.direction, breadcrumbsBar)
		});
	}
}

window.addEventListener("resize", manageBreadcrumbs);

function scale_breadcrumbs_pagename(direction, breadcrumbsBar) {
	const pageName = document.querySelector("[js-sticky-pagename]");
	const distanceToTop = 0.08;
	let position = ScrollTrigger.positionInViewport(breadcrumbsBar, "top");

	// scrolling down
	if (direction === 1 && position < distanceToTop) scaleDown(pageName, breadcrumbsBar);

	// scrolling up
	if (direction === -1 && position > distanceToTop) scaleUp(pageName, breadcrumbsBar);
}

function scaleDown(pageName, breadcrumbsBar) {
	pageName.classList.add("js-transform-pagename");
	breadcrumbsBar.classList.add("js-transform-breadcrumbs");
}

function scaleUp(pageName, breadcrumbsBar) {
	pageName.classList.remove("js-transform-pagename");
	breadcrumbsBar.classList.remove("js-transform-breadcrumbs");
}

function setOptsOnMarketoForm() {
	document.querySelector("#optInNHA").value = true;
	document.querySelector("#optInWebinar").value = true;
	document.querySelector("#optInStories").value = true;
	document.querySelector("#optInSurveys").value = true;
	document.querySelector("#optInTripDrips").value = true;
	document.querySelector("#optInSalesperson").value = true;
}

function setSMSOptsOnMarketoForm() {
	document.querySelector("#optInSMS").value = true;
}

function isFormValid(formName) {
	var invalidCount = $(formName).find(":invalid").length;
	if (invalidCount > 0) {
		$(formName).find(":invalid").addClass("js-invalid");
		return false;
	} else {
		return true;
	}
}

function isNewsletterChecked(formName) {
	return document.querySelector(`${formName} ${formName}-requestNewsletter`).checked;
}

function isSMSOptinChecked(formName) {
	return document.querySelector(`${formName} ${formName}-Optin-SMS`).checked;
}

// Add event listener to name input to remove special characters
function initJsFormatName() {
	const nameInputs = document.querySelectorAll("[js-format-name]");

	if (!nameInputs) return;

	nameInputs.forEach((input) => {
		input.addEventListener("blur", () => {
			encodeSpecialChars(input);
		});
	});
}

function encodeSpecialChars(input) {
	let inputValue = input.value;

	if (inputValue.match(/&/g)) input.value = inputValue.replace(/&/g, "and");

	if (inputValue.match(/[!@#$%^*(),.?":{}|<>]/g)) input.value = inputValue.replace(/[!@#$%^*(),.?":{}|<>]/g, "");
}

// Add event listener to phone input
function initJsFormatPhone() {
	// select it
	const phoneInputs = document.querySelectorAll("[js-format-phone]");

	// check it
	if (!phoneInputs) return;

	// handle it
	phoneInputs.forEach((input) => {
		input.addEventListener("blur", () => {
			formatAndValidatePhoneNumber(input);
		});
	});
}

// Format and validate phone numbers
function formatAndValidatePhoneNumber(phoneInput) {
	let phoneNumber = phoneInput.value.replace(/\D/g, "");

	if (phoneNumber.length >= 3) {
		phoneNumber = "(" + phoneNumber.substr(0, 3) + ") " + phoneNumber.substr(3);
		if (phoneNumber.length > 9) {
			phoneNumber = phoneNumber.slice(0, 9) + "-" + phoneNumber.slice(9);
		}
	}

	phoneInput.value = phoneNumber;

	if (phoneInput.hasAttribute("required")) {
		const phonePattern = /^\(\d{3}\) \d{3}-\d{4}$/;
		if (!phonePattern.test(phoneNumber)) {
			phoneInput.classList.add("js-invalid");
			phoneInput.setCustomValidity("invalid");
		} else {
			phoneInput.classList.remove("js-invalid");
			phoneInput.setCustomValidity("");
		}
	} else {
		phoneInput.classList.remove("js-invalid");
		phoneInput.setCustomValidity("");
	}
}

function setNewsletterCheckbox() {
	let listOfCheckboxes = document.querySelectorAll(".js-set-by-country");
	listOfCheckboxes.forEach((element) => {
		element.setAttribute("checked", "checked");
	});
}

function pushUtmToMarketoForm() {
	try {
		document.querySelector("#utmcampaign").value = utmObject.utmcampaign || "";
		document.querySelector("#utmcontent").value = utmObject.utmcontent || "";
		document.querySelector("#utmmedium").value = utmObject.utmmedium || "";
		document.querySelector("#utmsource").value = utmObject.utmsource || "";
		document.querySelector("#utmterm").value = utmObject.utmterm || "";

		$("#gclid").val(utmObject.gclid || "");
		$("#fbclid").val(utmObject.fbclid || "");
		$("#msclkid").val(utmObject.msclkid || "");
		$("#cid").val(utmObject.cid || "");
	} catch (error) {
		console.error("Error: ", error);
	}
}

function toggleButtonDisabled(button) {
	button.setAttribute("disabled", "true");
	setTimeout(function () {
		button.removeAttribute("disabled");
	}, 15000);
}

function isThisSpam(formName) {
	var fields = ["first_name", "last_name"];
	for (const field of fields) {
		let target = `${formName}-${field}`;
		var spamCheck = document.querySelector(`${formName} ${target}`).value;
		if (spamCheck.match(/[!@#$%^&*(),.?":{}|<>]/g)) {
			return true;
		}
	}
}

// Disable sibling(ish) checkboxes after x checkbox is checked
function limitCheckboxes(form) {
	let arrayOfCheckboxLists = document.querySelectorAll(`${form} [js-limit]`); // sort of vague
	arrayOfCheckboxLists.forEach((checkboxList) => {
		let max = parseInt(checkboxList.getAttribute("js-limit"), 10);
		let arrayOfCheckboxes = checkboxList.querySelectorAll("input[type='checkbox']");
		let totalChecked = 0;

		arrayOfCheckboxes.forEach((checkbox) => {
			checkbox.addEventListener("change", () => {
				if (checkbox.checked) {
					totalChecked++;
				} else {
					totalChecked--;
				}
				if (totalChecked > max) {
					checkbox.checked = false;
					totalChecked--;
				}
			});
		});
	});
}

async function customModal() {
	await saveUserCountryToLocalStorage();
	let userCountry = localStorage.getItem("country") || "unknown";

	let pageURL = document.URL;
	let custom = new Object();
	custom.formName = "#form-custom";
	custom.newsletter = false;
	custom.smsElementParent = document.querySelectorAll(".js-sms-checkbox-custom");
	custom.smsElement = document.querySelector("[js-custom-sms]");
	custom.phoneElementInput = document.querySelector("[js-custom-phone-toggle]");
	custom.phoneElementLabel = document.querySelector('[for~="form-custom-phone"]');
	custom.locationSelector = "js-custom-location";
	custom.locationFirstElement = document.querySelector(`[${custom.locationSelector}]`);
	custom.locationAllElements = document.querySelectorAll(`[${custom.locationSelector}]`);
	custom.firstInput = document.querySelector("[custom-form-label]");

	let customScreenRequired = document.querySelector(".js-custom-required"),
		customScreenThankYou = document.querySelector(".js-custom-thankyou");

	initJsFormatPhone();
	initJsFormatName();

	// Event - When SMS checkbox changes do stuff
	custom.smsElement.addEventListener("input", function () {
		if (this.checked) {
			custom.phoneElementInput.setAttribute("required", "");
			custom.phoneElementLabel.setAttribute("custom-form-label", "required");
		} else {
			custom.phoneElementInput.removeAttribute("required");
			custom.phoneElementLabel.setAttribute("custom-form-label", "");
			custom.phoneElementInput.classList.remove("js-invalid");
		}
	});

	// Add event listener to all elements that can open this modal
	custom.locationAllElements.forEach((element) => {
		//check eNews box for users in US, India, and Australia
		if (userCountry === "US" || userCountry === "IN" || userCountry === "AU") {
			setNewsletterCheckbox();
			custom.smsElementParent.forEach((checkbox) => {
				checkbox.classList.remove("hide");
			});
		}
		element.addEventListener("click", function () {
			sessionStorage.setItem("modalOpen", true);

			// pause ambient video when modal is opened
			toggleAmbientVideo(false);

			if (checkMarketoForm() === false) {
				initMarketoForm();
			}
			pushEvent("Custom", "Open");

			setTimeout(() => {
				custom.firstInput.focus();
			}, 1000);
		});
	});

	// Check for #custom in links
	let linksWithHash = document.querySelectorAll("a[href^='#']");
	let linksWithHashNormalized = [];
	linksWithHash.forEach((link) => {
		let href = link.getAttribute("href").toLowerCase();
		if (href.includes("#custom")) {
			linksWithHashNormalized.push(link);
		}
	});
	let linksWithLightbox = document.querySelectorAll("a[href~='?lightbox=custom']");
	let linksCombined = [...linksWithHashNormalized, ...linksWithLightbox];
	addClickEvents(linksCombined);
	function addClickEvents(list) {
		list.forEach((element) => {
			element.addEventListener("click", function (e) {
				e.preventDefault();
				custom.locationFirstElement.click();
			});
		});
	}

	// Check for #hash or ?lightbox=value in URL
	if (pageURL.indexOf("#custom") > 0 || pageURL.indexOf("#Custom") > 0 || window.location.search.match(/lightbox\=custom/i)) {
		custom.locationFirstElement.click();
	}

	// EVENT - Handle submit of required form
	document.querySelector(".js-custom-button-required").addEventListener("click", function (e) {
		e.preventDefault();
		postFormCustom();
	});

	function copyCustomFieldsToMarketoForm() {
		let fieldsToCopyArray = document.querySelectorAll(`${custom.formName} [mrkto-field]`);
		fieldsToCopyArray.forEach((field) => {
			let mrktoFieldSelector = field.getAttribute("mrkto-field");
			if (field.value) {
				document.querySelector(mrktoFieldSelector).value = field.value;
			}
		});
	}

	function postFormCustom() {
		let retryLimit = 3,
			retryAttempt = 0;

		// Validate form
		let isValid = isFormValid(custom.formName);
		if (isValid === false) {
			return;
		}

		// Check for spam
		if (isThisSpam(custom.formName) === true) {
			return;
		}

		toggleButtonDisabled(document.querySelector(".js-custom-button-required"));

		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormCustom();
			});
		}

		MktoForms2.whenReady(function () {
			let optins = "";

			pushUtmToMarketoForm(); // function lives in global
			document.querySelector("#requestedAt").value = document.URL;
			document.querySelector("#LeadSource").value = "www.nathab.com";
			document.querySelector("#sourceDetail").value = "Custom Africa Question";
			document.querySelector("#recentConversionAction").value = "Custom Africa Question";
			document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
			document.querySelector("#isAskQuestion").value = true;

			copyCustomFieldsToMarketoForm(custom.formName); // Used for both required and optional

			if (isNewsletterChecked(custom.formName) === true) {
				document.querySelector("#isEmailSignup").value = true;
				optins += " eNews";
				setOptsOnMarketoForm();
			}

			if (isSMSOptinChecked(custom.formName) === true) {
				document.querySelector("#isSMSSignup").value = true;
				optins += " SMS,";
				setSMSOptsOnMarketoForm();
			}

			optins = optins || " no optins"; // if empty string, set to no optins

			let pushEventString = `Submitted w/${optins}`;
			pushEvent("Custom", pushEventString);

			marketoSubmitFormCustom();

			pushEventFacebook();
			pushEventBing();

			setTimeout(() => {
				customScreenRequired.classList.add("hide");
				customScreenThankYou.classList.remove("hide");
				customScreenThankYou.scrollTop = 0;
			}, 2750);
		});
	}

	function marketoSubmitFormCustom() {
		if (checkMarketoForm() === false) {
			pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
		}

		MktoForms2.whenReady(function (form) {
			form.submit();
		});
	}
}

async function privateModal() {
	await saveUserCountryToLocalStorage();
	let userCountry = localStorage.getItem("country") || "unknown";

	let pageURL = document.URL;
	let privateModal = new Object();
	privateModal.formName = "#form-private";
	privateModal.newsletter = false;
	privateModal.smsElementParent = document.querySelectorAll(".js-sms-checkbox-private");
	privateModal.smsElement = document.querySelector("[js-private-sms]");
	privateModal.phoneElementInput = document.querySelector("[js-private-phone-toggle]");
	privateModal.phoneElementLabel = document.querySelector('[for~="form-private-phone"]');
	privateModal.locationSelector = "js-private-location";
	privateModal.locationFirstElement = document.querySelector(`[${privateModal.locationSelector}]`);
	privateModal.locationAllElements = document.querySelectorAll(`[${privateModal.locationSelector}]`);
	privateModal.firstInput = document.querySelector("[private-form-label]");

	let privateScreenRequired = document.querySelector(".js-private-required"),
		privateScreenThankYou = document.querySelector(".js-private-thankyou");

	initJsFormatPhone();
	initJsFormatName();

	// Function - insert trip name into aside text
	function insertTripNameIntoAsideText() {
		const asideTextSelector = document.querySelector(".js-private-aside-text");
		const questionTextSelector = document.querySelector(".js-private-question-text");

		if (asideTextSelector && questionTextSelector) {
			let asideText = asideTextSelector.innerHTML;
			let questionText = questionTextSelector.innerHTML;

			let tripName = document.querySelector(".js-tripName").textContent;
			if (tripName.startsWith("The ")) {
				tripName = tripName.replace("The ", "");
			}

			function updateTripName(selector, oldText) {
				let updatedText = oldText.replace("${tripName}", tripName);
				selector.innerHTML = updatedText;
			}

			updateTripName(asideTextSelector, asideText);
			updateTripName(questionTextSelector, questionText);
		}
	}
	insertTripNameIntoAsideText();

	// Event - When SMS checkbox changes do stuff
	function smsCheckbox() {
		privateModal.smsElement.addEventListener("input", function () {
			if (this.checked) {
				privateModal.phoneElementInput.setAttribute("required", "");
				privateModal.phoneElementLabel.setAttribute("private-form-label", "required");
			} else {
				privateModal.phoneElementInput.removeAttribute("required");
				privateModal.phoneElementLabel.setAttribute("private-form-label", "");
				privateModal.phoneElementInput.classList.remove("js-invalid");
			}
		});
	}

	privateModal.locationAllElements.forEach((element) => {
		//pre-check eNews box for users in US, India, and Australia
		if (userCountry === "US" || userCountry === "IN" || userCountry === "AU") {
			setNewsletterCheckbox();
			privateModal.smsElementParent.forEach((checkbox) => {
				checkbox.classList.remove("hide");
			});
			smsCheckbox();
		}
		element.addEventListener("click", function () {
			sessionStorage.setItem("modalOpen", true);

			// pause ambient video when modal is opened
			toggleAmbientVideo(false);

			if (checkMarketoForm() === false) {
				initMarketoForm();
			}
			pushEvent("Private", "Open");

			setTimeout(() => {
				privateModal.firstInput.focus();
			}, 1000);
		});
	});

	// Check for #private in links
	let linksWithHash = document.querySelectorAll("a[href^='#']");
	let linksWithHashNormalized = [];
	linksWithHash.forEach((link) => {
		let href = link.getAttribute("href").toLowerCase();
		if (href.includes("#private")) {
			linksWithHashNormalized.push(link);
		}
	});
	let linksWithLightbox = document.querySelectorAll("a[href~='?lightbox=private']");
	let linksCombined = [...linksWithHashNormalized, ...linksWithLightbox];
	addClickEvents(linksCombined);
	function addClickEvents(list) {
		list.forEach((element) => {
			element.addEventListener("click", function (e) {
				e.preventDefault();
				privateModal.locationFirstElement.click();
			});
		});
	}

	// Check for #hash or ?lightbox=value in URL
	if (pageURL.indexOf("#private") > 0 || pageURL.indexOf("#Private") > 0 || window.location.search.match(/lightbox\=private/i)) {
		privateModal.locationFirstElement.click();
	}

	// EVENT - Handle submit of required form
	document.querySelector(".js-private-button-required").addEventListener("click", function (e) {
		e.preventDefault();
		postFormPrivate();
	});

	function copyPrivateFieldsToMarketoForm() {
		let fieldsToCopyArray = document.querySelectorAll(`${privateModal.formName} [mrkto-field]`);
		fieldsToCopyArray.forEach((field) => {
			let mrktoFieldSelector = field.getAttribute("mrkto-field");
			if (field.value) {
				document.querySelector(mrktoFieldSelector).value = field.value;
			}
		});
		// set hidden form textarea id=" askaQuestionText" to visible form text; fixes ${tripName} not getting populated in Marketo
		document.querySelector("#askaQuestionText").value = document.querySelector("#form-private-askaQuestionText").value;
	}

	function postFormPrivate() {
		let retryLimit = 3,
			retryAttempt = 0;

		// Validate form
		let isValid = isFormValid(privateModal.formName);
		if (isValid === false) {
			return;
		}

		// Check for spam
		if (isThisSpam(privateModal.formName) === true) {
			return;
		}

		toggleButtonDisabled(document.querySelector(".js-private-button-required"));

		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormPrivate();
			});
		}

		MktoForms2.whenReady(function () {
			let optins = "";

			pushUtmToMarketoForm(); // function lives in global
			document.querySelector("#requestedAt").value = document.URL;
			document.querySelector("#LeadSource").value = "www.nathab.com";
			document.querySelector("#sourceDetail").value = "Make It Private Question";
			document.querySelector("#recentConversionAction").value = "Make It Private Question";
			document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
			document.querySelector("#isAskQuestion").value = true;

			copyPrivateFieldsToMarketoForm(privateModal.formName); // Used for both required and optional

			if (isNewsletterChecked(privateModal.formName) === true) {
				document.querySelector("#isEmailSignup").value = true;
				optins += " eNews";
				setOptsOnMarketoForm();
			}

			if (isSMSOptinChecked(privateModal.formName) === true) {
				document.querySelector("#isSMSSignup").value = true;
				optins += " SMS";
				setSMSOptsOnMarketoForm();
			}

			optins = optins || " no optins"; // if empty string, set to no optins
			let pushEventString = `Submitted w/${optins}`;

			pushEvent("Private", pushEventString);

			marketoSubmitFormPrivate();

			pushEventFacebook();
			pushEventBing();

			setTimeout(() => {
				privateScreenRequired.classList.add("hide");
				privateScreenThankYou.classList.remove("hide");
				privateScreenThankYou.scrollTop = 0;
			}, 2750);
		});
	}

	function marketoSubmitFormPrivate() {
		if (checkMarketoForm() === false) {
			pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
		}

		MktoForms2.whenReady(function (form) {
			form.submit();
		});
	}
}

const countryList = [
	{ code: "AF", name: "Afghanistan" },
	{ code: "AX", name: "Åland Islands" },
	{ code: "AL", name: "Albania" },
	{ code: "DZ", name: "Algeria" },
	{ code: "AS", name: "American Samoa" },
	{ code: "AD", name: "Andorra" },
	{ code: "AO", name: "Angola" },
	{ code: "AI", name: "Anguilla" },
	{ code: "AQ", name: "Antarctica" },
	{ code: "AG", name: "Antigua and Barbuda" },
	{ code: "AR", name: "Argentina" },
	{ code: "AM", name: "Armenia" },
	{ code: "AW", name: "Aruba" },
	{ code: "AU", name: "Australia" },
	{ code: "AT", name: "Austria" },
	{ code: "AZ", name: "Azerbaijan" },
	{ code: "BS", name: "Bahamas" },
	{ code: "BH", name: "Bahrain" },
	{ code: "BD", name: "Bangladesh" },
	{ code: "BB", name: "Barbados" },
	{ code: "BY", name: "Belarus" },
	{ code: "BE", name: "Belgium" },
	{ code: "BZ", name: "Belize" },
	{ code: "BJ", name: "Benin" },
	{ code: "BM", name: "Bermuda" },
	{ code: "BT", name: "Bhutan" },
	{ code: "BO", name: "Bolivia (Plurinational State of)" },
	{ code: "BQ", name: "Bonaire, Sint Eustatius and Saba" },
	{ code: "BA", name: "Bosnia and Herzegovina" },
	{ code: "BW", name: "Botswana" },
	{ code: "BV", name: "Bouvet Island" },
	{ code: "BR", name: "Brazil" },
	{ code: "IO", name: "British Indian Ocean Territory" },
	{ code: "BN", name: "Brunei Darussalam" },
	{ code: "BG", name: "Bulgaria" },
	{ code: "BF", name: "Burkina Faso" },
	{ code: "BI", name: "Burundi" },
	{ code: "CV", name: "Cabo Verde" },
	{ code: "KH", name: "Cambodia" },
	{ code: "CM", name: "Cameroon" },
	{ code: "CA", name: "Canada" },
	{ code: "KY", name: "Cayman Islands" },
	{ code: "CF", name: "Central African Republic" },
	{ code: "TD", name: "Chad" },
	{ code: "CL", name: "Chile" },
	{ code: "CN", name: "China" },
	{ code: "CX", name: "Christmas Island" },
	{ code: "CC", name: "Cocos (Keeling) Islands" },
	{ code: "CO", name: "Colombia" },
	{ code: "KM", name: "Comoros" },
	{ code: "CG", name: "Congo" },
	{ code: "CD", name: "Congo (Democratic Republic of the)" },
	{ code: "CK", name: "Cook Islands" },
	{ code: "CR", name: "Costa Rica" },
	{ code: "CI", name: "Côte d'Ivoire" },
	{ code: "HR", name: "Croatia" },
	{ code: "CU", name: "Cuba" },
	{ code: "CW", name: "Curaçao" },
	{ code: "CY", name: "Cyprus" },
	{ code: "CZ", name: "Czech Republic" },
	{ code: "DK", name: "Denmark" },
	{ code: "DJ", name: "Djibouti" },
	{ code: "DM", name: "Dominica" },
	{ code: "DO", name: "Dominican Republic" },
	{ code: "EC", name: "Ecuador" },
	{ code: "EG", name: "Egypt" },
	{ code: "SV", name: "El Salvador" },
	{ code: "GQ", name: "Equatorial Guinea" },
	{ code: "ER", name: "Eritrea" },
	{ code: "EE", name: "Estonia" },
	{ code: "SZ", name: "Eswatini" },
	{ code: "ET", name: "Ethiopia" },
	{ code: "FK", name: "Falkland Islands (Malvinas)" },
	{ code: "FO", name: "Faroe Islands" },
	{ code: "FJ", name: "Fiji" },
	{ code: "FI", name: "Finland" },
	{ code: "FR", name: "France" },
	{ code: "GF", name: "French Guiana" },
	{ code: "PF", name: "French Polynesia" },
	{ code: "TF", name: "French Southern Territories" },
	{ code: "GA", name: "Gabon" },
	{ code: "GM", name: "Gambia" },
	{ code: "GE", name: "Georgia" },
	{ code: "DE", name: "Germany" },
	{ code: "GH", name: "Ghana" },
	{ code: "GI", name: "Gibraltar" },
	{ code: "GR", name: "Greece" },
	{ code: "GL", name: "Greenland" },
	{ code: "GD", name: "Grenada" },
	{ code: "GP", name: "Guadeloupe" },
	{ code: "GU", name: "Guam" },
	{ code: "GT", name: "Guatemala" },
	{ code: "GG", name: "Guernsey" },
	{ code: "GN", name: "Guinea" },
	{ code: "GW", name: "Guinea-Bissau" },
	{ code: "GY", name: "Guyana" },
	{ code: "HT", name: "Haiti" },
	{ code: "HM", name: "Heard Island and McDonald Islands" },
	{ code: "VA", name: "Holy See" },
	{ code: "HN", name: "Honduras" },
	{ code: "HK", name: "Hong Kong" },
	{ code: "HU", name: "Hungary" },
	{ code: "IS", name: "Iceland" },
	{ code: "IN", name: "India" },
	{ code: "ID", name: "Indonesia" },
	{ code: "IR", name: "Iran (Islamic Republic of)" },
	{ code: "IQ", name: "Iraq" },
	{ code: "IE", name: "Ireland" },
	{ code: "IM", name: "Isle of Man" },
	{ code: "IL", name: "Israel" },
	{ code: "IT", name: "Italy" },
	{ code: "JM", name: "Jamaica" },
	{ code: "JP", name: "Japan" },
	{ code: "JE", name: "Jersey" },
	{ code: "JO", name: "Jordan" },
	{ code: "KZ", name: "Kazakhstan" },
	{ code: "KE", name: "Kenya" },
	{ code: "KI", name: "Kiribati" },
	{ code: "KP", name: "Korea (Democratic People's Republic of)" },
	{ code: "KR", name: "Korea (Republic of)" },
	{ code: "KW", name: "Kuwait" },
	{ code: "KG", name: "Kyrgyzstan" },
	{ code: "LA", name: "Lao People's Democratic Republic" },
	{ code: "LV", name: "Latvia" },
	{ code: "LB", name: "Lebanon" },
	{ code: "LS", name: "Lesotho" },
	{ code: "LR", name: "Liberia" },
	{ code: "LY", name: "Libya" },
	{ code: "LI", name: "Liechtenstein" },
	{ code: "LT", name: "Lithuania" },
	{ code: "LU", name: "Luxembourg" },
	{ code: "MO", name: "Macao" },
	{ code: "MG", name: "Madagascar" },
	{ code: "MW", name: "Malawi" },
	{ code: "MY", name: "Malaysia" },
	{ code: "MV", name: "Maldives" },
	{ code: "ML", name: "Mali" },
	{ code: "MT", name: "Malta" },
	{ code: "MH", name: "Marshall Islands" },
	{ code: "MQ", name: "Martinique" },
	{ code: "MR", name: "Mauritania" },
	{ code: "MU", name: "Mauritius" },
	{ code: "YT", name: "Mayotte" },
	{ code: "MX", name: "Mexico" },
	{ code: "FM", name: "Micronesia (Federated States of)" },
	{ code: "MD", name: "Moldova (Republic of)" },
	{ code: "MC", name: "Monaco" },
	{ code: "MN", name: "Mongolia" },
	{ code: "ME", name: "Montenegro" },
	{ code: "MS", name: "Montserrat" },
	{ code: "MA", name: "Morocco" },
	{ code: "MZ", name: "Mozambique" },
	{ code: "MM", name: "Myanmar" },
	{ code: "NA", name: "Namibia" },
	{ code: "NR", name: "Nauru" },
	{ code: "NP", name: "Nepal" },
	{ code: "NL", name: "Netherlands" },
	{ code: "NC", name: "New Caledonia" },
	{ code: "NZ", name: "New Zealand" },
	{ code: "NI", name: "Nicaragua" },
	{ code: "NE", name: "Niger" },
	{ code: "NG", name: "Nigeria" },
	{ code: "NU", name: "Niue" },
	{ code: "NF", name: "Norfolk Island" },
	{ code: "MK", name: "North Macedonia" },
	{ code: "MP", name: "Northern Mariana Islands" },
	{ code: "NO", name: "Norway" },
	{ code: "OM", name: "Oman" },
	{ code: "PK", name: "Pakistan" },
	{ code: "PW", name: "Palau" },
	{ code: "PS", name: "Palestine, State of" },
	{ code: "PA", name: "Panama" },
	{ code: "PG", name: "Papua New Guinea" },
	{ code: "PY", name: "Paraguay" },
	{ code: "PE", name: "Peru" },
	{ code: "PH", name: "Philippines" },
	{ code: "PN", name: "Pitcairn" },
	{ code: "PL", name: "Poland" },
	{ code: "PT", name: "Portugal" },
	{ code: "PR", name: "Puerto Rico" },
	{ code: "QA", name: "Qatar" },
	{ code: "RE", name: "Réunion" },
	{ code: "RO", name: "Romania" },
	{ code: "RU", name: "Russian Federation" },
	{ code: "RW", name: "Rwanda" },
	{ code: "BL", name: "Saint Barthélemy" },
	{ code: "SH", name: "Saint Helena, Ascension and Tristan da Cunha" },
	{ code: "KN", name: "Saint Kitts and Nevis" },
	{ code: "LC", name: "Saint Lucia" },
	{ code: "MF", name: "Saint Martin (French part)" },
	{ code: "PM", name: "Saint Pierre and Miquelon" },
	{ code: "VC", name: "Saint Vincent and the Grenadines" },
	{ code: "WS", name: "Samoa" },
	{ code: "SM", name: "San Marino" },
	{ code: "ST", name: "Sao Tome and Principe" },
	{ code: "SA", name: "Saudi Arabia" },
	{ code: "SN", name: "Senegal" },
	{ code: "RS", name: "Serbia" },
	{ code: "SC", name: "Seychelles" },
	{ code: "SL", name: "Sierra Leone" },
	{ code: "SG", name: "Singapore" },
	{ code: "SX", name: "Sint Maarten (Dutch part)" },
	{ code: "SK", name: "Slovakia" },
	{ code: "SI", name: "Slovenia" },
	{ code: "SB", name: "Solomon Islands" },
	{ code: "SO", name: "Somalia" },
	{ code: "ZA", name: "South Africa" },
	{ code: "GS", name: "South Georgia and the South Sandwich Islands" },
	{ code: "SS", name: "South Sudan" },
	{ code: "ES", name: "Spain" },
	{ code: "LK", name: "Sri Lanka" },
	{ code: "SD", name: "Sudan" },
	{ code: "SR", name: "Suriname" },
	{ code: "SJ", name: "Svalbard and Jan Mayen" },
	{ code: "SE", name: "Sweden" },
	{ code: "CH", name: "Switzerland" },
	{ code: "SY", name: "Syrian Arab Republic" },
	{ code: "TW", name: "Taiwan, Province of China" },
	{ code: "TJ", name: "Tajikistan" },
	{ code: "TZ", name: "Tanzania, United Republic of" },
	{ code: "TH", name: "Thailand" },
	{ code: "TL", name: "Timor-Leste" },
	{ code: "TG", name: "Togo" },
	{ code: "TK", name: "Tokelau" },
	{ code: "TO", name: "Tonga" },
	{ code: "TT", name: "Trinidad and Tobago" },
	{ code: "TN", name: "Tunisia" },
	{ code: "TR", name: "Turkey" },
	{ code: "TM", name: "Turkmenistan" },
	{ code: "TC", name: "Turks and Caicos Islands" },
	{ code: "TV", name: "Tuvalu" },
	{ code: "UG", name: "Uganda" },
	{ code: "UA", name: "Ukraine" },
	{ code: "AE", name: "United Arab Emirates" },
	{ code: "GB", name: "United Kingdom of Great Britain and Northern Ireland" },
	{ code: "US", name: "United States" },
	{ code: "UM", name: "United States Minor Outlying Islands" },
	{ code: "UY", name: "Uruguay" },
	{ code: "UZ", name: "Uzbekistan" },
	{ code: "VU", name: "Vanuatu" },
	{ code: "VE", name: "Venezuela (Bolivarian Republic of)" },
	{ code: "VN", name: "Viet Nam" },
	{ code: "VG", name: "Virgin Islands (British)" },
	{ code: "VI", name: "Virgin Islands (U.S.)" },
	{ code: "WF", name: "Wallis and Futuna" },
	{ code: "EH", name: "Western Sahara" },
	{ code: "YE", name: "Yemen" },
	{ code: "ZM", name: "Zambia" },
	{ code: "ZW", name: "Zimbabwe" }
];

// Function : Smarty : Select Address
function selectAddress(streetVal, cityVal, stateVal, zipVal, smarty) {
	let userCountry = localStorage.getItem("country") || "unknown";
	if (userCountry !== "US") return;

	smarty.streets.forEach((street) => {
		street.value = streetVal;
	});
	smarty.cities.forEach((city) => {
		city.value = cityVal;
	});
	smarty.states.forEach((state) => {
		state.value = stateVal;
	});
	smarty.zips.forEach((zip) => {
		zip.value = zipVal;
	});
	smarty.countries.forEach((country) => {
		country.value = "United States";
	});
	emptyMenu(smarty);
}

// Function : Empty Element
function emptyMenu(smarty) {
	smarty.menus.forEach((menu) => {
		var children = Array.prototype.slice.call(menu.childNodes);
		children.forEach(function (child) {
			menu.removeChild(child);
		});
	});
}

// Function : Smarty : Build Menu
function buildAddressMenu(suggestions, smarty) {
	emptyMenu(smarty);
	suggestions.forEach(function (suggestion) {
		smarty.menus.forEach((menu) => {
			let div = document.createElement("div");
			div.setAttribute("smarty", "selector");
			div.className = "js-smarty-selector";
			div.innerHTML = `<strong>${suggestion.street_line}</strong> ${suggestion.city}, ${suggestion.state} ${suggestion.zipcode}`;
			div.addEventListener("click", () => selectAddress(suggestion.street_line, suggestion.city, suggestion.state, suggestion.zipcode, smarty));
			menu.appendChild(div);
		});
	});
}

function initSmarty(form) {
	let smarty = {};
	// Create Object : Smarty : Selectors
	smarty.menus = document.querySelectorAll(`${form} .js-smarty-menu`);
	smarty.streets = document.querySelectorAll(`${form} .js-smarty-street`);
	smarty.suites = document.querySelectorAll(`${form} .js-smarty-street-2`);
	smarty.cities = document.querySelectorAll(`${form} .js-smarty-city`);
	smarty.states = document.querySelectorAll(`${form} .js-smarty-state`);
	smarty.zips = document.querySelectorAll(`${form} .js-smarty-zip`);
	smarty.countries = document.querySelectorAll(`${form} .js-smarty-country`);

	function suggestNow(street, smarty) {
		if (street.value.length < 4) {
			return;
		}
		if (street.value) {
			smartySuggestions(street.value, smarty);
		}
	}

	// Function : Smarty : Ajax Post to Smarty Streets
	function smartySuggestions(search, smarty) {
		let ref = `${location.protocol}//${window.location.hostname}`;
		fetch(`https://us-autocomplete-pro.api.smartystreets.com/lookup?key=91583922427951116&search=${search}&max_results=5`, {
			method: "GET",
			headers: {
				host: "us-autocomplete-pro.api.smartystreets.com",
				referer: ref
			}
		})
			.then(function (response) {
				return response.json();
			})
			.then(function (data) {
				if (data.suggestions) {
					buildAddressMenu(data.suggestions, smarty);
				} else {
					emptyMenu(smarty);
				}
			})
			.catch(function (err) {
				console.warn("Something went wrong.", err);
			});
	}

	// Event : Smarty : Handle typing into street address
	smarty.streets.forEach((street) => {
		var current = -1;

		street.addEventListener(
			"keyup",
			_.throttle(function (event) {
				if (street.value.length < 4 || street.value.length > 25) {
					return;
				}
				if (event.keyCode === 38 || event.keyCode === 40 || event.keyCode === 13) {
					return;
				}
				suggestNow(street, smarty);
			}, 1250)
		);

		street.addEventListener("keyup", function (event) {
			if (street.value.length < 4) {
				return;
			}
			if (event.keyCode === 38) {
				var checkExist = setInterval(function () {
					if (street.nextElementSibling.hasChildNodes() === true) {
						clearInterval(checkExist);
					}
				}, 100);
				if (street.nextElementSibling.hasChildNodes() === true) {
					if (current === 0) {
						return;
					}
					street.nextElementSibling.children[current].classList.remove("focus");
					current--;
					street.nextElementSibling.children[current].classList.add("focus");
				}
			} else if (event.keyCode === 40) {
				var checkExist = setInterval(function () {
					if (street.nextElementSibling.hasChildNodes() === true) {
						clearInterval(checkExist);
					}
				}, 100);
				if (street.nextElementSibling.hasChildNodes() === true) {
					if (current === street.nextElementSibling.children.length - 1) {
						return;
					}
					if (current > -1) {
						street.nextElementSibling.children[current].classList.remove("focus");
					}
					current++;
					street.nextElementSibling.children[current].classList.add("focus");
				}
			} else if (event.keyCode === 13) {
				event.preventDefault();
				if (street.nextElementSibling.children[current].classList.contains("focus")) {
					var simulateClick = function (elem) {
						// Create our event (with options)
						var evt = new MouseEvent("click", {
							bubbles: true,
							cancelable: true,
							view: window
						});
						// If cancelled, don't dispatch our event
						!elem.dispatchEvent(evt);
					};
					simulateClick(street.nextElementSibling.children[current]);
				}
				return false;
			} else {
				current = -1;
			}
		});
	});

	//  Event : Smarty : When suite or city field gains focus
	smarty.suites.forEach((suite) => {
		suite.addEventListener("focus", function () {
			emptyMenu(smarty);
		});
	});

	smarty.cities.forEach((city) => {
		city.addEventListener("focus", function () {
			emptyMenu(smarty);
		});
	});
}

function olarkLoader() {
	let isChatBoxOpen = false;
	let modalAndVideoCheck = true;
	let isOperatorAvailable = "blocked"; // default state
	let chatCookieCheck;
	const browserDevice = getBrowserDevice();
	const chatCookieMaxAge = "43200"; // 43200 seconds = 12 hours
	const userActionAutopopDelay = 15000; // 15 seconds
	const bodyDiv = document.querySelector("body");

	document.addEventListener("readystatechange", (event) => {
		if (event.target.readyState === "complete") {
			const chatButtonDesktop = document.querySelector(".js-chat-button-desktop");
			const chatButtonMobileBanner = document.querySelector(".js-chat-banner-mobile");
			const chatButtonMobile = document.querySelector(".js-chat-button-mobile");
			const chatMobileDrawerLabel = document.querySelector("[js-click-toggle~='contact']");
			const chatMobileDrawerToggle = document.querySelector("[js-close-chat]");
			const chatButtonDesktopClose = document.querySelector(".js-chat-button-desktop--close");

			olark("api.chat.onReady", function () {
				setTimeout(() => {
					isOperatorAvailable = checkChatStatus();
					autoPopChatAfterXSeconds(isOperatorAvailable); // function call for 90 second auto popup
					if (isOperatorAvailable !== "blocked" && browserDevice !== "mobile") {
						preventChatFromMisbehaving();
						chatButtonDesktop.classList.remove("hide");
					} else if (isOperatorAvailable !== "blocked" && browserDevice == "mobile") {
						chatButtonMobileBanner.classList.remove("hide");
						chatButtonMobile.classList.remove("hide");
					}

					// Turned off for now, because this was causing a new misbehavior in Foxy
					// Sometimes more than one Olark div gets created in Firefox
					// const chatWrappers = document.querySelectorAll("#hbl-live-chat-wrapper");
					// const firstChatWrapper = document.querySelector("#hbl-live-chat-wrapper");
					// console.log(chatWrappers);

					// if (chatWrappers.length > 1) {
					// 	chatWrappers.forEach(function (wrapper) {
					// 		if (wrapper !== firstChatWrapper) {
					// 			wrapper.remove();
					// 		}
					// 	});
					// }
					// console.log(chatWrappers.length);
				}, 2000);
				olark("api.box.shrink");
			});

			// For when the box is expanded either from a button click or operator initiated
			olark("api.box.onExpand", function () {
				isChatBoxOpen = true;
				if (browserDevice !== "mobile") {
					chatButtonDesktop.classList.add("hide");
					chatButtonDesktopClose.classList.remove("hide");
				}
				if (browserDevice === "mobile") {
					chatMobileDrawerLabel.click();
					setTimeout(() => {
						olark("api.box.expand");
					}, 100);
				}

				// check if session has been set to remove consent message
				let showConsent = sessionStorage.getItem("showConsent");
				if (showConsent === "false") {
					const consentMessageDiv = document.querySelector(".olark-gdpr-consent-message");
					if (consentMessageDiv) {
						consentMessageDiv.remove();
					}
				}
				// When chat is opened, call function to decide if enews consent box is displayed and gets pre-checked
				shouldEmailConsentBeDisplayed();
			});

			olark("api.box.onShow", function () {
				isChatBoxOpen = true;
				chatButtonDesktop.classList.add("hide");
				chatButtonDesktopClose.classList.remove("hide");
			});

			// For when the box is shrunk either from a button click
			olark("api.box.onShrink", function () {
				isChatBoxOpen = false;
				chatButtonDesktop.classList.remove("hide");
				chatButtonDesktopClose.classList.add("hide");
				chatButtonDesktop.classList.remove("animate__animated");
			});

			olark("api.box.onHide", function () {
				isChatBoxOpen = false;
				chatButtonDesktop.classList.remove("hide");
				chatButtonDesktopClose.classList.add("hide");
				chatButtonDesktop.classList.remove("animate__animated");
			});

			// For when the operator sends a message on mobile only
			olark("api.chat.onMessageToVisitor", function (event) {
				isOperatorAvailable = checkChatStatus();
				if (browserDevice === "mobile" && isOperatorAvailable) {
					olark("api.box.expand");
				}
			});

			// Callback if operator is available
			olark("api.chat.onOperatorsAvailable", function () {
				isOperatorAvailable = checkChatStatus();
				autoPopChatAfterXSeconds(isOperatorAvailable);
			});

			// Disappear consent button on first message to operator when chat is online
			olark("api.chat.onMessageToOperator", function (e) {
				const consentMessageDiv = document.querySelector(".olark-gdpr-consent-message");
				consentMessageDiv.remove();
				// set session so div is removed when user goes to a new page
				sessionStorage.setItem("showConsent", "false");
			});

			// CLICK LISTENERS
			// Add click listener to mobile button on contact drawer
			chatButtonMobile.addEventListener("click", function (e) {
				olark("api.box.expand");
			});

			// Add click listener to mobile close button or any drawer toggle
			chatMobileDrawerToggle.addEventListener("click", function (e) {
				olark("api.box.shrink");
			});

			// Add click listener to mobile banner
			chatButtonMobileBanner.addEventListener("click", function (e) {
				chatMobileDrawerLabel.click();
				setTimeout(() => {
					olark("api.box.expand");
				}, 100);
				pushEvent("Olark_Chat", "Button Click", "Mobile");
			});

			// Add click listener to desktop button
			chatButtonDesktop.addEventListener("click", function (e) {
				olark("api.box.expand");
				pushEvent("Olark_Chat", "Button Click", "Desktop");
			});

			// Add click listener to desktop close button
			chatButtonDesktopClose.addEventListener("click", function (e) {
				olark("api.box.shrink");
			});

			// check for session value in case user went to different page before the 15 second timeout allowed chat to autopop after user action
			chatCookieCheck = cookieValueCheck("chatAutoPopupSession");
			if (chatCookieCheck > userActionAutopopDelay) {
				openChat(isOperatorAvailable);
				// set auto popup cookies to prevent more auto popups
				setAutoPopupCookie("chatAutoPopup", chatCookieMaxAge);
				// setAutoPopupCookie("chatAutoPopupBlock", chatCookieMaxAge);
			}

			// Function: Mutation Observers to prevent chat from misbehaving: standalone X, standalone chat window, X not working and both olark buttons visible at same time
			// Refactor this code so that the mutation observers are calling functions instead of initiating side effects
			function preventChatFromMisbehaving() {
				const olarkDiv = document.querySelector("#olark-container");

				// Mutation observer to watch for class changes on chat box and desktop and close buttons
				let listenForClassChanges = new MutationObserver(function (mutations) {
					mutations.forEach(function (mutation) {
						if (mutation.type === "attributes" && mutation.attributeName === "class") {
							const classCheckInterval = setInterval(() => {
								// Turned off original code because it started causing more frequent misbehaviors;
								// Save old code for now and revisit if the original misbehaviors resurface, but hopefully the new code below resolves those

								// if (olarkDiv.classList.contains("olark-hidden") === true) {
								// 	// chat closed and close button showing, so open chat
								// 	if (chatButtonDesktopClose.classList.contains("hide") === false) {
								// 		// olarkDiv.classList.remove("olark-hidden");
								// 		olark("api.box.expand");
								// 		console.log("olark hidden and close button stranded");
								// 		// chat and both buttons hidden (because this is now happening on Foxy), so show desktop button
								// 	} else if (chatButtonDesktopClose.classList.contains("hide") === true && chatButtonDesktop.classList.contains("hide") === true) {
								// 		chatButtonDesktop.classList.remove("hide");
								// 		console.log("everything hidden");
								// 	}
								// } else if (olarkDiv.classList.contains("olark-hidden") === false) {
								// 	// chat open and close button missing, so show close button
								// 	if (chatButtonDesktopClose.classList.contains("hide") === true) {
								// 		chatButtonDesktopClose.classList.remove("hide");
								// 		console.log("olark open and close button missing");
								// 		// chat open and both buttons showing, so close chat
								// 	} else if (chatButtonDesktopClose.classList.contains("hide") === false && chatButtonDesktop.classList.contains("hide") === false) {
								// 		// chatButtonDesktop.classList.add("hide");
								// 		olark("api.box.shrink");
								// 		console.log("olark open and both buttons showing");
								// 	}
								// } else console.log("olark behaving?");

								// Possible solution for misbehaviors
								// if chat box is open and out of sync with variable, close it & reset variable
								if (olarkDiv.classList.contains("olark-hidden") === true && isChatBoxOpen) {
									// console.log("chat open, isChatBoxOpen false");
									olark("api.box.shrink");
									isChatBoxOpen = false;
									// if chat box is closed and out of sync with variable, open it & reset variable
								} else if (olarkDiv.classList.contains("olark-hidden") === false && !isChatBoxOpen) {
									// console.log("chat closed, isChatBoxOpen true");
									olark("api.box.expand");
									isChatBoxOpen = true;
								}
								clearInterval(classCheckInterval); // is this doing anything?
							}, 500);
						}
					});
				});

				// Mutation observer to watch for removal of olark wrapper element which started happening after leaving chat box open overnight
				let listenForElementRemoval = new MutationObserver(function (mutations) {
					mutations.forEach(function (mutation) {
						mutation.removedNodes.forEach(function (removed_node) {
							if (removed_node.id == "hbl-live-chat-wrapper") {
								listenForClassChanges.disconnect();
								chatButtonDesktopClose.classList.add("hide");
								chatButtonDesktop.classList.add("hide");
								// console.log("olark removed the entire div (all the bad words)");
							}
						});
					});
				});

				// Initiate observers on chat box and both buttons
				listenForClassChanges.observe(olarkDiv, { attributes: true });
				listenForClassChanges.observe(chatButtonDesktopClose, { attributes: true });
				listenForClassChanges.observe(chatButtonDesktop, { attributes: true });

				// Initiate observer on body (parent element of chat wrapper)
				listenForElementRemoval.observe(bodyDiv, { subtree: true, childList: true });
			}
		}
	});

	// MAIN FUNCTIONS FOR EMAIL CONSENT BOX
	function shouldEmailConsentBeDisplayed() {
		const consentMessageDiv = document.querySelector(".olark-gdpr-consent-message");
		const consentButton = document.querySelector(".olark-gdpr-consent-checkbox");

		if (consentButton && consentButton.classList.contains("olark-gdpr-consent-checked")) {
			consentMessageDiv.remove();
		}
		const onlineStartChatButton = document.querySelector(".olark-button.olark-survey-form-submit"); // when chat is online, this exists and email consent is displayed
		const offlineNextButton = document.querySelector(".olark-button.olark-survey-form-nav"); // when chat is offline, this exists and email consent is not displayed

		// when chat is online, listen for chat start button and call function to decide if enews consent gets checked and set cookies so no autopop happens
		if (onlineStartChatButton) {
			onlineStartChatButton.addEventListener("click", function () {
				preCheckConsent("online");
				setAutoPopupCookie("chatAutoPopup", chatCookieMaxAge);
				setAutoPopupCookie("chatAutoPopupBlock", chatCookieMaxAge);
			});
		}

		// when chat is offline, add click listener, call function to decide if enews consent gets checked and call next function
		if (offlineNextButton) {
			offlineNextButton.addEventListener("click", offlinePageTwo);
			preCheckConsent("offline");
		}
	}

	// Precheck email consent box for users in US, India, and Australia when chat is online and add privacy policy
	function preCheckConsent(chatStatus) {
		let consentButtonClass;
		let consentMessageDivClass;
		const privacyPolicy = '<a class="js-chat-button-privacy" href="https://www.nathab.com/privacy-policy/" target="_blank">Privacy Policy</a>';

		if (chatStatus === "online") {
			consentButtonClass = ".olark-gdpr-consent-checkbox";
			consentMessageDivClass = ".olark-gdpr-consent-message";
		}
		if (chatStatus === "offline") {
			consentButtonClass = ".olark-survey-form-input.olark-survey-form-checkbox";
			consentMessageDivClass = ".olark-survey-form-input-wrap";
		}

		waitUntilElementExists(consentButtonClass).then(countryCheck);
		waitUntilElementExists(consentMessageDivClass).then(insertPrivacyPolicy);

		function countryCheck() {
			let userCountry = localStorage.getItem("country") || "unknown";
			const consentButton = document.querySelector(consentButtonClass);
			if (userCountry === "US" || userCountry === "IN" || userCountry === "AU") {
				if (consentButton.checked === false) {
					consentButton.click();
				}
			}
		}

		function insertPrivacyPolicy() {
			const consentMessageDiv = document.querySelector(consentMessageDivClass);
			const privacyPolicyElement = document.querySelector(".js-chat-button-privacy");
			if (!privacyPolicyElement) {
				consentMessageDiv.insertAdjacentHTML("beforeend", privacyPolicy);
			}
		}
	}

	// When chat is offline, switch mailbox icon to eNews icon on page 2
	function offlinePageTwo() {
		document.querySelector(".olark-button").removeEventListener("click", offlinePageTwo);
		const mailboxIconClass = ".olark-survey-form-emoji-wrap svg";
		waitUntilElementExists(mailboxIconClass).then(iconSwitch);

		function iconSwitch() {
			const mailboxIcon = document.querySelector(mailboxIconClass);
			const enewsIcon = '<img class="js-chat-enews-icon" ignore-cdn src="https://cdn.filestackcontent.com/A6dTpd53SmIg0pBfJJhgAz/cache=expiry:31536002/https://www.nathab.com/uploaded-files/_global/thumbnail-enews-v11.png"></img>';
			const enewsIconElement = document.querySelector(".js-chat-enews-icon");
			if (!enewsIconElement) {
				mailboxIcon.insertAdjacentHTML("beforebegin", enewsIcon);
			}
		}
	}

	// MAIN FUNCTIONS TO AUTO POPUP CHAT
	// Initial 90 second chat auto popup
	function autoPopChatAfterXSeconds(isOperatorAvailable) {
		const autopopDelay = 90000; // 90 seconds
		// const autopopDelay = 15000; // 15 seconds for testing

		// auto popup chat only on desktop && if operator is online
		if (browserDevice !== "desktop" || isOperatorAvailable !== true) {
			return;
		}

		// autopop only if chat is online, autopop blocking cookie is not set, and at least 90 seconds have passed
		let chatCookieCheck = cookieValueCheck("chatAutoPopup");
		if (getCookie("chatAutoPopupBlock") === "true" || chatCookieCheck < autopopDelay) {
			return;
		}

		// set cookie if not already set
		if (chatCookieCheck === "none") {
			setAutoPopupCookie("chatAutoPopup", chatCookieMaxAge);
			return;
		}

		// if no modal is open and no video is playing, auto pop chat and set cookies
		modalAndVideoCheck = callOpenModalAndVideoFunctions();
		if (modalAndVideoCheck === false) {
			openChat(isOperatorAvailable);
			setAutoPopupCookie("chatAutoPopup", "0"); //remove (expire) cookie so other auto popup works
			setAutoPopupCookie("chatAutoPopupBlock", chatCookieMaxAge);
		}
	}
}

// User-action-initiated chat auto popup occurs after user submits Ask a Question, Send Us a Message, or downloads PDF forms or opens a date or pricing accordion
function autoPopChatUserAction(inputID) {
	const inputDiv = document.querySelector(inputID);
	const bodyDiv = document.querySelector("body");
	const userActionAutopopDelay = 15000; // 15 seconds
	let modalInputDiv;
	let accordionInputDiv;

	// auto popup chat only on desktop && if operator is online
	let isOperatorAvailable = checkChatStatus();
	if (getBrowserDevice() !== "desktop" || isOperatorAvailable !== true) {
		return;
	}

	// assign variable whether modal or accordion to determine how chat auto popup is executed
	if (inputDiv.hasAttribute("accordion")) {
		accordionInputDiv = inputDiv;
	} else {
		modalInputDiv = inputDiv;
	}

	// if input that triggered function is an open modal, add click listener to know when it's closed
	if (modalInputDiv && modalInputDiv.checked) {
		bodyDiv.addEventListener("click", shouldChatAutoPop);
	}

	// if input that triggered function is an open accordion, call chat auto popup to open on top of accordion
	if (accordionInputDiv) {
		shouldChatAutoPop();
	}

	function shouldChatAutoPop() {
		const chatCookieMaxAge = "43200"; // 43200 seconds = 12 hours

		// don't auto popup chat if the form is still open
		if (modalInputDiv && modalInputDiv.checked) {
			return;
		}
		// don't auto popup chat if user action autopop has happened within 12 hours (both cookies have a value)
		let chatCookieCheck = cookieValueCheck("chatAutoPopup");
		if (chatCookieCheck !== "none" && getCookie("chatAutoPopupBlock") === "true") {
			return;
		}
		// don't auto popup chat if any modal is open or video is playing
		let modalAndVideoCheck = callOpenModalAndVideoFunctions();
		if (modalAndVideoCheck === true) {
			return;
		}

		if (modalInputDiv || (accordionInputDiv && accordionInputDiv.checked)) {
			// set session in case user goes to a new page before chat is auto popped
			sessionStorage.setItem("chatAutoPopupSession", Number(Date.now()));

			// 15 second delay
			setTimeout(function () {
				// need to recheck this in case modal or video opened after Thank You message closed and before chat is popped
				modalAndVideoCheck = callOpenModalAndVideoFunctions();
				if (modalAndVideoCheck === true) {
					bodyDiv.addEventListener("click", () => {
						modalAndVideoCloseTimerForAccordion(isOperatorAvailable);
					});
					return;
				}

				if (getCookie("chatAutoPopupBlock") === "true") return;

				openChat(isOperatorAvailable);
				if (chatCookieCheck === "none") {
					setAutoPopupCookie("chatAutoPopup", chatCookieMaxAge);
				}
				setAutoPopupCookie("chatAutoPopupBlock", chatCookieMaxAge);

				// remove listener on all accordions after the first one is opened and triggers chat auto popup
				if (accordionInputDiv && accordionInputDiv.checked) {
					removeAccordionClickListener();
				}
			}, userActionAutopopDelay);
		}
	}
}

// AUTO POPUP HELPER FUNCTIONS
// Check online/offline chat status
function checkChatStatus() {
	const chatButtonDesktop = document.querySelector(".js-chat-button-desktop");
	if (chatButtonDesktop.classList.contains("chatoff")) {
		return false;
	}
	const olarkTopBarText = document.querySelector(".olark-top-bar-text");
	if (!olarkTopBarText) {
		return "blocked"; // olark not rendered so likely blocking 3rd party cookies
	}

	if (olarkTopBarText.textContent.toLowerCase().includes("offline")) {
		return false;
	} else {
		return true;
	}
}

//  As a pre-condition to auto popping chat, call functions to check if any modal is open or a video is playing
function callOpenModalAndVideoFunctions() {
	let isModalOpen = checkForOpenModals();
	let wistiaVideoPlayStatus = checkIfWistiaVideoPlaying();
	if (isModalOpen === false && wistiaVideoPlayStatus === false) {
		return false;
	} else {
		return true;
	}
}

// Remove click listeners on all accordions after one has been opened and triggered chat auto pop
function removeAccordionClickListener() {
	const datesAndPricingAccordions = document.querySelectorAll('[accordion="checkbox"]');
	datesAndPricingAccordions.forEach(function (accordion) {
		accordion.removeEventListener("click", accordionClickListener);
	});
}

// Timer function in case user has opened modal/video after accordion timer is set and before chat popup happens to pop chat after modal/video is closed
function modalAndVideoCloseTimerForAccordion(isOperatorAvailable) {
	const closeTimerDelay = 1500; // 1.5 second delay
	const bodyDiv = document.querySelector("body");

	const modalAndVideoCheck = callOpenModalAndVideoFunctions();
	if (modalAndVideoCheck === false) {
		setTimeout(function () {
			openChat(isOperatorAvailable);
			bodyDiv.removeEventListener("click", () => {
				modalAndVideoCloseTimerForAccordion(isOperatorAvailable);
			});
			removeAccordionClickListener(); // remove listener on all accordions after the first one is open and triggers chat auto popup
			let chatCookieCheck = cookieValueCheck();
			if (chatCookieCheck === "none") {
				setAutoPopupCookie("chatAutoPopup", chatCookieMaxAge);
			}
			setAutoPopupCookie("chatAutoPopupBlock", chatCookieMaxAge);
		}, closeTimerDelay);
	}
}

// UTILITY FUNCTIONS
// Utility function to check cookie or session
function cookieValueCheck(cookie) {
	let currentTime = Number(Date.now());
	let currentCookieValue;
	if (cookie === "chatAutoPopupSession") {
		currentCookieValue = sessionStorage.getItem("chatAutoPopupSession") || currentTime;
	} else {
		currentCookieValue = Number(getCookie(`${cookie}`) || currentTime);
	}
	let timeDiff = currentTime - currentCookieValue;
	if (cookie === "chatAutoPopupSession") {
		return timeDiff;
	}
	if (currentCookieValue === currentTime) {
		return "none";
	} else {
		return timeDiff;
	}
}

// Utility function to set cookie
function setAutoPopupCookie(cookie, expiration) {
	let currentTime = Number(Date.now());
	let autoPopupCookieValue;
	if (cookie === "chatAutoPopup") {
		autoPopupCookieValue = currentTime;
	}
	if (cookie === "chatAutoPopupBlock") {
		autoPopupCookieValue = "true";
	}
	document.cookie = `${cookie}=${autoPopupCookieValue}; path=/; domain=nathab.com; max-age=${expiration}`; // 43200 = 12 hour expiration, seconds
}

// Utility function to auto open chat, clear session, and push event
function openChat(isOperatorAvailable) {
	if (isOperatorAvailable !== true) return;
	olark("api.box.expand");
	pushEvent("Olark_Chat", "Auto Popup");
	sessionStorage.removeItem("chatAutoPopupSession");

	const chatButtonStartChatClass = ".olark-button.olark-survey-form-submit";
	waitUntilElementExists(chatButtonStartChatClass).then(chatStartClickListener);

	function chatStartClickListener() {
		const chatButtonStartChat = document.querySelector(chatButtonStartChatClass);
		chatButtonStartChat.addEventListener("click", function (e) {
			pushEvent("Olark_Chat", "Auto Popup", "Chat Started");
		});
	}
}
// Utility function to check whether chat box open
function isChatOpen() {
	const olarkContainer = document.querySelector("#olark-container");
	let isChatBoxOpen = false;

	if (olarkContainer && !olarkContainer.classList.contains("olark-hidden")) {
		isChatBoxOpen = true;
	}

	return isChatBoxOpen;
}

function accordionClickListener(event) {
	if (event.target.checked) {
		let accordionID = event.target.getAttribute("id");
		autoPopChatUserAction(`input[id="${accordionID}"]`); // NOW THAT OLARK IS WRAPPED IN FUNCTION, THIS ISN'T AVAILABLE FOR USE HERE
	}
}

async function pdfModal() {
	await saveUserCountryToLocalStorage();
	let userCountry = localStorage.getItem("country") || "unknown";

	let pageURL = document.querySelector(".js-page-url").innerText.trim();
	let getPageURL = pageURL.split("/");
	let pdf = new Object();
	pdf.formName = "#form-pdf";
	pdf.eventAction = "";
	pdf.catalog = false;
	pdf.catalogElement = document.querySelector("[js-pdf-catalog-toggle]");
	pdf.smsElementParent = document.querySelector(".js-sms-checkbox-pdf");
	pdf.smsElement = document.querySelector("[js-pdf-sms]");
	pdf.phoneElementInput = document.querySelector("[js-pdf-phone-toggle]");
	pdf.phoneElementLabel = document.querySelector('[for~="form-pdf-phone"]');
	pdf.emailElement = document.querySelector("[js-pdf-form-email]");
	pdf.locationSelector = "js-pdf-location";
	pdf.locationFirstElement = document.querySelector(`[${pdf.locationSelector}]`);
	pdf.locationAllElements = document.querySelectorAll(`[${pdf.locationSelector}]`);
	pdf.locationValue = "PDF";
	pdf.linkSelector = document.querySelector("#printpdf");
	pdf.linkHref = `https://nathab-pdf.s3.amazonaws.com/${getPageURL[2]}.pdf`;
	pdf.linkSelector.setAttribute("href", pdf.linkHref);
	pdf.recentTripPDFRequest = $("h1").text();
	pdf.firstInput = document.querySelector("[pdf-form-label]");

	let catalogFieldWrappersForPdf = document.querySelectorAll("[js-pdf-toggle-catalog]"),
		catalogRequiredFieldsForPdf = document.querySelectorAll("[js-pdf-field-required]"),
		pdfScreenRequired = document.querySelector(".js-pdf-required"),
		pdfScreenThankYou = document.querySelector(".js-pdf-thankyou");

	initJsFormatPhone();
	initJsFormatName();

	// // EVENT - Generate image in aside from hero image
	// let pdfAsideImage = document.querySelector(".js-pdf-aside-image");
	// let heroImageSrc = document.querySelector('[jstemplate="trip"]').src;
	// pdfAsideImage.setAttribute("src", heroImageSrc);

	// Event - When catalog request checkbox changes do stuff
	pdf.catalogElement.addEventListener("input", function () {
		if (this.checked) {
			toggleCatalogFieldsForPdf("show");
			pdf.emailElement.setAttribute("pdf-form-field", "100%");
			pushEvent("Misc", "PDF", "Show Catalog Form");
		} else {
			toggleCatalogFieldsForPdf("hide");
			pdf.emailElement.setAttribute("pdf-form-field", "50%");
			pushEvent("Misc", "PDF", "Hide Catalog Form");
		}
	});

	// Event - When SMS checkbox changes do stuff
	function smsCheckbox() {
		pdf.smsElement.addEventListener("input", function () {
			if (this.checked) {
				pdf.phoneElementInput.setAttribute("required", "");
				pdf.phoneElementLabel.setAttribute("pdf-form-label", "required");
			} else {
				pdf.phoneElementInput.removeAttribute("required");
				pdf.phoneElementLabel.setAttribute("pdf-form-label", "");
				pdf.phoneElementInput.classList.remove("js-invalid");
			}
		});
	}

	// EVENT - Add event listener to all elements with the locationSelector
	pdf.locationAllElements.forEach((element) => {
		element.addEventListener("click", function () {
			sessionStorage.setItem("modalOpen", true);

			// pause ambient video when modal is opened
			toggleAmbientVideo(false);

			const countryInput = document.querySelectorAll(`${pdf.formName} .js-smarty-country`);

			if (userCountry !== "unknown") {
				countryInput.forEach((input) => {
					const country = countryList.filter((country) => userCountry === country.code);
					input.value = country[0].name;
				});
			}
			if (userCountry === "US") {
				setNewsletterCheckbox();
				initSmarty(pdf.formName);
				pdf.smsElementParent.classList.remove("hide");
				smsCheckbox();
			} else if (userCountry === "IN" || userCountry === "AU") {
				setNewsletterCheckbox();
			}
			if (checkMarketoForm() === false) {
				initMarketoForm();
			}
			if (pdf.locationValue !== "URL") {
				pdf.locationValue = element.getAttribute(pdf.locationSelector);
			}
			pushEvent("Misc", pdf.locationValue, "Open");

			setTimeout(() => {
				pdf.firstInput.focus();
			}, 1000);
		});
	});

	// EVENT - Check for #refer or in URL
	let linksWithHash = document.querySelectorAll("a[href^='#']");
	let linksWithHashNormalized = [];
	linksWithHash.forEach((link) => {
		let href = link.getAttribute("href").toLowerCase();
		if (href.includes("#pdf")) {
			linksWithHashNormalized.push(link);
		}
	});
	let linksWithLightbox = document.querySelectorAll("a[href~='?lightbox=pdf']");
	let linksCombined = [...linksWithHashNormalized, ...linksWithLightbox];
	addClickEvents(linksCombined);
	function addClickEvents(list) {
		list.forEach((element) => {
			element.addEventListener("click", function (e) {
				e.preventDefault();
				pdf.locationValue = "Link";
				pdf.locationFirstElement.click();
			});
		});
	}

	// EVENT - Check for #hash or ?lightbox=value in URL
	if (pageURL.indexOf("#pdf") > 0 || pageURL.indexOf("#pdf") > 0 || window.location.search.match(/lightbox\=pdf/i)) {
		pdf.locationValue = "URL"; //default
		pdf.locationFirstElement.click();
	}

	// EVENT - Handle submit of required form
	document.querySelector(".js-pdf-button-required").addEventListener("click", function (e) {
		e.preventDefault();
		postFormpdf();
		autoPopChatUserAction("#modal-pdf"); // NOW THAT OLARK IS WRAPPED IN FUNCTION, THIS ISN'T AVAILABLE FOR USE HERE
	});

	function toggleCatalogFieldsForPdf(action) {
		if (action === "show") {
			pdf.catalog = true;
			catalogFieldWrappersForPdf.forEach((element) => {
				element.classList.remove("hide");
			});
			catalogRequiredFieldsForPdf.forEach((element) => {
				element.setAttribute("required", "");
			});
		} else {
			pdf.catalog = false;
			catalogFieldWrappersForPdf.forEach((element) => {
				element.classList.add("hide");
			});
			catalogRequiredFieldsForPdf.forEach((element) => {
				element.removeAttribute("required");
			});
		}
	}

	function copyFieldsToMarketoForm() {
		let fieldsToCopyArray = document.querySelectorAll(`${pdf.formName} [mrkto-field]`);
		fieldsToCopyArray.forEach((field) => {
			let mrktoFieldSelector = field.getAttribute("mrkto-field");
			if (field.value) {
				document.querySelector(mrktoFieldSelector).value = field.value;
			}
		});
	}

	function postFormpdf() {
		let retryLimit = 3,
			retryAttempt = 0;

		// Validate form
		let isValid = isFormValid(pdf.formName);
		if (isValid === false) {
			return;
		}

		// Check for spam
		if (isThisSpam(pdf.formName) === true) {
			return;
		}

		toggleButtonDisabled(document.querySelector(".js-pdf-button-required"));

		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormpdf();
			});
		}

		MktoForms2.whenReady(function () {
			let optins = "";

			pushUtmToMarketoForm(); // function lives in global

			document.querySelector("#recentTripPDFURL").value = pdf.linkHref;
			document.querySelector("#recentTripPDFRequest").value = pdf.recentTripPDFRequest;
			document.querySelector("#sourceDetail").value = pdf.locationValue;
			document.querySelector("#requestedAt").value = document.URL;
			document.querySelector("#LeadSource").value = "www.nathab.com";
			document.querySelector("#recentConversionAction").value = "PDF Download";
			document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
			document.querySelector("#isPDFDownload").value = true;

			if (isNewsletterChecked(pdf.formName) === true) {
				document.querySelector("#isEmailSignup").value = true;
				optins += " eNews,";
				setOptsOnMarketoForm();
			}

			if (isSMSOptinChecked(pdf.formName) === true) {
				document.querySelector("#isSMSSignup").value = true;
				optins += " SMS,";
				setSMSOptsOnMarketoForm();
			}

			if (pdf.catalog === true) {
				document.querySelector("#isCatalogRequested").value = true;
				document.querySelector("#temp").value = "CatRequestIsTrue";
				optins += " Catalog";
			}

			optins = optins || " no optins"; // if empty string, set to no optins
			optins = optins.endsWith(",") ? optins.slice(0, -1) : optins; // get rid of unnecessary ','

			let pushEventString = `Submitted w/${optins}`;
			pushEvent("Misc", pdf.locationValue, pushEventString);

			copyFieldsToMarketoForm(pdf.formName);

			marketoSubmitFormPdf();

			pushEventFacebook();
			pushEventBing();

			setTimeout(() => {
				pdfScreenRequired.classList.add("hide");
				pdfScreenThankYou.classList.remove("hide");
				window.open(pdf.linkHref, "_blank");
				pdfScreenThankYou.scrollTop = 0;
			}, 2750);
		});
	}

	function marketoSubmitFormPdf() {
		if (checkMarketoForm() === false) {
			pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
		}

		MktoForms2.whenReady(function (form) {
			form.submit();
		});
	}
}

async function askModal() {
	await saveUserCountryToLocalStorage();
	let userCountry = localStorage.getItem("country") || "unknown";

	let ask = new Object();
	ask.formName = "#form-ask";
	ask.newsletter = false;
	ask.catalog = false;
	ask.catalogElement = document.querySelector("[js-ask-catalog-toggle]");
	ask.smsElementParent = document.querySelector(".js-sms-checkbox-ask");
	ask.smsElement = document.querySelector("[js-ask-sms]");
	ask.phoneElementInput = document.querySelector("[js-ask-phone-toggle]");
	ask.phoneElementLabel = document.querySelector('[for~="form-ask-phone"]');
	ask.locationSelector = "js-ask-location";
	ask.locationFirstElement = document.querySelector(`[${ask.locationSelector}]`);
	ask.locationAllElements = document.querySelectorAll(`[${ask.locationSelector}]`);
	ask.locationValue = "Unknown";
	ask.firstInput = document.querySelector("[ask-form-label]");

	let catalogFieldWrappersForAsk = document.querySelectorAll("[js-ask-toggle-catalog]"),
		catalogRequiredFieldsForAsk = document.querySelectorAll("[js-ask-field-required]"),
		askScreenRequired = document.querySelector(".js-ask-required"),
		askScreenThankYou = document.querySelector(".js-ask-thankyou");

	initJsFormatPhone();
	initJsFormatName();

	// Function - insert trip name into aside text
	function insertTripNameIntoAsideText() {
		const asideTextSelector = document.querySelector(".js-ask-aside-text");
		const questionTextSelector = document.querySelector(".js-ask-question-text");
		let asideText = asideTextSelector.innerHTML;
		let questionText = questionTextSelector.innerHTML;

		let tripName = document.querySelector(".js-tripName").textContent;
		if (tripName.startsWith("The ")) {
			tripName = tripName.replace("The ", "");
		}

		function updateTripName(selector, oldText) {
			let updatedText = oldText.replace("${tripName}", tripName);
			selector.innerHTML = updatedText;
		}

		updateTripName(asideTextSelector, asideText);
		updateTripName(questionTextSelector, questionText);
	}
	insertTripNameIntoAsideText();

	// Event - When catalog request checkbox changes do stuff
	ask.catalogElement.addEventListener("input", function () {
		if (this.checked) {
			toggleCatalogFieldsForAsk("show");
			pushEvent("Misc", "Ask", "Show Catalog Form");
		} else {
			toggleCatalogFieldsForAsk("hide");
			pushEvent("Misc", "Ask", "Hide Catalog Form");
		}
	});

	// Event - When SMS checkbox changes do stuff
	ask.smsElement.addEventListener("input", function () {
		if (this.checked) {
			ask.phoneElementInput.setAttribute("required", "");
			ask.phoneElementLabel.setAttribute("ask-form-label", "required");
		} else {
			ask.phoneElementInput.removeAttribute("required");
			ask.phoneElementLabel.setAttribute("ask-form-label", "");
			ask.phoneElementInput.classList.remove("js-invalid");
		}
	});

	// Add event listener to all elements that can open this modal
	ask.locationAllElements.forEach((element) => {
		element.addEventListener("click", function () {
			sessionStorage.setItem("modalOpen", true);

			// pause ambient video when modal is opened
			toggleAmbientVideo(false);

			//check eNews box for users in US, India, and Australia
			if (userCountry === "US") {
				setNewsletterCheckbox();
				initSmarty(ask.formName);
				ask.smsElementParent.classList.remove("hide");
			} else if (userCountry === "IN" || userCountry === "AU") {
				setNewsletterCheckbox();
			}
			if (checkMarketoForm() === false) {
				initMarketoForm();
			}
			if (ask.locationValue !== "Ask Question URL") {
				ask.locationValue = element.getAttribute(ask.locationSelector);
			}
			pushEvent("Misc", ask.locationValue, "Open");

			setTimeout(() => {
				ask.firstInput.focus();
			}, 1000);
		});
	});

	// Check for #refer in links
	let linksWithHash = document.querySelectorAll("a[href^='#']");
	let linksWithHashNormalized = [];
	linksWithHash.forEach((link) => {
		let href = link.getAttribute("href").toLowerCase();
		if (href.includes("#ask")) {
			linksWithHashNormalized.push(link);
		}
	});
	let linksWithLightbox = document.querySelectorAll("a[href~='?lightbox=ask']");
	let linksCombined = [...linksWithHashNormalized, ...linksWithLightbox];
	addClickEvents(linksCombined);
	function addClickEvents(list) {
		list.forEach((element) => {
			element.addEventListener("click", function (e) {
				e.preventDefault();
				ask.locationFirstElement.click();
			});
		});
	}

	// Check for #hash or ?lightbox=value in URL
	if (document.URL.indexOf("#ask") > 0 || document.URL.indexOf("#Ask") > 0 || window.location.search.match(/lightbox\=ask/i)) {
		ask.locationValue = "Ask Question URL";
		ask.locationFirstElement.click();
	}

	// EVENT - Handle submit of required form
	document.querySelector(".js-ask-button-required").addEventListener("click", function (e) {
		e.preventDefault();
		postFormAsk();
		autoPopChatUserAction("#modal-ask"); // NOW THAT OLARK IS WRAPPED IN FUNCTION, THIS ISN'T AVAILABLE FOR USE HERE
	});

	function toggleCatalogFieldsForAsk(action) {
		if (action === "show") {
			ask.catalog = true;
			catalogFieldWrappersForAsk.forEach((element) => {
				element.classList.remove("hide");
			});
			catalogRequiredFieldsForAsk.forEach((element) => {
				element.setAttribute("required", "");
			});
		} else {
			ask.catalog = false;
			catalogFieldWrappersForAsk.forEach((element) => {
				element.classList.add("hide");
			});
			catalogRequiredFieldsForAsk.forEach((element) => {
				element.removeAttribute("required");
			});
		}
	}

	function copyaskFieldsToMarketoForm() {
		let fieldsToCopyArray = document.querySelectorAll(`${ask.formName} [mrkto-field]`);
		fieldsToCopyArray.forEach((field) => {
			let mrktoFieldSelector = field.getAttribute("mrkto-field");
			if (field.value) {
				document.querySelector(mrktoFieldSelector).value = field.value;
			}
		});

		// set hidden form textarea id=" askaQuestionText" to visible form text; fixes ${tripName} not getting populated in Marketo
		document.querySelector("#askaQuestionText").value = document.querySelector("#form-ask-askaQuestionText").value;
	}

	function postFormAsk() {
		let retryLimit = 3,
			retryAttempt = 0;
		// Validate form
		let isValid = isFormValid(ask.formName);

		if (isValid === false) {
			return;
		}
		// Check for spam
		if (isThisSpam(ask.formName) === true) {
			return;
		}
		toggleButtonDisabled(document.querySelector(".js-ask-button-required"));
		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormAsk();
			});
		}
		MktoForms2.whenReady(function () {
			let optins = "";
			pushUtmToMarketoForm(); // function lives in global
			document.querySelector("#requestedAt").value = document.URL;
			document.querySelector("#LeadSource").value = "www.nathab.com";
			document.querySelector("#sourceDetail").value = "Ask a Question";
			document.querySelector("#recentConversionAction").value = "Ask a Question";
			document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
			document.querySelector("#isAskQuestion").value = true;
			copyaskFieldsToMarketoForm(ask.formName); // Used for both required and optional

			if (isNewsletterChecked(ask.formName) === true) {
				document.querySelector("#isEmailSignup").value = true;
				optins += " eNews,";
				setOptsOnMarketoForm();
			}

			if (isSMSOptinChecked(ask.formName) === true) {
				document.querySelector("#isSMSSignup").value = true;
				optins += " SMS,";
				setSMSOptsOnMarketoForm();
			}

			if (ask.catalog === true) {
				document.querySelector("#isCatalogRequested").value = true;
				document.querySelector("#temp").value = "CatRequestIsTrue";
				optins += " Catalog";
			}

			optins = optins || " no optins"; // if empty string, set to no optins
			optins = optins.endsWith(",") ? optins.slice(0, -1) : optins; // get rid of unnecessary ','

			let pushEventString = `Submitted w/${optins}`;
			pushEvent("Misc", ask.locationValue, pushEventString);

			marketoSubmitFormAsk();
			pushEventFacebook();
			pushEventBing();

			setTimeout(() => {
				askScreenRequired.classList.add("hide");
				askScreenThankYou.classList.remove("hide");
				askScreenThankYou.scrollTop = 0;
			}, 2750);
		});
	}

	function marketoSubmitFormAsk() {
		if (checkMarketoForm() === false) {
			pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
		}
		MktoForms2.whenReady(function (form) {
			form.submit();
		});
	}
}

function setTripNavPosition() {
	const hero = document.querySelector("[hero]");
	const main = document.querySelector("main");
	const leftNav = document.querySelector("[js-position-left-nav]");
	const tripCTAs = document.querySelector("[js-position-trip-ctas]");
	const magicCTA = document.querySelector("[js-magic-wrapper]");
	const magicHidden = !magicCTA || getCookie("magic") === "hide" ? true : false;
	const buffer = 24;
	let isHeroSticky = true;
	let observer;

	function checkPositions() {
		const browserDevice = getBrowserDevice();
		if (browserDevice === "mobile") return;

		let heightMasthead = getElementProperty("[masthead]", null, "height");
		let heightMagic = magicHidden ? 0 : getElementProperty("[js-magic-wrapper]", "[magic-image-catalog] img", "height");
		let heightTabletBreadcrumbsBar = getElementProperty("[js-tripnav-section-wrapper]", null, "height");

		const heightStickyHero = heightMasthead + buffer;
		let heightNav, heightsAll, heightsNavHero;

		// define variables based on device size
		if (browserDevice === "desktop") {
			const slideshow = document.querySelector("[js-get-slideshow-height]");
			const heightSlideshow = slideshow ? slideshow.offsetHeight : 0;

			heightNav = leftNav ? leftNav.offsetHeight + buffer : 0;
			heightsNavHero = heightNav > heightSlideshow ? heightNav + heightStickyHero : heightSlideshow + heightStickyHero;
			heightsAll = heightsNavHero + heightMagic;
		}

		if (browserDevice === "tablet") {
			heightNav = tripCTAs ? tripCTAs.offsetHeight + heightTabletBreadcrumbsBar + buffer : 0;
			heightsAll = heightNav + heightMagic;
		}

		const heightsNavMagic = heightNav + heightMagic;

		// in case of resize, reset all classes and disconnect observer
		removeAllStaticClasses();
		stopObservingMagicCTA();

		// if all sticky elements fit in the window, keep sticky and set magic default position
		if (window.innerHeight > heightsAll) {
			setDefaultMagicPosition(magicHidden, magicCTA);
			return;
		}

		// if leftnav doesn't fit, make everything static and set magic default position
		if (window.innerHeight <= heightNav) {
			addAllStaticClasses();
			setDefaultMagicPosition(magicHidden, magicCTA);
			return;
		}

		// if hero doesn't fit, make hero static
		if (browserDevice === "desktop" && window.innerHeight <= heightsNavHero) {
			addRemoveClass(hero, "js-static-hero", "add");
			isHeroSticky = false;
		}

		if (magicHidden) return;

		// if leftnav and magic fit, set magic default position
		if (window.innerHeight > heightsNavMagic) {
			setDefaultMagicPosition(magicHidden, magicCTA);

			// if hero is sticky, watch when magicCTA is intersecting with main and remove sticky hero to make room
			if (browserDevice === "desktop" && isHeroSticky) observeMagicCTA();

			// otherwise watch for end of main to show magicCTA
		} else {
			ScrollTrigger.create({
				trigger: main,
				onUpdate: (self) => positionMagicCTA(self.direction, main, magicCTA)
			});
		}
	}

	function removeAllStaticClasses() {
		addRemoveClass(leftNav, "js-static-nav", "remove");
		addRemoveClass(tripCTAs, "js-static-ctas", "remove");
		addRemoveClass(magicCTA, "js-default-magic-position", "remove");
		setAttribute(magicCTA, "js-position", "");
		addRemoveClass(hero, "js-static-hero", "remove");
		isHeroSticky = true;
	}

	function addAllStaticClasses() {
		addRemoveClass(leftNav, "js-static-nav", "add");
		addRemoveClass(tripCTAs, "js-static-ctas", "add");
		addRemoveClass(hero, "js-static-hero", "add");
		isHeroSticky = false;
		setDefaultMagicPosition(magicCTA);
	}

	function observeMagicCTA() {
		observer = new IntersectionObserver(addRemoveStickyHero, {
			rootMargin: "100px 0px 0px 0px"
		});
		observer.observe(magicCTA);
	}

	function addRemoveStickyHero(entries) {
		entries.forEach((entry) => {
			if (entry.isIntersecting) {
				addRemoveClass(hero, "js-static-hero", "add");
			} else if (isHeroSticky) {
				addRemoveClass(hero, "js-static-hero", "remove");
			}
		});
	}

	function stopObservingMagicCTA() {
		if (observer) {
			observer.disconnect();
		}
	}

	// Run the function initially and when the window is resized
	checkPositions();
	window.addEventListener("resize", checkPositions);
}

function getElementProperty(selector, childSelector, property) {
	const element = document.querySelector(selector);
	if (element) {
		const child = childSelector ? element.querySelector(childSelector) : element;
		const styles = window.getComputedStyle(child);
		return parseFloat(styles.getPropertyValue(property));
	}
	return 0;
}

function addRemoveClass(element, className, condtion) {
	if (!element) return;
	if (condtion === "remove") element.classList.remove(className);
	if (condtion === "add") element.classList.add(className);
}

function setAttribute(element, attributeName, value) {
	if (!element) return;
	element.setAttribute(attributeName, value);
}

function setDefaultMagicPosition(magicHidden, magicCTA) {
	if (magicHidden) return;
	addRemoveClass(magicCTA, "js-default-magic-position", "add");
	setAttribute(magicCTA, "js-position", "js-default-magic-position");
}

function positionMagicCTA(direction, main, magicCTA) {
	let mainPosition = ScrollTrigger.positionInViewport(main, "bottom");

	// scrolling down
	if (direction === 1 && mainPosition < 0.85) {
		addRemoveClass(magicCTA, "js-reposition-magic", "add");
	}

	// scrolling up
	if (direction === -1 && mainPosition > 0.8) {
		addRemoveClass(magicCTA, "js-reposition-magic", "remove");
	}
}

// to do : write test
// to do : review and refactor
function showMastheadOnUpwardScroll() {
	document.addEventListener("readystatechange", (event) => {
		if (event.target.readyState === "complete") {
			function scrollWatchForMasthead() {
				const html = document.querySelector(".js-scroll-trigger");
				const masthead = document.querySelector(".js-scroll-target");
				const megaReset = document.querySelector("#mega-reset");
				const heroGradient = document.querySelector("[gradient]");
				let gradient = heroGradient.getAttribute("gradient");
				const scrollUpPostionBuffer = 0.25;
				const scrollDownPostionBuffer = -0.15;
				let scrollUpPositionTarget = 0;
				let scrollDownPositionTarget = scrollDownPostionBuffer;
				const magicCTA = document.querySelector("[magic]");

				function getGradientValue() {
					if (gradient === "auto") {
						setTimeout(() => {
							gradient = heroGradient.getAttribute("gradient");
							if (gradient === "auto") {
								getGradientValue();
							}
						}, 100);
					}
				}
				getGradientValue(); // sneaky little recursive hack to get gradient once that code final runs

				// Plugin: https://greensock.com/docs/v3/Plugins/ScrollTrigger/static.create()
				ScrollTrigger.create({
					trigger: html,
					onUpdate: (self) => toggleMasthead(self.direction)
				});

				function toggleMasthead(direction) {
					// direction key : -1 up, 1 down
					// Plugin: https://greensock.com/docs/v3/Plugins/ScrollTrigger/static.positionInViewport()
					let position = ScrollTrigger.positionInViewport(html, "top");

					// IMPORTANT: masthead and magicCTA are moving together; when masthead is showing, magicCTA is repositioned to lower on the page

					// Scrolling up, set scrollDownTarget
					if (direction === -1 && position > scrollUpPositionTarget) {
						masthead.classList.remove("js-masthead-hide");
						masthead.classList.add("js-masthead-show");
						scrollDownPositionTarget = position + scrollDownPostionBuffer;
						magicCTA.classList.remove("js-reposition-magic", "js-default-magic-position");
					}

					// Scrolling down, set scrollUpTarget
					if (direction === 1 && position < scrollDownPositionTarget) {
						megaReset.checked = true;
						masthead.classList.add("js-masthead-hide");
						masthead.classList.remove("js-masthead-show");
						scrollUpPositionTarget = position + scrollUpPostionBuffer;
						if (magicCTA.getAttribute("js-position") === "js-default-magic-position") {
							magicCTA.classList.add("js-default-magic-position");
						}
					}

					// Reset Masthead
					if (position === 0) {
						setTimeout(() => {
							masthead.classList.remove("js-masthead-show");
						}, 500);
					}
				}
			}
			scrollWatchForMasthead();
		}
	});
}

// does not make sense that this is in this folder
// split for mobile and desktop
function mobileSiteNavHandler() {
	const mobileNavToggleLinks = document.querySelectorAll("[js-click-toggle]"); // this attribute also exists on modal close buttons
	const modalReset = document.querySelector("#modal-reset");

	mobileNavToggleLinks.forEach((link) => {
		link.addEventListener("click", function () {
			let targetElementName = link.getAttribute("js-click-toggle");
			let targetElementNameToTitle = targetElementName.charAt(0).toUpperCase() + targetElementName.slice(1);
			if (targetElementName) {
				pushEvent("Misc", `${targetElementNameToTitle} Mobile Nav`, "Clicked");
			}
			modalReset.setAttribute("modal-toggle", targetElementName);
			sessionStorage.setItem("modalOpen", false);

			toggleAmbientVideo(true);
		});
	});
}

async function modalCatalog() {
	await saveUserCountryToLocalStorage();
	let userCountry = localStorage.getItem("country") || "unknown";

	let pageURL = document.URL;
	let catalog = new Object();
	let enewsChecked, smsChecked;
	catalog.formName = "#form-catalog";
	catalog.newsletter = false;
	catalog.smsElementParent = document.querySelector(".js-sms-checkbox-catalog");
	catalog.smsElement = document.querySelector("[js-catalog-sms]");
	catalog.phoneElementInput = document.querySelector("[js-catalog-phone-toggle]");
	catalog.phoneElementLabel = document.querySelector('[for~="form-catalog-phone"]');
	catalog.locationSelector = "js-catalog-location";
	catalog.locationFirstElement = document.querySelector(`[${catalog.locationSelector}]`);
	catalog.locationAllElements = document.querySelectorAll(`[${catalog.locationSelector}]`);
	catalog.locationValue = "Unknown";
	catalog.firstInput = document.querySelector("[catalog-form-label]");

	let catalogScreenRequired = document.querySelector(".js-catalog-required"),
		catalogScreenOptional = document.querySelector(".js-catalog-optional"),
		catalogScreenThankYou = document.querySelector(".js-catalog-thankyou");

	initJsFormatPhone();
	initJsFormatName();

	// Event - When SMS checkbox changes do stuff
	function smsCheckbox() {
		catalog.smsElement.addEventListener("input", function () {
			if (this.checked) {
				catalog.phoneElementInput.setAttribute("required", "");
				catalog.phoneElementLabel.setAttribute("catalog-form-label", "required");
			} else {
				catalog.phoneElementInput.removeAttribute("required");
				catalog.phoneElementLabel.setAttribute("catalog-form-label", "");
			}
		});
	}
	// EVENT - Add event listener to all elements with the locationSelector
	catalog.locationAllElements.forEach((element) => {
		element.addEventListener("click", function () {
			sessionStorage.setItem("modalOpen", true);

			// pause ambient video when modal is opened
			toggleAmbientVideo(false);

			const countryInput = document.querySelectorAll(`${catalog.formName} .js-smarty-country`);
			if (userCountry !== "unknown") {
				countryInput.forEach((input) => {
					const country = countryList.filter((country) => userCountry === country.code);
					input.value = country[0].name;
				});
			}

			//check eNews box for users in US, India, and Australia
			if (userCountry === "US") {
				setNewsletterCheckbox();
				initSmarty(catalog.formName);
				catalog.smsElementParent.classList.remove("hide");
				smsCheckbox();
			} else if (userCountry === "IN" || userCountry === "AU") {
				setNewsletterCheckbox();
			}

			if (checkMarketoForm() === false) {
				initMarketoForm();
			}

			if (catalog.locationValue !== "URL") {
				catalog.locationValue = element.getAttribute(catalog.locationSelector);
			}

			pushEvent("Catalog", catalog.locationValue, "Open");

			setTimeout(() => {
				catalog.firstInput.focus();
			}, 1000);
		});
	});

	// EVENT - Check for #catalog or in URL
	let linksWithHash = document.querySelectorAll("a[href^='#']");
	let linksWithHashNormalized = [];
	linksWithHash.forEach((link) => {
		let href = link.getAttribute("href").toLowerCase();
		if (href.includes("#catalog")) {
			linksWithHashNormalized.push(link);
		}
	});
	let linksWithLightbox = document.querySelectorAll("a[href~='?lightbox=catalog']");
	let linksCombined = [...linksWithHashNormalized, ...linksWithLightbox];

	// check it
	if (linksCombined.length > 0) {
		addClickEvents(linksCombined);
		function addClickEvents(list) {
			list.forEach((element) => {
				element.addEventListener("click", function (e) {
					e.preventDefault();
					catalog.locationValue = "Link";
					catalog.locationFirstElement.click();
				});
			});
		}
	}

	// EVENT - Check for #hash or ?lightbox=value in URL
	if (pageURL.indexOf("#catalog") > 0 || pageURL.indexOf("#Catalog") > 0 || window.location.search.match(/lightbox\=catalog/i)) {
		catalog.locationValue = "URL"; //default
		catalog.locationFirstElement.click();
	}

	//EVENT - How did you hear about us? If answer = "Friend", show 'Who Referred You?' input
	let referralOptions = document.querySelector(".js-show-hide-who-referred");
	let friendReferralInput = document.querySelector(".js-show-hide-me");

	referralOptions.addEventListener("input", function () {
		let referralChoice = referralOptions.value;
		if (referralChoice === "Friend") {
			friendReferralInput.classList.remove("hide");
		} else {
			friendReferralInput.classList.add("hide");
		}
	});

	// EVENT - Handle submit of required form
	document.querySelector(".js-catalog-button-required").addEventListener("click", function (e) {
		e.preventDefault();
		postFormCatalog();
	});

	// EVENT - Handle submit of optional form
	document.querySelector(".js-catalog-button-optional").addEventListener("click", function (e) {
		e.preventDefault();
		postFormOptional();
	});

	function createUniqueID() {
		return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (c) {
			let r = (Math.random() * 16) | 0,
				v = c == "x" ? r : (r & 0x3) | 0x8;
			return v.toString(16);
		});
	}

	let uniqueFormId = createUniqueID(); // Used twice, hence the need for the variable

	function copyCatalogFieldsToMarketoForm() {
		let fieldsToCopyArray = document.querySelectorAll(`${catalog.formName} [mrkto-field]`);
		fieldsToCopyArray.forEach((field) => {
			let mrktoFieldSelector = field.getAttribute("mrkto-field");
			if (field.value) {
				document.querySelector(mrktoFieldSelector).value = field.value;
			}
		});
	}

	function pushToMarketoCatalogOptional(formName) {
		let checkboxesToCopyArray = document.querySelectorAll(`${catalog.formName} [mrkto-checkbox]`);
		checkboxesToCopyArray.forEach((checkbox) => {
			let mrktoCheckboxSelector = checkbox.getAttribute("mrkto-checkbox");
			if (checkbox.checked) {
				document.querySelector(mrktoCheckboxSelector).value = checkbox.value;
			}
		});

		let travelFrequency = document.querySelectorAll(`${formName} [name='travel-frequency']`);
		travelFrequency.forEach((radio) => {
			if (radio.checked) {
				document.querySelector("#temp15CatTravelFrequency").value = radio.value;
			}
		});
	}

	function postFormCatalog() {
		let retryLimit = 3,
			retryAttempt = 0;

		// Validate form
		let isValid = isFormValid(catalog.formName);
		if (isValid === false) {
			return;
		}

		// Check for spam
		if (isThisSpam(catalog.formName) === true) {
			return;
		}

		toggleButtonDisabled(document.querySelector(".js-catalog-button-required"));

		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormCatalog();
			});
		}

		MktoForms2.whenReady(function () {
			enewsChecked = isNewsletterChecked(catalog.formName);
			smsChecked = isSMSOptinChecked(catalog.formName);

			pushUtmToMarketoForm(); // function lives in global
			document.querySelector("#catalogOptionalFieldIndicator").value = false;
			document.querySelector("#requestedAt").value = document.URL;
			document.querySelector("#LeadSource").value = "www.nathab.com";
			document.querySelector("#uniqueVisitorID").value = uniqueFormId;
			document.querySelector("#temp").value = "CatRequestIsTrue";
			document.querySelector("#sourceDetail").value = "Catalog Request";
			document.querySelector("#recentConversionAction").value = "Catalog Request";
			document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
			document.querySelector("#isCatalogRequested").value = true;

			copyCatalogFieldsToMarketoForm(catalog.formName); // Used for both required and optional

			if (enewsChecked === true) {
				document.querySelector("#isEmailSignup").value = true;
				setOptsOnMarketoForm();
			}
			if (smsChecked === true) {
				document.querySelector("#isSMSSignup").value = true;

				setSMSOptsOnMarketoForm();
			}

			marketoSubmitFormCatalog();

			pushEvent("Catalog", catalog.locationValue, "Submit Page 1");
			pushEventFacebook();
			pushEventBing();

			limitCheckboxes(catalog.formName);

			setTimeout(() => {
				catalogScreenRequired.classList.add("hide");
				catalogScreenOptional.classList.remove("hide");
			}, 2750);
		});
	}

	function postFormOptional() {
		let retryLimit = 3,
			retryAttempt = 0;
		let optins = "";

		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormOptional();
			});
		}

		toggleButtonDisabled(document.querySelector(".js-catalog-button-optional"));

		document.querySelector("#catalogOptionalFieldIndicator").value = true;

		document.querySelector("#requestedAt").value = document.URL;
		document.querySelector("#LeadSource").value = "www.nathab.com";
		document.querySelector("#uniqueVisitorID").value = uniqueFormId;
		document.querySelector("#temp").value = "CatRequestIsTrue";
		document.querySelector("#sourceDetail").value = "Catalog Request";
		document.querySelector("#recentConversionAction").value = "Catalog Request";
		document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
		document.querySelector("#isCatalogRequested").value = true;

		copyCatalogFieldsToMarketoForm(catalog.formName); // Used for both required and optional

		pushUtmToMarketoForm(); // function lives in global
		pushToMarketoCatalogOptional(catalog.formName); // Only used for catalog optional

		if (isNewsletterChecked(catalog.formName) === true) {
			document.querySelector("#isEmailSignup").value = true;
			optins += " eNews,";
			setOptsOnMarketoForm();
		}

		if (isSMSOptinChecked(catalog.formName) === true) {
			document.querySelector("#isSMSSignup").value = true;
			optins += " SMS";
			setSMSOptsOnMarketoForm();
		}

		optins = optins || " no optins"; // if empty string, set to no optins
		optins = optins.endsWith(",") ? optins.slice(0, -1) : optins; // get rid of unnecessary ','

		let pushEventString = `Submitted w/${optins}`;
		pushEvent("Catalog", catalog.locationValue, pushEventString);

		marketoSubmitFormCatalog(); // Will be used for all forms eventually
		pushEventFacebook();
		pushEventBing();

		setTimeout(function () {
			catalogScreenOptional.classList.add("hide");
			catalogScreenThankYou.classList.remove("hide");
			catalogScreenThankYou.scrollTop = 0;
		}, 3000);
	}

	function marketoSubmitFormCatalog() {
		if (checkMarketoForm() === false) {
			pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
		}

		MktoForms2.whenReady(function (form) {
			form.submit();
		});
	}
}

async function modalEnews() {
	await saveUserCountryToLocalStorage();
	let userCountry = localStorage.getItem("country") || "unknown";

	let pageURL = document.URL;
	let enews = new Object();
	enews.formName = "#form-enews";
	enews.eventAction = "";
	enews.smsElementParent = document.querySelector(".js-sms-checkbox-enews");
	enews.smsElement = document.querySelector("[js-enews-sms]");
	enews.phoneElementInput = document.querySelector("[js-enews-phone-toggle]");
	enews.phoneElementLabel = document.querySelector('[for~="form-enews-phone"]');
	enews.locationSelector = "js-enews-location";
	enews.locationFirstElement = document.querySelector(`[${enews.locationSelector}]`);
	enews.locationAllElements = document.querySelectorAll(`[${enews.locationSelector}]`);
	enews.locationValue = "Unknown";
	enews.firstInput = document.querySelector("[enews-form-label]");

	let eNewsScreenRequired = document.querySelector(".js-enews-required"),
		eNewsScreenThankYou = document.querySelector(".js-enews-thankyou");

	initJsFormatPhone();
	initJsFormatName();

	// EVENT - Populate modal with email from inline enews input
	const populateEmail = () => {
		const inlineEmail = document.getElementById("enews-inline-email");
		const modalEmail = document.getElementById("form-enews-email");
		modalEmail.value = inlineEmail.value;
	};

	// Event - When SMS checkbox changes do stuff
	function smsCheckbox() {
		enews.smsElement.addEventListener("input", function () {
			if (this.checked) {
				enews.phoneElementInput.setAttribute("required", "");
				enews.phoneElementLabel.setAttribute("enews-form-label", "required");
			} else {
				enews.phoneElementInput.removeAttribute("required");
				enews.phoneElementLabel.setAttribute("enews-form-label", "");
				enews.phoneElementInput.classList.remove("js-invalid");
			}
		});
	}

	// EVENT - Add event listener to all elements with the locationSelector
	enews.locationAllElements.forEach((element) => {
		element.addEventListener("click", function (e) {
			sessionStorage.setItem("modalOpen", true);

			// pause ambient video when modal is opened
			toggleAmbientVideo(false);

			if (userCountry === "US") {
				setNewsletterCheckbox();
				enews.smsElementParent.classList.remove("hide");
				smsCheckbox();
			}
			if (checkMarketoForm() === false) {
				initMarketoForm();
			}
			if (enews.locationValue !== "URL") {
				enews.locationValue = element.getAttribute(enews.locationSelector);
			}
			pushEvent("eNews", enews.locationValue, "Open");

			setTimeout(() => {
				enews.firstInput.focus();
			}, 1000);
		});
	});

	enews.locationAllElements.forEach((el) => {
		if (el.getAttribute("js-enews-location") === "Bottom") {
			el.addEventListener("click", function (e) {
				populateEmail();
			});
		}
	});

	// EVENT - Check for #enews or in URL
	let linksWithHash = document.querySelectorAll("a[href^='#']");
	let linksWithHashNormalized = [];
	linksWithHash.forEach((link) => {
		let href = link.getAttribute("href").toLowerCase();
		if (href.includes("#enews")) {
			linksWithHashNormalized.push(link);
		}
	});

	let linksWithLightbox = document.querySelectorAll("a[href~='?lightbox=enews']");
	let linksCombined = [...linksWithHashNormalized, ...linksWithLightbox];
	addClickEvents(linksCombined);
	function addClickEvents(list) {
		list.forEach((element) => {
			element.addEventListener("click", function (e) {
				e.preventDefault();
				enews.locationValue = "Link";
				enews.locationFirstElement.click();
			});
		});
	}
	// EVENT - Check for #hash or ?lightbox=value in URL
	if (pageURL.indexOf("#enews") > 0 || pageURL.indexOf("#eNews") > 0 || window.location.search.match(/lightbox\=enews/i)) {
		enews.locationValue = "URL"; //default
		enews.locationFirstElement.click();
	}

	// EVENT - Handle submit of required form
	document.querySelector(".js-enews-button-required").addEventListener("click", function (e) {
		e.preventDefault();
		postFormEnews();
	});

	function setEnewsBasicsOnMarketoForm() {
		document.querySelector("#sourceDetail").value = enews.locationValue;
		document.querySelector("#requestedAt").value = document.URL;
		document.querySelector("#LeadSource").value = "www.nathab.com";
		document.querySelector("#recentConversionAction").value = "Email Sign-Up";
		document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
	}

	function copyNewsletterFieldsToMarketoForm() {
		let fieldsToCopyArray = document.querySelectorAll(`${enews.formName} [mrkto-field]`);
		fieldsToCopyArray.forEach((field) => {
			let mrktoFieldSelector = field.getAttribute("mrkto-field");
			if (field.value) {
				document.querySelector(mrktoFieldSelector).value = field.value;
			}
		});
	}

	function postFormEnews() {
		let retryLimit = 3,
			retryAttempt = 0;

		// Validate form
		let isValid = isFormValid(enews.formName);
		if (isValid === false) {
			return;
		}

		// Check for spam
		if (isThisSpam(enews.formName) === true) {
			return;
		}

		toggleButtonDisabled(document.querySelector(".js-enews-button-required"));

		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormEnews();
			});
		}

		MktoForms2.whenReady(function () {
			let optins = "";

			pushUtmToMarketoForm(); // function lives in global

			document.querySelector("#isEmailSignup").value = true;

			setEnewsBasicsOnMarketoForm(enews.formName);

			copyNewsletterFieldsToMarketoForm(enews.formName);

			setOptsOnMarketoForm();

			if (isSMSOptinChecked(enews.formName) === true) {
				document.querySelector("#isSMSSignup").value = true;
				optins += " SMS";
				setSMSOptsOnMarketoForm();
			}

			optins = optins || " no optins"; // if empty string, set to no optins
			let pushEventString = `Submitted w/${optins}`;

			pushEvent("eNews", enews.locationValue, pushEventString);

			marketoSubmitFormEnews();
			pushEventFacebook();
			pushEventBing();

			setTimeout(() => {
				eNewsScreenRequired.classList.add("hide");
				eNewsScreenThankYou.classList.remove("hide");
				eNewsScreenThankYou.scrollTop = 0;
			}, 2750);
		});
	}

	function marketoSubmitFormEnews() {
		if (checkMarketoForm() === false) {
			pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
		}

		MktoForms2.whenReady(function (form) {
			form.submit();
		});
	}
}

async function modalMessage() {
	await saveUserCountryToLocalStorage();
	let userCountry = localStorage.getItem("country") || "unknown";

	let pageURL = document.URL;
	let message = new Object();
	message.formName = "#form-message";
	message.newsletter = false;
	message.smsElementParent = document.querySelector(".js-sms-checkbox-message");
	message.smsElement = document.querySelector("[js-message-sms]");
	message.phoneElementInput = document.querySelector("[js-message-phone-toggle]");
	message.phoneElementLabel = document.querySelector('[for~="form-message-phone"]');
	message.locationSelector = "js-message-location";
	message.locationFirstElement = document.querySelector(`[${message.locationSelector}]`);
	message.locationAllElements = document.querySelectorAll(`[${message.locationSelector}]`);
	message.firstInput = document.querySelector("[message-form-label]");

	let messageScreenRequired = document.querySelector(".js-message-required"),
		messageScreenThankYou = document.querySelector(".js-message-thankyou");

	initJsFormatName();

	// Event - When SMS checkbox changes do stuff
	function smsCheckbox() {
		message.smsElement.addEventListener("input", function () {
			if (this.checked) {
				message.phoneElementInput.setAttribute("required", "");
				message.phoneElementLabel.setAttribute("message-form-label", "required");
			} else {
				message.phoneElementInput.removeAttribute("required");
				message.phoneElementLabel.setAttribute("message-form-label", "");
				message.phoneElementInput.classList.remove("js-invalid");
			}
		});
	}

	// EVENT - Add event listener to all elements with the locationSelector
	message.locationAllElements.forEach((element) => {
		element.addEventListener("click", function (e) {
			sessionStorage.setItem("modalOpen", true);

			// pause ambient video when modal is opened
			toggleAmbientVideo(false);

			//check eNews box for users in US, India, and Australia
			if (userCountry === "US" || userCountry === "IN" || userCountry === "AU") {
				setNewsletterCheckbox();
				message.smsElementParent.classList.remove("hide");
				smsCheckbox();
			}
			if (checkMarketoForm() === false) {
				initMarketoForm();
			}
			pushEvent("Misc", "Info Request", "Open");

			setTimeout(() => {
				message.firstInput.focus();
			}, 1000);
		});
	});

	// EVENT - Check for #message or in URL
	let linksWithHash = document.querySelectorAll("a[href^='#']");
	let linksWithHashNormalized = [];
	linksWithHash.forEach((link) => {
		let href = link.getAttribute("href").toLowerCase();
		if (href.includes("#message")) {
			linksWithHashNormalized.push(link);
		}
	});
	let linksWithLightbox = document.querySelectorAll("a[href~='?lightbox=message']");
	let linksCombined = [...linksWithHashNormalized, ...linksWithLightbox];
	addClickEvents(linksCombined);
	function addClickEvents(list) {
		list.forEach((element) => {
			element.addEventListener("click", function (e) {
				e.preventDefault();
				message.locationFirstElement.click();
			});
		});
	}

	// EVENT - Check for #hash or ?lightbox=value in URL
	if (pageURL.indexOf("#message") > 0 || window.location.search.match(/lightbox\=message/i)) {
		message.locationFirstElement.click();
	}

	// EVENT - Handle submit of required form
	document.querySelector(".js-message-button-required").addEventListener("click", function (e) {
		e.preventDefault();
		postFormmessage();
		autoPopChatUserAction("#modal-message"); // NOW THAT OLARK IS WRAPPED IN FUNCTION, THIS ISN'T AVAILABLE FOR USE HERE
	});

	function copymessageFieldsToMarketoForm() {
		let fieldsToCopyArray = document.querySelectorAll(`${message.formName} [mrkto-field]`);
		fieldsToCopyArray.forEach((field) => {
			let mrktoFieldSelector = field.getAttribute("mrkto-field");
			if (field.value) {
				document.querySelector(mrktoFieldSelector).value = field.value;
			}
		});
	}

	function postFormmessage() {
		let retryLimit = 3,
			retryAttempt = 0;

		// Validate form
		let isValid = isFormValid(message.formName);
		if (isValid === false) {
			return;
		}

		// Check for spam
		if (isThisSpam(message.formName) === true) {
			return;
		}

		toggleButtonDisabled(document.querySelector(".js-message-button-required"));

		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormmessage();
			});
		}

		MktoForms2.whenReady(function () {
			let optins = "";

			pushUtmToMarketoForm(); // function lives in global

			document.querySelector("#requestedAt").value = document.URL;
			document.querySelector("#LeadSource").value = "www.nathab.com";
			document.querySelector("#sourceDetail").value = "Send Us a Message";
			document.querySelector("#recentConversionAction").value = "Send Us a Message";
			document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
			document.querySelector("#isSendMessage").value = true;

			copymessageFieldsToMarketoForm(message.formName); // Used for both required and optional

			if (isNewsletterChecked(message.formName) === true) {
				document.querySelector("#isEmailSignup").value = true;
				optins += " eNews";
				setOptsOnMarketoForm();
			}

			if (isSMSOptinChecked(message.formName) === true) {
				document.querySelector("#isSMSSignup").value = true;
				optins += " SMS";
				setSMSOptsOnMarketoForm();
			}

			optins = optins || " no optins"; // if empty string, set to no optins
			let pushEventString = `Submitted w/${optins}`;

			pushEvent("Misc", `Info Request`, pushEventString);

			marketoSubmitFormMessage();

			pushEventFacebook();
			pushEventBing();

			setTimeout(() => {
				messageScreenRequired.classList.add("hide");
				messageScreenThankYou.classList.remove("hide");
				messageScreenThankYou.scrollTop = 0;
			}, 2750);
		});
	}

	function marketoSubmitFormMessage() {
		if (checkMarketoForm() === false) {
			pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
		}

		MktoForms2.whenReady(function (form) {
			form.submit();
		});
	}
}

async function modalRefer() {
	await saveUserCountryToLocalStorage();
	let userCountry = localStorage.getItem("country") || "unknown";

	let pageURL = document.URL;
	let refer = new Object();
	refer.formName = "#form-refer";
	refer.newsletter = false;
	refer.locationSelector = "js-refer-location";
	refer.smsElementParent = document.querySelector(".js-sms-checkbox-refer");
	refer.smsElement = document.querySelector("[js-refer-sms]");
	refer.phoneElementInput = document.querySelector("[js-refer-phone-toggle]");
	refer.phoneElementLabel = document.querySelector('[for~="form-refer-phone"]');
	refer.locationFirstElement = document.querySelector(`[${refer.locationSelector}]`);
	refer.locationAllElements = document.querySelectorAll(`[${refer.locationSelector}]`);
	refer.firstInput = document.querySelector("[refer-form-label]");

	let referScreenRequired = document.querySelector(".js-refer-required"),
		referScreenThankYou = document.querySelector(".js-refer-thankyou");

	initJsFormatName();

	// Event - When SMS checkbox changes do stuff
	refer.smsElement.addEventListener("input", function () {
		if (this.checked) {
			refer.phoneElementInput.setAttribute("required", "");
			refer.phoneElementLabel.setAttribute("refer-form-label", "required");
		} else {
			refer.phoneElementInput.removeAttribute("required");
			refer.phoneElementLabel.setAttribute("refer-form-label", "");
			refer.phoneElementInput.classList.remove("js-invalid");
		}
	});

	// EVENT - Add event listener to all elements with the locationSelector
	refer.locationAllElements.forEach((element) => {
		element.addEventListener("click", function () {
			const countryInput = document.querySelectorAll(`${refer.formName} .js-smarty-country`);
			if (userCountry !== "unknown") {
				countryInput.forEach((input) => {
					const country = countryList.filter((country) => userCountry === country.code);
					input.value = country[0].name;
				});
			}
			if (userCountry === "US") {
				setNewsletterCheckbox();
				initSmarty(refer.formName);
				refer.smsElementParent.classList.remove("hide");
			} else if (userCountry === "IN" || userCountry === "AU") {
				setNewsletterCheckbox();
			}
			if (checkMarketoForm() === false) {
				initMarketoForm();
			}
			pushEvent("Misc", "Refer a Friend", "Open");

			setTimeout(() => {
				refer.firstInput.focus();
			}, 1000);
		});
	});

	// EVENT - Check for #refer or in URL
	let linksWithHash = document.querySelectorAll("a[href^='#']");
	let linksWithHashNormalized = [];
	linksWithHash.forEach((link) => {
		let href = link.getAttribute("href").toLowerCase();
		if (href.includes("#refer")) {
			linksWithHashNormalized.push(link);
		}
	});
	let linksWithLightbox = document.querySelectorAll("a[href~='?lightbox=refer']");
	let linksCombined = [...linksWithHashNormalized, ...linksWithLightbox];
	addClickEvents(linksCombined);
	function addClickEvents(list) {
		list.forEach((element) => {
			element.addEventListener("click", function (e) {
				e.preventDefault();
				refer.locationFirstElement.click();
			});
		});
	}

	// EVENT - Check for #hash or ?lightbox=value in URL
	if (pageURL.indexOf("#refer") > 0 || window.location.search.match(/lightbox\=refer/i)) {
		refer.locationFirstElement.click();
	}

	// EVENT - Handle submit of required form
	document.querySelector(".js-refer-button-required").addEventListener("click", function (e) {
		e.preventDefault();
		postFormRefer();
	});

	function copyReferFieldsToMarketoForm() {
		let fieldsToCopyArray = document.querySelectorAll(`${refer.formName} [mrkto-field]`);
		fieldsToCopyArray.forEach((field) => {
			let mrktoFieldSelector = field.getAttribute("mrkto-field");
			if (field.value) {
				document.querySelector(mrktoFieldSelector).value = field.value;
			}
		});
	}

	function postFormRefer() {
		let retryLimit = 3,
			retryAttempt = 0;

		// Validate form
		let isValid = isFormValid(refer.formName);
		if (isValid === false) {
			return;
		}

		// Check for spam
		if (isThisSpam(refer.formName) === true) {
			return;
		}

		toggleButtonDisabled(document.querySelector(".js-refer-button-required"));

		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormRefer();
			});
		}

		MktoForms2.whenReady(function () {
			let optins = "";

			pushUtmToMarketoForm(); // function lives in global

			document.querySelector("#requestedAt").value = document.URL;
			document.querySelector("#LeadSource").value = "www.nathab.com";
			document.querySelector("#sourceDetail").value = "Refer a Friend";
			document.querySelector("#recentConversionAction").value = "Refer a Friend";
			document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
			document.querySelector("#isFriendReferred").value = true;

			copyReferFieldsToMarketoForm(refer.formName); // Used for both required and optional

			if (isNewsletterChecked(refer.formName) === true) {
				document.querySelector("#isEmailSignup").value = true;
				optins += " eNews";
				setOptsOnMarketoForm();
			}

			if (isSMSOptinChecked(refer.formName) === true) {
				document.querySelector("#isSMSSignup").value = true;
				optins += " SMS,";
				setSMSOptsOnMarketoForm();
			}

			optins = optins || " no optins"; // if empty string, set to no optins
			let pushEventString = `Submitted w/${optins}`;

			pushEvent("Misc", `Refer a Friend`, pushEventString);
			marketoSubmitFormRefer();

			pushEventFacebook();
			pushEventBing();

			setTimeout(() => {
				referScreenRequired.classList.add("hide");
				referScreenThankYou.classList.remove("hide");
				referScreenThankYou.scrollIntoView("true");
			}, 2750);
		});
	}

	function marketoSubmitFormRefer() {
		if (checkMarketoForm() === false) {
			pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
		}

		MktoForms2.whenReady(function (form) {
			form.submit();
		});
	}
}

async function modalDigital() {
	await saveUserCountryToLocalStorage();
	let userCountry = localStorage.getItem("country") || "unknown";

	let pageURL = document.URL;
	let digital = new Object();
	digital.formName = "#form-digital";
	digital.newsletter = false;
	digital.smsElementParent = document.querySelector(".js-sms-checkbox-digital");
	digital.smsElement = document.querySelector("[js-digital-sms]");
	digital.phoneElementInput = document.querySelector("[js-digital-phone-toggle]");
	digital.phoneElementLabel = document.querySelector('[for~="form-digital-phone"]');
	digital.locationSelector = "js-digital-location";
	digital.locationFirstElement = document.querySelector(`[${digital.locationSelector}]`);
	digital.locationAllElements = document.querySelectorAll(`[${digital.locationSelector}]`);
	digital.firstInput = document.querySelector("[digital-form-label]");

	let digitalScreenRequired = document.querySelector(".js-digital-required"),
		digitalScreenThankYou = document.querySelector(".js-digital-thankyou");

	initJsFormatName();

	// Event - When SMS checkbox changes do stuff
	function smsCheckbox() {
		digital.smsElement.addEventListener("input", function () {
			if (this.checked) {
				digital.phoneElementInput.setAttribute("required", "");
				digital.phoneElementLabel.setAttribute("digital-form-label", "required");
			} else {
				digital.phoneElementInput.removeAttribute("required");
				digital.phoneElementLabel.setAttribute("digital-form-label", "");
				digital.phoneElementInput.classList.remove("js-invalid");
			}
		});
	}

	// EVENT - Add event listener to all elements with the locationSelector
	digital.locationAllElements.forEach((element) => {
		element.addEventListener("click", function () {
			sessionStorage.setItem("modalOpen", true);

			// pause ambient video when modal is opened
			toggleAmbientVideo(false);

			//check eNews box for users in US, India, and Australia
			if (userCountry === "US") {
				setNewsletterCheckbox();
				initSmarty(digital.formName);
				digital.smsElementParent.classList.remove("hide");
				smsCheckbox();
			} else if (userCountry === "IN" || userCountry === "AU") {
				setNewsletterCheckbox();
			}
			if (checkMarketoForm() === false) {
				initMarketoForm();
			}
			limitCheckboxes(digital.formName);
			pushEvent("Misc", "Digital Catalog", "Open");

			setTimeout(() => {
				digital.firstInput.focus();
			}, 1000);
		});
	});

	// EVENT - Check for #digital or in URL
	let linksWithHash = document.querySelectorAll("a[href^='#']");
	let linksWithHashNormalized = [];
	linksWithHash.forEach((link) => {
		let href = link.getAttribute("href").toLowerCase();
		if (href.includes("#digital")) {
			linksWithHashNormalized.push(link);
		}
	});
	let linksWithLightbox = document.querySelectorAll("a[href~='?lightbox=digital']");
	let linksCombined = [...linksWithHashNormalized, ...linksWithLightbox];
	addClickEvents(linksCombined);
	function addClickEvents(list) {
		list.forEach((element) => {
			element.addEventListener("click", function (e) {
				e.preventDefault();
				digital.locationFirstElement.click();
			});
		});
	}

	// EVENT - Check for #hash or ?lightbox=value in URL
	if (pageURL.indexOf("#digital") > 0 || window.location.search.match(/lightbox\=digital/i)) {
		digital.locationFirstElement.click();
	}

	// EVENT - Handle submit of required form
	document.querySelector(".js-digital-button-required").addEventListener("click", function (e) {
		e.preventDefault();
		postFormdigital();
	});

	function copydigitalFieldsToMarketoForm() {
		let fieldsToCopyArray = document.querySelectorAll(`${digital.formName} [mrkto-field]`);
		fieldsToCopyArray.forEach((field) => {
			let mrktoFieldSelector = field.getAttribute("mrkto-field");
			if (field.value) {
				document.querySelector(mrktoFieldSelector).value = field.value;
			}
		});
	}

	function postFormdigital() {
		let retryLimit = 3,
			retryAttempt = 0;

		// Validate form
		let isValid = isFormValid(digital.formName);
		if (isValid === false) {
			return;
		}

		// Check for spam
		if (isThisSpam(digital.formName) === true) {
			return;
		}

		toggleButtonDisabled(document.querySelector(".js-digital-button-required"));

		// Check if marketo form has been loaded, if not retry with limits
		if (checkMarketoForm() === false && retryAttempt < retryLimit) {
			initMarketoForm(function () {
				retryAttempt++;
				postFormdigital();
			});
		}

		MktoForms2.whenReady(function () {
			let optins = "";

			pushUtmToMarketoForm(); // function lives in global
			document.querySelector("#requestedAt").value = document.URL;
			document.querySelector("#LeadSource").value = "www.nathab.com";
			document.querySelector("#sourceDetail").value = "Digital Catalog Request";
			document.querySelector("#recentConversionAction").value = "Digital Catalog Request";
			document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
			document.querySelector("#isDigitalCatalog").value = true;

			copydigitalFieldsToMarketoForm(digital.formName); // Used for both required and optional

			if (isNewsletterChecked(digital.formName) === true) {
				document.querySelector("#isEmailSignup").value = true;
				optins += " eNews";
				setOptsOnMarketoForm();
			}

			if (isSMSOptinChecked(digital.formName) === true) {
				document.querySelector("#isSMSSignup").value = true;
				optins += " SMS";
				setSMSOptsOnMarketoForm();
			}

			optins = optins || " no optins"; // if empty string, set to no optins
			let pushEventString = `Submitted w/${optins}`;

			pushEvent("Misc", `Digital Catalog`, pushEventString);

			let checkboxesToCopyArray = document.querySelectorAll(`${digital.formName} [mrkto-checkbox]`);
			checkboxesToCopyArray.forEach((checkbox) => {
				let mrktoCheckboxSelector = checkbox.getAttribute("mrkto-checkbox");
				if (checkbox.checked) {
					document.querySelector(mrktoCheckboxSelector).value = checkbox.value;
				}
			});

			marketoSubmitFormDigital();

			pushEventFacebook();
			pushEventBing();

			setTimeout(() => {
				digitalScreenRequired.classList.add("hide");
				digitalScreenThankYou.classList.remove("hide");
				digitalScreenThankYou.scrollTop = 0;
			}, 2750);
		});
	}

	function marketoSubmitFormDigital() {
		if (checkMarketoForm() === false) {
			pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
		}

		MktoForms2.whenReady(function (form) {
			form.submit();
		});

		window.open("https://issuu.com/natural-habitat-adventures/docs/catalog-2024-2025-natural-habitat-adventures?fr=xKAE9_zU1NQ", "_blank");
	}
}

function modalYoutube() {
	const youtubeModal = document.querySelector("[youtube-modal]");
	const youtubeModalClose = document.querySelector("[youtube-modal-close]");
	const youtubeLinks = document.querySelectorAll("a[href*='youtube.com']");
	const youtubeIframe = document.querySelector("[youtube-modal-iframe]");
	const unsetSrc = "";

	// Function - check url for youtube
	function checkUrlForYoutube() {
		let querystring = new URLSearchParams(window.location.search);
		let modalParam = querystring.get("modal");
		let lightboxParam = querystring.get("lightbox");
		let youtubeSrc = "";

		// Check if either modal or lightbox parameter contains "youtube.com"
		if (modalParam && modalParam.includes("youtube.com")) {
			youtubeSrc = modalParam;
		} else if (lightboxParam && lightboxParam.includes("youtube.com")) {
			youtubeSrc = lightboxParam;
		}

		// If youtubeSrc has been set, decode and open the YouTube modal
		if (!youtubeSrc) return;
		youtubeSrc = decodeURIComponent(youtubeSrc);
		openYoutubeModal(youtubeSrc);
	}
	checkUrlForYoutube();

	// Event : check for youtube links
	function checkLinksForYoutube() {
		youtubeLinks.forEach((item) => {
			let href = item.getAttribute("href");
			if (href.includes("@nathab")) {
				return;
			}
			item.addEventListener("click", (event) => {
				event.preventDefault();
				let youtubeSrc = item.getAttribute("href");
				youtubeSrc = youtubeSrc.replace(/(^.*\?lightbox=)/i, "");
				youtubeSrc = youtubeSrc.replace(/(^.*\?modal=)/i, "");
				if (event.shiftKey) {
					let shiftClickUrl = `https://${window.location.hostname}${window.location.pathname}?modal=${youtubeSrc}`;
					copyToClipboard(shiftClickUrl);
				}
				openYoutubeModal(`${youtubeSrc}`);
			});
		});
	}
	checkLinksForYoutube();

	// Function - Open Youtube Modal
	function openYoutubeModal(src) {
		setSrc(src);
		if (youtubeModal.hasAttribute("open")) return;
		if (!isDialogSupported()) {
			youtubeModal.setAttribute("open", "");
		} else {
			youtubeModal.showModal();
		}
		sessionStorage.setItem("modalOpen", true);
		toggleAmbientVideo(false);
	}

	// Function - Close Youtube Modal
	function closeYoutubeModal() {
		setSrc(unsetSrc);
		if (!isDialogSupported()) {
			youtubeModal.removeAttribute("open");
		} else {
			youtubeModal.close();
		}
	}

	// Function - Set Youtube Src
	function setSrc(src) {
		youtubeIframe.setAttribute("src", src);
	}

	// Event : close event for when modal is open
	document.addEventListener("click", function (event) {
		if (youtubeModal.contains(event.target) || (event.target === youtubeModal && youtubeModal.open)) {
			closeYoutubeModal();
		}
	});

	// Event : close button click
	youtubeModalClose.addEventListener("click", () => {
		closeYoutubeModal();
	});

	// Event : if escape key is pressed (but captures all close events)
	youtubeModal.addEventListener("close", () => {
		closeYoutubeModal();
		sessionStorage.setItem("modalOpen", false);
		toggleAmbientVideo(true);
	});
}

function ebookCTAs() {
	let marketoCampaignName;
	let ebookUrl;

	// Function: do stuff to ebook modal
	async function eBookModal(id) {
		let campaignID = id;
		await saveUserCountryToLocalStorage();
		let userCountry = localStorage.getItem("country") || "unknown";

		let eBook = new Object();
		eBook.formName = "#form-ebook";
		eBook.newsletter = false;
		eBook.firstInput = document.querySelector("#form-ebook-first_name");
		eBook.smsElementParent = document.querySelector(".js-sms-checkbox-ebook");
		eBook.smsElement = document.querySelector("[js-ebook-sms]");
		eBook.phoneElementInput = document.querySelector("[js-ebook-phone-toggle]");
		eBook.phoneElementLabel = document.querySelector('[for~="form-ebook-phone"]');
		eBook.phoneElementLabelRequired = document.querySelector('[for~="form-ebook-phone"] span');

		initJsFormatPhone();
		initJsFormatName();

		const campaignData = {
			tu18oaqav9qkl5yfxsyv: {
				name: "Fundamentals of Nature Photography",
				url: "https://issuu.com/natural-habitat-adventures/docs/nature_photography_fundamentals_ebook?fr=sZDYxNTYwMDUyMTM"
			},
			voupy8wdnwblul6vjl1y: {
				name: "Fundamentals of Nature Photography",
				url: "https://issuu.com/natural-habitat-adventures/docs/nature_photography_fundamentals_ebook?fr=sZDYxNTYwMDUyMTM"
			},
			urqd4tb4mtflhk3tzox6: {
				name: "Polar Bear Photography Guide",
				url: "https://issuu.com/natural-habitat-adventures/docs/polar_bear_photography_guide"
			},
			wjpuhgvxuo1nxcgrgfam: {
				name: "Polar Bear Photography Guide",
				url: "https://issuu.com/natural-habitat-adventures/docs/polar_bear_photography_guide"
			},
			op07bfqilfpg9akgzxvn: {
				name: "Northern Lights Photography Guide",
				url: "https://issuu.com/natural-habitat-adventures/docs/northern-lights-photography-guide"
			},
			quthwhoxff0adv3mp0fs: {
				name: "Galapagos Brochure",
				url: "https://issuu.com/natural-habitat-adventures/docs/feb_galapagos_brochure"
			},
			jnurbdjfkiftde7yhpej: {
				name: "Polar Bear Brochure",
				url: "https://issuu.com/natural-habitat-adventures/docs/mar_polar_bear_brochure"
			},
			h73zz2yn0ttzbpmquk3y: {
				name: "Australia Brochure",
				url: "https://issuu.com/natural-habitat-adventures/docs/jun_australia_brochure"
			}
		};

		if (campaignData[campaignID]) {
			marketoCampaignName = campaignData[campaignID].name;
			ebookUrl = campaignData[campaignID].url;
		}

		sessionStorage.setItem("modalOpen", true);

		// pause ambient video when modal is opened
		toggleAmbientVideo(false);

		pushEvent("Gated Content", "eBook", "Open");

		setTimeout(() => {
			eBook.firstInput.focus();
		}, 1000);

		// if eBook shown on page, prevent itinerary (enews) modal from auto popping
		let pageVisits = Cookies.get("itin");
		if (pageVisits === 1) {
			Cookies.set("itin", 0);
		}

		//check eNews box for users in US, India, and Australia
		if (userCountry === "US") {
			setNewsletterCheckbox();
			initSmarty(eBook.formName);
			eBook.smsElementParent.classList.remove("hide");
			smsCheckbox();
		} else if (userCountry === "IN" || userCountry === "AU") {
			setNewsletterCheckbox();
		}

		// Event - When SMS checkbox changes do stuff
		function smsCheckbox() {
			eBook.smsElement.addEventListener("input", function () {
				if (this.checked) {
					eBook.phoneElementInput.setAttribute("required", "");
					eBook.phoneElementLabel.setAttribute("ebook-form-label", "required");
					eBook.phoneElementLabelRequired.classList.remove("hide");
				} else {
					eBook.phoneElementInput.removeAttribute("required");
					eBook.phoneElementLabel.setAttribute("ebook-form-label", "");
					eBook.phoneElementInput.classList.remove("js-invalid");
					eBook.phoneElementLabelRequired.classList.add("hide");
				}
			});
		}

		// EVENT - Handle submit of required form
		document.querySelector(".js-ebook-submit-button").addEventListener("click", function (e) {
			e.preventDefault();
			postFormEbook();
		});

		function copyEbookFieldsToMarketoForm() {
			let fieldsToCopyArray = document.querySelectorAll(`${eBook.formName} [mrkto-field]`);
			fieldsToCopyArray.forEach((field) => {
				let mrktoFieldSelector = field.getAttribute("mrkto-field");
				if (field.value) {
					document.querySelector(mrktoFieldSelector).value = field.value;
				}
			});
		}

		function postFormEbook() {
			let retryLimit = 3,
				retryAttempt = 0;
			// Validate form
			let isValid = isFormValid(eBook.formName);
			if (isValid === false) {
				return;
			}
			// Check for spam
			if (isThisSpam(eBook.formName) === true) {
				return;
			}
			toggleButtonDisabled(document.querySelector(".js-ebook-submit-button"));
			// Check if marketo form has been loaded, if not retry with limits
			if (checkMarketoForm() === false && retryAttempt < retryLimit) {
				initMarketoForm(function () {
					retryAttempt++;
					postFormEbook();
				});
			}
			MktoForms2.whenReady(function () {
				let optins = "";

				pushUtmToMarketoForm(); // function lives in global
				document.querySelector("#requestedAt").value = document.URL;
				document.querySelector("#LeadSource").value = "www.nathab.com";
				document.querySelector("#sourceDetail").value = "eBook";
				document.querySelector("#iseBookDownload").value = "true";
				document.querySelector("#recentConversionAction").value = "eBook Download";
				document.querySelector("#referringWebsite").value = utmObject.referringWebsite || "";
				document.querySelector("#recenteBookRequest").value = marketoCampaignName;
				document.querySelector("#recenteBookURL").value = ebookUrl;
				copyEbookFieldsToMarketoForm(eBook.formName);

				if (isNewsletterChecked(eBook.formName) === true) {
					document.querySelector("#isEmailSignup").value = true;
					optins += " eNews";
					setOptsOnMarketoForm();
				}

				if (isSMSOptinChecked(eBook.formName) === true) {
					document.querySelector("#isSMSSignup").value = true;
					optins += " SMS";
					setSMSOptsOnMarketoForm();
				}

				optins = optins || " no optins"; // if empty string, set to no optins
				let pushEventString = `Submitted w/${optins}`;

				pushEvent("Gated Content", "eBook", pushEventString);

				marketoSubmitFormEbook();
				pushEventFacebook();
				pushEventBing();

				// click hidden OptinMonster button to advance to success screen
				setTimeout(() => {
					document.querySelector(".js-ebook-goto-success button").click();
				}, 2100);
			});
		}

		function marketoSubmitFormEbook() {
			if (checkMarketoForm() === false) {
				pushEvent("Marketo", "Form", "Not Loaded during marketoSubmitForm()");
			}
			MktoForms2.whenReady(function (form) {
				form.submit();
			});
		}

		// resume ambient video play when modal is closed
		document.addEventListener("om.Campaign.afterClose", function (event) {
			sessionStorage.setItem("modalOpen", false);
			toggleAmbientVideo(true);
		});
	}

	// Function: if campaign is removed above due to open chat, etc. remove these OM classes to make their overlay go away. Worked with OM tech and this was the only solution. Boo Monsty.
	function removeOmOverlay() {
		setTimeout(function () {
			try {
				document.querySelector("html").classList.remove("om-position-popup");
				document.querySelector("body").classList.remove("om-effect-overlay");
			} catch (error) {}
		}, 1500);
	}

	// Event: this runs right before a campaign screen is visible and for every view (yes/no, optin, success)
	document.addEventListener("om.Campaign.load", (event) => {
		let omCampaign = document.querySelector("#om-" + event.detail.Campaign.id);

		// Check if any other modals are open or if inline Wistia video is playing
		if (event.detail.Campaign.view === "optin") {
			if (window.location.pathname.includes("/blog/")) {
				eBookModal(event.detail.Campaign.id);
			} else {
				let isModalOpenOrVideoPlaying = callOpenModalAndVideoFunctions();

				if (isModalOpenOrVideoPlaying || isChatOpen()) {
					omCampaign.remove();
					removeOmOverlay();
				} else eBookModal(event.detail.Campaign.id);
			}
		}
		// Event: when success screen loads, click on ebook link for user
		if (event.detail.Campaign.view === "success") {
			document.querySelector(".js-ebook-goto-url").click();
		}

		// Event: listen for click on bottom nav on mobile to close campaign
		let browserDevice = getBrowserDevice();

		if (browserDevice === "mobile") {
			const mobileMenuLinks = document.querySelectorAll("[nav-site-links--mobile] label");
			mobileMenuLinks.forEach((link) => {
				link.addEventListener("click", function () {
					if (omCampaign) {
						omCampaign.remove();
						removeOmOverlay();
					}
				});
			});
		}
	});
}

function magicCta() {
	const magicCTA = document.querySelector("[magic]");
	const main = document.querySelector("[main]");
	let magicWrapper = document.querySelector("[js-magic-wrapper]");
	let magicClose = document.querySelector("[js-magic-close-button]");

	// check it
	if (!magicWrapper) return;
	if (!magicClose) return;

	// check for cookie
	if (Cookies.get("magic") == "hide") {
		magicWrapper.setAttribute("hide", "all");
	} else {
		magicClose.addEventListener("click", function () {
			setCookie("magic", "hide", 7);
			magicWrapper.setAttribute("hide", "all");
		});
	}

	if (!main) {
		magicCTA.classList.add("js-default-magic-position");
	}

	if (magicCTA.classList.contains("js-default-magic-position")) return;

	function positionMagicCTA(direction) {
		let mainPosition = ScrollTrigger.positionInViewport(main, "bottom");

		// scrolling down
		if (direction === 1 && mainPosition < 0.85) {
			magicCTA.classList.add("js-reposition-magic");
		}

		// scrolling up
		if (direction === -1 && mainPosition > 0.8) {
			magicCTA.classList.remove("js-reposition-magic");
		}
	}

	function setCookie(name, value, days) {
		const date = new Date();
		date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
		const expires = "expires=" + date.toUTCString();
		document.cookie = name + "=" + value + ";" + expires + ";path=/";
	}

	if (getBrowserDevice() === "desktop" && main) {
		ScrollTrigger.create({
			trigger: main,
			onUpdate: (self) => positionMagicCTA(self.direction)
		});
	}
}

// global components try/catch to run first
try {
	enso();
} catch (error) {
	console.error(error);
}

// this must run before other modal functions
try {
	observeAmbientVideo();
} catch (error) {
	console.error(error);
}

// template components try/catch
try {
	checkLinksForAccomodationModal();
} catch (error) {
	console.error(error);
}

try {
	manageBreadcrumbs();
} catch (error) {
	console.error(error);
}

try {
	customModal();
} catch (error) {
	console.error(error);
}

try {
	privateModal();
} catch (error) {
	console.error(error);
}

try {
	pdfModal();
} catch (error) {
	console.error(error);
}

try {
	askModal();
} catch (error) {
	console.error(error);
}

try {
	autoScroll();
} catch (error) {
	console.error(error);
}

try {
	bookNowButton();
} catch (error) {
	console.error(error);
}

try {
	setTripItinerarySubSubClass();
} catch (error) {
	console.error(error);
}

try {
	removeActiveFromOtherLi();
} catch (error) {
	console.error(error);
}

try {
	setTripNavPosition();
} catch (error) {
	console.error(error);
}

// global components try/catch
try {
	saveUserCountryToLocalStorage();
} catch (error) {
	console.error(error);
}

try {
	showMastheadOnUpwardScroll();
} catch (error) {
	console.error(error);
}

try {
	mobileSiteNavHandler();
} catch (error) {
	console.error(error);
}

try {
	modalEnews();
} catch (error) {
	console.error(error);
}

try {
	modalCatalog();
} catch (error) {
	console.error(error);
}

try {
	modalMessage();
} catch (error) {
	console.error(error);
}

try {
	modalRefer();
} catch (error) {
	console.error(error);
}

try {
	modalDigital();
} catch (error) {
	console.error(error);
}

try {
	modalYoutube();
} catch (error) {
	console.error(error);
}

try {
	olarkLoader();
} catch (error) {
	console.error(error);
}

try {
	ebookCTAs();
} catch (error) {
	console.error(error);
}

try {
	magicCta();
} catch (error) {
	console.error(error);
}

try {
	cleanupAnchorTags();
	cleanupAnchorTagsBlankTarget();
} catch (error) {
	console.error(error);
}

try {
	browserSize();
} catch (error) {
	console.error(error);
}

try {
	showHeroPhotoCredit();
} catch (error) {
	console.error(error);
}

try {
	trackSocialClicks("js-social-link-mega", "Menu");
	trackSocialClicks("js-social-link-footer", "Footer");
} catch (error) {
	console.error(error);
}

try {
	setFavIcon();
} catch (error) {
	console.error(error);
}

try {
	checkUrlForAccommodationModal();
} catch (error) {
	console.error(error);
}
//# sourceMappingURL=script.js.map
