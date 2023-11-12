<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as RoleSpatie;

class Group extends RoleSpatie
{
    use HasFactory;
    protected $table = 'authenticate.groups';
    public $primaryKey = 'group_id';
}
