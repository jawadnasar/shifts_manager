<?php

namespace App\Http\Controllers;

use App\Helpers\BlogHelper;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        try {
            return BlogHelper::index($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
