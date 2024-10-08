<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">Home</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ Route::currentRouteName() }}
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-uppercase">{{ $pageName }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <div class="nav-item d-flex align-self-end">
            </div>
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn bg-gradient-info dropdown-toggle btn-sm mb-0 me-2" type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Create Data
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#createTripModal">Trip</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#createRegionModal">Region</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#createCountryModal">Country</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#createInterestModal">Interest</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#createWildlifeModal">Wildlfie</a></li>
                    </ul>
                </div>
                <delete-multiple-data :datas="{{ json_encode($deleteDatas) }}"
                    :selected="{{ json_encode($selected) }}"></delete-multiple-data>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0 me-3" data-bs-toggle="modal"
                        data-bs-target="#socialLinksModal">Social Links</button>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <button type="button" class="btn btn-primary btn-sm mb-0 me-3" data-bs-toggle="modal"
                        data-bs-target="#siteSettingsModal">Site Settings <bi class="bi-gear-wide-connected"></bi>
                    </button>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-sign-out-alt  me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
