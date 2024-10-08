<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Region;
use App\Models\Country;
use App\Models\Interest;
use App\Models\SitePage;
use App\Models\Wildlife;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Concerns\DataMethods;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CreateController extends BaseController
{
    use DataMethods;

    public function createPage(Request $r): JsonResponse
    {

        try {
            $validated = $r->validate($this->pagesRules());

            if (SitePage::count() >= 15)
                return $this->sendError(msg: 'You have reached the maximum of 15 page !');

            SitePage::create($r->all());

            return $this->sendSuccess('Site page have been created !');
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }

    public function createData(string $type, Request $r): RedirectResponse
    {
        try {
            $validated = $r->validate($this->dataRules());
            $item = null;
            if ($type == 'trips')
                $item = Trip::create($r->all());
            if ($type == 'regions')
                $item = Region::create($r->all());
            if ($type == 'countries')
                $item = Country::create($r->all());
            if ($type == 'interests')
                $item = Interest::create($r->all());
            if ($type == 'wlidlives')
                $item = Wildlife::create($r->all());

            if (!$item)
                return $this->showError('The data could not be created, please try again !');

            $redirect = $this->dataShowUrl($type, $item->id);

            return $this->showSuccess(msg: 'The data have been created.', where: $redirect);
        } catch (\Throwable $th) {
            return $this->redirectTh($th);
        }
    }
}
