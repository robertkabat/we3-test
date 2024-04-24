<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'email' => 'dexter@miami.us',
         ]);

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        $brands = Brand::factory(2)->create();

        $brands->each(function ($brand) {
            Product::factory(10)->create([
                'brand_id' => $brand->id,
            ]);
        });
    }
}
