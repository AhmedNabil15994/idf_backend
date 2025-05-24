<?php

namespace Modules\Volunteers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Charities\Entities\Charity;
use Modules\Core\Traits\ScopesTrait;
use Modules\Order\Entities\Order;
use Modules\User\Entities\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Volunteer extends Model implements HasMedia
{
    use SoftDeletes ,ScopesTrait,InteractsWithMedia;

    protected $table = 'volunteers';
    public $timestamps = true;
    protected $fillable = array('user_id','charity_id', 'status','d_o_b');

    public function charity() {
        return $this->belongsTo(Charity::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function getUsernameAttribute() {
        return $this->user->name ?? '';
    }
}