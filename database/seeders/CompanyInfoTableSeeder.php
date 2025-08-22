<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Companyinfo;

class CompanyInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyinfo = new Companyinfo;        
        $companyinfo->status = 1;
        $companyinfo->save();
    }
}
