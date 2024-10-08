@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <div class="d-md-flex justify-content-between">
                        <h6 class="flex-fill">Here are the regions and and their respective country, interests & wildlives
                        </h6>
                        <form action="" method="get" class="flex-fill">
                            <div class="input-group">
                                <button type="submit" class="btn btn-sm btn-outline-primary mb-0"><i class="fas fa-search"
                                        aria-hidden="true"></i></button>
                                @if ($search)
                                    <a href="{{ url()->current() }}" class="btn mb-0"><i class="fas fa-window-close"
                                            aria-hidden="true"></i></a>
                                @endif
                                <input type="text" name="search" value="{{ $search }}"
                                    class="form-control form-control-sm px-2 pe-0"
                                    placeholder="Search by region title or country/interest/wildlife">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-3">
                    {!! $datas->withQueryString()->links('pagination::bootstrap-5') !!}
                    <div class="row g-3">
                        @foreach ($datas as $item)
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                        <a href="javascript:;" class="d-block">
                                            <img src="{{ $item->medias()['pic'] }}" class="img-fluid border-radius-lg">
                                        </a>
                                    </div>

                                    <div class="card-body pt-2">
                                        <h5 class="card-title h5 d-block text-darker">
                                            {{ $item->title }}
                                        </h5>
                                        <p class="card-description mb-4">
                                            {!! strlen($item->intro) > 100 ? substr($item->intro, 0, 101) . '..' : $item->intro !!}
                                        </p>
                                        <div class="d-flex align-items-center justify-content-end">
                                            <a href="{{ route($route_prefix . 'showData', ['type' => 'regions', 'id' => $item->id]) }}"
                                                class="btn btn-outline-primary btn-sm mb-0"> Show region </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer pb-0 p-3">
                    {!! $datas->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
