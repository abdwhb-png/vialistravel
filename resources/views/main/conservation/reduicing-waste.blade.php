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
                        {{ $site_name }} is leading the way in eliminating disposable plastic, creating the world's first
                        zero waste
                        adventure, and reducing waste in our office operations.
                    </h1>
                </div>
                <div content="wrapper" enso="">Waste is a big problem in the travel industry. Every year, global
                    flyers create an estimated 5.7 million tons of waste in airline cabins alone,&nbsp; while large cruise
                    lines discharge tons of solid waste pollution into the sea. The planet faces a growing scourge of
                    disposable plastic washing up on beaches, entangling turtles and clogging the stomachs of whales. A
                    staggering 1.3 billion tons of food is thrown away every year, with food the biggest form of waste in
                    the travel industry. And while {{ $site_name }} is a relatively small contributor industry-wide,
                    given all this,
                    we simply can’t do “business as usual” when it comes to addressing waste woes. <br>
                    <br>
                    At {{ $site_name }}, we are taking these steps to stem the production of waste:<br>
                    <br>
                    <strong>Pursuing Plastic-Free Travel</strong><br>
                    In 2011, we opted to get rid of single-use plastic water bottles on our trips, accomplishing that goal
                    worldwide within two years. We now give all our travelers a reusable stainless steel water bottle, which
                    we refill with safe, filtered drinking water. And in destinations where a hot beverage is welcome on a
                    chilly excursion, we provide reusable insulated mugs, too. In 2018, we eliminated plastic straws. We’re
                    a proud supporter of Travelers Against Plastic (TAP), a campaign to spread awareness about the impacts
                    of using disposable plastic water bottles while traveling. You, too, can support TAP by <a
                        href="https://www.travelersagainstplastic.org/">signing the pledge</a> to not use single-use
                    plastics when you travel.<br>
                    <br>
                    <strong>The World’s First Zero Waste Adventure</strong><br>
                    In 2019, {{ $site_name }} operated the <a href="#zero-waste-adventure-travel/">World’s
                        First Zero Waste Adventure</a> in Yellowstone National Park, an ambitious quest to reduce waste so
                    dramatically that everything we generated on a weeklong trip would fit into one quart-sized bottle. And
                    we did it! While we would love to make all our trips zero waste immediately, we recognize that it’s a
                    process—opportunities to refuse, repurpose or recycle don’t exist at the same level in every destination
                    we operate—but we learned many things from this initial endeavor that we’re able to integrate across
                    multiple trips, working with our partners around the world to up the bar on waste reduction. <br>
                    <br>
                    <strong>Guiding the Industry</strong><br>
                    As a result of all we learned on the World’s First Zero Waste Adventure, we’ve created a list of <a
                        href="#conservation/reducing-waste/zero-waste-travel-lessons/">12 Lessons
                        Learned</a> to share with other companies, to inspire and assist them in their own waste-reduction
                    efforts. <br>
                    <br>
                    <strong>Inspiring Our Travelers</strong><br>
                    We know it’s not enough to reduce waste on our trips alone. Our goal is for our travelers to make it a
                    way of life, at home and on the road or in the air, too. Toward that end, we have these <a
                        href="#zero-waste-adventure-travel/zero-waste-travel-tips/">Tips for Zero
                        Waste Travel</a> to share. <br>
                    <br>
                    <strong>Reducing Waste in Our Home Office</strong><br>
                    When we created the World’s First Zero Waste Adventure in 2019, we made a parallel effort to ramp up
                    waste reduction at our Colorado headquarters. We have bins for conventional recycling and composting, we
                    recycle plastic bags and toiletry containers like toothpaste and tubes and makeup containers, and we’ve
                    added a TerraCycle Zero Waste Box for hard-to-recycle plastics like candy and snack wrappers and scrap
                    packaging. In our company kitchen, we provide bulk snacks for our staff, refilling dispensers with raw
                    nuts, pretzels, chocolate and the like, and providing fresh, unwrapped fruit. We use bulk tea to fill
                    individual compostable tea bags (did you know most tea bags contain plastic and aren’t compostable?).
                    And when it’s time to pour a cup of fair-trade coffee, it goes in a ceramic mug, and the cream we
                    provide comes in a glass bottle from a local dairy delivery service.
                </div>

                <div repeater-wrapper="" js-show-for-admin="block" settings="vertical" enso="">
                    <div repeater="title" enso=""></div>
                    <div repeater-options-layout="" js-show-for-admin="grid" class="hide" enso="">

                        <div repeater-options-title=""><span repeater-options-highlight="">Admin Note</span> : Repeater
                            Settings</div>
                        <div repeater-options-text="" hide="md"></div>
                        <div repeater-options-state="" hide="md">
                            Current Settings: <span repeater-options-state-value="">trip</span>
                        </div>
                        <a href="?ensoAction=group&amp;name=repeater-options-layout-group" repeater-options-button="">Edit
                            Settings</a>

                    </div>

                    <div repeater-trips="" class="trip-show-trip" enso="">

                    </div>
                    <div repeater-trips="" class="non-trip-show-trip" enso="">

                    </div>
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
