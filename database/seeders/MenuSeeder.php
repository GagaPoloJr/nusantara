<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $konfigurasi = Menu::create([
                'menu_name' => 'Konfigurasi',
                'url' => 'konfigurasi',
                'icon' => 'share-2',
                'main_menu' => 0,
                'sort' => 'a'
            ]);
            $vehicles = Menu::create([
                'menu_name' => 'Master',
                'url' => 'vehicles',
                'icon' => 'share-2',
                'main_menu' => 1,
                'sort' => 'aa'
            ]);
          
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
