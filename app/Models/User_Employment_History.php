<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Employment_History extends Model
{
    //
    protected $table = 'user_employment_history';
    protected $primary_key = 'id';

    /** Special function to put the created_by and updated_by automatically*/
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->created_by) {
                $model->created_by = \Illuminate\Support\Facades\Auth::user()->id;
            }
        });

        static::updating(function ($model) {
            $model->updated_by = \Illuminate\Support\Facades\Auth::user()->id;
        });
    }

    /** Relationship to user */
    public function relate_user()
    {
        return $this->belongsTo(User::class);
    }
}
