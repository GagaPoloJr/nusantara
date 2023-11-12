<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;
    protected $table = 'core.companys';
    protected $primaryKey = 'company_id';
    protected $keyType = 'string';
    protected $guarded=[];

    public function companyuser()
    {
        return $this->hasMany(CompanyUser::class,'company_id');
    }

    public function group()
    {
        return $this->hasMany(Group::class,'company_id');
    }
}
