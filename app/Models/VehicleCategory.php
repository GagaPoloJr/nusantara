<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use HasFactory;
    protected $table= 'core.vehicle_categories';
    public $primaryKey='category_id';
    protected $guarded=[];

    // public static function generateCodeVehicle()
    // {
    //     $latestCode = static::latest()->first();
    //     if ($latestCode) {
    //         $numericPart = (int)substr($latestCode->menu_id, 3) + 1;
    //         return 'MT-' . str_pad($numericPart, 4, '0', STR_PAD_LEFT);
    //     } else {
    //         return 'MT-0001';
    //     }
    // }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'category_id');
    }
}
