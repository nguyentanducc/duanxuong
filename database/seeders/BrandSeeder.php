<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::query()->create(['name'=>'Gucci']);
        Brand::query()->create(['name'=>'May 10']);
        Brand::query()->create(['name'=>'Addidas']);
    }
}
