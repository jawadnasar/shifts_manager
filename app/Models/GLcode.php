<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GLcode extends Model
{
    use HasFactory;

    protected $table = 'glcodes';
    protected $primaryKey = 'actype';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'actype',
        'name',
        'basetype',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class, 'actype', 'actype');
    }
}
