<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Documents extends Model
{
    /** @use HasFactory<\Database\Factories\UserDetailsFactory> */
    use HasFactory;
    protected $table = 'user_documents';
    protected $primary_key = 'doc_id';

    /** Relationship to user */
    public function relate_user()
    {
        return $this->belongsTo(User::class);
    }
}
