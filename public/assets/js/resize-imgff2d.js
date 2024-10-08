// Utility function to get user's device size. This function is intentionally duplicated here to be available for use within this file. Second instance lives in utilities.js
function getBrowserDevice() {
    if (window.matchMedia("(max-width : 767px)").matches) return "mobile";
    if (
        window.matchMedia("(min-width : 768px) AND (max-width : 1023px)")
            .matches
    )
        return "tablet";
    if (window.matchMedia("(min-width : 1024px)").matches) return "desktop";
    return "unsure";
}

// Accommodation repeaters that are misisng images ... must run before next
// Updated : 12.27.21 - jQuery to Vanilla JS
const fixMissingImages = () => {
    const imagesNodeList = document.querySelectorAll("[lightbox~='open'] img");
    const imagesArray = Array.from(imagesNodeList);
    imagesArray.forEach((image) => {
        const srcValue = image.getAttribute("src");
        if (srcValue == "\xA0" || srcValue == "" || srcValue == " ") {
            let closest = image.closest("[lightbox='open']");
            let forAttr = closest.getAttribute("for");
            forAttr = forAttr.replace("lightbox", "lightSlider");
            image.setAttribute("for", forAttr);
            const thisLightbox = `#${image.getAttribute("for")}`;
            const firstPhotoParent = document.querySelector(`${thisLightbox}`);
            const firstPhoto =
                firstPhotoParent.querySelector("img:first-of-type");
            if (!firstPhoto) return;
            const firstPhotoSrc = firstPhoto.getAttribute("src");
            image.setAttribute("src", firstPhotoSrc);
        }
    });
};
try {
    fixMissingImages();
} catch (error) {
    console.log(error);
}

// change src to filestack
// Updated : 04.21.22 - jQuery to Vanilla JS
const cdnifyImages = () => {
    const cdnSrc =
        "https://cdn.filestackcontent.com/A6dTpd53SmIg0pBfJJhgAz/cache=expiry:31536002/";
    const cdnSrcAccommodations =
        "https://cdn.filestackcontent.com/A6dTpd53SmIg0pBfJJhgAz/resize=width:800,fit:max/quality=value:70/cache=expiry:31536002/";
    const images = document.querySelectorAll("img");
    const imagesArray = Array.from(images);
    let paredDownImages = [];

    imagesArray.forEach((image) => {
        const attributesArray = Array.from(image.attributes);
        let add = true;
        attributesArray.find((attr) => {
            if (
                attr.name === "logo" ||
                attr.name === "resize-img-src" ||
                attr.name === "resize-30-img-src" ||
                attr.name === "hero-desktop" ||
                attr.name === "ignore-cdn"
            ) {
                add = false;
            }
        });
        if (image.parentNode.id === "lightSlider") {
            add = false;
        }
        if (add) {
            paredDownImages.push(image);
        }
    });
    paredDownImages.forEach((image) => {
        let originalSrc = image.getAttribute("src");
        let newSrc;

        if (originalSrc && originalSrc.startsWith("https://process")) return; // Not really needed anymore but left it just in case

        if (originalSrc && originalSrc.startsWith("https://cdn")) return;

        if (originalSrc) {
            originalSrc = originalSrc.replace("https://www.nathab.com", "");
            originalSrc = originalSrc.replace("https://nha.ensocloud.com", "");
            if (
                originalSrc !== "undefined" &&
                !originalSrc.includes("undefined")
            ) {
                if (image.parentNode.hasAttribute("data-thumb")) {
                    newSrc =
                        cdnSrcAccommodations +
                        "https://www.nathab.com" +
                        originalSrc;
                } else {
                    newSrc = cdnSrc + "https://www.nathab.com" + originalSrc;
                }
                image.setAttribute("src", newSrc);
            }
        }
    });
};
try {
    cdnifyImages();
} catch (error) {
    console.log(error);
}

// NEW FEATURE : 06.07.19 - Dynamically set mobile, tablet, desktop hero image
// Updated : 12.27.21 - jQuery to Vanilla JS
const setDynamicImages = () => {
    const imagesNodeList = document.querySelectorAll("[hero-desktop]");
    const imagesArray = Array.from(imagesNodeList);
    imagesArray.forEach((image) => {
        const container = image.closest("div");
        const containerWidth = container ? container.offsetWidth : null;
        const mobile = image.getAttribute("hero-mobile");
        const tablet = image.getAttribute("hero-tablet");
        const desktop = image.getAttribute("hero-desktop");
        let newSrcSet = "undefined";
        const template = image.getAttribute("jstemplate");
        const fsPath =
            "https://cdn.filestackcontent.com/A6dTpd53SmIg0pBfJJhgAz";
        const fsQuality = "/quality=value:60/compress/";
        const fsDomain = "https://www.nathab.com";
        if (containerWidth < 481) {
            if (mobile !== "") {
                newSrcSet = fsPath + fsQuality + fsDomain + mobile;
                image.setAttribute("src", newSrcSet);
            } else if (tablet && tablet !== "") {
                newSrcSet =
                    newSrcSet.replace("undefined", "") +
                    fsPath +
                    fsQuality +
                    fsDomain +
                    tablet;
                image.setAttribute("src", newSrcSet);
            } else {
                image.setAttribute("resize-img-src", desktop); // resize-img-src only works on home
            }
        } else if (containerWidth < 1024) {
            if (tablet && tablet !== "") {
                newSrcSet =
                    newSrcSet.replace("undefined", "") +
                    fsPath +
                    fsQuality +
                    fsDomain +
                    tablet;
                image.setAttribute("src", newSrcSet);
            } else {
                if (template == "page") {
                    image.setAttribute("resize-30-img-src", desktop);
                } else {
                    image.setAttribute("resize-img-src", desktop);
                }
            }
        } else {
            if (template == "page") {
                image.setAttribute("resize-30-img-src", desktop);
            } else {
                image.setAttribute("resize-img-src", desktop);
            }
        }
    });
};
try {
    setDynamicImages();
} catch (error) {
    console.log(error);
}

const containerSizes = [
    {
        min: 1,
        max: 415,
        width: 414,
        usePixelDensityRatio: true,
    },
    {
        min: 414,
        max: 685,
        width: 684,
        usePixelDensityRatio: true,
    },
    {
        min: 684,
        max: 955,
        width: 954,
        usePixelDensityRatio: true,
    },
    {
        min: 954,
        max: 1255,
        width: 1224,
        usePixelDensityRatio: true,
    },
    {
        min: 1224,
        max: 1495,
        width: 1494,
        usePixelDensityRatio: false,
    },
    {
        min: 1494,
        max: 1765,
        width: 1764,
        usePixelDensityRatio: false,
    },
    {
        min: 1764,
        max: 2035,
        width: 2034,
        usePixelDensityRatio: false,
    },
    {
        min: 2564,
        max: null,
        width: 2880,
        usePixelDensityRatio: false,
    },
];

const resize = (attr) => {
    const imagesNodeList = document.querySelectorAll(`[${attr}]`);
    const imagesArray = Array.from(imagesNodeList);
    imagesArray.forEach((image) => {
        if (image.hasAttribute("resized")) return;

        // NOTES :
        // getting closest 'div' is a bit fragile, but with the current patterns set in the architecture (img within parent div),
        // it should be totally fine.  however, the patterns must be maintained in order for this function to
        // continue to work properly.
        const container = image.closest("div"); // should this use a more specific selector like [hero~='photo']

        let containerWidth = container ? container.offsetWidth : null;
        let containerHeight = container ? container.offsetHeight : null;
        if (containerHeight <= 50) {
            containerHeight = 200;
        }
        const smartCropValue = image.getAttribute("hero-smart-crop")
            ? image.getAttribute("hero-smart-crop")
            : "auto";
        const containerRatio = containerHeight / containerWidth;
        // const newAttr = attr.replace(/[\[\]']+/g, ""); // No need to do this if you use template literal on line 167
        let resizeImgSrc = image.getAttribute(attr);

        let originalSrc;
        if (resizeImgSrc) {
            resizeImgSrc.includes("https://www.nathab.com")
                ? (resizeImgSrc = resizeImgSrc.replace(
                      "https://www.nathab.com",
                      ""
                  ))
                : resizeImgSrc;
            originalSrc = "https://www.nathab.com" + resizeImgSrc;
            // image.setAttribute("src", originalSrc); // Turned off for testing, not sure why this is needed considering the fallback on line 221
        }
        let newSrc = "";
        const pixelDensityRatio = window.devicePixelRatio
            ? window.devicePixelRatio
            : 2;
        const fsPath =
            "https://cdn.filestackcontent.com/A6dTpd53SmIg0pBfJJhgAz";
        const fsCropBase = "/smart_crop=";
        const fsCropValue = `width:${Math.floor(
            containerWidth * 1.5
        )},height:${Math.floor(
            containerHeight * 1.5
        )},mode:object,object:${smartCropValue}`;
        const fsResize = "/resize=width:";
        const fsQuality =
            ",fit:max/quality=value:80/cache=expiry:31536000/compress/";
        const isPortrait = containerRatio >= 1 ? true : false;
        if (originalSrc) {
            containerRatio >= 0.5208
                ? (containerWidth = containerHeight * (containerRatio + 1))
                : containerWidth;
            containerSizes.forEach((size) => {
                if (size.min && size.max && !newSrc) {
                    if (
                        containerWidth > size.min &&
                        containerWidth < size.max
                    ) {
                        containerWidth = size.usePixelDensityRatio
                            ? pixelDensityRatio * size.width
                            : size.width;
                        if (
                            isPortrait &&
                            (smartCropValue !== "auto" || !smartCropValue)
                        ) {
                            newSrc =
                                fsPath +
                                fsCropBase +
                                fsCropValue +
                                fsQuality +
                                originalSrc;
                        } else {
                            newSrc =
                                fsPath +
                                fsResize +
                                Math.floor(containerWidth) +
                                fsQuality +
                                originalSrc;
                        }
                    }
                } else {
                    newSrc =
                        fsPath +
                        fsResize +
                        Math.floor(containerWidth) +
                        fsQuality +
                        originalSrc;
                }
            });
            image.setAttribute("src", newSrc || originalSrc); // seems to fallback to originalSrc for homepage when not logged into cms which is interesting
        }
    });
};
try {
    resize("resize-30-img-src");
    resize("resize-img-src");
} catch (error) {
    console.log(error);
}

function setGradientValue() {
    const elementWithGradientAttribute =
        document.querySelector("[js-set-gradient]");

    if (
        !elementWithGradientAttribute ||
        elementWithGradientAttribute.getAttribute("gradient") !== "auto"
    )
        return;

    const userDevice = getBrowserDevice();

    if (userDevice === "mobile") return;

    let imageHero = document.querySelector(".js-get-hero-brightness");

    imageHero.addEventListener("load", () => {
        let brightness = calcHeroBrightness(imageHero);
        brightness = brightness - 35; // We prefer the dark gradient so typing the scales. Def not a hack.
        if (brightness <= 127.5) {
            elementWithGradientAttribute.setAttribute("gradient", "dark");
        } else {
            elementWithGradientAttribute.setAttribute("gradient", "light");
        }
    });
}
try {
    setGradientValue();
} catch (error) {
    console.log(error);
}

function calcHeroBrightness(imageHero) {
    let colorSum = 0;
    let canvas = document.createElement("canvas");
    let ctx = canvas.getContext("2d");
    canvas.width = imageHero.naturalWidth;
    canvas.height = imageHero.naturalHeight;
    ctx.drawImage(imageHero, 0, 0);

    const testWidth = canvas.width;
    const testHeight = 100; //100px
    const imageData = ctx.getImageData(0, 0, testWidth, testHeight);
    const data = imageData.data;
    const testArea = testWidth * testHeight;
    let r, g, b, avg;

    for (let i = 0; i < testArea; i++) {
        r = data[i];
        g = data[++i];
        b = data[++i];
        avg = Math.floor(r + g + b);
        colorSum = colorSum + avg;
    }
    return Math.floor(colorSum / testArea);
}
//# sourceMappingURL=resize-img.js.map
