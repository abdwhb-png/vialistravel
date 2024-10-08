<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Trip;
use App\Models\Region;
use App\Models\Review;
use App\Models\Country;
use App\Models\Setting;
use App\Models\ErrorLog;
use App\Models\Interest;
use App\Models\SitePage;
use App\Models\Wildlife;
use Illuminate\View\View;
use App\Models\TripReview;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Concerns\DataMethods;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;

class AdminController extends BaseController
{
    use DataMethods;
    protected $viewPrefix = 'admin.';
    protected $routePrefix;

    public function __construct()
    {
        $this->routePrefix = config('vars.admin_route_prefix');
    }

    public function dashboard(): View
    {
        $stats = [
            'regions' => [Trip::count(), 'world'],
            'trips' => [Trip::count(), 'spaceship'],
            'site pages' => [SitePage::withTrashed()->count(), 'single-copy-04'],
            'FAQs' => [Faq::count(), 'chat-33'],
            'reviews' => [Review::count(), 'shape-star'],
        ];
        $simple_datas = [
            'countries' => $this->getSimpleDatas('countries'),
            'wildlives' => $this->getSimpleDatas('wildlives'),
            'interests' => $this->getSimpleDatas('interests'),
            'regions' => $this->getSimpleDatas('regions'),
        ];
        return view($this->viewPrefix . 'dashboard', compact('stats', 'simple_datas'));
    }

    public function trips(): View
    {
        $search = app('request')->input('search');
        $datas = Trip::when(
            $search,
            function (Builder $query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orwhereHas('region', function (Builder $query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    });
            }
        )->paginate(20);

        return view($this->viewPrefix . 'trips', compact('datas', 'search'));
    }

    public function regions(): View
    {
        $search = app('request')->input('search');
        $datas = Region::when(
            $search,
            function (Builder $query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orwhereHas('countries', function (Builder $query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    })->orwhereHas('interests', function (Builder $query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    })->orwhereHas('wildlives', function (Builder $query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    });
            }
        )->paginate(20);

        return view($this->viewPrefix . 'regions', compact('datas', 'search'));
    }

    public function sitePages(): View
    {
        $pages = SitePage::orderBy('deleted_at', 'DESC')->orderBy('name')->withTrashed()->get();
        foreach ($pages as $p) {
            $index = $p->id < 25 ? $p->id : intdiv($p->id, 25);
            $p->img = "https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/" . $index . ".jpeg";
        }
        $menu_sections = config('vars.menu_sections');
        return view($this->viewPrefix . 'site-pages', compact('pages', 'menu_sections'));
    }

    public function restorePage(int $id): RedirectResponse
    {
        $page = SitePage::withTrashed()->where('id', $id)->first();
        $page->restore();

        return $this->showSuccess('Site page have been restored');
    }

    public function showData(string $type, int $id): View
    {
        $item = null;
        if ($type == 'countries') {
            $item = Country::findOrFail($id);
        }
        if ($type == 'regions') {
            $item = Region::findOrFail($id);
        }
        if ($type == 'trips') {
            $item = Trip::findOrFail($id);
        }
        if ($type == 'interests') {
            $item = Interest::findOrFail($id);
        }
        if ($type == 'wildlives') {
            $item = Wildlife::findOrFail($id);
        }

        if (!$item)
            return $this->showError('Data not found...');

        $deleteRoute = route($this->routePrefix . 'deleteData', ['type' => $type, 'id' => $item->id]);

        return view($this->viewPrefix . 'show-data', compact('item', 'type', 'deleteRoute'));
    }
}