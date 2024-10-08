<div subpage="middle">
    <h2 name="wrapper">
        Overview
    </h2>
    <div pricing="wrapper" class="show" enso="">
        <div tagline="wrapper" class="hide" enso="">{{ 'Dicover our ' . $item->title }}</div>
        <div pricing="first-group">
            <svg icon="calendar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37 37">
                <path
                    d="M20 23.333Q19.292 23.333 18.812 22.854Q18.333 22.375 18.333 21.667Q18.333 20.958 18.812 20.479Q19.292 20 20 20Q20.708 20 21.188 20.479Q21.667 20.958 21.667 21.667Q21.667 22.375 21.188 22.854Q20.708 23.333 20 23.333ZM13.333 23.333Q12.625 23.333 12.146 22.854Q11.667 22.375 11.667 21.667Q11.667 20.958 12.146 20.479Q12.625 20 13.333 20Q14.042 20 14.521 20.479Q15 20.958 15 21.667Q15 22.375 14.521 22.854Q14.042 23.333 13.333 23.333ZM26.667 23.333Q25.958 23.333 25.479 22.854Q25 22.375 25 21.667Q25 20.958 25.479 20.479Q25.958 20 26.667 20Q27.375 20 27.854 20.479Q28.333 20.958 28.333 21.667Q28.333 22.375 27.854 22.854Q27.375 23.333 26.667 23.333ZM20 30Q19.292 30 18.812 29.521Q18.333 29.042 18.333 28.333Q18.333 27.625 18.812 27.146Q19.292 26.667 20 26.667Q20.708 26.667 21.188 27.146Q21.667 27.625 21.667 28.333Q21.667 29.042 21.188 29.521Q20.708 30 20 30ZM13.333 30Q12.625 30 12.146 29.521Q11.667 29.042 11.667 28.333Q11.667 27.625 12.146 27.146Q12.625 26.667 13.333 26.667Q14.042 26.667 14.521 27.146Q15 27.625 15 28.333Q15 29.042 14.521 29.521Q14.042 30 13.333 30ZM26.667 30Q25.958 30 25.479 29.521Q25 29.042 25 28.333Q25 27.625 25.479 27.146Q25.958 26.667 26.667 26.667Q27.375 26.667 27.854 27.146Q28.333 27.625 28.333 28.333Q28.333 29.042 27.854 29.521Q27.375 30 26.667 30ZM7.792 36.667Q6.667 36.667 5.833 35.833Q5 35 5 33.875V8.875Q5 7.75 5.833 6.938Q6.667 6.125 7.792 6.125H10.125V3.333H13.042V6.125H26.958V3.333H29.875V6.125H32.208Q33.333 6.125 34.167 6.938Q35 7.75 35 8.875V33.875Q35 35 34.167 35.833Q33.333 36.667 32.208 36.667ZM7.792 33.875H32.208Q32.208 33.875 32.208 33.875Q32.208 33.875 32.208 33.875V16.375H7.792V33.875Q7.792 33.875 7.792 33.875Q7.792 33.875 7.792 33.875ZM7.792 13.625H32.208V8.875Q32.208 8.875 32.208 8.875Q32.208 8.875 32.208 8.875H7.792Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875ZM7.792 13.625V8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875V13.625Z">
                </path>
            </svg>
            <a href="/polar-bear-tours/ultimate-churchill/dates-fees/" link="trip-details">
                <div pricing="row">
                    <span pricing="days">
                        {{ $item->duration }}
                    </span>
                </div>
                <div pricing="row">
                    <span pricing="travelers" class="js-hide-if-blank">{{ $item->travelers_limit }}</span>
                </div>
                <div pricing="row">
                    <span pricing="cost">
                        From {{ $item->pricing }}
                    </span>
                    <span pricing="suffix" class="hide">
                        (+air)
                    </span>
                </div>
            </a>
        </div>
        <div pricing="group">
            @if ($item->can_be_private)
                <div pricing="item private">
                    <div link="make-it-private" class="show">
                        <svg icon="location" width="31" height="44" viewBox="0 0 31 44" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1049_5774)">
                                <path
                                    d="M15.18 1C7.35 1 1 7.35 1 15.18C1 17.9 1.76 20.43 3.09 22.59L3.24 22.83L15.18 41.77L27.12 22.83L27.27 22.59C28.59 20.43 29.36 17.9 29.36 15.18C29.36 7.35 23.01 1 15.18 1V1Z"
                                    stroke-width="3" stroke-miterlimit="10"></path>
                                <path
                                    d="M19.71 16.91L20.62 23L15.18 20.25L9.74004 23L10.65 16.91L6.29004 12.53L12.45 11.61L15.18 6.07996L17.92 11.61L24.07 12.53L19.71 16.91Z"
                                    stroke-width="2.25" stroke-miterlimit="10"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_1049_5774">
                                    <rect width="30.36" height="43.64" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                        <a href="?lightbox=custom" class="custom hide">Make it Custom</a>
                        <a href="?lightbox=private" class="private">Make it Private</a>
                    </div>
                </div>
            @endif
        </div>

    </div>

    <div intro="wrapper" enso="">
        {!! $item->overview->description !!}
    </div>

    @if ($item->photos)
        <div style="text-align: center">
            <my-gallery :datas="{{ json_encode($item->parsedPhotos()) }}"></my-gallery>
        </div>
    @endif

    <div highlights-wrapper="" class="" enso="">
        <h2 highlights-title="">Trip Highlights</h2>
        @foreach ($item->highlights as $h)
            <div highlight="">
                <p highlight-title="">{{ $h->title }}</p>
                <div highlight-description="">{{ $h->text }}<br></div>
            </div>
        @endforeach
    </div>

    <section reasons="wrapper" enso="" class="">
        <div class="js-differences" reasons="anchor-link"></div>
        <h2 reasons="title">
            More details about trip
        </h2>
        <div reasons="text">
            {!! $item->overview->more_infos !!}
        </div>
    </section>

    @if ($item->reviews && false)
        <x-main.reviews-repeater :title="'Read what travelers are saying about our ' . $item->title" :reviews="$item->reviews"></x-main.reviews-repeater>
    @endif

</div>
