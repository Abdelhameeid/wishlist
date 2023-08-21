<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SellerSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sellers = ['seller 1', 'seller 2', 'seller 3'];

        foreach($sellers as $seller){
            Seller::firstOrCreate(['name' => $seller]);
        }
    }
}
