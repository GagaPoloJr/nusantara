<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;
    protected $table= 'core.dictionarys';
    public $primaryKey='dictionary_id';
    protected $keyType = 'string';
    protected $guarded=[];

    public function dictionaryData()
    {
        return $this->hasMany(DictionaryData::class,'dictionary_id');
    }
}
