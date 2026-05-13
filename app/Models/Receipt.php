<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Receipt extends Model
{
    protected $table = 'receipts';

    protected $primaryKey = 'transid';

    public $incrementing = true;

    public function getRouteKeyName(): string
    {
        return 'transid';
    }

    protected $fillable = [
        'date',
        'debitac',
        'creditac',
        'amount',
        'user_id',
        'details',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'amount' => 'decimal:4',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function debitAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'debitac', 'accountid');
    }

    public function creditAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'creditac', 'accountid');
    }

    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function canEdit(): bool
    {
        $created = $this->created_at;
        if ($created === null) {
            return false;
        }

        return now()->lt($created->copy()->addWeek());
    }

    public function canDelete(): bool
    {
        $created = $this->created_at;
        if ($created === null) {
            return false;
        }

        return now()->lt($created->copy()->addDays(2));
    }
}
