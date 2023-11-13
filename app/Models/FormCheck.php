<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormCheck extends Model
{
    use HasFactory;

    protected $table= 'core.form_checks';
    public $primaryKey='form_id';
    protected $guarded=[];

    public function vehicleChecklists()
    {
        return $this->hasMany(VehicleChecklist::class, 'form_id', 'form_id');
    }
}
