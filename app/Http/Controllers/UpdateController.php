<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Faq;
use App\Models\Trip;
use App\Models\Period;
use App\Models\Region;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Interest;
use App\Models\SitePage;
use App\Models\TripDate;
use App\Models\Wildlife;
use App\Models\LegalPage;
use App\Models\SocialLink;
use App\Models\TripOverview;
use Illuminate\Http\Request;
use App\Concerns\DataMethods;
use App\Models\TripHighlight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;

class UpdateController extends BaseController
{
    use DataMethods;

    public function updtSettings(Request $r): RedirectResponse
    {
        $validated = $r->validate($this->siteSettingsRules());
        try {
            $s = Setting::first();
            $s->update($r->all());
        } catch (\Throwable $th) {
            $this->redirectTh($th);
        }

        return $this->showSuccess('Site settings have been updated');
    }

    public function updtSocialLinks(Request $r): RedirectResponse
    {
        $validated = $r->validate($this->socialLinksRules());
        try {
            foreach ($r->links as $key => $value) {
                $link = SocialLink::updateOrCreate(
                    ['id' => $key],
                    ['url' => $value]
                );
            }
        } catch (\Throwable $th) {
            $this->redirectTh($th);
        }

        return $this->showSuccess('Social links have been updated !');
    }

    public function updtPage(string $type, int $id, Request $r): JsonResponse
    {
        try {
            if ($type == 'site')
                $page = SitePage::findOrFail($id);
            if ($type == 'legal')
                $page = LegalPage::findOrFail($id);

            if (!$page) return abort(400);

            $validated = $r->validate($this->pagesRules($page->id, $type . '_pages'));
            $r['content'] = $this->purifyHtml($r['content']);
            $page->update($r->all());

            return $this->sendSuccess($type . ' page have been updated !');
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }

    public function updtData(string $type, Request $r): JsonResponse
    {
        try {
            $validated = $r->validate($this->dataRules($type));

            $item = null;
            if ($r->intro) {
                $r['intro'] = $this->purifyHtml($r['intro']);
            }
            if ($r->description) {
                $r['description'] = $this->purifyHtml($r['description']);
            }

            $data = $r->all();
            if ($type == 'regions') {
                $item = Region::findOrFail($r->id);
                $data = $r->only('intro', 'title', 'description');
            }
            if ($type == 'trips') {
                $data = $r->only('title', 'description', 'duration', 'pricing', 'travelers_limit', 'ountries', 'can_be_private');
                $item = Trip::findOrFail($r->id);
            }

            if (!$item)
                return $this->sendError('Data not found...');

            $item->update($data);

            return $this->sendSuccess('The data have been updated !');
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }

    public function updateRegion(String $section, Request $r)
    {
        try {
            if ($section == 'trips')
                $msg = $this->regionTrips($r);
            if ($section == 'countries')
                $msg = $this->regionCountries($r);
            if ($section == 'interests')
                $msg = $this->regionInterests($r);
            if ($section == 'wildlives')
                $msg = $this->regionWildlives($r);

            return $this->sendSuccess(msg: $msg);
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }

    public function regionTrips(Request $r)
    {
        try {
            $validated = $r->validate($this->regionTripsCountriesRules());
            $region = Region::findOrFail($r->id);

            $already_selected = [];
            foreach (Trip::whereNotNull('region_id')->where('region_id', '!=', $region->id)->get() as $c) {
                foreach ($r->datas as $cc) {
                    if ($c->id == $cc['code'])
                        $already_selected[] = $cc['name'];
                }
            }
            if (count($already_selected))
                return $this->sendError('This countries has already been added to other regions. Please select countries that are not selected yet', $already_selected);

            foreach (Trip::where('region_id', $region->id)->get() as $c) {
                $c->update(['region_id' => null]);
            }

            foreach ($r->datas as $c) {
                Trip::find($c['code'])->update(['region_id' => $region->id]);
            }

            return $this->showSuccess(msg: 'The region\'s trips have been updated !', json_res: true);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function regionCountries(Request $r)
    {
        try {
            $validated = $r->validate($this->regionTripsCountriesRules());
            $region = Region::findOrFail($r->id);

            $already_selected = [];
            foreach (Country::whereNotNull('region_id')->where('region_id', '!=', $region->id)->get() as $c) {
                foreach ($r->datas as $cc) {
                    if ($c->id == $cc['code'])
                        $already_selected[] = $cc['name'];
                }
            }
            if (count($already_selected))
                return $this->sendError('This countries has already been added to other regions. Please select countries that are not selected yet', $already_selected);

            foreach (Country::where('region_id', $region->id)->get() as $c) {
                $c->update(['region_id' => null]);
            }

            foreach ($r->datas as $c) {
                Country::find($c['code'])->update(['region_id' => $region->id]);
            }

            return $this->showSuccess(msg: 'The region\'s countries have been updated !', json_res: true);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function regionInterests(Request $r)
    {
        try {
            // $validated = $r->validate([]);
            $item = Region::findOrFail($r->id);

            $item->interests()->detach();

            foreach ($r->selected as $sel) {
                $item->interests()->attach($sel['id']);
            }

            return 'The interests has been bounded to the region !';
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function regionWildlives(Request $r)
    {
        try {
            // $validated = $r->validate([]);
            $item = Region::findOrFail($r->id);

            $item->wildlives()->detach();

            foreach ($r->selected as $sel) {
                $item->wildlives()->attach($sel['id']);
            }

            return 'The wildlives has been bounded to the region !';
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function interestRegions(Request $r): JsonResponse
    {
        try {
            // $validated = $r->validate([]);
            $item = Interest::findOrFail($r->id);

            $item->regions()->detach();

            foreach ($r->selected as $sel) {
                $item->regions()->attach($sel['id']);
            }

            return $this->showSuccess(msg: 'The regions has been bounded to the interest !', json_res: true);
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }

    public function wildlifeRegions(Request $r): JsonResponse
    {
        try {
            // $validated = $r->validate([]);
            $item = Wildlife::findOrFail($r->id);

            $item->regions()->detach();

            foreach ($r->selected as $sel) {
                $item->regions()->attach($sel['id']);
            }

            return $this->showSuccess(msg: 'The regions has been bounded to the wildlife', json_res: true);
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }

    public function countryRegion(Request $r): JsonResponse
    {
        try {
            // $validated = $r->validate([]);
            $item = Country::findOrFail($r->id);

            $item->update([
                'region_id' => $r->datas['code'],
            ]);

            return $this->showSuccess(msg: 'The country\'s region have been updated', json_res: true);
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }

    public function updateTrip(String $section, Request $r)
    {
        try {
            $validated = $r->validate($this->tripRules());
            $successMsg = 'The trip\'s ' . $section . ' have been updated';
            $item = Trip::findOrFail($r->id);
            $ok = null;
            if ($section == 'region') {
                $ok = $item->update([
                    'region_id' => $r->datas['code'],
                ]);
                return $this->showSuccess(msg: $successMsg, json_res: true);
            }

            if ($section == 'overview') {
                $ok = $this->createTripData($item, $section, $r->all());
            }
            if (in_array($section, ['highlights', 'dates', 'faqs'])) {
                foreach ($r->datas as $k => $it) {
                    if ($section == 'dates' && $it['return'] < $it['departure']) {
                        return $this->sendError('Return date cannot be before departure date for date ' . $k + 1);
                    }
                    $ok = $this->createTripData($item, $section, $it);
                }
            }

            if (!$ok)
                return $this->sendError();

            return $this->sendSuccess(msg: $successMsg);
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }
}
