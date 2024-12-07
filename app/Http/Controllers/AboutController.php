<?php

namespace App\Http\Controllers;

use App\Helpers\AboutHelper;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        try {
            return AboutHelper::index($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
