<?php

namespace Modules\Donations\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;
use Modules\User\Entities\User;

class Donor extends Model 
{
    use SoftDeletes , ScopesTrait;

    protected $table = 'donors';
    public $timestamps = true;
    protected $fillable = array('status','user_id');

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}