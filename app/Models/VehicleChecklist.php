<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleChecklist extends Model
{
    use HasFactory;
    protected $table= 'core.vehicles_checklists';
    public $primaryKey='checklist_id';
    protected $guarded=[];


    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class, 'category_code', 'category_code');
    }
    public function forms()
    {
        return $this->belongsTo(FormCheck::class, 'form_id', 'form_id');
    }
}
