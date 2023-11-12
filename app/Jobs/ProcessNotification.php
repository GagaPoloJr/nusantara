<?php

namespace App\Jobs;

use App\Models\Dictionary;
use App\Models\DictionaryData;
use App\Models\Notification;
use App\Models\NotificationRule;
use App\Models\Option;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserGroup;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProcessNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function auth()
    {

        $curl = curl_init();
        /*
         * http://192.168.102.204:8000/
         * user_name
         * password
         * session
         * take
         * */
        curl_setopt_array($curl, array(
            CURLOPT_URL => Option::find('whatsapp_base_url')->value.'api/token/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('user_name' =>'servicedesk','password' => '#qazplm#'),
        ));

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $body = json_decode($response);
        curl_close($curl);

        //var_dump($response);

        if ($body) {
            if ($info['http_code'] == 200) {
                try {
                    $option = Option::find('whatsapp_refresh');
                    if ($option){
                        $option->update([
                            'value'=> $body->refresh,
                        ]);
                    } else {
                        Option::create([
                            'option_id' => 'whatsapp_refresh',
                            'value' => $body->refresh,
                            'description' => 'whatsapp refresh token',
                            'create_by' => 'sistem',
                        ]);
                    }
                    $option = Option::find('whatsapp_access');
                    if ($option){
                        $option->update([
                            'value'=> $body->access,
                        ]);
                    } else {
                        Option::create([
                            'option_id' => 'whatsapp_access',
                            'value' => $body->access,
                            'description' => 'whatsapp access token',
                            'create_by' => 'sistem',
                        ]);
                    }
                    return true;
                } catch (\Exception $e){

                }

            }
        }
        return false;
    }

    public function refresh()
    {
        $refresh = Option::find('whatsapp_refresh');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Option::find('whatsapp_base_url')->value.'api/token/refresh/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('refresh' => $refresh->value),
        ));

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $body = json_decode($response);
        curl_close($curl);
        //var_dump($response);
        if ($body) {
            if ($info['http_code'] == 200) {
                try {
                    $option = Option::find('whatsapp_refresh');
                    if ($option){
                        $option->update([
                            'value'=> $body->refresh,
                        ]);
                    } else {
                        Option::create([
                            'option_id' => 'whatsapp_refresh',
                            'value' => $body->refresh,
                            'description' => 'whatsapp refresh token',
                            'create_by' => 'sistem',
                        ]);
                    }
                    $option = Option::find('whatsapp_access');
                    if ($option){
                        $option->update([
                            'value'=> $body->access,
                        ]);
                    } else {
                        Option::create([
                            'option_id' => 'whatsapp_access',
                            'value' => $body->access,
                            'description' => 'whatsapp access token',
                            'create_by' => 'sistem',
                        ]);
                    }
                    return true;
                } catch (\Exception $e){

                }
            }
        }
        return false;
    }

    public function send()
    {
        $access = Option::find('whatsapp_access');
        $notifications=[];

        foreach (Notification::where('type','=','wa')->where('status','=',null)->where('send_to','<>',null)->skip(0)->take((int)Option::find('whatsapp_take')->value)->get() as $notification){
            $outbox_fors=explode(',',User::find($notification->send_to)->no_hp);
            foreach ($outbox_fors as $index=>$outbox_for) {
                if (substr( $outbox_for, 0, 2 ) === '08') {
                    $outbox_for = '628'.substr( $outbox_for, 2, strlen($outbox_for) ).'@s.whatsapp.net';
                    $outbox_fors[$index]=$outbox_for;
                }
            }

            array_push($notifications,[
                'message' => $notification->content,
                'message_type' => 'conversation',
                'outbox_for' => implode(',',$outbox_fors),
                'is_interactive' => false,
                'retry' => 1,
                'session' => Option::find('whatsapp_session')->value,
                'properties' => [
                    'id' => $notification->notification_id
                ],
                'description' => '',
            ]);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Option::find('whatsapp_base_url')->value.'whatsapp/api/outbox/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($notifications),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$access->value,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $body = json_decode($response);
        curl_close($curl);
        //var_dump($info['http_code']);
        if ($body) {
            //var_dump($body);
            if ($info['http_code'] == 201) {
                try {
                    foreach ($body as $row) {
                        $id = $row->properties->id;

                        Notification::find($id)->update([
                            'status'=> 'send_to_wa',
                        ]);

                    }
                    return true;
                } catch (\Exception $e){

                }
            }
        }
        return false;

    }

    public function handle()
    {
        //dd($this->auth());
        if($this->send()){
        } else {

            if($this->refresh()){
                $this->send();
            } else {
                if ($this->auth()){
                    $this->send();
                }
            }
        }

    }
    public function waBot()
    {
        ProcessNotification::dispatch();
        //$this->send();
    }
}
