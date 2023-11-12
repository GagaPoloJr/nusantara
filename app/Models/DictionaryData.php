<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryData extends Model
{
    use HasFactory;
    protected $table= 'core.dictionary_data';
    public $primaryKey='dictionary_data_id';
    protected $guarded=[];

    public function dictionary()
    {
        return $this->belongsTo(Dictionary::class,'dictionary_id');
    }

    public function project()
    {
        return $this->hasMany(Project::class,'dictionary_data_id');
    }

    public static function getData()
    {
        return DictionaryData::join((new Dictionary())->getTable(), (new Dictionary())->getTable().'.'.(new Dictionary())->getKeyName(), '=', (new DictionaryData())->getTable().'.dictionary_id')
            ->where((new DictionaryData())->getTable().'.dictionary_id','<>',true)
            ->orderBy((new DictionaryData())->getTable().'.dictionary_id','DESC')
            ->orderBy((new DictionaryData())->getTable().'.value','ASC')
            ->get();
    }
}
