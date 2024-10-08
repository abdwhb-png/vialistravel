var oldWidgetsData = {
    displaySlides: "18",
    reviewsRef: "7706706ff7f670fb35805810f486d4d5b543362c",
    layoutType: "boxed_reviews_1",
    lightboxLayoutType: "slider",
    filterKeyword: "",
    filterRating: "",
    queryTags: "",
    reviewsLoadMoreURL: "https://embedsocial.com/api/get_reviews_page",
    getLightboxReviewsURL: "https://embedsocial.com/api/get_lightbox_reviews",
    getVerticalLightboxReviewsURL:
        "https://embedsocial.com/api/get_vertical_lightbox",
    imageFixedWidth: false,
    imageWidth: "210px",
    filterPageReviewsURL: "https://embedsocial.com/api/get_reviews_page",
    testimonialFormURL:
        "https://embedsocial.com/api/testimonial_form/7706706ff7f670fb35805810f486d4d5b543362c?locale=en",
    paginationType: "loadmore",
    autoplayIsEnabled: true,
    sliderAutoPlayInterval: parseInt("2000"),
    numSlides: "dynamic",
    fixedReviewsTextHeight: true,
};

function showLightbox(index, page) {
    var ratings = [];
    var ratingCheckboxs = document.querySelectorAll(".reviews-rating:checked");
    for (i = 0; i < ratingCheckboxs.length; i++) {
        ratings.push(ratingCheckboxs[i].value);
    }
    var filter = document.getElementById("filter-reviews")
        ? document.getElementById("filter-reviews").value.trim()
        : "";
    var lightboxLayout = "slider";
    var src =
        oldWidgetsData.getLightboxReviewsURL +
        "/" +
        oldWidgetsData.reviewsRef +
        "/" +
        index +
        "/" +
        page +
        "?filterKeyword=" +
        filter +
        "&filterRating=" +
        ratings.toString() +
        oldWidgetsData.queryTags;
    if (oldWidgetsData.lightboxLayoutType !== "slider") {
        lightboxLayout = oldWidgetsData.lightboxLayoutType;
        src =
            oldWidgetsData.getVerticalLightboxReviewsURL +
            "/" +
            oldWidgetsData.reviewsRef +
            oldWidgetsData.queryTags;
    }
    var msgData = {
        reviewsRef: oldWidgetsData.reviewsRef,
        index: index,
        page: page,
        src: src,
        action: "create",
        type: lightboxLayout,
    };
    if ("parentIFrame" in window) {
        parentIFrame.sendMessage(msgData);
    }
    if (oldWidgetsData.layoutType === "slider_2") {
        swiper.autoplay.stop();
    }
}
document.addEventListener("keydown", function (e) {
    var e = window.event ? window.event : e;
    var keys = [37, 39, 27];
    if (keys.indexOf(e.keyCode) > -1) {
        if ("parentIFrame" in window) {
            parentIFrame.sendMessage({
                navigationCode: e.keyCode,
                reviewsRef: oldWidgetsData.reviewsRef,
            });
        }
    } else if (e.keyCode == 13) {
        var closestEl = closest(e.target, ".f-onclick-event");
        var childEl = e.target.querySelector(".f-onclick-event");
        if (closestEl) {
            closestEl.click();
        } else if (childEl) {
            childEl.click();
        }
    }
});
function showReviewsForm(linkSource, id) {
    var src = oldWidgetsData.testimonialFormURL;
    if (linkSource == "facebook") {
        src = "https://www.facebook.com/" + id + "/reviews";
        return window.open(src, "_blank");
    }
    if (linkSource == "google") {
        src = "https://search.google.com/local/writereview?placeid=" + id;
        return window.open(src, "_blank");
    }
    var msgData = {
        reviewsRef: oldWidgetsData.reviewsRef,
        src: src,
        type: "collect",
        iframeId:
            "parentIFrame" in window
                ? parentIFrame.getId()
                : "embedIFrame_" + oldWidgetsData.reviewsRef,
        action: "create",
    };
    parentIFrame.sendMessage(msgData);
}
function showReadMore(reviewId) {
    document.getElementById("review_text_" + reviewId).style.display = "none";
    document.getElementById("read_more_review_" + reviewId).style.display =
        "block";
    if (oldWidgetsData.layoutType === "boxed_reviews_1") {
        initMasonry();
    } else if (
        ["boxed_reviews_2", "boxed_reviews_3", "boxed_reviews_4"].indexOf(
            oldWidgetsData.layoutType
        ) !== -1
    ) {
        captionsVisibility();
    }
}
if (oldWidgetsData.paginationType === "loadmore") {
    function loadMore() {
        document.getElementById("load-more-div").style.display = "none";
        document.getElementById("loading-more-div").style.display = "block";
        var parentDiv = document.getElementsByClassName("reviews-block")[0];
        var http = new XMLHttpRequest();
        var nextNumDivs = document.getElementsByClassName("next-page-num");
        var num = nextNumDivs[nextNumDivs.length - 1].innerHTML.trim();
        var params =
            "reviewsRef=" +
            oldWidgetsData.reviewsRef +
            "&num=" +
            num +
            "&layout=" +
            oldWidgetsData.layoutType +
            oldWidgetsData.queryTags;
        http.open("POST", oldWidgetsData.reviewsLoadMoreURL, true);
        http.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
        );
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                var innerParentDiv = parentDiv.innerHTML;
                innerParentDiv += http.responseText;
                parentDiv.innerHTML = innerParentDiv;
                if (oldWidgetsData.layoutType === "boxed_reviews_1") {
                    initMasonry();
                }
                var nextNumDivs =
                    document.getElementsByClassName("next-page-num");
                if (
                    !nextNumDivs[nextNumDivs.length - 1].innerHTML.trim().length
                ) {
                    var loadMoreBtn = document.getElementById(
                        "load-more-pages-btn"
                    );
                    document
                        .getElementById("li-load-more")
                        .removeAttribute("class");
                    loadMoreBtn.style.display = "none";
                }
                document.getElementById("loading-more-div").style.display =
                    "none";
                document.getElementById("load-more-div").style.display =
                    "block";
            }
        };
        http.send(params);
    }
}
function closest(ele, selector) {
    if (!selector || !ele) {
        return null;
    }
    if (Element && !Element.prototype.matches) {
        Element.prototype.matches =
            Element.prototype.matchesSelector ||
            Element.prototype.mozMatchesSelector ||
            Element.prototype.msMatchesSelector ||
            Element.prototype.oMatchesSelector ||
            Element.prototype.webkitMatchesSelector;
    }
    if (ele.matches(selector)) {
        return ele;
    }
    var parent = ele.parentNode;
    var i = 0;
    while (!parent.matches(selector)) {
        parent = parent.parentNode;
        if (parent.tagName == undefined) {
            return null;
        }
        if (i >= 100) {
            return null;
        }
        i += 1;
    }
    return parent;
}

function initMasonry() {
    var grid = document.querySelector(".grid");
    var masonryParameters = {
        itemSelector: ".grid-item",
        transitionDuration: 0,
    };
    if (oldWidgetsData.imageFixedWidth) {
        masonryParameters.columnWidth = parseInt(
            oldWidgetsData.imageWidth.replace("px", "")
        );
    } else {
        (masonryParameters.columnWidth = ".grid-sizer"),
            (masonryParameters.percentPosition = true);
    }
    var masonry = new Masonry(grid, masonryParameters);
    masonry.layout();
}
initMasonry();
window.addEventListener("load", function () {
    initMasonry();
});
setTimeout(initMasonry, 3e3);
