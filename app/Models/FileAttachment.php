<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileAttachment extends Model
{
    use HasFactory;
    protected $table = 'core.file_attachments';
    protected $primaryKey = 'file_attachment_id';
    protected $guarded=[];

    /*public function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }*/
}
