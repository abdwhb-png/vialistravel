<div subpage="middle">
    <h2 name="wrapper">
        Dates, Prices &amp; Info
    </h2>
    <div content="wrapper" enso="">

    </div>
    {{-- <script>
        var misplacedSpan = document.getElementsByTagName("span");
        Array.from(misplacedSpan).forEach((spanTag) => {
            var unstyleSpan = function() {
                if (spanTag.parentNode.matches("a")) {
                    this.removeAttribute("style");
                }
            };
        });
    </script> --}}

    <div dates="wrapper">
        <div dates="accordions" class="js-departure-test">
            <h5 dates="header" class="accordion-header" enso="">
                Trip Dates
            </h5>
            <div wrapper="dates-accordion">
                @foreach ($datesYears as $y => $dates)
                    <div accordions="wrapper" class="js-show-for-admin-dates js-{{ $y }}-accordion">
                        <div accordion="details">
                            <input accordion="checkbox" id="dates-{{ $y }}" class="js-accordion-year-input"
                                type="checkbox" name="faq-input">
                            <label accordion="summary" for="dates-{{ $y }}"
                                class="js-accordion-year">{{ $y }} Departures
                            </label>
                            <span accordion="content" class="test-accordion">
                                <div class="trip-dates-{{ $y }}" id="date-wrapper">
                                    <div class="trip-dates-hint-{{ $y }}" trip="hint" enso="">
                                        Mouse over or tap the departure dates to see trip prices.
                                    </div>
                                    <div trip="wrapper" class="js-table-container">
                                        <div trip="table">
                                            <div trip-table="header">
                                                <ul trip-header="list">
                                                    <li trip-header="item departure" class="departure">Departure</li>
                                                    <li trip-header="item return" class="return">Return</li>
                                                    <li trip-header="item comment" class="comment" hide="sm!">Notes
                                                    </li>
                                                </ul>
                                            </div>
                                            <div trip-table="body"
                                                class="original-tr trips-{{ $y }} trip-wrapper">
                                                @foreach ($dates as $date)
                                                    <div trip-body="wrapper" class="pricing js-trip-data">
                                                        <div trip-body="list-wrapper">
                                                            <ul trip-body="list" class="trip-data">
                                                                <li trip-body="item departure" class="departure">
                                                                    {{ \Carbon\Carbon::parse($date->departure)->format('M j, Y') }}
                                                                </li>
                                                                <li trip-body="item return" class="return">
                                                                    {{ \Carbon\Carbon::parse($date->return)->format('M j, Y') }}
                                                                </li>
                                                                <li trip-body="item comment" class="comment"
                                                                    hide="sm!">{{ $date->notes }}</li>
                                                            </ul>
                                                            <span trip-body="item mobile-comment" class="mobile-comment"
                                                                hide="md+">{{ $date->notes }}</span>
                                                        </div>
                                                        <div trip-body="hidden-item price" class="price">
                                                            {{ $date->pricing ?? $item->pricing }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="trip-dates-fine-print-{{ $y }}" trip="fine-print"
                                        enso=""> </div>
                                </div>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <h5 dates="header" class="accordion-header" enso="">
                Trip Pricing
            </h5>
            <div accordions="wrapper pricing" js-pricing-accordion=""
                class="accordion-show pricing-{{ date('Y') }}" enso="" js-show-for-admin="block">

                <input accordion="checkbox" id="{{ date('Y') }}-fees" type="checkbox" name="faq-input">
                <label accordion="summary" for="{{ date('Y') }}-fees" js-pricing-summary="">
                    {{ date('Y') }} Prices
                </label>
                <span accordion="content">
                    <div accordion="options" class="hide" js-show-for-admin="inline-flex">
                        Accordion Visibility :
                        show
                    </div>
                    <div accordion="innercontent">
                        <em>Mouse over or tap dates above to view prices for specific departure dates.
                        </em><br>
                        <a href="/-lightboxes/global/quality-value-guarantee/#QualityValueGuarantee" generic=""><img
                                alt="" style="float: right;"
                                src="{{ asset('assets/images/quality-value-24.png') }}"></a><br>
                        <ul>
                            <li><strong>Trip Price </strong><br>
                                {{ $item->pricing }}</li>
                        </ul>
                    </div>
                </span>

            </div>
        </div>
        <div dates="inclusions">
            <h5 dates="header" js-show-for-admin="block">Group Size</h5>
            <div dates="private-trip" js-show-for-admin="block" enso="">
                <strong><em>Limited to {{ $item->travelers_limit }} Travelers</em> <br>
                </strong>A very important feature of this expedition is the limited group size. Nature is
                always best experienced in smaller groups, and it is particularly important on this adventure to ensure
                that all guests have plenty of room on board.
            </div>
        </div>
        <h5 dates="header" js-show-for-admin="block" style="display: none;">Specialized 4x4 Land Rovers and Land
            Cruisers</h5>
        <div dates="text" js-show-for-admin="block" enso="" style="display: none;">

        </div>
        <h5 dates="header" js-show-for-admin="block" style="display: none;">Our Private Leaders</h5>
        <div dates="text" js-show-for-admin="block" enso="" style="display: none;">

        </div>
        <h5 dates="header" js-show-for-admin="block">More Details</h5>
        <div dates="text" js-show-for-admin="block" enso="">
            {!! $item->overview->more_infos !!}
        </div>

    </div>
    <h5 dates="header" js-show-for-admin="block">Getting There &amp; Getting Home</h5>
    <div dates="text" js-show-for-admin="block" enso="">
        In case of flight or weather delays, we recommend that you arrive a day early. Please schedule your flights to
        arrive by 5 pm in order to
        attend a 7 pm orientation dinner on Day 1 of your program. You are free to depart at any time on the final day.
    </div>
</div>
