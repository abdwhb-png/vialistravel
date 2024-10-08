<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'join_code' => Hash::make(config('vars.join_code')),
            'site_name' => 'VIALIS TRAVEL AND TOUR',
            'email' => 'info@vialis-travel-tour.com',
            'phone' => '800-543-8917',
            'address' => "PO Box 3065 · Boulder, CO USA 80307",
            'availability' => "8 am to 5 pm, Monday through Friday & 8 am to 3 pm on Saturdays",
            'indication' => "When you fill out a form, the fields followed by a red * are required !",
        ]);
    }
}