<?php

namespace Modules\User\Entities;

use Laravel\Passport\HasApiTokens;
use Modules\Charities\Entities\Charity;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Notifications\Notifiable;
use Modules\Donations\Entities\Donor;
use Modules\Donations\Entities\RecurringDonation;
use Modules\Volunteers\Entities\Volunteer;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use Notifiable , ScopesTrait , HasApiTokens,InteractsWithMedia,HasRoles;

    use SoftDeletes {
      restore as private restoreB;
    }

    protected $dates = [
      'deleted_at'
    ];

    protected $fillable = [
        'name', 'email', 'password', 'mobile' , 'image'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function restore()
    {
        $this->restoreA();
        $this->restoreB();
    }

    public function charity()
    {
        return $this->hasOne(Charity::class);
    }

    public function donor()
    {
        return $this->hasOne(Donor::class);
    }

    public function Volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

    public function recurringDonations()
    {
        return $this->hasMany(RecurringDonation::class);
    }
}
