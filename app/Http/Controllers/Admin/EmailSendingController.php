<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Mailer_Send_Email_Template;
use App\Models\Email_Sent;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailSendingController extends Controller
{
    //

    public function email_template_preview(Request $request)
    {
        $template = EmailTemplate::find($request->template_id);
        return view('admin.email_template_preview')->with(compact('template'));
    }

    // Connecting to mailer from here
    public function sendEmailWithTemplate(Request $request)
    {
        try {
            $email_subject = $request['subject'];
            $email_body    = $request['email_body'];
            $email_footer  = $request['email_footer'];

            // return $this->previewEmail($request);            // preview email before sending
            $emailsArray = explode(';', $request['to_email']); // Split by semicolon

            Mail::to($emailsArray)->send(new Mailer_Send_Email_Template($email_subject, $email_body, $email_footer)); // Real mailer function
            
            // Save the email sent to the database
            $email_sent = new Email_Sent();
            $email_sent->to_email = $request['to_email'];
            $email_sent->subject = $email_subject;
            $email_sent->email_body = $this->previewEmail($request);
            $email_sent->save();

            return back()->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {return response()->json([
            'status' => 'error',
            'msg'    => $e->getMessage(),
        ]);}
    }

    // If you want to preview the email before sending
    public function previewEmail(Request $request)
    {
        $email_subject = $request['subject'];
        $email_body    = $request['email_body'];
        $email_footer  = $request['email_footer'];

        return view('admin.email_template_send', compact('email_body', 'email_footer'));
    }

}
