<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use App\Models\Region;
use App\Models\Setting;
use App\Models\SitePage;
use App\Models\TripDate;
use App\Models\LegalPage;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Concerns\DataMethods;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\BaseController;
use App\Mail\ModalFormSubmited;
use App\Models\ModalForm;
use Illuminate\Database\Eloquent\Builder;

class MainController extends BaseController
{
    use DataMethods;

    protected $view = 'main.';

    public function home(): View
    {
        $regions = Region::all();
        return view($this->view . 'home', compact('regions'));
    }

    public function legal(String $slug)
    {
        $section = 'legal';
        $sectionTitle = Str::title(str_replace('-', ' ', $section));
        $bread = [[$sectionTitle, '#' . $section]];
        $slug = '/' . $section . '/' . $slug;
        $page = LegalPage::where('permalink', $slug)->first();
        $pages = LegalPage::all();
        if (!$page) return redirect('/');
        return view($this->view . $section . '.template', compact('page', 'bread', 'sectionTitle', 'pages'));
    }

    public function conservation(String $slug)
    {
        $section = 'conservation';
        $sectionTitle = Str::title(str_replace('-', ' ', $section));
        $bread = [[$sectionTitle, '#' . $section]];
        $slug = '/' . $section . '/' . $slug;
        $page = SitePage::where('menu_section', $section)->where('permalink', $slug)->first();
        if (!$page) return redirect('/');
        return view($this->view . $section . '.template', compact('page', 'bread', 'sectionTitle'));
    }

    public function ourStory(String $slug)
    {
        $section = 'our-story';
        $sectionTitle = Str::title(str_replace('-', ' ', $section));
        $bread = [[$sectionTitle, '#' . $section]];
        $slug = '/' . $section . '/' . $slug;
        $page = SitePage::where('menu_section', $section)->where('permalink', $slug)->first();
        if (!$page) return redirect('/');
        return view($this->view . $section . '.template', compact('page', 'bread', 'sectionTitle'));
    }

    public function travelerResources(String $slug)
    {
        $section = 'traveler-resources';
        $sectionTitle = Str::title(str_replace('-', ' ', $section));
        $bread = [[$sectionTitle, '#' . $section]];
        $slug = '/' . $section . '/' . $slug;
        $page = SitePage::where('menu_section', $section)->where('permalink', $slug)->first();
        if (!$page) return redirect('/');
        return view($this->view . $section . '.template', compact('page', 'bread', 'sectionTitle'));
    }

    public function more(String $slug)
    {
        $section = 'more';
        $sectionTitle = Str::title(str_replace('-', ' ', $section));
        $bread = [[$sectionTitle, '#' . $section]];
        $slug = '/' . $section . '/' . $slug;
        $page = SitePage::where('menu_section', $section)->where('permalink', $slug)->first();
        if (!$page) return redirect('/');
        return view($this->view . $section . '.template', compact('page', 'bread', 'sectionTitle'));
    }

    public function regions()
    {
        $parts = ceil(Region::count() / 2);
        $destinations = Region::all()->chunk(intval($parts))->all();

        return view($this->view . 'regions', compact('destinations'));
    }

    public function region(string $slug)
    {
        $section = 'regions';
        $sectionTitle = Str::title(str_replace('-', ' ', $section));
        $bread = [[$sectionTitle, '/' . $section]];
        $item = Region::where('permalink', 'like', '%' . $slug)->first();
        return view($this->view . 'trips-by-region', compact('item', 'bread'));
    }

    public function trip(?string $trip_section = 'overview', string $slug)
    {
        $section = 'trips';
        $sectionTitle = Str::title(str_replace('-', ' ', $section));
        $bread = [[$sectionTitle, '/our-' . $section]];

        $navLinks = [
            ['overview', 'Overview'],
            ['itinerary', 'Itinerary'],
            ['reviews', 'Traveler Reviews'],
            ['dates-prices-infos', 'Dates, Prices & Infos'],
            ['faqs', 'Know Before You Go'],
        ];

        $item = Trip::where('permalink', 'like', '%' . $slug)->first();
        if (!$item) return abort(404);

        $datesYears = TripDate::where('trip_id', $item->id)->whereNotNull('year')->get()->groupBy('year');

        return view($this->view . 'trip.template', compact('item', 'bread', 'trip_section', 'datesYears', 'navLinks'));
    }

    public function ourTrips(Request $r)
    {
        $region = app('request')->input('region');
        $country = app('request')->input('country');
        $wildlife = app('request')->input('wildlife');
        $interest = app('request')->input('interest');
        $startDate = app('request')->input('startDate');
        $endDate = app('request')->input('endDate');

        $trips = Trip::when($region, function (Builder $query) use ($region) {
            $query->whereHas('region', function (Builder $query) use ($region) {
                $query->where('permalink', 'like', '%' . $region . '%');
            });
        })->when($interest, function (Builder $query) use ($interest) {
            $query->whereHas('region', function (Builder $query) use ($interest) {
                $query->whereHas('interests', function (Builder $query) use ($interest) {
                    $query->where('permalink', 'like', '%' . $interest);
                });
            });
        })->when($startDate, function (Builder $query) use ($startDate) {
            $query->whereHas('dates', function (Builder $query) use ($startDate) {
                $query->whereDate('departure', '>=', $startDate);
            });
        })->when($endDate, function (Builder $query) use ($endDate) {
            $query->whereHas('dates', function (Builder $query) use ($endDate) {
                $query->whereDate('departure', '<=', $endDate);
            });
        })->get();

        return view($this->view . 'our-trips', compact('trips'));
    }

    public function modalForm(string $section = '', Request $r)
    {
        try {
            $validated = $r->validate($this->modalFormRules());
            $siteEmail = Setting::first() ? Setting::first()->email : User::where('role', 'admin')->first()->email;
            ModalForm::create(['section' => $section, 'fields' => $validated]);
            Mail::to($siteEmail)->send(new ModalFormSubmited($section, $r->except('_token')));

            return redirect(route('confirmation'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}