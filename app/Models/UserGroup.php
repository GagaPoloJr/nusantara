<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
    protected $table = 'authenticate.user_group';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded=[];

    public function group()
    {
        return $this->belongsTo(Group::class,'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'model_id');
    }
}
