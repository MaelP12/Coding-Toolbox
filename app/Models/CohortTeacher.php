<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CohortTeacher extends Pivot
{
    protected $table = 'cohort_teacher';

    protected $fillable = [
        'user_id',
        'cohort_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }
}
