<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as AccessSpatie;
use Yajra\DataTables\DataTables;

class Access extends AccessSpatie
{
    use HasFactory;
    protected $table = 'authenticate.access';
    public $primaryKey = 'access_id';
}


