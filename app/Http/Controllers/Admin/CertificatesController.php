<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Admin\CertificatesHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    public function index()
    {
        try{ return CertificatesHelper::index(); } catch (\Exception $e) { return $e->getMessage(); }
    }

    public function save(Request $request)
    {
        try{ return CertificatesHelper::save($request); } catch (\Exception $e) { return $e->getMessage(); }
    }

    public function getall(Request $request)
    {
        try{ return CertificatesHelper::getall($request); } catch (\Exception $e) { return $e->getMessage(); }
    } 
}
