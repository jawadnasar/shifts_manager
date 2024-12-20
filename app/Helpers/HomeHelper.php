<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\MetaHelper;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class HomeHelper {

    public static function index()
        {
            $certificates = Certificate::all();
            return view('home', compact('certificates'));
        }
}










