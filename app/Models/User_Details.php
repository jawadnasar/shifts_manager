<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Details extends Model
{
    /** @use HasFactory<\Database\Factories\UserDetailsFactory> */
    use HasFactory;
    protected $table = 'user_details';
    protected $primary_key = 'id';

    /** Special function to put the created_by and updated_by automatically*/
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->created_by) {
                $model->created_by = auth()->User()->id;
            }
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->User()->id;
        });
    }

    /** Relationship to user */
    public function relate_user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'nationality', 'id');
    }
}
