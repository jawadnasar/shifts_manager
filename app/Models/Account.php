<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'accounts';
    protected $primaryKey = 'accountid';
    public $timestamps = true;          // Automatic created_at and updated_at set

    protected $fillable = [
        'name',
        'actype',
        'is_active',
        'email',
        'phone',
        'company',
        'address',
        'details',
        'created_by',
        'updated_by',
    ];

    public function account_glcode()
    {
        return $this->belongsTo(GLcode::class, 'actype', 'actype');
    }
}
