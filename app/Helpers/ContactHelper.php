<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\MetaHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ContactHelper {

    public static function index()
        {
            return view('contact');
        }
}





