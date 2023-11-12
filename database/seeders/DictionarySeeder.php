<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DictionarySeeder extends Seeder
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
            Dictionary::create([
                'dictionary_id'=> 'jenis_it',
                'name'=> 'JENIS IT',
                'key'=> 'jenis',
            ]);
            Dictionary::create([
                'dictionary_id'=> 'tipe_it',
                'name'=> 'TIPE IT',
                'key'=> 'tipe',
            ]);
            Dictionary::create([
                'dictionary_id'=> 'urg',
                'name'=> 'URGENCY',
                'key'=> 'urgent',
            ]);
            Dictionary::create([
                'dictionary_id'=> 'ktgri_it',
                'name'=> 'KATEGORI IT',
                'key'=> 'kategori',
            ]);
            Dictionary::create([
                'dictionary_id'=> 'status',
                'name'=> 'STATUS',
                'key'=> 'status',
            ]);
            Dictionary::create([
                'dictionary_id'=> 'choice',
                'name'=> 'PILIHAN',
                'key'=> 'choice',
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
