<footer class="footer pt-3  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    © {{ date('Y') }}
                    made with <i class="fa fa-heart"></i> by your favorite developper
                    <span class="font-weight-bold">KFEINE</span>
                </div>
            </div>
            <div class="col-lg-6 d-,one">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    @foreach ($social_links as $item)
                        <li class="nav-item">
                            <a href="{{ $item->url ?? '#' }}" class="nav-link text-muted"
                                target="_blank">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>
