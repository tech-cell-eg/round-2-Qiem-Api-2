<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Database\Seeders\UserSeeder as UserSeeder;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            // UserSeeder::class,
            // InspectorSeeder::class,
            // CompanySeeder::class,
            // RealEstateSeeder::class,
            // OfferSeeder::class,
            ProjectSeeder::class,
            RequestSeeder::class,
            TermsAndConditionsSeeder::class,
        ]);
    }
}
