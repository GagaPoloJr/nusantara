<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\DictionaryData;
use App\Models\Notification;
use App\Models\NotificationRule;
use App\Models\Option;
use App\Models\Ticket;
use App\Models\TicketHistory;
use App\Models\User;
use App\Models\UserGroup;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateStatusTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status otomatis tutup tiket.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $tickets = Ticket::where('status','=','04.RES')->where('choice','=','complaint');
        if ($tickets->count() > 0){
            foreach ($tickets->get() as $index => $ticket) {
                $setup = explode('/',Option::find('close_ticket')->value);
                $date_plus  = Carbon::parse(date('Y-m-d H:i:s', strtotime('+'.$setup[0].' '.$setup[1], strtotime($ticket->updated_at))))->timestamp;
                $now = Carbon::now()->timestamp;
                if ($date_plus < $now) {
                    $NotificationRules =  NotificationRule::where('status','=','06.CL')->where('jenis','=','complaint')->where('active','=',true)->get();
                    $notifications = [];
                    foreach ($NotificationRules as $NotificationRule) {
                        $notification = [
                            'ticket_id'=>$ticket->ticket_id,
                            'type'=>$NotificationRule->type,
                            'action'=> Option::find('base_url')->value.'web.tms/ticket/'.$ticket->ticket_id,
                            'content'=>'🔔 *Sistem* secara otomatis merubah status tiket'.PHP_EOL.'Nomor *'.$ticket->ticket_id.'*.'.PHP_EOL.'" *'.ucwords($ticket->title).'* "'.PHP_EOL.'dari _'.DictionaryData::where('value', '=', '04.RES')->first()->view.'_ ➤ _'.DictionaryData::where('value', '=', '06.CL')->first()->view.'_'.PHP_EOL.PHP_EOL.'👉 '.Option::find('base_url')->value.'ticket/'.$ticket->ticket_id,
                            'status'=>null,
                        ];
                        switch ($NotificationRule->notified_to) {
                            case'PLPR':
                                $notification['send_to']=User::find($ticket->reporter)->user_id;
                                //$notification['xxx']='PLPR';
                                array_push($notifications, $notification);
                                break;
                            case'PLPRA':
                                $usergroup = UserGroup::all()->where('model_id','=',$ticket->reporter);
                                $adminGroups = UserGroup::whereIn('group_id',$usergroup->pluck('group_id'))->where('is_admin','=',true)->get();
                                if ($adminGroups->count() > 0) {
                                    foreach ($adminGroups as $index => $adminGroup) {
                                        $notification['send_to'] = User::find($adminGroup->model_id)->user_id;
                                    }
                                    /*$notification['xxx']='PLPRA';*/
                                    array_push($notifications, $notification);
                                }
                                break;
                            case'TLPR':
                                $notification['send_to']=User::find($ticket->assign_to)->user_id;
                                //$notification['xxx']='TLPR';
                                array_push($notifications, $notification);
                                break;
                            case'TLPRA':
                                $adminGroups = UserGroup::all()->where('group_id','=',$ticket->group_destination)->where('is_admin','=',true);
                                if ($adminGroups->count() > 0) {
                                    foreach ($adminGroups as $index => $adminGroup) {
                                        if ($adminGroup->model_id != User::find($ticket->assign_to)->user_id) {
                                            $notification['send_to'] = User::find($adminGroup->model_id)->user_id;
                                            //$notification['xxx']='TLPRA';
                                            array_push($notifications, $notification);
                                        }
                                    }
                                }
                                break;
                            default:
                        }

                        /*$kodecomment = 'C-'.time();
                        while (Comment::find($kodecomment)){
                            $kodecomment = 'C-'.time();
                        }
                        Comment::create([
                            'comment_id'=>'C-'.time(),
                            'user_id'=>NULL,
                            'ticket_id'=> $ticket->ticket_id,
                            'body' => '<b>Sistem secara otomatis </b> merubah status tiket dari <span class="badge bg-info">RESOLVED</span> &#8594; <span class="badge bg-info">CLOSED</span>',
                        ]);
                        TicketHistory::create([
                            'ticket_id'=> $ticket->ticket_id,
                            'value' => '<b>Sistem secara otomatis </b> merubah status tiket dari <span class="badge bg-info">RESOLVED</span> &#8594; <span class="badge bg-info">CLOSED</span>',
                            'create_by' => 'Sistem',
                        ]);*/
                    }
                    DB::table((new Notification())->getTable())->insert(array_unique($notifications,SORT_REGULAR));
                    $updateTicket['closedate'] = now();
                    $updateTicket['status'] = '06.CL';
                    $updateTicket['update_by'] = 'system';
                    $tickets->update($updateTicket);
                }
            }
        }
    }
}
