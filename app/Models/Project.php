<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table= 'service.projects';
    public $primaryKey='project_id';
    protected $keyType = 'string';
    protected $guarded=[];

    public function dictionaryData()
    {
        return $this->belongsTo(DictionaryData::class,'dictionary_data_id');
    }

    public function subProject()
    {
        return $this->hasMany(Project::class,'parent');
    }
}
