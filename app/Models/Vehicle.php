<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table= 'core.vehicles';
    public $primaryKey='vehicle_id';
    protected $guarded=[];

    public static function generateCodeVehicle()
    {
        $latestCode = static::latest()->first();
        // dd($latestCode);
        if ($latestCode) {
            $numericPart =$latestCode->vehicle_id + 1;
             $result = 'MT-' . str_pad($numericPart, 4, '0', STR_PAD_LEFT);
             return $result;
        } else {
            return 'MT-0001';
        }
    }
    public function vehicleCategory()
    {
        return $this->belongsTo(VehicleCategory::class, 'category_id');
    }
}
