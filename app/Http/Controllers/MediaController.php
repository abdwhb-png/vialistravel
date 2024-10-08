<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Media;
use App\Models\Region;
use App\Models\Country;
use App\Models\ErrorLog;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class MediaController extends BaseController
{
    public function uploadFile($file, $storagePath)
    {
        $stored = $file->store($storagePath);
        // $file->move(public_path('deals'), $stored);
        return $stored;
    }

    public function deleteFile(String $path): bool
    {
        $path = 'public' . $path;
        $ret = Storage::exists($path) && Storage::delete($path);
        if (!$ret)
            ErrorLog::create([
                'severity' => 'medium',
                'desc' => 'Error occured when deleting file',
                'error' => 'Impossible to delete : ' . $path,
            ]);
        return $ret;
    }

    public function deleteMedia(Media $media): bool
    {
        return $this->deleteFile($media->path) && $media->delete();
    }

    public function uplDataMedia(string $type, Request $r): JsonResponse
    {
        try {
            $validated = $r->validate($this->dataMediaRules());
            $uuid = Str::uuid();
            $dataMedia = $r->data['data_media'];
            if ($type == 'regions') {
                $item = Region::findOrFail($r->data['theItem_id']);
            }
            if ($type == 'trips') {
                $item = Trip::findOrFail($r->data['theItem_id']);
            }
            if ($type == 'settings') {
                $item = Setting::findOrFail($r->data['theItem_id']);
            }

            foreach ($r->file('files') as $file) {
                $stored = $this->uploadFile($file, 'public/' . $type . '-medias');
                $media = Media::create(
                    [
                        'name' => $r->data['name'],
                        'path' => str_replace('public', '', $stored),
                        'uuid' => $uuid,
                    ]
                );

                if ($dataMedia && in_array($dataMedia, ['pic', 'hero', 'site_logo'])) {
                    $oldMedia = $dataMedia == 'hero' ? $item->heroMedia : $item->picMedia;
                    if ($oldMedia)
                        $this->deleteMedia($oldMedia);

                    $item->update([$dataMedia => $media->id]);
                } else {
                    $item->photos()->attach($media->id);
                }
            }

            return $this->sendSuccess(msg: 'The media have been uploaded !');
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }

    public function deleteTripPhoto(Request $r): JsonResponse
    {
        try {
            $media = Media::findOrFail($r->id);
            $media->trips()->detach($r->pivot['trip_id']);
            $this->deleteMedia($media);

            return $this->sendSuccess(msg: 'The trip photo have been deleted !');
        } catch (\Throwable $th) {
            return $this->sendTh($th);
        }
    }
}