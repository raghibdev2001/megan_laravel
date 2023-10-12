<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class amenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['amenity_name'=>'Lock on bedroom door'],
            ['amenity_name'=>'Garden view'],
            ['amenity_name'=>'Resort view'],
            ['amenity_name'=>'Beach access'],
            ['amenity_name'=>'Kitchen'],
            ['amenity_name'=>'Wifi – 28 Mbps'],
            ['amenity_name'=>'Dedicated workspace'],
            ['amenity_name'=>'Free parking on premises'],
            ['amenity_name'=>'Shared outdoor pool - available all year, open 24 hours'],
            ['amenity_name'=>'Pets allowed'],
            ['amenity_name'=>'Paid washer – In unit'],
            ['amenity_name'=>'Paid dryer – In unit'],
            ['amenity_name'=>'Security cameras on property']

        ];
        
        \DB::table('amenities')->insert($data);
    }
}
