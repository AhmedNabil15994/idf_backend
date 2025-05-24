<?php

namespace Modules\Donations\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class DonationStatus extends Model
{
    use Translatable;
    protected $table = 'donation_statuses';
    public $timestamps = true;
    protected $fillable = array('code');
    protected $with               = [ 'translations' ];
    public $translatedAttributes  = ['title'];
    public $translationModel      = DonationStatusTranslation::class;

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

}