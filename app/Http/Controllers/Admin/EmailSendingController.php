<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use PharIo\Manifest\Email;

class EmailSendingController extends Controller
{
    //

    public function email_template_preview(Request $request)
    {
        $template = EmailTemplate::find($request->template_id);
        return view('admin.email_template_preview')->with(compact('template'));
    }
}
