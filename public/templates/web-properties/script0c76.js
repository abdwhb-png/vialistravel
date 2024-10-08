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

function isDialogSupported() {
	// Directly check for the existence of HTMLDialogElement in the window
	if (!window.HTMLDialogElement) return false;

	// Check if 'show' and 'close' methods are part of the HTMLDialogElement's prototype
	const dialogPrototype = window.HTMLDialogElement.prototype;

	// Return boolean
	return typeof dialogPrototype.show === "function" && typeof dialogPrototype.close === "function";
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
// Utility function to check whether chat box open
function isChatOpen() {
	const olarkContainer = document.querySelector("#olark-container");
	let isChatBoxOpen = false;

	if (olarkContainer && !olarkContainer.classList.contains("olark-hidden")) {
		isChatBoxOpen = true;
	}

	return isChatBoxOpen;
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

// global components

// global components try/catch
try {
	saveUserCountryToLocalStorage();
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
	modalYoutube();
} catch (error) {
	console.error(error);
}

try {
	ebookCTAs();
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
//# sourceMappingURL=script.js.map
