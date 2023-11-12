<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubMenu;
use Illuminate\Support\Facades\DB;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            SubMenu::create([
                'sub_menu_name' => 'Perusahaan',
                'url' => 'company',
                'menu_id' => 1,
                'sort' => 'a'
            ]);
            SubMenu::create([
                'sub_menu_name' => 'Akses',
                'url' => 'access',
                'menu_id' => 1,
                'sort' => 'ab'
            ]);
            SubMenu::create([
                'sub_menu_name' => 'Kamus',
                'url' => 'dictionary',
                'menu_id' => 1,
                'sort' => 'a'
            ]);
            SubMenu::create([
                'sub_menu_name' => 'Data Kamus',
                'url' => 'dictionarydata',
                'menu_id' => 1,
                'sort' => 'a'
            ]);
            SubMenu::create([
                'sub_menu_name' => 'Grup',
                'url' => 'Group',
                'menu_id' => 1,
                'sort' => 'a'
            ]);
            SubMenu::create([
                'sub_menu_name' => 'User',
                'url' => 'user',
                'menu_id' => 1,
                'sort' => 'a'
            ]);
            SubMenu::create([
                'sub_menu_name' => 'Menu',
                'url' => 'menu',
                'menu_id' => 1,
                'sort' => 'a'
            ]);
            SubMenu::create([
                'sub_menu_name' => 'Sub Menu',
                'url' => 'submenu',
                'menu_id' => 1,
                'sort' => 'a'
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
