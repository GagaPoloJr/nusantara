<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\Option;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNotificationRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $args;
    public function __construct($args)
    {
        $this->args = $args;
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

        var_dump($response);

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

        var_dump($response);

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

    public function send($args)
    {
        $access = Option::find('whatsapp_access');
        $notifications=[];

        array_push($notifications,[
            'message' => $args['message'].$args['message2'],
            'message_type' => 'conversation',
            'outbox_for' => $args['outbox_for'].'@s.whatsapp.net',
            'is_interactive' => false,
            'session' => Option::find('whatsapp_session')->value,
            'properties' => [
                'id' => '123'
            ],
            'description' => '',
        ]);

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



        if ($body) {
            if ($info['http_code'] == 201) {
                try {
                    return true;
                } catch (\Exception $e){
                    return false;
                }
            }
        }
        return false;
    }

    public function handle()
    {
        if($this->send( $this->args)){
        } else {
            if($this->refresh()){
                $this->send( $this->args);
            } else {
                if ($this->auth()){
                    $this->send( $this->args);
                }
            }
        }

    }
}
