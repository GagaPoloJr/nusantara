<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        try {
            Option::create([
                'option_id' => 'whatsapp_access',
                'value' => 'eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJ0eXBlIjoiYWNjZXNzIiwiZXhwIjoxNjc3ODEyMTUzLCJpYXQiOjE2Nzc4MDkyNTgsImp0aSI6ImExYmZmMzM5ODQxNDRlZWViMmFhOTQ0NDI1ZWZlYTdiIiwidXNlciI6InNlcnZpY2VkZXNrIiwiYXVkIjoiRVJQcm8uTW9iaWxlIiwiaXNzIjoiRVJQcm8ifQ._XfDLhHkNlKyXPjrPRL4sQJFbThq331VwjF6E3-f6N8-LRyfXr7w5LSIjU8Bi-INXb8fUq4tl2XP4zNDZaenmQ',
                'description' => 'whatsapp access token',
            ]);
            Option::create([
                'option_id' => 'whatsapp_take',
                'value' => 5,
                'description' => 'jumlah  tiap sesi kirim',
            ]);
            Option::create([
                'option_id' => 'whatsapp_username',
                'value' => 'servicedesk',
                'description' => 'whatsapp username',
            ]);
            Option::create([
                'option_id' => 'whatsapp_password',
                'value' => '#qazplm#',
                'description' => 'whatsapp password',
            ]);
            Option::create([
                'option_id' => 'whatsapp_base_url',
                'value' => 'https://whatsapp.itnusantara.online:8000/',
                'description' => 'base url api whatsapp bot',
            ]);
            Option::create([
                'option_id' => 'whatsapp_refresh',
                'value' => 'eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJ0eXBlIjoicmVmcmVzaCIsImV4cCI6MTY3Nzg5Njc1MywiaWF0IjoxNjc3ODEwMzUzLCJqdGkiOiI5YTkxMGU2NGRhNTE0NjZkYjNiM2E3NDQ3OWJkYzUzYiIsInVzZXIiOiJzZXJ2aWNlZGVzayIsImF1ZCI6IkVSUHJvLk1vYmlsZSIsImlzcyI6IkVSUHJvIn0.V5eYbflzlsFo5YgCdvOqlxIPth7jV6WL6ow1WcRTOYu8cczgYFGZr2wFziPO-nBk-LoNNSPIKtv29MVGBgWjNg',
                'description' => 'whatsapp refresh token',
            ]);
            Option::create([
                'option_id' => 'whatsapp_session',
                'value' => 'sDnp7MqkinhT4Gj39c9QHPXBh',
                'description' => 'whatsapp session',
            ]);

            Option::create([
                'option_id' => 'global_reporter_group',
                'value' => '2',
                'description' => 'reporter global group',
            ]);
            Option::create([
                'option_id' => 'global_destination_group',
                'value' => '3',
                'description' => 'destination global group',
            ]);
            Option::create([
                'option_id' => 'version_app',
                'value' => '23.10.26',
                'description' => 'versi app',
            ]);
            Option::create([
                'option_id' => 'base_url',
                'value' => 'http://tms.itnusantara.online:8080/web.tms/',
                'description' => 'base url app',
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
