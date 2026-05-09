<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acctran extends Model
{
    // use HasFactory;

    protected $table = 'acctran';

    protected $fillable = [
        'date',
        'vtype',
        'description',
        'debit',
        'credit',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'accountid', 'accountid');
    }
}
