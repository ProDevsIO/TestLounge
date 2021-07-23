<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Country;

class CountriesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    
            $json_file = File::get('countries.json');
            $data = json_decode($json_file);
            foreach ($data as $obj)
            {
             
                 Country::create(array(
                    'id' => $obj->id,
                    'iso' => $obj->iso,
                    'name' => $obj->name,
                    'nicename' => $obj->nicename,
                    'iso3' => $obj->iso3,
                    'numcode' => $obj->numcode,
                    'phonecode' => $obj->phonecode
                ));
            }
    
    }
}
