<div>
    <label accordion-button="" class="js-accordions-button-open">Expand All</label>
    <div accordions="wrapper faq" enso>
        @foreach ($faqs as $item)
            <label accordion="details" for="summary-{{ $item->id }}">
                <input accordion="checkbox" class="js-accordion" id="summary-{{ $item->id }}" type="checkbox"
                    name="faq-input">
                <span accordion="summary"> {{ $item->question }}</span>
                <span accordion="content" style="padding: 10px"> {{ $item->response }}</span>
            </label>
        @endforeach
    </div>
</div>
