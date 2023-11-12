<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        try {
            Project::create([
                'project_id' => 'HRMS',
                'project_name' => 'SDM & GA Informasi Manajemen',
                'dictionary_data_id' => 4,
                'parent' => null,
            ]);
            Project::create([
                'project_id' => 'MS',
                'project_name' => 'MASTER SETTING',
                'dictionary_data_id' => 4,
                'parent' => 'HRMS',
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
