<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shifts';

    protected $fillable = [
        'user_id',
        'client_id',
        'user_rate',
        'client_rate',
        'total_hours',
        'total_pay_user',
        'total_billed_client',
        'shift_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Account::class, 'client_id', 'accountid');
    }

    public function clockEntries()
    {
        return $this->hasMany(ClockEntry::class);
    }
}