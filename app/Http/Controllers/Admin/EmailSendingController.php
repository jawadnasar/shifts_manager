<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Admin\EmailSendingHelper;
use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PharIo\Manifest\Email;

class EmailSendingController extends Controller
{
    //

    public function email_template_preview(Request $request)
    {
        $template = EmailTemplate::find($request->template_id);
        return view('admin.email_template_preview')->with(compact('template'));
    }

    public function sendEmailWithTemplate(Request $request)
    {
        try{ return EmailSendingHelper::sendEmailWithTemplate($request); } catch (\Exception $e) { return $e->getMessage(); }
    }


}

