<div>
    <dialog slideshow="outer new" js-slideshow="" js-get-slideshow-height="" class="show-new" enso="">
        <button slideshow-close="" js-slideshow-close="">
            <span slideshow-close-text="">Close</span>
            <svg slideshow-close-svg="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20"
                height="20">
                <line slideshow-close-svg-line="" x1="4" y1="4" x2="16" y2="16"></line>
                <line slideshow-close-svg-line="" x1="4" y1="16" x2="16" y2="4"></line>
            </svg>
        </button>
        <div slideshow="wrapper">
            <div js-arrows="wrapper">
                <div js-arrow="previous" class="disabled">
                    <svg viewBox="150 25 400 500" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M415.78 122.31c-.27 0-.55.008-.824.035v-.015a8.709 8.709 0 00-5.88 3.046l-130.45 147.84a8.928 8.928 0 00-1.882 2.274c-.016.015-.016.035-.035.05-2.582 4.087-1.363 9.485 2.723 12.075.07.043.14.086.203.132l129.44 146.7c3.027 3.762 8.547 4.36 12.3 1.32 3.755-3.034 4.36-8.546 1.313-12.3a9.668 9.668 0 00-.5-.57l-126.14-142.98 126.14-142.98a8.736 8.736 0 00-.613-12.356 8.535 8.535 0 00-5.797-2.28z">
                        </path>
                    </svg>
                </div>
                <div js-arrow="next">
                    <svg viewBox="150 25 400 500" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M284 122.28c-4.84.203-8.574 4.29-8.375 9.11a8.74 8.74 0 002.238 5.484l126.14 142.98-126.14 142.98c-3.402 3.437-3.367 8.969.051 12.37a8.762 8.762 0 0012.391-.062c.234-.234.465-.5.664-.761l129.46-146.72c3.656-2.188 5.2-6.696 3.656-10.668a8.811 8.811 0 00-2.992-4.22l-130.12-147.47a8.745 8.745 0 00-6.969-3.015z">
                        </path>
                    </svg>
                </div>
            </div>
            <div slideshow="slides" js-export-images="">

                @foreach ($photos as $k => $item)
                    <div slide-new="wrapper" tabindex="0">
                        <div slide="image-wrapper" class="{{ $k == 0 ? 'image-active' : '' }}">
                            <img ignore-cdn="" slide="image" js-image-position="auto" js-slide-img=""
                                data-src="{{ asset('storage/' . $item->path) }}" alt="trip-main-photo"
                                class="image-active" src="{{ asset('storage/' . $item->path) }}"
                                js-image="image-{{ $k }}">

                            <div slide="text-wrapper" class="hide">
                                <div slide="credit">Expedition Leader Jeremy Covert</div>
                                <div slide="caption">Nat Hab guests view polar bear from Polar Rover, Churchill,
                                    Manitoba.</div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div slideshow="navigation">
            @foreach ($photos as $k => $item)
                <div target="image-{{ $k }}" tabindex="0" slideshow="thumbnail"
                    class="{{ $k == 0 ? 'image-active' : '' }}"><img js-image-position="auto"
                        slideshow="thumbnail-image" src="{{ asset('storage/' . $item->path) }}">
                </div>
            @endforeach
        </div>
    </dialog>
</div>
