<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Mailer_Send_Email_Template;
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

            return $this->previewEmail($request);            // preview email before sending

            Mail::to($request['to_email'])->send(new Mailer_Send_Email_Template($email_subject, $email_body, $email_footer)); // Real mailer function
            return response()->json([
                'status' => 'success',
                'msg'    => 'Email sent successfully!',
            ]);
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

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('form').on('submit', function(event) {
        let isValid = true;

        // Iterate through required fields
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;

                // Show a popup near the input field
                const offset = $(this).offset();
                const popup = $('<div class="validation-popup">This field is required</div>');
                popup.css({
                    position: 'absolute',
                    top: offset.top - $(this).outerHeight() - 10,
                    left: offset.left,
                    background: '#f8d7da',
                    color: '#721c24',
                    padding: '5px 10px',
                    border: '1px solid #f5c6cb',
                    borderRadius: '5px',
                    zIndex: 1000
                });

                $('body').append(popup);

                // Remove the popup after 3 seconds
                setTimeout(function() {
                    popup.remove();
                }, 3000);

                // Stop iterating further
                return false;
            }
        });

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>
