<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Admin\AdminDashboardHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        try{ return AdminDashboardHelper::index(); } catch (\Exception $e) { return $e->getMessage(); }
    }
}
