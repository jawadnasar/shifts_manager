<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Admin\EmailTemplateHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index()
    {
        try{ return EmailTemplateHelper::index(); } catch (\Exception $e) { return $e->getMessage(); }
    }

    public function save(Request $request)
    {
        try{ return EmailTemplateHelper::save($request); } catch (\Exception $e) { return $e->getMessage(); }
    }

    public function edit(Request $request)
    {
        try{ return EmailTemplateHelper::edit($request); } catch (\Exception $e) { return $e->getMessage(); }
    }

    public function delete(Request $request)
    {
        try{ return EmailTemplateHelper::delete($request); } catch (\Exception $e) { return $e->getMessage(); }
    } 
}
