<?php

namespace Database\Seeders;

use App\Models\Trip;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            foreach (Region::inRandomOrder()->limit(1)->get() as $r) {
                $t = Trip::create([
                    'region_id' => $r->id,
                    'title' => 'Test trip for fun ' . $i,
                    'travelers_limit' => random_int(7, 25),
                    'pricing' => '$ ' . random_int(5000, 20000),
                    'intro' => "Lorem ipsum dolor sit amet. Aut mollitia omnis sit harum cumque ut galisum enim vel sint velit sit consectetur nobis aut numquam asperiores aut quia similique. Et libero tempora aut adipisci odit non recusandae rerum et corrupti autem et velit sapiente in numquam culpa."
                ]);
            }
        }
    }
}
