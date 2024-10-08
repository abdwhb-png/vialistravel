@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-1">Here are the customizable pages of the site with their respective menu section in blue
                    </h6>
                    <p class="text-sm">You can add, edit or delete a page...</p>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card h-100 card-plain border">
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <new-site-page route="{{ route($route_prefix . 'createPage') }}"
                                        v-bind:menu-sections="{{ json_encode($menu_sections) }}"></new-site-page>
                                </div>
                            </div>
                        </div>
                        @foreach ($pages as $item)
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="{{ $item->img }}" alt="{{ $item->name }}"
                                                class="img-fluid shadow border-radius-xl">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <span
                                            class="text-gradient {{ $item->menu_section ? 'text-primary' : 'text-danger' }} text-uppercase text-xs font-weight-bold my-2">
                                            {{ $item->menu_section ?? 'NO SECTION' }} </span>
                                        <a href="#">
                                            <h5>
                                                {{ $item->name }}
                                            </h5>
                                        </a>
                                        <div id="page-html">
                                            {!! strlen($item->content) > 350 ? substr($item->content, 0, 351) . '..' : $item->content !!}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <edit-site-page
                                                route="{{ route($route_prefix . 'updt-page', ['type' => 'legal', 'id' => $item->id]) }}"
                                                :menu-sections="{{ json_encode($menu_sections) }}"
                                                :item="{{ json_encode($item) }}"></edit-site-page>
                                            <div class="mt-2">
                                                @if (!$item->trashed())
                                                    <button class="btn btn-sm btn-danger delete-btn"
                                                        data-dialog="Are you sure to delete the page {{ $item->name }} ??"
                                                        data-route="{{ route(session('route_prefix') . 'deletePage', $item->id) }}">
                                                        <bi class="bi-trash"></bi>
                                                    </button>
                                                @else
                                                    <a class="btn btn-sm btn-secondary"
                                                        href="{{ route(session('route_prefix') . 'restorePage', $item->id) }}">
                                                        <bi class="bi-arrow-clockwise"></bi>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
