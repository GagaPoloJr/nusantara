<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'core.comments';
    protected $primaryKey = 'comment_id';
    protected $keyType = 'string';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public  function childerns()
    {
        return $this->hasMany(Comment::class,'parent');
    }

}
