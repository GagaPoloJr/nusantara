<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $table = 'core.sub_menus';
    public $primaryKey = 'sub_menu_id';
    protected $guarded = [];


    public function menus()
    {
        return $this->belongsTo(Menu::class);
    }
}
