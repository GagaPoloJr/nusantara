<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        try {
            Company::create([
                'company_id'=> 'SBYNSA',
                'company_name'=> 'NUSA UNGGUL SARANA ADICIPTA',
                'parent'=> null,
            ]);
            Company::create([
                'company_id'=> 'SMGNBI',
                'company_name'=> 'NUSANTARA BUILDING INDUSTRIES',
                'parent'=> null,
            ]);
            Company::create([
                'company_id'=> 'NJRBJM',
                'company_name'=> 'NUSANTARA JAYA RAYA MUJUR',
                'parent'=> null,
            ]);
            Company::create([
                'company_id'=> 'NJRSMD',
                'company_name'=> 'ANUGERAH NUSANTARA JAYA',
                'parent'=> null,
            ]);
            Company::create([
                'company_id'=> 'NJRPRY',
                'company_name'=> 'PUTRA KAHAYAN ABADI',
                'parent'=> null,
            ]);
            Company::create([
                'company_id'=> 'NJRUPG',
                'company_name'=> 'KARUNIA ANUGERAH NUSANTARA',
                'parent'=> null,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
