<?php

namespace App\Models;

use App\Jobs\ProcessNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'core.notifications';
    protected $primaryKey = 'notification_id';
    public $timestamps = false;
    protected $guarded=[];

    public static function boot()
    {
        parent::boot();

        self::created(function($model){

        });

    }
}
