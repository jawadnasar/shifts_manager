<?php

namespace App\Http\Controllers;

use App\Helpers\ApplyHelper;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function index(Request $request)
    {
        try {
            return ApplyHelper::index($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function save(Request $request)
    {
        try{ return ApplyHelper::save($request); } catch (\Exception $e) { return $e->getMessage(); }
    }


}
