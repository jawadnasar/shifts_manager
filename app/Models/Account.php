<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = "accounts";
    protected $primaryKey = "accountid";
    public $timestamps = true;          // Automatic created_at and updated_at set
    
}
