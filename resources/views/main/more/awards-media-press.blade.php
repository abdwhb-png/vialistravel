@extends('layouts.main')

@section('content')
    <input mobile-nav-section="toggle" id="mobile-nav-section" type="checkbox" class="hide-off-canvas">
    <div tripnav-section="wrapper" js-tripnav-section-wrapper="" hide="lg+">
        <x-main.mobile-breadcrumb></x-main.mobile-breadcrumb>
        <label tripnav-section="bar" for="mobile-nav-section">
            <div tripnav-section="hamburger"><span tripnav-section="icon"></span></div>
        </label>
    </div>

    <div main="wrapper">
        <main subpage="wrapper subpage">
            <div subpage="middle">
                <div name="wrapper" enso="">
                    <h1>
                        Our reputation is the foundation for your confidence.
                    </h1>
                </div>
                <div content="wrapper" enso="">Since Natural Habitat Adventures was launched in 1985, we've worked
                    hard to build a reputation that's unsurpassed in the travel industry—and we're proud to be recognized
                    for it by our guests, media, and professional peers alike.&nbsp;</div>

                <div repeater-wrapper="" js-show-for-admin="block" settings="vertical" enso="">
                    <div repeater="title" enso=""></div>
                    <div repeater-options-layout="" js-show-for-admin="grid" class="hide" enso="">

                        <div repeater-options-title=""><span repeater-options-highlight="">Admin Note</span> : Repeater
                            Settings</div>
                        <div repeater-options-text="" hide="md"></div>
                        <div repeater-options-state="" hide="md">
                            Current Settings: <span repeater-options-state-value="">non-trip</span>
                        </div>
                        <a href="?ensoAction=group&amp;name=repeater-options-layout-group" repeater-options-button="">Edit
                            Settings</a>

                    </div>

                    <div repeater-trips="" class="trip-show-non-trip" enso="">

                    </div>
                    <div repeater-trips="" class="non-trip-show-non-trip" enso="">

                        <a href="#awards/" repeater-non-trip="">
                            <div class="hide">
                                Awards
                            </div>
                            <div repeater-photo="">
                                <button repeater="play_button" class="story">
                                    <svg video="play_button" width="18" height="18" viewBox="0 0 18 18"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.5 6.26795C13.8333 7.03775 13.8333 8.96225 12.5 9.73205L7.25 12.7631C5.91667 13.5329 4.25 12.5707 4.25 11.0311L4.25 4.96891C4.25 3.42931 5.91667 2.46706 7.25 3.23686L12.5 6.26795Z"
                                            fill="white"></path>
                                    </svg>

                                    <span>Play</span>
                                </button>
                                <img repeater-img=""
                                    resize-img-src="{{ asset('assets/images') }}/subpage-photos/awards-repeater.jpg"
                                    src="{{ asset('assets/images') }}/subpage-photos/awards-repeater.jpg">
                                <div repeater-tag="" class="hide">

                                </div>
                            </div>
                            <div repeater-text="">
                                <h3 repeater-name="">
                                    Awards
                                </h3>
                                <div repeater-details="">
                                    <div repeater-trip-description="">
                                        Natural Habitat Adventures has repeatedly been recognized for our outstanding trips,
                                        our unyielding commitment to sustainability, and for creating an exceptional work
                                        environment.
                                    </div>
                                </div>
                            </div>
                            <div repeater-button-non-trip="" class="story show"></div>
                        </a>


                        <a href="#media-mentions/" repeater-non-trip="">
                            <div class="hide">
                                Media Mentions

                            </div>
                            <div repeater-photo="">
                                <button repeater="play_button" class="story">
                                    <svg video="play_button" width="18" height="18" viewBox="0 0 18 18"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.5 6.26795C13.8333 7.03775 13.8333 8.96225 12.5 9.73205L7.25 12.7631C5.91667 13.5329 4.25 12.5707 4.25 11.0311L4.25 4.96891C4.25 3.42931 5.91667 2.46706 7.25 3.23686L12.5 6.26795Z"
                                            fill="white"></path>
                                    </svg>

                                    <span>Play</span>
                                </button>
                                <img repeater-img=""
                                    resize-img-src="{{ asset('assets/images') }}/subpage-photos/media-repeater.jpg"
                                    src="{{ asset('assets/images') }}/subpage-photos/media-repeater.jpg">
                                <div repeater-tag="" class="hide">

                                </div>
                            </div>
                            <div repeater-text="">
                                <h3 repeater-name="">
                                    Media Mentions
                                </h3>
                                <div repeater-details="">
                                    <div repeater-trip-description="">
                                        We’re proud of the one-of-a-kind travels we lead, and honored by the accolades the
                                        global press continues to rain on our adventures.
                                    </div>
                                </div>
                            </div>
                            <div repeater-button-non-trip="" class="story show"></div>
                        </a>


                        <a href="#press-room/" repeater-non-trip="">
                            <div class="hide">
                                Press Room
                            </div>
                            <div repeater-photo="">
                                <button repeater="play_button" class="story">
                                    <svg video="play_button" width="18" height="18" viewBox="0 0 18 18"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.5 6.26795C13.8333 7.03775 13.8333 8.96225 12.5 9.73205L7.25 12.7631C5.91667 13.5329 4.25 12.5707 4.25 11.0311L4.25 4.96891C4.25 3.42931 5.91667 2.46706 7.25 3.23686L12.5 6.26795Z"
                                            fill="white"></path>
                                    </svg>

                                    <span>Play</span>
                                </button>
                                <img repeater-img=""
                                    resize-img-src="{{ asset('assets/images') }}/subpage-photos/press-repeater.jpg"
                                    src="{{ asset('assets/images') }}/subpage-photos/press-repeater.jpg">
                                <div repeater-tag="" class="hide">

                                </div>
                            </div>
                            <div repeater-text="">
                                <h3 repeater-name="">
                                    Press Room
                                </h3>
                                <div repeater-details="">
                                    <div repeater-trip-description="">
                                        With every great trip, there is an extraordinary story to be told. As a respected
                                        member of the media, we appreciate your interest in Nat Hab, and we’re happy to help
                                        in any way we can.
                                    </div>
                                </div>
                            </div>
                            <div repeater-button-non-trip="" class="story show"></div>
                        </a>


                    </div>
                </div>

            </div>

            <div trip-name-vert="wrapper 1">
                <div trip-name-vert="sticky">
                    Awards, Media &amp; Press
                </div>
            </div>
        </main>
    </div>
@endsection
