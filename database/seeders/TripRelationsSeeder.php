<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Review;
use App\Models\Trip;
use App\Models\TripDate;
use App\Concerns\DataMethods;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripRelationsSeeder extends Seeder
{
    use DataMethods;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Trip::inRandomOrder()->limit(20)->get() as $t) {
            for ($i = 1; $i <= rand(5, 25); $i++) {
                $item = Review::create([
                    'trip_id' => $t->id,
                    'author' => 'Author Bidon ' . $i,
                    'stars' => random_int(1, 5),
                    "publi_date" => $this->randomDate(),
                    'comment' => "Lorem ipsum dolor sit amet. Aut mollitia omnis sit harum cumque ut galisum enim vel sint velit sit consectetur nobis aut numquam asperiores aut quia similique. Et libero tempora aut adipisci odit non recusandae rerum et corrupti autem et velit sapiente in numquam culpa."
                ]);
            }

            for ($i = 1; $i <= rand(3, 10); $i++) {
                $item = Faq::create([
                    'trip_id' => $t->id,
                    'question' => 'Lorem ipsum dolor sit amet ' . $i . ' ?',
                    'response' => "Lorem ipsum dolor sit amet. Aut mollitia omnis sit harum cumque ut galisum enim vel sint velit sit consectetur nobis aut numquam asperiores aut quia similique. Et libero tempora aut adipisci odit non recusandae rerum et corrupti autem et velit sapiente in numquam culpa."
                ]);
            }

            $item = TripDate::create([
                'year' => date('Y'),
                'trip_id' => $t->id,
                'departure' => now(),
                'return' => now()->addDays(5),
            ]);
            for ($i = 1; $i <= rand(2, 5); $i++) {
                $item = TripDate::create([
                    'year' => now()->addMonths($i)->format('Y'),
                    'trip_id' => $t->id,
                    'departure' => now()->addMonths($i),
                    'return' => now()->addMonths($i)->addDays(random_int(9, 21)),
                ]);
            }
        }
    }
}
