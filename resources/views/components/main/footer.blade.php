<footer footer="wrapper">
    <div footer="photo" enso="">
        <img ignore-cdn="" src="{{ asset('assets/images/footer-photo.jpg') }}" alt="">
    </div>
    <div footer="links">
        <div links="col 1">
            <div links="header" enso="">
                Interests
            </div>
            <nav links="nav" enso="">
                <ul class="nha-col-1-links-ul" id="">
                    @foreach ($interests as $k => $item)
                        <li id="{{ 'nha-col-1-links-ul-li-' . $k }}">
                            <a href="{{ $item['route'] }}" target="_self">{{ $item['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div links="col 2">
            <div links="header" enso="">
                Regions
            </div>
            <nav links="nav" enso="">
                <ul class="nha-col-2-links-ul" id="">
                    @foreach ($regions as $k => $item)
                        <li id="{{ 'nha-col-1-links-ul-li-' . $k }}">
                            <a href="{{ $item['route'] }}" target="_self">{{ $item['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div links="col 3">
            <div links="header" enso="">
                About Us
            </div>
            <nav links="nav" enso="">
                <ul class="nha-col-3-links-ul" id="">
                    @foreach ($aboutUs as $k => $item)
                        <li id="{{ 'nha-col-1-links-ul-li-' . $k }}">
                            <a href="{{ $item['route'] }}" target="_self">{{ $item['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div links="col 4">
            <div links="header" enso="">
                Traveler Resources
            </div>
            <nav links="nav" enso="">
                <ul class="nha-col-4-links-ul" id="">
                    @foreach ($travelerResources as $k => $item)
                        <li id="{{ 'nha-col-1-links-ul-li-' . $k }}">
                            <a href="{{ $item['route'] }}" target="_self">{{ $item['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
    <div footer="social">
        @foreach ($social_links as $item)
            @if ($item->url)
                <a social="link" js-social-link-footer="{{ $item->name }}" href="{{ $item->url }}"
                    target="_self">
                    {!! $item->icon !!}
                </a>
            @endif
        @endforeach
    </div>
    <div footer="contact">
        <div contact="phone">
            <div phone="number">{{ $site_settings->phone }}</div>
            <div phone="description">Phone No</div>
        </div>
        <div contact="phone">
            <div phone="number">{{ $site_settings->international_phone ?? $site_settings->phone }}</div>
            <div phone="description">International</div>
        </div>
        <address contact="address">
            {{ $site_settings->address }}
            <a contact="email" href="{{ 'mailto:' . $site_settings->email }}"
                target="_self">{{ $site_settings->email }}</a>
        </address>
    </div>
    <div footer="copyright" enso="">Copyright © {{ date('Y') }} •&nbsp;{{ $site_name }}</div>
</footer>
