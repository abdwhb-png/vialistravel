<?php

namespace App\Concerns;

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Trip;
use App\Models\Region;
use App\Models\Country;
use App\Models\ErrorLog;
use App\Models\Interest;
use App\Models\TripDate;
use App\Models\Wildlife;
use Illuminate\Support\Str;
use App\Models\TripOverview;
use App\Models\TripHighlight;

trait DataMethods
{
    public function getSimpleDatas(string $type = '', ?array $data = []): array
    {
        $ret = [
            'list' => [],
            'cols' => [],
        ];
        try {
            $datas = [
                'countries' => Country::orderBy('title')->get()->toArray(),
                'interests' => Interest::orderBy('title')->get()->toArray(),
                'regions' => Region::orderBy('title')->get()->toArray(),
                'wildlives' => Wildlife::orderBy('title')->get()->toArray(),
            ];

            $data = count($data) ? $data : $datas[$type];
            $ret['list'] = $this->getDataWithShowUrl($type, $data);

            if (count($ret['list'])) {
                foreach (array_keys($ret['list'][0]) as $k) {
                    if (in_array($k, ['title', 'created_at', 'updated_at'])) {
                        $ret['cols'][] = ['field' => $k, 'header' => str_replace('_', ' ', Str::title($k))];
                    }
                }
            }
        } catch (\Throwable $th) {
            // throw $th;
            ErrorLog::create([
                'severity' => 'medium',
                'desc' => 'Error occured when retriving ' . $type . ' records',
                'error' => $th->getMessage(),
            ]);
        } finally {
            return $ret;
        }
    }

    public function dataShowUrl(string $type, int $id): string
    {
        return route(session('route_prefix') . 'showData', ['type' => $type, 'id' => $id]);
    }

    public function getDataWithShowUrl(string $type, array $data): array
    {
        $result = [];
        foreach ($data as $item) {
            $item['show_url'] = $this->dataShowUrl($type, $item['id']);
            $result[] = $item;
        }
        return $result;
    }

    public function createTripData(Trip $trip, string $section, array $data)
    {
        $ok = null;
        if ($section == 'highlights') {
            $ok = TripHighlight::updateOrCreate([
                'trip_id' => $trip->id,
                'id' => $data['id'] ?? null,
                'title' => $data['title'],
            ], ['text' => $data['text']]);
        }
        if ($section == 'dates') {
            $ok = TripDate::updateOrCreate([
                'trip_id' => $trip->id,
                'id' => $data['id'] ?? null,
            ], [
                'departure' => $data['departure'],
                'return' => $data['return'],
                'year' => $data['year'],
            ]);
        }
        if ($section == 'faqs') {
            $ok = Faq::updateOrCreate([
                'trip_id' => $trip->id,
                'id' => $data['id'] ?? null,
            ], [
                'question' => $data['question'],
                'response' => $data['response']
            ]);
        }
        if ($section == 'overview') {
            $ok = TripOverview::updateOrCreate(
                [
                    'trip_id' => $trip->id,
                ],
                $data
            );
        }

        return $ok;
    }

    public function randomDate($start = '2022-12-22')
    {
        $start = Carbon::parse($start); // Date de début
        $end = Carbon::now(); // Date actuelle

        // Générer un timestamp aléatoire entre les deux dates
        $randomTimestamp = rand($start->timestamp, $end->timestamp);

        // Convertir le timestamp en un objet Carbon
        return Carbon::createFromTimestamp($randomTimestamp);
    }
}