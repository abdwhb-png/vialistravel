<div slider="wrapper" class="js-slider-swipable" enso>
    <!-- EXTRA -->
    <div slider="set" setnum="2">
        @foreach ($datas as $item)
            <div slider="slide">
                <a href="{{ $item['permalink'] }}" slider="link">
                    <div class="hide">
                        {{ $item['name'] }}
                    </div>

                    <div slider="photo">
                        <img slider="img" nopin="nopin" src="{{ $item['image'] }}"
                            resize-img-src="{{ $item['image'] }}" alt={{ $item['img_alt'] }}>
                    </div>
                    <div slider="tag" class='hide'>

                    </div>
                    <div slider="text">
                        <h3 slider="name">
                            {{ $item['name'] }}
                        </h3>
                        <div slider="details">
                            <div slider="description">
                                {!! $item['description'] !!}
                            </div>
                            <div slider="pricing">
                                <span>

                                </span>
                            </div>
                        </div>
                        <div slider="tag-vert" class='hide'>

                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <!-- PRIMARY-->
    <div slider="set" primary="true" setnum="2" class="js-start">
        @foreach ($datas as $item)
            <div slider="slide">
                <a href="{{ $item['permalink'] }}" slider="link">
                    <div class="hide">
                        {{ $item['name'] }}
                    </div>

                    <div slider="photo">
                        <img slider="img" nopin="nopin" src="{{ $item['image'] }}"
                            resize-img-src="{{ $item['image'] }}" alt={{ $item['img_alt'] }}>
                    </div>
                    <div slider="tag" class='hide'>

                    </div>
                    <div slider="text">
                        <h3 slider="name">
                            {{ $item['name'] }}
                        </h3>
                        <div slider="details">
                            <div slider="description">
                                {!! $item['description'] !!}
                            </div>
                            <div slider="pricing">
                                <span>

                                </span>
                            </div>
                        </div>
                        <div slider="tag-vert" class='hide'>

                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <!-- EXTRA -->
    <div slider="set" setnum="2">
        @foreach ($datas as $item)
            <div slider="slide">
                <a href="{{ $item['permalink'] }}" slider="link">
                    <div class="hide">
                        {{ $item['name'] }}
                    </div>

                    <div slider="photo">
                        <img slider="img" nopin="nopin" src="{{ $item['image'] }}"
                            resize-img-src="{{ $item['image'] }}" alt={{ $item['img_alt'] }}>
                    </div>
                    <div slider="tag" class='hide'>

                    </div>
                    <div slider="text">
                        <h3 slider="name">
                            {{ $item['name'] }}
                        </h3>
                        <div slider="details">
                            <div slider="description">
                                {!! $item['description'] !!}
                            </div>
                            <div slider="pricing">
                                <span>

                                </span>
                            </div>
                        </div>
                        <div slider="tag-vert" class='hide'>

                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div slider="arrow prev" class="js-slider-prev" hide="sm! md!"></div>
    <div slider="arrow next" class="js-slider-next" hide="sm! md!"></div>
</div>
