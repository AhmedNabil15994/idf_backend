<?php

namespace Modules\Donations\Entities;

use Illuminate\Database\Eloquent\Model;
use IlluminateAgnostic\Str\Support\Carbon;
use Modules\Projects\Entities\Project;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecurringDonation extends Model
{
    use SoftDeletes;
    protected $table = 'recurring_donations';
    public $timestamps = true;
    protected $fillable = array(
        'user_id',
        'status',
        'total',
        'RecurringId',
        'pending_response',
        'failed_response',
        'paid_response',
        'project_id',
        'time_period',
        'end_at',
    );

    protected $casts = [
        'pending_response' => 'array',
        'failed_response' => 'array',
        'paid_response' => 'array',
        'end_at' => 'date',
    ];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function getRetryCountAttribute()
    {
        $RetryCount = 0;

        if ($this->end_at) {
            $end_at = Carbon::parse($this->end_at);
            $now = Carbon::now();

            switch ($this->time_period) {
                case 'daily':
                    $RetryCount = $end_at->diffInDays($now) + 1; // Add 1 to include the current date
                    break;
                case 'weekly':
                    $RetryCount = $end_at->diffInWeeks($now) + 1;
                    break;
                case 'monthly':
                    $RetryCount = $end_at->diffInMonths($now) + 1;
                    break;
            }
        }

        return $RetryCount;
    }

//    public function getRetryCountAttribute()
//    {
//        $RetryCount = 0;
//
//        if($this->end_at){
//            $end_at = Carbon::parse($this->end_at);
//            switch($this->time_period){
//                case 'daily':
//                    $RetryCount = $end_at->diffInDays(Carbon::now());
//                    break;
//                case 'weekly':
//                    $RetryCount = $end_at->diffInWeeks(Carbon::now());
//                    break;
//                case 'monthly':
//                    $RetryCount = $end_at->diffInMonths(Carbon::now());
//                    break;
//            }
//        }
//
//        return $RetryCount;
//    }
}
