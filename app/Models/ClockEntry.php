<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClockEntry extends Model
{
    use HasFactory;

    protected $table = 'shifts_clock';

    protected $fillable = [
        'shift_id',
        'clock_in_datetime',
        'clock_out_datetime',
    ];

    protected $casts = [
        'clock_in_datetime' => 'datetime',
        'clock_out_datetime' => 'datetime',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

}