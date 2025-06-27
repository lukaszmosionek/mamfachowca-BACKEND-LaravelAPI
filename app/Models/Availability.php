<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'user_id', 'day_of_week', 'start_time', 'end_time',
    ];

    // provider
    public function provider()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
