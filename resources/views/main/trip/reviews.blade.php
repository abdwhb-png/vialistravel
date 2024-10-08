<div subpage="middle">
    <h2 name="wrapper">
        Traveler Reviews
    </h2>
    <div content="wrapper">
        <label custom="button" class="hide" js-show-custom-button="" for="modal-custom">Request Info</label>
        <div js-scroll-on-mobile="" enso="">We've earned a stellar reputation for our nature adventures,
            top-notch naturalist guides and outstanding service. We’re especially proud of the feedback and reviews
            from our guests.&nbsp;Here’s what our past travelers are saying about their <em>{{ $item->title }}</em>.
        </div>
    </div>

    <x-main.reviews-repeater :reviews="$item->reviews"></x-main.reviews-repeater>

</div>
