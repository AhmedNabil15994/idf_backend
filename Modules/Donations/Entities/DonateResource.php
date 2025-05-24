<?php

namespace Modules\Donations\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;

class DonateResource extends Model 
{
    use SoftDeletes,ScopesTrait;

    protected $table = 'donate_resources';
    public $timestamps = true;
    protected $fillable = array('name', 'phone');

    public function items()
    {
        return $this->hasMany(DonateResourceItem::class);
    }

}