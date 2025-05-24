<?php

namespace Modules\Families\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Catalog\Entities\Nationality;
use Modules\Catalog\Entities\Religion;

class FamilyMember extends Model 
{

    protected $table = 'family_members';
    public $timestamps = true;
    protected $fillable = array('family_id', 'nationality_id', 'religion_id', 'national_id', 'name', 'type', 'gender', 'phone', 'current_salary', 'marital_status');

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

}