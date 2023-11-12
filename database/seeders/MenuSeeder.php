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
            $konfigurasi->subMenus()->create([
                'menu_name' => 'Perusahaan',
                'url' => 'company',
                'icon' => 'git-pull-request',
                'sort' => 'aa'
            ]);
            $konfigurasi->subMenus()->create([
                'menu_name' => 'Akses',
                'url' => 'access',
                'icon' => 'layers',
                'sort' => 'ab'
            ]);
            $konfigurasi->subMenus()->create([
                'menu_name' => 'Grup',
                'url' => 'group',
                'icon' => 'git-pull-request',
                'sort' => 'ac'
            ]);
            $konfigurasi->subMenus()->create([
                'menu_name' => 'User',
                'url' => 'user',
                'icon' => 'layers',
                'sort' => 'ad'
            ]);
            $konfigurasi->subMenus()->create([
                'menu_name' => 'Kamus',
                'url' => 'dictionary',
                'icon' => 'layers',
                'sort' => 'ae'
            ]);
            $konfigurasi->subMenus()->create([
                'menu_name' => 'Data Kamus',
                'url' => 'dictionarydata',
                'icon' => 'layers',
                'sort' => 'af'
            ]);
            // $konfigurasi->subMenus()->create([
            //     'menu_name' => 'Vehicle',
            //     'url' => 'vehicle',
            //     'icon' => 'layers',
            //     'sort' => 'ag'
            // ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
