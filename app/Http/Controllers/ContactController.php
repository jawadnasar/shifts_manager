<?php

namespace App\Http\Controllers;

use App\Helpers\ContactHelper;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        try {
            return ContactHelper::index($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add(Request $request)
    {
        try {
            return ContactHelper::add($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
