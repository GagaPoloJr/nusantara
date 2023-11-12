<?php

namespace Database\Seeders;

use App\Models\NotificationRule;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationruleSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        try {
            $default_op_value = [
                'status' => '01.OP',
                'model' => 'App\Models\Ticket',
                'active' => true,
            ];
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_op_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_op_value));

            /*==================*/
            $default_wait_value = [
                'status' => '02.WAIT',
                'model' => 'App\Models\Ticket',
                'active' => true,
            ];
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_wait_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_wait_value));

            /*==========================*/

            $default_prog_value = [
                'status' => '03.PROG',
                'model' => 'App\Models\Ticket',
                'active' => true,
            ];
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_prog_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_prog_value));

            /*==========================*/

            $default_res_value = [
                'status' => '04.RES',
                'model' => 'App\Models\Ticket',
                'active' => true,
            ];
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_res_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_res_value));

            /*==========================*/

            $default_cc_value = [
                'status' => '05.CC',
                'model' => 'App\Models\Ticket',
                'active' => true,
            ];
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_cc_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_cc_value));

            /*==========================*/

            $default_cl_value = [
                'status' => '06.CL',
                'model' => 'App\Models\Ticket',
                'active' => true,
            ];
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'pelapor admin',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'issue',
                'description' => 'terlapor admin',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'PLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'pelapor admin',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPR',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'wa',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_cl_value));
            NotificationRule::create(array_merge([
                'notified_to' => 'TLPRA',
                'type' => 'web',
                'jenis' => 'complaint',
                'description' => 'terlapor admin',
            ],$default_cl_value));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
