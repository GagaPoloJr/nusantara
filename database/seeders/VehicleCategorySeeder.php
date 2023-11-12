<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\VehicleCategory;
use Illuminate\Support\Facades\DB;

class VehicleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::beginTransaction();
        try {
            VehicleCategory::create([
                'category_id' => 1,
                'name' => 'Transportasi',
            ]);
            VehicleCategory::create([
                'category_id' => 2,
                'name' => 'Angkut Barang',
            ]);
            VehicleCategory::create([
                'category_id' => 3,
                'name' => 'Super Car',
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }


    }
}
