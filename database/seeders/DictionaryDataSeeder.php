<?php

namespace Database\Seeders;

use App\Models\DictionaryData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DictionaryDataSeeder extends Seeder
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
            DictionaryData::create([
                'dictionary_id'=> 'jenis_it',
                'value'=> 'JNS.A',
                'view'=> 'REQUEST',
                'default'=> true,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'jenis_it',
                'value'=> 'JNS.B',
                'view'=> 'REPORT PROBLEM',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'jenis_it',
                'value'=> 'JNS.C',
                'view'=> 'REPAIR',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'tipe_it',
                'value'=> 'TP.A',
                'view'=> 'SOFTWARE',
                'default'=> true,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'tipe_it',
                'value'=> 'TP.B',
                'view'=> 'HARDWARE',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'tipe_it',
                'value'=> 'TP.C',
                'view'=> 'NETWORKING',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'urg',
                'value'=> 'URG.A',
                'view'=> 'CRITICAL',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'urg',
                'value'=> 'URG.B',
                'view'=> 'HIGH',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'urg',
                'value'=> 'URG.C',
                'view'=> 'MEDIUM',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'urg',
                'value'=> 'URG.D',
                'view'=> 'LOW',
                'default'=> true,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'ktgri_it',
                'value'=> '01.CR',
                'view'=> 'USER',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'ktgri_it',
                'value'=> '02.AD',
                'view'=> 'SOFTWARE',
                'default'=> true,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'ktgri_it',
                'value'=> '03.HD',
                'view'=> 'HARDWARE',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'status',
                'value'=> '01.OP',
                'view'=> 'OPEN',
                'default'=> true,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'status',
                'value'=> '02.WAIT',
                'view'=> 'WAITING FOR SUPPORT',
                'default'=> true,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'status',
                'value'=> '03.PROG',
                'view'=> 'IN PROGRES',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'status',
                'value'=> '04.RES',
                'view'=> 'RESOLVED',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'status',
                'value'=> '05.CC',
                'view'=> 'CANCEL',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'status',
                'value'=> '06.CL',
                'view'=> 'CLOSED',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'choice',
                'value'=> 'COMPLAINT',
                'view'=> 'KOMPLAIN',
                'default'=> false,
            ]);
            DictionaryData::create([
                'dictionary_id'=> 'choice',
                'value'=> 'ISSUE',
                'view'=> 'DISKUSI',
                'default'=> false,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
