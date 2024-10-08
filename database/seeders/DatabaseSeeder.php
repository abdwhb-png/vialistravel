<?php

namespace Database\Seeders;

use App\Models\LegalPage;
use App\Models\SitePage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'root',
            'email' => 'thorstormz013@gmail.com',
            'role' => 'root',
        ]);
        User::factory()->count(1)->create();

        LegalPage::create(['name' => 'Privacy Policy']);
        LegalPage::create(['name' => 'Terms of Service']);

        for ($i = 1; $i <= 5; $i++) {
            $item = SitePage::create([
                'name' => 'Test Page ' . $i,
                'content' => "Lorem ipsum dolor sit amet. Eos itaque officiis aut corporis commodi ut obcaecati nihil quo enim voluptas et internos recusandae ad internos adipisci. Et officiis temporibus qui voluptatem perferendis cum quia neque et modi dolorem. Ea aperiam dolorem At galisum magnam ea temporibus dolores et nostrum exercitationem qui iusto quia est perspiciatis officia ut enim repellendus?<br>
Id atque neque id quibusdam accusantium ut dolores consequatur et placeat labore sed soluta unde qui veritatis amet eum doloremque dolores. Ut nemo nihil est officiis odio ab tenetur rerum vel quod quasi est velit autem.<br>
Eos deserunt fugiat ex autem culpa et sint illo aut aliquid distinctio et vitae nisi in voluptate neque aut sunt autem? A voluptatem enim aut provident officia nam sint magni sed ipsum dolores. Nam illum numquam ut sunt impedit et impedit soluta eos porro reiciendis sed galisum laboriosam?"
            ]);
        }

        $this->call([
            SettingSeeder::class,
            SocialLinkSeeder::class,
            InterestSeeder::class,
            RegionSeeder::class,
            CountrySeeder::class,
            WildlifeSeeder::class,
            TripSeeder::class,
            TripRelationsSeeder::class,
        ]);
    }
}
