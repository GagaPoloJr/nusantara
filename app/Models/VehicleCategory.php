<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use HasFactory;
    protected $table = 'core.vehicle_categories';
    public $primaryKey = 'category_id';
    protected $guarded = [];


    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'category_id');
    }
}
