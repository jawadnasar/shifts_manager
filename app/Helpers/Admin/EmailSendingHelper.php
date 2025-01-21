<?php

namespace App\Helpers\Admin;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EmailSendingHelper {

    public static function sendEmailWithTemplate(Request $request)
    {
        try {
            // Validate incoming request data with custom messages
            $validatedData = $request->validate([
                // 'from_email' => 'required|email',
                'to_email' => 'required|email',
                'subject' => 'required|string|max:255',
                'email_body' => 'required|string',
                'email_footer' => 'nullable|string',
                'image' => 'nullable|string', // Image name as a string
            ], [
                // 'from_email.required' => 'Please enter a valid "From" email address.',
                'from_email.email' => 'Please enter a valid email address for "From".',
                'to_email.required' => 'Please enter a valid "To" email address.',
                'to_email.email' => 'Please enter a valid email address for "To".',
                'subject.required' => 'Please enter a subject line.',
                'email_body.required' => 'Please enter the email body.',
                'image.string' => 'The image must be a string with a valid filename.',
            ]);

            // Prepare the email content
            $htmlContent = $validatedData['email_body'] . ($validatedData['email_footer'] ?? '');

            // Fetch the logo and footer images using the 'asset' function
            $logoUrl = asset('front-theme/images/main_logo.png'); // Logo URL
            $fbIconUrl = asset('front-theme/images/fb.png');    // Facebook icon URL
            $xIconUrl = asset('front-theme/images/x.png');      // Twitter icon URL

            // Handle the image field logic
            $imageData = null;
            if (!empty($validatedData['image']) && preg_match('/\.(jpg|jpeg|png)$/i', $validatedData['image'])) {
                // Fetch the image from the email_templates directory
                $imageData = asset('storage/email_templates/' . $validatedData['image']);
            }

            // Send the email
            Mail::send([], [], function ($message) use ($validatedData, $htmlContent, $imageData, $logoUrl, $fbIconUrl, $xIconUrl) {
                // $message->from($validatedData['from_email']);
                $message->to($validatedData['to_email']);
                $message->subject($validatedData['subject']);
                $message->setBody($htmlContent, 'text/html'); // Setting content type as HTML

                // Attach image if available
                if ($imageData) {
                    $message->embed($imageData); // Embed the image in the email
                }

                // Embed the logo in the email header
                $message->embed($logoUrl); // This embeds the logo in the email

                // Embed the social media icons in the email footer
                $message->embed($fbIconUrl); // Facebook icon
                $message->embed($xIconUrl);  // Twitter icon
            });

            return response()->json([
                'status' => 'success',
                'msg' => 'Email sent successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }
    }



}

