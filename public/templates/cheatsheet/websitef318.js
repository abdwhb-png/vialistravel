$(function () {
	$.scrollUp({ scrollName: "scrollUp", scrollDistance: 150, scrollFrom: "top", scrollSpeed: 300, easingType: "linear", animation: "fade", animationInSpeed: 200, animationOutSpeed: 200, scrollText: "Scroll to top", scrollTitle: !1, scrollImg: !1, activeOverlay: !1, zIndex: 2147483647 }),
		$("h2").click(function () {
			var l = $(this);
			l.next().toggleClass("show");
		}),
		$("#transfer-chart").wrapInner("#transfer-chart .enso-overlay-content");
});

// Function: feature for guest facing staff to open/close all cheatsheet accordions
function openCloseCheatsheetAccordions() {
	const openCloseCheatsheetButton = document.querySelector(".js-accordions-button-open");
	const allCheatsheetAccordions = document.querySelectorAll(".js-accordion");

	// Function: open all accordions
	function openCheatsheetAccordions() {
		allCheatsheetAccordions.forEach(function (accordion) {
			accordion.classList.add("show");
			openCloseCheatsheetButton.textContent = "Close All Accordions";
		});
	}

	// Function: close all accordions
	function closeCheatsheetAccordions() {
		allCheatsheetAccordions.forEach(function (accordion) {
			accordion.classList.remove("show");
			openCloseCheatsheetButton.textContent = "Open All Accordions";
		});
	}

	// Event: listen for open/close button click
	openCloseCheatsheetButton.addEventListener("click", function () {
		if (openCloseCheatsheetButton.textContent.includes("Open")) {
			openCheatsheetAccordions();
		} else {
			closeCheatsheetAccordions();
		}
	});

	// Event: listen for Ctl/Cmd + F and automatically open all accordions
	document.addEventListener("keydown", function (event) {
		const platform = navigator.userAgent;
		if (platform.includes("Mac") && event.metaKey && event.key === "f") {
			openCheatsheetAccordions();
		} else if (platform.includes("Win") && event.ctrlKey && event.key === "f") {
			openCheatsheetAccordions();
		}
	});
}
openCloseCheatsheetAccordions();
//# sourceMappingURL=website.js.map
