<div class="container-fluid mb-4">
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url({{ $images['hero'] }});background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-2"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ $images['pic'] }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $item->title }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {!! $text !!}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                        <li class="nav-item">

                            <button class="btn btn-sm btn-danger delete-btn" data-dialog="{{ $dataDialog }}"
                                data-route="{{ $deleteRoute }}">
                                <bi class="bi-trash"></bi> Delete
                            </button>
                        </li>
                        {{-- <div class="moving-tab position-absolute nav-link"
                            style="padding: 0px; transition: 0.5s; transform: translate3d(0px, 0px, 0px); width: 136px;">
                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="javascript:;"
                                role="tab" aria-selected="true">-</a> --}}
                </div>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="dropdown" id="fixedMiddle" style="right: 0">
    <button class="btn bg-gradient-warning dropdown-toggle" type="button" id="dropdownMenuButton"
        data-bs-toggle="dropdown" aria-expanded="false">
        <bi class="bi-search"></bi> Find Section
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @foreach ($tabs as $item)
            <li><a class="dropdown-item" href="{{ $item[1] }}">{{ $item[0] }}</a></li>
        @endforeach
    </ul>
</div>
