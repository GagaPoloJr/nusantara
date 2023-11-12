<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'authenticate.users';
    public $primaryKey='user_id';
    protected $guarded=[];

    public function companyuser()
    {
        return $this->hasMany(CompanyUser::class,'user_id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class,'user_id');
    }
    public function usergroup()
    {
        return $this->hasMany(UserGroup::class,'model_id');
    }
}
