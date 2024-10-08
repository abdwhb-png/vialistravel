<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Trip;
use App\Models\Region;
use App\Models\Review;
use App\Models\Country;
use App\Models\Interest;
use App\Models\SitePage;
use App\Models\TripDate;
use App\Models\Wildlife;
use Illuminate\Http\Request;
use App\Models\TripHighlight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;

class DeleteController extends BaseController
{
    public function deletePage(SitePage $page): RedirectResponse
    {
        $page->delete();

        return $this->showSuccess(msg: 'Site page have been deleted !', where: '/site-pages');
    }

    public function deleteData(string $type, ?int $id = null): RedirectResponse|JsonResponse
    {
        try {
            $name =  substr($type, 0, -1);
            $json_res = false;

            $item = null;
            if ($type == 'countries') {
                $item = Country::findOrFail($id);
            }
            if ($type == 'regions') {
                $item = Region::findOrFail($id);
            }
            if ($type == 'interests') {
                $item = Interest::findOrFail($id);
            }
            if ($type == 'wildlives') {
                $item = Wildlife::findOrFail($id);
            }
            if ($type == 'trips') {
                $item = Trip::findOrFail($id);
            }
            if ($type == 'highlights') {
                $item = TripHighlight::findOrFail($id);
                $name = 'trip highlight';
                $json_res = true;
            }
            if ($type == 'dates') {
                $item = TripDate::findOrFail($id);
                $name = 'trip date';
                $json_res = true;
            }
            if ($type == 'faqs') {
                $item = Faq::findOrFail($id);
                $name = 'trip faq';
                $json_res = true;
            }
            if ($type == 'reviews') {
                $item = Review::findOrFail($id);
                $name = 'trip review';
                $json_res = true;
            }

            if (!$item)
                return $this->showError(msg: 'Data not found...', json_res: $json_res);

            $item->delete();
            $msg = 'The ' . $name . ' have been deleted !';

            if ($json_res)
                return $this->sendSuccess(msg: $msg);
            return $this->showSuccess(msg: $msg, where: '/dashboard');
        } catch (\Throwable $th) {
            if ($json_res) {
                return $this->sendTh($th);
            }
            return $this->redirectTh($th);
        }
    }

    public function massDeleteData(string $type, Request $r): JsonResponse
    {
        try {
            if ($type == 'countries') {
                $items = Country::whereIn('id', $r->ids);
            }
            if ($type == 'regions') {
                $items = Region::whereIn('id', $r->ids);
            }
            if ($type == 'interests') {
                $items = Interest::whereIn('id', $r->ids);
            }
            if ($type == 'wildlives') {
                $items = Wildlife::whereIn('id', $r->ids);
            }
            if ($type == 'trips') {
                $items = Trip::whereIn('id', $r->ids);
            }
            if ($type == 'faqs') {
                $items = Faq::whereIn('id', $r->ids);
            }

            $ok = $items->delete();

            if (!$ok)
                return $this->sendError('Something went wrong, please try again.');

            return $this->showSuccess(msg: 'The data records have been successfully deleted !', json_res: true);
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }
}
