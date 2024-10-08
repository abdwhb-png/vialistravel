@extends('layouts.main')

@section('content')
    <div main="wrapper">
        <input mobile-nav-section="toggle" id="mobile-nav-section" type="checkbox" class="hide-off-canvas">
        <div tripnav-section="wrapper" js-tripnav-section-wrapper="" hide="lg+">
            <x-main.mobile-breadcrumb></x-main.mobile-breadcrumb>
            <label tripnav-section="bar" for="mobile-nav-section">
                <div tripnav-section="hamburger"><span tripnav-section="icon"></span></div>
            </label>
            <div mobile-nav-section="wrapper" hide="lg+">
                <div mobile-nav-section="stage">
                    <nav mobile-nav-section="nav" class="js-tripnav js-level-2">
                        <ul class="section-navigation-ul" id="">
                            <li id="section-navigation-ul-li-1" class="active"><a href="{{ route('contact-us') }}">Contact
                                    Us</a></li>
                            <li id="section-navigation-ul-li-2"><a href="?lightbox=message">Send Us a Message</a></li>
                            <li id="section-navigation-ul-li-3"><a href="?lightbox=enews">eNews Signup</a></li>
                            <li id="section-navigation-ul-li-4"><a href="/contact/get-a-catalog/">Get Our Catalog by
                                    Mail</a></li>
                            <li id="section-navigation-ul-li-5"><a href="?lightbox=digital">Digital Catalog</a></li>
                        </ul>
                    </nav>
                    <nav mobile-nav-section="nav" hide="all" class="js-tripnav js-level-3">
                        &nbsp;


                    </nav>
                    <nav mobile-nav-section="nav" hide="all" class="js-tripnav js-level-4">
                        &nbsp;

                    </nav>
                </div>
            </div>
        </div>

        <main subpage="wrapper subpage">
            <div subpage="middle">
                <div name="wrapper" enso="">
                    <h1>
                        Contact {{ $site_name }}
                    </h1>
                </div>
                <div content="wrapper" enso="">You can contact us by phone, fax, email or
                    mail. Here's all the info you need to get in contact with us!&nbsp;Please <a
                        href="#catalog"><strong>click here</strong></a> if you would like to receive a copy of our Catalog
                    of <em>The World's Greatest Nature Expeditions</em>. <br>
                    <br>
                    <strong>Email</strong> <br>
                    <a href="?lightbox=message"><strong>Click here to send us a message</strong></a><br>
                    <br>
                    <strong>Phone</strong><br>
                    {{ $site_settings->phone }} <br><br>
                    @if ($site_settings->international_phone)
                        International: {{ $site_settings->phone }} <br><br>
                    @endif
                    <strong>Availability</strong><br>
                    {!! $site_settings->availability !!}
                    <br><br>
                    @if ($site_settings->fax)
                        {{ $site_settings->fax }} <br><br>
                    @endif
                    <strong>Address</strong> <br>
                    {!! $site_settings->address !!}
                </div>

            </div>
            <div tripnav="wrapper" js-position-left-nav="" hide="sm md">
                <nav tripnav="nav" class="js-tripnav js-level-2" role="navigation" enso="">
                    <ul class="section-navigation-ul" id="">
                        <li id="section-navigation-ul-li-1" class="active"><a href="/contact/">Contact Us</a></li>
                        <li id="section-navigation-ul-li-2"><a href="?lightbox=message">Send Us a Message</a></li>
                        <li id="section-navigation-ul-li-3"><a href="?lightbox=enews">eNews Signup</a></li>
                        <li id="section-navigation-ul-li-4"><a href="/contact/get-a-catalog/">Get Our Catalog by Mail</a>
                        </li>
                        <li id="section-navigation-ul-li-5"><a href="?lightbox=digital">Digital Catalog</a></li>
                    </ul>
                </nav>
                <nav tripnav="nav" hide="all" class="js-tripnav js-level-3" role="navigation" enso="">
                    &nbsp;


                </nav>
                <nav tripnav="nav" hide="all" class="js-tripnav js-level-4" role="navigation" enso="">
                    &nbsp;


                </nav>
                <script type="text/javascript">
                    function assignNavLevel(navAttribute) {
                        try {
                            // Determine Level
                            const urlPathname = window.location.pathname;
                            let pathnameArray = urlPathname.split("/");
                            let galapagosPattern = /\/know-before-you-go\/galapagos-islands\/[^/]+/;
                            let antarcticaPattern = /\/know-before-you-go\/antarctica\/[^/]+/;
                            let level;

                            if (galapagosPattern.test(urlPathname) || antarcticaPattern.test(urlPathname)) {
                                level = pathnameArray.length - 2;
                            } else level = pathnameArray.length - 1;
                            const desktopNavDefault = document.querySelector(`${navAttribute}.js-level-2`);

                            if (level === 3) {
                                desktopNavDefault.classList.add("hide");
                                document.querySelector(`${navAttribute}.js-level-3`).removeAttribute("hide");
                            } else if (level >= 4) {
                                desktopNavDefault.classList.add("hide");
                                document.querySelector(`${navAttribute}.js-level-4`).removeAttribute("hide");
                            }
                        } catch (error) {
                            // console.log(error);
                        }
                    }

                    // This variable must be set here to work
                    document.addEventListener("DOMContentLoaded", function() {
                        // Feature - On/Off
                        let specialNav = 'on';
                        if (specialNav && specialNav === "off") {
                            assignNavLevel("[mobile-nav-section~='nav']");
                            assignNavLevel("[tripnav~='nav']");
                        }
                    });
                </script>
            </div>

            <div trip-name-vert="wrapper 1">
                <div trip-name-vert="sticky">
                    Contact Us
                </div>
            </div>
        </main>
    </div>
@endsection
