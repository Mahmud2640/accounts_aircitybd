<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'name' => 'Head office',
            'email' => 'info@aircitybd.com',
            'mobile' => '+8801644299822',
            'location' => 'New market 2nd floor,Raipur lakshmipur, Bangladesh',
        ]);
    }
}
