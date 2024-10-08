@extends('layouts.main')

@section('hero')
    <x-main.hero :pageName="$item->title" :heroImg="$item->medias()['hero']" :list="$bread"></x-main.hero>
@endsection

@section('content')
    <div main="wrapper">
        <input mobile-nav-section="toggle" id="mobile-nav-section" type="checkbox" class="hide-off-canvas">
        <div tripnav-section="wrapper" js-tripnav-section-wrapper="" hide="lg+">
            <x-main.mobile-breadcrumb :pageName="$item->title" :list="$bread"></x-main.mobile-breadcrumb>
            <label tripnav-section="bar" for="mobile-nav-section">
                <div tripnav-section="hamburger"><span tripnav-section="icon"></span></div>
            </label>
            <div mobile-nav-section="wrapper" hide="lg+">
                <div mobile-nav-section="stage">
                    <nav mobile-nav-section="nav" class="js-tripnav js-level-2">
                        <ul class="section-navigation-ul" id="">
                            @foreach ($navLinks as $k => $v)
                                <li id="section-navigation-ul-li-{{ $k + 1 }}"
                                    class="{{ $trip_section == $v[0] ? 'active' : '' }}"><a
                                        href="{{ route('trip', ['trip_section' => $v[0], 'slug' => $item->permalink]) }}">{{ $v[1] }}</a>
                                </li>
                            @endforeach
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

        <main subpage="wrapper trip {{ $trip_section }}" id="app">

            @include('main.trip.' . $trip_section)

            <div tripnav="wrapper" js-position-left-nav="" hide="sm md">
                <nav tripnav="nav" class="js-tripnav" role="navigation" enso="">
                    <ul class="trip-nav-ul" id="">
                        @foreach ($navLinks as $k => $v)
                            <li id="trip-nav-ul-li-{{ $k + 1 }}"
                                class="{{ $trip_section == $v[0] ? 'active' : '' }}"><a
                                    href="{{ route('trip', ['trip_section' => $v[0], 'slug' => $item->permalink]) }}">{{ $v[1] }}</a>
                            </li>
                        @endforeach
                        </li>
                    </ul>
                </nav>
            </div>

            <div ctas="sticky" js-position-trip-ctas="">
                @if ($item->isAvailable())
                    <div ctas="book cta primary" class="js-cta-book booknowon allow-book-now">
                        <a href="#is-available" class="" ctas="center">
                            <svg class="cta-icon-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
                                <path class="cta-icon-path"
                                    d="M11.17 9.22a1.34 1.34 0 0 1-1.34-1.15 1.37 1.37 0 0 1 0-.3v-1.9-4.41a1.52 1.52 0 0 1 .39-1.11 1.42 1.42 0 0 1 2.35 1.15v6.24a1.38 1.38 0 0 1-1.26 1.52zM28.79 9.24a1.39 1.39 0 0 1-1.39-1.41V1.42a1.42 1.42 0 0 1 .41-1 1.31 1.31 0 0 1 1-.38 1.33 1.33 0 0 1 1.36 1.45V7.8a1.47 1.47 0 0 1-.42 1.06 1.34 1.34 0 0 1-.93.38z">
                                </path>
                                <path class="cta-icon-path"
                                    d="M5.76 40a4.8 4.8 0 0 1-5-5v-7.25V9.26a4.91 4.91 0 0 1 1.52-3.59 4.6 4.6 0 0 1 3.14-1.29h2.33c.18 0 .27 0 .31.1s.06.07 0 .32V8a3.13 3.13 0 1 0 6.26 0v-.14-3.11a.44.44 0 0 1 .07-.3.51.51 0 0 1 .31-.07h10.52a.47.47 0 0 1 .31.07s.08.13.08.35v3.26a3.12 3.12 0 1 0 6.23 0v-.85V4.9c0-.29.05-.39.1-.43s.16-.1.33-.1h2.37a4.61 4.61 0 0 1 3.06 1.28 4.84 4.84 0 0 1 1.52 3.6v23.1a26.06 26.06 0 0 1-.09 3.53A4.73 4.73 0 0 1 34.38 40H5.76zM4.3 13.81a.48.48 0 0 0-.32.12c-.22.23-.22.73-.21 1.43V34c0 2.19.61 2.78 2.81 2.78h26.94c1.89 0 2.66-.76 2.66-2.65V15.78v-.42c0-.59 0-1.15-.21-1.4a.38.38 0 0 0-.29-.12H4.3z">
                                </path>
                                <path class="book-static"
                                    d="M16.33 34.14a1.63 1.63 0 0 1-.89-.43l-4.25-3.41-2-1.64c-.27-.21-.39-.37-.38-.5s.15-.27.44-.45a8.17 8.17 0 0 1 3.29-1.1h.23a1.64 1.64 0 0 1 1.1.41c.66.55 1.34 1.09 2 1.62L17.56 30a.7.7 0 0 0 .42.21.62.62 0 0 0 .42-.3l2.6-3.45.19-.25c1.51-2 3.07-4.06 4.55-6.12a4.83 4.83 0 0 1 3.38-2 6.7 6.7 0 0 1 1.06-.1 2.71 2.71 0 0 1 .56.05c.31.05.4.1.44.14l-.06.06v.09a3.17 3.17 0 0 1-.2.29L24 28c-1.08 1.43-2.18 2.9-3.26 4.36A3.39 3.39 0 0 1 19 33.59a9.32 9.32 0 0 1-2.62.54h-.08z">
                                </path>
                                <clipPath id="book-clip">
                                    <path class="cta-icon-path"
                                        d="M16.33 34.14a1.63 1.63 0 0 1-.89-.43l-4.25-3.41-2-1.64c-.27-.21-.39-.37-.38-.5s.15-.27.44-.45a8.17 8.17 0 0 1 3.29-1.1h.23a1.64 1.64 0 0 1 1.1.41c.66.55 1.34 1.09 2 1.62L17.56 30a.7.7 0 0 0 .42.21.62.62 0 0 0 .42-.3l2.6-3.45.19-.25c1.51-2 3.07-4.06 4.55-6.12a4.83 4.83 0 0 1 3.38-2 6.7 6.7 0 0 1 1.06-.1 2.71 2.71 0 0 1 .56.05c.31.05.4.1.44.14l-.06.06v.09a3.17 3.17 0 0 1-.2.29L24 28c-1.08 1.43-2.18 2.9-3.26 4.36A3.39 3.39 0 0 1 19 33.59a9.32 9.32 0 0 1-2.62.54h-.08z">
                                    </path>
                                </clipPath>
                                <path id="book-clip-path" class="cta-icon-path"
                                    d="M16.33 34.14a1.63 1.63 0 0 1-.89-.43l-4.25-3.41-2-1.64c-.27-.21-.39-.37-.38-.5s.15-.27.44-.45a8.17 8.17 0 0 1 3.29-1.1h.23a1.64 1.64 0 0 1 1.1.41c.66.55 1.34 1.09 2 1.62L17.56 30a.7.7 0 0 0 .42.21.62.62 0 0 0 .42-.3l2.6-3.45.19-.25c1.51-2 3.07-4.06 4.55-6.12a4.83 4.83 0 0 1 3.38-2 6.7 6.7 0 0 1 1.06-.1 2.71 2.71 0 0 1 .56.05c.31.05.4.1.44.14l-.06.06v.09a3.17 3.17 0 0 1-.2.29L24 28c-1.08 1.43-2.18 2.9-3.26 4.36A3.39 3.39 0 0 1 19 33.59a9.32 9.32 0 0 1-2.62.54h-.08z">
                                </path>
                            </svg>
                            <p class="cta-text">Availabile</p>
                        </a>
                    </div>
                @endif
                <label ctas="pdf cta secondary center" for="modal-pdf" js-pdf-location="PDF">
                    <svg class="cta-icon-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
                        <path class="cta-icon-path"
                            d="M39.28 38.13H.89c-.89 0-.89 0-.89-.89V24.58c0-.78 0-.78.77-.78h1.55a2.78 2.78 0 0 1 .92.07 9.31 9.31 0 0 1 .06 1.6V33.27a1.64 1.64 0 0 0 .37 1.26 1.62 1.62 0 0 0 1.2.4h30.32a1.71 1.71 0 0 0 1.26-.41 1.73 1.73 0 0 0 .39-1.31V28.86v-4.37c0-.48.08-.6.1-.62s.11-.08.39-.08H39.65c.4 0 .4.05.4.36v13.53c0 .28-.06.34-.06.34s-.12.1-.64.1z">
                        </path>
                        <path class="cta-icon-path pdf-animate"
                            d="M20 27.32a3.15 3.15 0 0 1-.5-.44l-3.35-3.35c-2-2-4.09-4.09-6.14-6.12-.31-.3-.32-.44-.32-.47s0-.15.3-.4c.5-.44 1-.94 1.52-1.51.19-.2.32-.26.36-.26s.15 0 .44.3c1.07 1.11 2.16 2.2 3.34 3.39l2.72 2.73V2.68c0-.8 0-.8.7-.8h1.67a2.56 2.56 0 0 1 .87.07 9.6 9.6 0 0 1 0 1.43V21l3-3 2.57-2.52a5.3 5.3 0 0 1 .85-.75s.31.26.75.7l.51.5a7.53 7.53 0 0 1 1 1.06 12.11 12.11 0 0 1-.93 1l-.59.58q-4.14 4.17-8.32 8.32a3.53 3.53 0 0 1-.45.43z">
                        </path>
                    </svg>
                    <p class="cta-text">Download Trip Details</p>
                </label>
                <label ctas="ask cta secondary center" for="modal-ask" js-ask-location="Ask Question">
                    <svg class="cta-icon-full ask-animate" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
                        <circle class="ask-animate-circle" cx="20" cy="20" r="18"></circle>
                        <path class="cta-icon-path"
                            d="M15.56 10.93a7.17 7.17 0 0 0-2.33 4.37.84.84 0 0 0 .14.67.82.82 0 0 0 .62.27h1.58c.54 0 .74-.17.87-.75a5.2 5.2 0 0 1 .47-1.31 3.68 3.68 0 0 1 3.32-1.71 4 4 0 0 1 2.77 1 3 3 0 0 1 .13 4.32A7.21 7.21 0 0 1 21.74 19 5.68 5.68 0 0 0 19 23.77a.75.75 0 0 0 .78.88h1.58a.72.72 0 0 0 .82-.74 2.64 2.64 0 0 1 1.3-2.25 9.55 9.55 0 0 0 2.37-2.17 6.16 6.16 0 0 0-1.61-9.07 7.62 7.62 0 0 0-5.58-.93 6.18 6.18 0 0 0-3.1 1.44zM20.51 27a2 2 0 0 0-1.42.59A2.05 2.05 0 0 0 18.5 29a2 2 0 0 0 2 2 2 2 0 0 0 1.41-.59 1.94 1.94 0 0 0 .61-1.41 2 2 0 0 0-2.01-2z">
                        </path>
                    </svg>
                    <p class="cta-text">Ask a Question</p>
                </label>
            </div>

        </main>
    </div>
@endsection
