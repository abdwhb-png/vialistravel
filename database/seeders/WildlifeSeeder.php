<?php

namespace Database\Seeders;

use App\Models\Wildlife;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WildlifeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'African Safari Wildlife',
                'description' => "africa safrica eafrica botswana kenya namibia southafrica tanzania zambia zimbabwe bigfive",
            ],
            [
                'title' => 'Bears',
                'description' => 'class="polarbears north nationalparks asia cruise europe canadanorth alaska canada unitedstates china greenland russia bears"'
            ],
            [
                'title' => 'Big Cats',
                'description' => 'africa asia centralamerica southamerica eafrica safrica botswana namibia kenya tanzania southafrica zambia zimbabwe india srilanka bhutan nepal borneo costarica belize brazil bigcats'
            ],
            [
                'title' => 'Birds & Butterflies',
                'description' => 'galapagos southamerica africa europe north centralamerica cruise eafrica safrica canadanorth alaska ecuador madagascar scotland costarica mexico belize peru brazil southgeor falkland higharc norway iceland greenland spitsbergen birdsbutterflies'
            ],
            [
                'title' => 'Primates',
                'description' => 'asia africa centralamerica eafrica myanmar thailand uganda rwanda ethiop madagascar srilanka borneo costarica primates'
            ],
            [
                'title' => ' Whales & Marine Wildlife',
                'description' => 'galapagos south america north asia centralamerica cruise polar europe canadanorth alaska ecuador unitedstates greenland iceland canada scotland srilanka borneo newzealand costarica mexico belize antarctica southgeorg falkland higharc norway spitsbergen marine'
            ],
            [
                'title' => 'Wolves',
                'description' => 'nationalparks unitedstates wolves'
            ],
        ];
        collect($data)->each(function ($d) {
            Wildlife::create($d);
        });
    }
}