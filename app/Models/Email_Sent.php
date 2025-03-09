<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email_Sent extends Model
{
    protected $table = 'emails_sent';
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
    }
}