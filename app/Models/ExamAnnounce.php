<?php

namespace App\Models;

use Eloquent;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ExamAnnounce extends Eloquent
{
    use LogsActivity;

    protected $fillable = ['exam_id', 'message', 'duration'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->dontSubmitEmptyLogs()
            ->logOnlyDirty();
    }
}
