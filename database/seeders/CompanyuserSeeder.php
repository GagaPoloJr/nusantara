<?php

namespace Database\Seeders;

use App\Models\CompanyUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyuserSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        try {
            CompanyUser::create([
                'user_id'=> 1,
                'company_id'=> 'SBYNSA',
                'as_owner'=> true,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
