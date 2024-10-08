@if (!in_array(Route::currentRouteName(), ['home']))
    <div hero="wrapper" js-hero-scroll-trigger="" enso="">
        <img hero="photo" crossorigin="anonymous" class="js-get-hero-brightness" jstemplate="page" hero-mobile=""
            hero-desktop="{{ $heroImg }}" alt="" hero-smart-crop="auto"
            resize-30-img-src="{{ $heroImg }}" src="{{ $heroImg }}">

        <div breadcrumbs="" js-breadcrumbs-bar="" hide="sm md" class="">
            <ul breadcrumbs-list="">
                <li breadcrumbs-item="" breadcrumbs-home-icon="">
                    <a breadcrumbs-link="" href="{{ route('home') }}">Home</a>
                </li>
                @foreach ($list as $item)
                    <li breadcrumbs-item="" js-breadcrumbs-item="">
                        <a href="{{ $item[1] }}">{{ $item[0] }}</a>
                    </li>
                @endforeach
                <li breadcrumbs-item="" js-breadcrumbs-item="">
                    <a breadcrumbs-link="" href="{{ url()->current() }}">
                        {{ $pageName }}
                    </a>
                </li>
            </ul>
        </div>

        <h1 hero="name" js-sticky-pagename="" class="animated fadeInUp">
            {{ $pageName }}
        </h1>
        <div hero="bottom-bar" class="js-back-to-trip-on">
            <a href="{{ url()->previous() }}" hero="back-to-trip" class="" js-back-to-trip="">Back to previous
                page</a>
            <div hero="photo-credit" class="hide" js-hero-photo-credit="">©&nbsp;</div>
        </div>
    </div>
@else
    <section hero="wrapper">
        <div hero-video="wrapper" enso>

            <div hero-video="landscape">

                <video js-ambient-video="desktop" width="100%" autoplay playsinline muted loop>
                    <!-- prettier-ignore -->
									
                    <!-- prettier-ignore-attribute -->
                    <source src="{{ asset('assets/videos/2024_Website_Hompage_Video_v6_web_uywbql.webm') }}"
                        type="video/webm" />
                    <!-- prettier-ignore-attribute -->
                    <source src="{{ asset('assets/videos/2024_Website_Hompage_Video_v6_web_uywbql.mp4') }}"
                        type="video/mp4" />
                </video>
            </div>
            <div hero-video="portrait">
                <video js-ambient-video="mobile" width="100%" autoplay playsinline muted loop>
                    <!-- prettier-ignore -->
									
                    <!-- prettier-ignore-attribute -->
                    <source src="{{ asset('assets/videos/2024_Website_Hompage_Video_v6_web_vertical_kt76uy.webm') }}"
                        type="video/webm" />
                    <!-- prettier-ignore-attribute -->
                    <source src="{{ asset('assets/videos/2024_Website_Hompage_Video_v6_web_vertical_kt76uy.mp4') }}"
                        type="video/mp4" />
                </video>
            </div>

        </div>
        <div hero-video-text>
            <h1 hero-video-title>{{ $site_name }}</h1>
            <h2 hero-video-subtitle>Conservation Through Exploration</h2>
            <a hero-video-button href="{{ route('our-trips') }}">Start Exploring</a>
        </div>
    </section>
@endif
