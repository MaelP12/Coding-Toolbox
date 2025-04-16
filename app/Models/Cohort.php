<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $table        = 'cohorts';
    protected $fillable     = ['school_id', 'name', 'description', 'start_date', 'end_date', 'address'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
