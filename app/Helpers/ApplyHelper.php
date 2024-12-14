<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\MetaHelper;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ApplyHelper {

    public static function index()
        {
            $countries = Country::all();
            return view('apply', compact('countries'));
        }
}










