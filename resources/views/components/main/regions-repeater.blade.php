<div repeater-regions enso>
    @foreach ($regions as $item)
        <a href="{{ route('region', $item->permalink) }}" repeater-region>
            <div region-photo>
                <img region-photo-img alt="{{ 'Image : ' . $item->title }}" src="{{ $item->medias()['pic'] }}"
                    resize-img-src="{{ $item->medias()['pic'] }}" />
            </div>
            <div region-text>
                <h3 region-text-name>
                    {{ $item->title }}
                </h3>
                @if ($item->intro)
                    <p region-text-description>
                        {!! $item->intro !!}
                    </p>
                @endif
            </div>
        </a>
    @endforeach
</div>
