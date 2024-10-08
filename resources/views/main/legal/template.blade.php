@extends('layouts.main')

@section('hero')
    <x-main.hero :pageName="$page->name"></x-main.hero>
@endsection

@section('content')
    <div main="wrapper">
        <input mobile-nav-section="toggle" id="mobile-nav-section" type="checkbox" class="hide-off-canvas">
        <div tripnav-section="wrapper" js-tripnav-section-wrapper="" hide="lg+">
            <x-main.mobile-breadcrumb :pageName="$page->name"></x-main.mobile-breadcrumb>

            <label tripnav-section="bar" for="mobile-nav-section">
                <div tripnav-section="hamburger"><span tripnav-section="icon"></span></div>
            </label>
            <div mobile-nav-section="wrapper" hide="lg+">
                <div mobile-nav-section="stage">
                    <nav mobile-nav-section="nav" class="js-tripnav js-level-2">
                        <ul class="section-navigation-ul" id="">
                            @foreach ($pages as $k => $item)
                                <li id="section-navigation-ul-li-{{ $k + 1 }}"
                                    class="{{ $page->id == $item->id ? 'active' : '' }}"><a
                                        href="{{ $item->permalink }}">{{ $item->name }}</a></li>
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

        <main subpage="wrapper subpage staff-updated">
            <div subpage="middle staff-bio">
                <section page-name="" enso="">
                    <h1 name="wrapper" enso="">
                        {{ $site_name . ' ' . $page->name }}
                    </h1>

                </section>
                <section page-aside-content-wrapper="" js-show-for-admin="flex">
                    <aside page-aside="" enso="">
                    </aside>
                    <div page-content="">
                        <div content-wrapper="" enso="">

                            <div content-lead-in-wrapper=""></div>
                            <div content="">
                                {!! $page->content !!}
                            </div>

                        </div>
                    </div>
                </section>
            </div>
            <div tripnav="wrapper" js-position-left-nav="" hide="sm md">
                <nav tripnav="nav" class="js-tripnav js-level-2" role="navigation" enso="">
                    <ul class="section-navigation-ul" id="">
                        @foreach ($pages as $k => $item)
                            <li id="section-navigation-ul-li-{{ $k + 1 }}"
                                class="{{ $page->id == $item->id ? 'active' : '' }}"><a
                                    href="{{ $item->permalink }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </nav>
                <nav tripnav="nav" hide="all" class="js-tripnav js-level-3" role="navigation" enso="">
                    &nbsp;
                </nav>
                <nav tripnav="nav" hide="all" class="js-tripnav js-level-4" role="navigation" enso="">
                    &nbsp;
                </nav>
            </div>

        </main>
    </div>
@endsection
