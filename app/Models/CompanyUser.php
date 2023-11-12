<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    use HasFactory;
    protected $table = 'core.company_user';
    protected $primaryKey = 'company_user_id';
    protected $guarded=[];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

}
