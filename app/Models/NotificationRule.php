<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationRule extends Model
{
    use HasFactory;
    protected $table = 'core.notification_rule';
    protected $guarded=[];
}
