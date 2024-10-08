<div>
    <div class="container mb-4" id="basic-informations">
        <trip-basics :the-item="{{ json_encode($item) }}" :regions="{{ json_encode($regions) }}"
            :routes="{{ json_encode($routes) }}" :reload="true"></trip-basics>
    </div>

    <div class="container mb-4" id="overview-and-itinerary">
        <trip-overview :the-item="{{ json_encode($item) }}" :overview="{{ json_encode($item->overview) }}"
            :routes="{{ json_encode($routes) }}"></trip-overview>
    </div>

    <div class="container mb-4" id="highlights-dates-and-faqs">
        <trip-highl-date-faq :the-item="{{ json_encode($item) }}" :highlights="{{ json_encode($item->highlights) }}"
            :dates="{{ json_encode($item->dates) }}" :faqs="{{ json_encode($item->faqs) }}"
            :routes="{{ json_encode($routes) }}"></trip-highl-date-faq>
    </div>

    <div class="container mb-4" id="more-details-and-reviews">
        <trip-more-reviews :the-item="{{ json_encode($item) }}" :reviews="{{ json_encode($item->reviews) }}"
            :more-infos="{{ json_encode($item->overview->more_infos) }}"
            :routes="{{ json_encode($routes) }}"></trip-more-reviews>
    </div>

    <div class="container" id="medias">
        <trip-medias :the-item="{{ json_encode($item) }}" :medias="{{ json_encode($medias) }}"
            :routes="{{ json_encode($routes) }}"></trip-medias>
    </div>
</div>
