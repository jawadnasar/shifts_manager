<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Admin\AdminBlogHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function index()
    {
        try{ return AdminBlogHelper::index(); } catch (\Exception $e) { return $e->getMessage(); }
    }

    public function add(Request $request)
    {
        try{ return AdminBlogHelper::add($request); } catch (\Exception $e) { return $e->getMessage(); }
    }


    public function save(Request $request)
    {
        try{ return AdminBlogHelper::save($request); } catch (\Exception $e) { return $e->getMessage(); }
    }

    

    public function edit(Request $request, $id)
    {
        try{ return AdminBlogHelper::edit($request, $id); } catch (\Exception $e) { return $e->getMessage(); }
        
    }

    public function update(Request $request)
    {
        try{ return AdminBlogHelper::update($request); } catch (\Exception $e) { return $e->getMessage(); }
        
    }

    public function view(Request $request, $id)
    {
        try{ return AdminBlogHelper::view($request, $id); } catch (\Exception $e) { return $e->getMessage(); }
        
    }



  public function filter(Request $request)
{
    try {
        // Delegate filtering logic to helper
        return AdminBlogHelper::filter($request);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while filtering blogs: ' . $e->getMessage()
        ], 500);
    }
}







    public function destroy(Request $request, $id)
    {
        try{ return AdminBlogHelper::destroy($request, $id); } catch (\Exception $e) { return $e->getMessage(); }
        
    }

     public function update_status(Request $request)
    {
        try{ return AdminBlogHelper::update_status($request); } catch (\Exception $e) { return $e->getMessage(); }
        
    }
}
