<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\MetaHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ServicesHelper {

    public static function index()
    {
        return view('services');
    }

    public static function receptionDetail()
        {
        return view('reception-detail');
    }

    public static function SiteScurityDetail()
        {
        return view('site-security-detail');
    }

    public static function DoorSecurityDetail()
    {
    return view('door-security-detail');
    }

    public static function EventSecurityDetail()
    {
    return view('event-security-detail');
    }

    public static function PersonalBodyGuardDetail()
        {
        return view('personal-body-guard-security-detail');
    }

    
    public static function ShoppingMallSecurityDetail()
        {
        return view('shopping-malls-security-detail');
    }
}










