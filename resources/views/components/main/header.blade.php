<header masthead class="js-scroll-target" aria-label="Masthead" role="banner">
    <div masthead-stage>
        <!-- Logos -->
        <a logos href="{{ route('home') }}" aria-label="Link to Homepage">
            <div logo="siteLogo" style="text-align: center">
                <img src="{{ $site_settings->site_logo }}" alt="site-logo">
            </div>
            <div logos-name hide="sm md" aria-label="{{ $site_name }}">{{ $site_name }}</div>
        </a>
        {{-- <script>
            const logoColors = ["#9f3323", "#b86125", "#4F758B", "#28724F", "#8A8D4A"];
            //FUNCTION - randomly pulls a HEX color from the above array and replaces the logo fill color with it
            const logoLoop = function() {
                const randomNumber = Math.floor(Math.random() * logoColors.length);
                const chosenLogo = logoColors[randomNumber];
                const logoChange = document.querySelector(".js-nha-logo-change");
                logoChange.style.fill = chosenLogo;
            };
            logoLoop();
        </script> --}}


        <!-- NAV -->
        <input type="radio" name="mega-toggle" id="mega-reset" aria-hidden="true" class="hide-off-canvas" />
        <input type="radio" name="mega-toggle" id="mega-trip-finder" aria-hidden="true" class="hide-off-canvas" />
        <input type="radio" name="mega-toggle" id="mega-conservation" aria-hidden="true" class="hide-off-canvas" />
        <input type="radio" name="mega-toggle" id="mega-our-story" aria-hidden="true" class="hide-off-canvas" />
        <input type="radio" name="mega-toggle" id="mega-resources" aria-hidden="true" class="hide-off-canvas" />
        <input type="radio" name="mega-toggle" id="mega-hamburger" aria-hidden="true" class="hide-off-canvas" />
        <div masthead-nav hide="sm" aria-hidden="true">
            <label for="mega-trip-finder" masthead-nav-link="trip-finder"></label>
            <label for="mega-reset" masthead-nav-link="trip-finder" class="active"></label>
            <label for="mega-conservation" masthead-nav-link="conservation"></label>
            <label for="mega-reset" masthead-nav-link="conservation" class="active"></label>
            <label for="mega-our-story" masthead-nav-link="our-story"></label>
            <label for="mega-reset" masthead-nav-link="our-story" class="active"></label>
            <label for="mega-resources" masthead-nav-link="resources"></label>
            <label for="mega-reset" masthead-nav-link="resources" class="active"></label>
            <label for="mega-hamburger" masthead-nav-link="hamburger"></label>
            <label for="mega-reset" masthead-nav-link="hamburger" class="active"></label>
            <div masthead-nav-indicator="hover" hide="sm md" aria-hidden="true"></div>
            <div masthead-nav-indicator="active" hide="sm md" aria-hidden="true">
                <!-- prettier-ignore -->
						<svg x="0" y="0" viewBox="0 0 1792 1792"><path d="M996,1314.5c-55.2,55.2-139.5,55.2-194.8,0c-2.4-2.8-2.4-2.8-2.4-2.8L154.4,670.1c-52.4-55.2-52.4-139.2,0-194.4c55.2-52.8,139.5-52.8,194.4,0l549.7,552.1l547.2-546.9c52.4-52.4,139.5-52.4,192,0c52.4,52.8,52.4,139.5,0,192L996,1314.5z" /></svg>
            </div>

        </div>
        <div mega-menu="trip-finder" hide="small">
            <div mega-menu-stage="trip-finder" enso>
                @foreach ($regions as $item)
                    <a trip-finder="link" href="{{ route('region', $item->permalink) }}">
                        <img trip-finder="image" src="{{ $item->medias()['pic'] }}"
                            resize-img-src="{{ $item->medias()['pic'] }}" alt='{{ 'Image : ' . $item['title'] }}' />
                        <div trip-finder="name">{{ $item['title'] }}</div>
                    </a>
                @endforeach
            </div>
        </div>

        <div mega-menu="conservation" aria-label="Conservation">
            <div mega-menu-stage="conservation">
                <aside mega-menu-stage-aside aria-label="Conservation Film">
                    <div mega-menu-stage-aside-headline aria-label="Film Title">Big Bad Wolf</div>
                    <div mega-menu-stage-aside-tagline aria-label="Film Description">A short film about the
                        conservation challenges facing the wolves of Yellowstone.</div>
                    <a href="index6ba0.html?lightbox=https://www.youtube.com/embed/_5Rwt12xnyo?rel=0&amp;autoplay=1"
                        mega-menu-aside-button aria-label="Watch Big Bad Wolf Film">Watch Film</a>
                    <div mega-menu-stage-aside-image aria-label="Film Photo">
                        <img crossOrigin="anonymous" aria-label="Film Photo Image" src="{{ $images['conservation'] }}"
                            resize-img-src="{{ $images['conservation'] }}" />
                    </div>
                </aside>
                <nav mega-menu-stage-links role="navigation" aria-label="Conservation Links" enso>
                    @foreach ($sitePages['conservation'] as $item)
                        <a mega-menu-stage-links-link href="{{ $item['route'] }}">{{ $item['title'] }}</a>
                    @endforeach
                </nav>
            </div>
        </div>

        <div mega-menu="our-story" hide="sm">
            <div mega-menu-stage="our-story">
                <div mega-menu-stage-aside>
                    <div mega-menu-stage-aside-headline="light">Making Travel Meaningful</div>
                    <div mega-menu-stage-aside-tagline="light">How conservation travel has the power to protect wild
                        places and the wild animals that depend on them.</div>
                    <a href="#?lightbox=https://www.youtube.com/embed/NJlDF398-bk/?rel=0&amp;autoplay=1"
                        mega-menu-aside-button>Watch Video</a>
                    <div mega-menu-stage-aside-image="ben">
                        <img crossOrigin="anonymous" src="{{ $images['our-story'] }}"
                            resize-img-src="{{ $images['our-story'] }}" />
                    </div>
                </div>
                <div mega-menu-stage-links role="navigation" aria-label="Our Story" enso>
                    @foreach ($sitePages['our-story'] as $item)
                        <a mega-menu-stage-links-link href="{{ $item['route'] }}">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div mega-menu="resources" hide="sm">
            <div mega-menu-stage="resources">
                <div mega-menu-stage-aside>
                    <div mega-menu-stage-aside-headline>Nature Videos</div>
                    <div mega-menu-stage-aside-tagline="light">Hear from our travelers and guides while watching
                        exhilarating footage from our worldwide nature adventures.</div>
                    <div mega-menu-stage-aside-image="nature-videos">
                        <img crossOrigin="anonymous" src="{{ $images['traveler-resources'] }}"
                            resize-img-src="{{ $images['traveler-resources'] }}" />
                    </div>
                </div>
                <div mega-menu-stage-links role="navigation" aria-label="Traveler Resources" enso>
                    @foreach ($sitePages['traveler-resources'] as $item)
                        <a mega-menu-stage-links-link href="{{ $item['route'] }}">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div mega-menu="hamburger">
            <div mega-menu-stage="hamburger">
                <div mega-menu-stage-aside>
                    <div mega-menu-stage-aside-headline="light">Good Nature Blog</div>
                    <div mega-menu-stage-aside-tagline="light">Explore the flagship travel blog of Nat Hab and WWF for
                        conservation news, thrilling wildlife photos and more.</div>
                    {{-- <a href="blog/index.html" target="_blank" mega-menu-aside-button>Visit Good Nature</a> --}}
                    <div mega-menu-stage-aside-image="blog">
                        <img crossOrigin="anonymous" src="{{ $images['more'] }}"
                            resize-img-src="{{ $images['more'] }}" />
                    </div>
                </div>
                <div mega-menu-stage-links role="navigation" aria-label="More Section" enso>
                    @foreach ($sitePages['more'] as $item)
                        <a mega-menu-stage-links-link href="{{ $item['route'] }}">{{ $item['title'] }}</a>
                    @endforeach
                </div>
                <div mega-menu-social="links">
                    @foreach ($social_links as $item)
                        @if ($item->url)
                            <a mega-menu-social="link" js-social-link-mega="{{ $item->name }}"
                                href="{{ $item->url }}" target="_blank">
                                {!! $item->icon !!}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <label mega-menu-overlay for="mega-reset"></label>



        <!-- CTAs -->
        <div masthead-ctas hide="sm">
            <label masthead-cta="enews" for="modal-enews" js-enews-location="Masthead">eNewsletter</label>
            <label masthead-cta="catalog" for="modal-catalog" js-catalog-location="Masthead">Request Catalog</label>
        </div>


        <!-- Tertiary -->
        <nav masthead-tertiary hide="sm">
            <a masthead-tertiary-link="phone" href="tel:+18005438917"><strong>Questions?</strong>
                {{ $site_settings->phone }}</a>
            <a masthead-tertiary-link="login" class="user-login-link" href="{{ route('enter-portal') }}"
                rel="nofollow" target="_blank">
                <svg class="icon-user" viewBox="0 0 32 33" xmlns="http://www.w3.org/2000/svg">
                    <path class="icon-user-path-head"
                        d="M16 20.0247C20.4183 20.0247 24 16.4429 24 12.0247C24 7.60638 20.4183 4.02466 16 4.02466C11.5817 4.02466 8 7.60638 8 12.0247C8 16.4429 11.5817 20.0247 16 20.0247Z" />
                    <path class="icon-user-path-body"
                        d="M3.875 27.0246C5.10367 24.896 6.87104 23.1284 8.99944 21.8994C11.1278 20.6704 13.5423 20.0234 16 20.0234C18.4577 20.0234 20.8722 20.6704 23.0006 21.8994C25.129 23.1284 26.8963 24.896 28.125 27.0246" />
                </svg>
                My Portal
            </a>
        </nav>

    </div>
</header>
