<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Xiaofengit\RegionOfChina\Region;

class RegionSeeder extends Seeder
{
    public function run()
    {
        // 省份
        $data = Region::getAllRegionsForDB();
        DB::table('regions')->insert($data);
    }
}