<?php

namespace Modules\Apps\Entities;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model 
{

    protected $table = 'attachments';
    public $timestamps = true;
    protected $fillable = array('path','usage','name','mime_type','type');

    public function attachmentable()
    {
        return $this->morphTo();
    }

}