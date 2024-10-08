 <div repeater-trips="">
     @foreach ($trips as $item)
         <a href="{{ route('trip', ['trip_section' => 'overview', 'slug' => $item->permalink]) }}" repeater-trip="">
             <div repeater-photo="">
                 <img repeater-img="" resize-img-src="{{ $item->medias()['pic'] }}" alt="{{ 'Image : ' . $item->title }}"
                     src="{{ $item->medias()['pic'] }}">
                 <img repeater-badge="" resize-img-src="">
                 <div repeater-tag="" class="hide">New 2024 Dates!</div>
                 <div repeater-tag="" class="hide">New Itinerary!</div>
             </div>
             <div repeater-text="">
                 <h3 repeater-name="">{{ $item->title }}</h3>
                 <div repeater-trip-description="">
                     {{ $item->intro }}
                     <br>
                 </div>
             </div>
             <div repeater-details="" trip="">
                 <div repeater-trip-pricing="" class="show">
                     <svg icon="calendar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37 37">
                         <path
                             d="M20 23.333Q19.292 23.333 18.812 22.854Q18.333 22.375 18.333 21.667Q18.333 20.958 18.812 20.479Q19.292 20 20 20Q20.708 20 21.188 20.479Q21.667 20.958 21.667 21.667Q21.667 22.375 21.188 22.854Q20.708 23.333 20 23.333ZM13.333 23.333Q12.625 23.333 12.146 22.854Q11.667 22.375 11.667 21.667Q11.667 20.958 12.146 20.479Q12.625 20 13.333 20Q14.042 20 14.521 20.479Q15 20.958 15 21.667Q15 22.375 14.521 22.854Q14.042 23.333 13.333 23.333ZM26.667 23.333Q25.958 23.333 25.479 22.854Q25 22.375 25 21.667Q25 20.958 25.479 20.479Q25.958 20 26.667 20Q27.375 20 27.854 20.479Q28.333 20.958 28.333 21.667Q28.333 22.375 27.854 22.854Q27.375 23.333 26.667 23.333ZM20 30Q19.292 30 18.812 29.521Q18.333 29.042 18.333 28.333Q18.333 27.625 18.812 27.146Q19.292 26.667 20 26.667Q20.708 26.667 21.188 27.146Q21.667 27.625 21.667 28.333Q21.667 29.042 21.188 29.521Q20.708 30 20 30ZM13.333 30Q12.625 30 12.146 29.521Q11.667 29.042 11.667 28.333Q11.667 27.625 12.146 27.146Q12.625 26.667 13.333 26.667Q14.042 26.667 14.521 27.146Q15 27.625 15 28.333Q15 29.042 14.521 29.521Q14.042 30 13.333 30ZM26.667 30Q25.958 30 25.479 29.521Q25 29.042 25 28.333Q25 27.625 25.479 27.146Q25.958 26.667 26.667 26.667Q27.375 26.667 27.854 27.146Q28.333 27.625 28.333 28.333Q28.333 29.042 27.854 29.521Q27.375 30 26.667 30ZM7.792 36.667Q6.667 36.667 5.833 35.833Q5 35 5 33.875V8.875Q5 7.75 5.833 6.938Q6.667 6.125 7.792 6.125H10.125V3.333H13.042V6.125H26.958V3.333H29.875V6.125H32.208Q33.333 6.125 34.167 6.938Q35 7.75 35 8.875V33.875Q35 35 34.167 35.833Q33.333 36.667 32.208 36.667ZM7.792 33.875H32.208Q32.208 33.875 32.208 33.875Q32.208 33.875 32.208 33.875V16.375H7.792V33.875Q7.792 33.875 7.792 33.875Q7.792 33.875 7.792 33.875ZM7.792 13.625H32.208V8.875Q32.208 8.875 32.208 8.875Q32.208 8.875 32.208 8.875H7.792Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875ZM7.792 13.625V8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875Q7.792 8.875 7.792 8.875V13.625Z">
                         </path>
                     </svg>
                     <div icon-text="">
                         <div text-days="">{{ $item->duration }}</div>
                         <div pricing-text="">{{ $item->pricing }}</span></div>
                         <div repeater-travelers="">{{ $item->travelers_limit }}</div>
                     </div>
                 </div>
                 <div repeater-countries="" class="hide">
                     <svg icon="globe" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                         viewBox="0 0 32 32" fill="none">
                         <path
                             d="M16 28C22.6274 28 28 22.6274 28 16C28 9.37258 22.6274 4 16 4C9.37258 4 4 9.37258 4 16C4 22.6274 9.37258 28 16 28Z"
                             stroke-width="2" stroke-miterlimit="10"></path>
                         <path d="M4.6875 12H27.3125" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                         </path>
                         <path d="M4.6875 20H27.3125" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                         </path>
                         <path
                             d="M16 27.6749C18.7614 27.6749 21 22.4479 21 16C21 9.55203 18.7614 4.32495 16 4.32495C13.2386 4.32495 11 9.55203 11 16C11 22.4479 13.2386 27.6749 16 27.6749Z"
                             stroke-width="1.5" stroke-miterlimit="10"></path>
                     </svg>
                     <span icon-text=""></span>
                 </div>
                 <div repeater-photo-departures="" class="hide">
                     <svg icon="camera" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                         viewBox="0 0 32 32" fill="none">
                         <path
                             d="M26 26H6C5.46957 26 4.96086 25.7893 4.58579 25.4142C4.21071 25.0391 4 24.5304 4 24V10C4 9.46957 4.21071 8.96086 4.58579 8.58579C4.96086 8.21071 5.46957 8 6 8H10L12 5H20L22 8H26C26.5304 8 27.0391 8.21071 27.4142 8.58579C27.7893 8.96086 28 9.46957 28 10V24C28 24.5304 27.7893 25.0391 27.4142 25.4142C27.0391 25.7893 26.5304 26 26 26Z"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                         <path
                             d="M16 21C18.4853 21 20.5 18.9853 20.5 16.5C20.5 14.0147 18.4853 12 16 12C13.5147 12 11.5 14.0147 11.5 16.5C11.5 18.9853 13.5147 21 16 21Z"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                     </svg>
                     <span icon-text="photo">Photo Expeditions Available</span>
                 </div>
                 <div repeater-private="" js-show-private-or-custom=""
                     class="{{ $item->can_be_private ? 'show' : 'hide' }}">
                     <svg icon="location" width="31" height="44" viewBox="0 0 31 44" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <g clip-path="url(#clip0_1049_5774)">
                             <path
                                 d="M15.18 1C7.35 1 1 7.35 1 15.18C1 17.9 1.76 20.43 3.09 22.59L3.24 22.83L15.18 41.77L27.12 22.83L27.27 22.59C28.59 20.43 29.36 17.9 29.36 15.18C29.36 7.35 23.01 1 15.18 1V1Z"
                                 stroke-width="2.5" stroke-miterlimit="10"></path>
                             <path
                                 d="M19.71 16.91L20.62 23L15.18 20.25L9.74004 23L10.65 16.91L6.29004 12.53L12.45 11.61L15.18 6.07996L17.92 11.61L24.07 12.53L19.71 16.91Z"
                                 stroke-width="2" stroke-miterlimit="10"></path>
                         </g>
                         <defs>
                             <clipPath id="clip0_1049_5774">
                                 <rect width="30.36" height="43.64" fill="white"></rect>
                             </clipPath>
                         </defs>
                     </svg>
                     <span icon-text="" class="custom hide">Make it Custom</span>
                     <span icon-text="" class="private">Make it Private</span>
                 </div>
                 <div repeater-tag-vert="" class="hide">New 2024 Dates!</div>
             </div>
             <div repeater-button="">View Trip</div>
         </a>
     @endforeach
 </div>
