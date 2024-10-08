    <section reviews="wrapper" enso="">
        <h3>{{ $title }}</h3>
        <div reviews="text">
            <div class="row">
                <div class="col-xs-24" style="padding-bottom: 15px;">
                    <div class="row gallery grid images-layout reviews-block"
                        style="position: relative; height: 1846.78px;">
                        <div class="grid-sizer"></div>
                        @foreach ($reviews as $item)
                            <div class="grid-item custom-review  cursor-default   gutter-images"
                                style="position: absolute; left: 0%; top: 0px;">
                                <div class="image-wrapper block-link-hover3" tabindex="0" data-type="review-box">
                                    <div
                                        class="review-grid-group review-grid-boxed-layout review-grid-group1 border-boxes ">
                                        <div>
                                            <span>
                                                <div class="div-img-boxed div-img-boxed-1"
                                                    style="background-color:#f1592a;"><span>
                                                        {{ substr($item->author, 0) }}</span></div>
                                                <p class="h5 push-15-t push-5 font-w600 text-center reviewer-name">
                                                    {{ $item->author }} </p>
                                                <div class="review-date review-date-boxed-1 text-center text-muted">
                                                    {{ $item->publi_date }} </div>
                                                <div class="review-grid-stars text-center margin-b-10">
                                                    @for ($i = 0; $i < $item->stars; $i++)
                                                        <svg height="16" width="16" role="img"
                                                            aria-label="star">
                                                            <path class="fill"
                                                                d="M8 .391l2.446 5.045 5.555 0.767-4.043 3.885 0.987 5.521-4.944-2.644-4.945 2.462 0.987-5.519-4.043-3.885 5.555-0.526z"
                                                                fill="#ac6302"></path>
                                                        </svg>
                                                    @endfor
                                                    @for ($i = 0; $i < 5 - $item->stars; $i++)
                                                        <svg height="16" width="16" role="img"
                                                            aria-label="star">
                                                            <path
                                                                d="M8 .391l2.446 5.045 5.555 0.767-4.043 3.885 0.987 5.521-4.944-2.644-4.945 2.462 0.987-5.519-4.043-3.885 5.555-0.526z"
                                                                fill="#cbcbcb"></path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                </a>
                                                <div class="review-grid-font review-grid-text margin-b-10 reviews-text cursor-default more-text"
                                                    id="read_more_review_{{ $item->id }}" style="display:block">
                                                    {{ $item->comment }}
                                                </div>
                                        </div>
                                        <a style="text-decoration:none" tabindex="-1" class="cursor-default">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="next-page-num" style="display:none"> </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
