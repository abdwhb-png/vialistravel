@extends('layouts.main')

@php
    $sectionTitle = 'Conservation';
    $bread = [[$sectionTitle, '#' . $sectionTitle]];
@endphp

@section('hero')
    <x-main.hero :list="$bread"></x-main.hero>
@endsection

@section('content')
    <div main="wrapper">
        <input mobile-nav-section="toggle" id="mobile-nav-section" type="checkbox" class="hide-off-canvas">
        <div tripnav-section="wrapper" js-tripnav-section-wrapper="" hide="lg+">
            <x-main.mobile-breadcrumb :list="$bread"></x-main.mobile-breadcrumb>
            <label tripnav-section="bar" for="mobile-nav-section">
                <div tripnav-section="hamburger"><span tripnav-section="icon"></span></div>
            </label>
        </div>
        {{-- SUBPAGE WRAPPER --}}
        <main subpage="wrapper subpage">
            <div subpage="middle">
                <div name="wrapper" enso="">
                    <h1>
                        {{ $site_name }}'s exclusive Quality &amp; Value Guarantee ensures we will meet the lofty
                        expectations we
                        set.
                    </h1>
                </div>
                <div content="wrapper" enso=""><img alt=""
                        style="margin-bottom: 10px; margin-left: 15px; float: right;"
                        src="https://cdn.filestackcontent.com/A6dTpd53SmIg0pBfJJhgAz/cache=expiry:31536002/#uploaded-files/global/quality-value-guarantee_sml.png">To
                    our knowledge, our guarantee is the best in the travel industry, ensuring that our trip prices reflect
                    the exceptional quality of the experience we provide. We promise to do everything we can to make your
                    nature adventure outstanding!<br>
                    <br>
                    <ol>
                        <li><strong>We’ll Deliver on Our Promises</strong><br>
                            As you read our catalog and website, you’ll see that the standards we set are very high. We are
                            so confident our nature adventures will meet those expectations that should you discover a
                            disparity, we’ll gladly give you credit <g
                                class="gr_ gr_27 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace"
                                id="27" data-gr-id="27">toward</g> a future trip. Of course, we can't control natural
                            circumstances such as weather and wildlife movements, and they do sometimes vary from expected
                            patterns. When that is the case, we'll make the best adjustments we can to ensure an excellent
                            experience. But when it comes to the inclusions, activities, accommodations and guiding we have
                            arranged, we'll deliver—or we'll compensate you!</li>
                        <li><strong>The Best Trip at the Best Price</strong><br>
                            We believe we offer an incomparable nature travel experience when you take into account our
                            expertly designed itineraries that include unique experiences and exclusive access, our remote
                            wild destinations, exceptionally small groups and highly qualified naturalist Expedition
                            Leaders. But, should you come across a matching itinerary of our quality at a lower price, even
                            within 30 days <em>after </em>booking with us, we will refund the difference.</li>
                        <li><strong>Rest Assured ... We Won’t Cancel!</strong><br>
                            While many companies often cancel trips due to low enrollment, we don't! This policy gives our
                            travelers security and peace of mind in knowing your travel plans are virtually guaranteed. In
                            the event circumstances outside our control force us to cancel, we will do our best to rebook
                            you on a departure that works for you.</li>
                    </ol>
                </div>

            </div>

            <div trip-name-vert="wrapper 1">
                <div trip-name-vert="sticky">
                    {{ $sectionTitle }}
                </div>
            </div>
        </main>
    </div>
@endsection
