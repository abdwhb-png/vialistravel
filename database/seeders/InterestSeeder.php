<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = Storage::json('interests.json');
        foreach ($data as $d) {
            Interest::create(['title' => $d['title']]);
        }
        // collect($data)->each(function ($d) {
        //     Interest::create($d);
        // });
    }
}