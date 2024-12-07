<?php

namespace App\Http\Controllers;

use App\Helpers\ServicesHelper;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        try {
            return ServicesHelper::index($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function receptionDetail(Request $request)
    {
        try {
            return ServicesHelper::receptionDetail($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function SiteScurityDetail(Request $request)
    {
        try {
            return ServicesHelper::SiteScurityDetail($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function DoorSecurityDetail(Request $request)
    {
        try {
            return ServicesHelper::DoorSecurityDetail($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function EventSecurityDetail(Request $request)
    {
        try {
            return ServicesHelper::EventSecurityDetail($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    
    public function PersonalBodyGuardDetail(Request $request)
    {
        try {
            return ServicesHelper::PersonalBodyGuardDetail($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function ShoppingMallSecurityDetail(Request $request)
    {
        try {
            return ServicesHelper::ShoppingMallSecurityDetail($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
