<?php

namespace App\Helpers\Admin;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EmailSendingHelper {

    public static function sendEmailWithTemplate(Request $request)
    {
        try {
            // Validate incoming request data with custom messages
            $validatedData = $request->validate([
                'from_email' => 'required|email',
                'to_email' => 'required|email',
                'subject' => 'required|string|max:255',
                'email_body' => 'required|string',
                'email_footer' => 'nullable|string',
                'image' => 'nullable|string',  // Image as string (filename)
            ], [
                'from_email.required' => 'Please enter a valid "From" email address.',
                'from_email.email' => 'Please enter a valid email address for "From".',
                'to_email.required' => 'Please enter a valid "To" email address.',
                'to_email.email' => 'Please enter a valid email address for "To".',
                'subject.required' => 'Please enter a subject line.',
                'email_body.required' => 'Please enter the email body.',
                'image.string' => 'The image must be a string with valid extension',
            ]);

             // Prepare the email content
             $htmlContent = $validatedData['email_body'] . ($validatedData['email_footer'] ?? '');

             // Fetch the logo and footer images using the 'asset' function
             $logoUrl = asset('front-theme/images/main_logo.png'); // Logo URL
             $fbIconUrl = asset('front-theme/images/fb.png');    // Facebook icon URL
             $xIconUrl = asset('front-theme/images/x.png');      // Twitter icon URL
 
             // Handle the image field logic
             if ($request->image) {
                 // If an image is uploaded, store it and include it in the email
                 $imagePath = $request->file('image')->store('email_templates', 'public');  // Store in 'public/email_templates' directory
                 $imageData = Storage::disk('public')->url($imagePath);  // Get the image URL for the attachment
             } elseif (!empty($validatedData['image']) && preg_match('/\.(jpg|jpeg|png)$/i', $validatedData['image'])) {
                 // If the image field contains a valid string (filename), use it
                 $imageData = asset('storage/email_templates/' . $validatedData['image']);
             } else {
                 // If no image uploaded and no valid image filename, set imageData to null
                 $imageData = null;
             }
 
             // Send the email
             Mail::send([], [], function ($message) use ($validatedData, $htmlContent, $imageData, $logoUrl, $fbIconUrl, $xIconUrl) {
                 $message->from($validatedData['from_email']);
                 $message->to($validatedData['to_email']);
                 $message->subject($validatedData['subject']);
                 $message->setBody($htmlContent, 'text/html');  // Setting content type as HTML
 
                 // Attach image if available
                 if ($imageData) {
                     $message->attach($imageData, [
                         'mime' => 'image/png',  // You can dynamically change mime type if needed
                         'as' => 'image.png'
                     ]);
                 }
 
                 // Embed the logo in the email header (using inline attachments)
                 $message->embed($logoUrl);  // This embeds the logo in the email
 
                 // Embed the social media icons in the email footer (using inline attachments)
                 $message->embed($fbIconUrl); // Facebook icon
                 $message->embed($xIconUrl);  // Twitter icon
             });

            return response()->json([
                'status' => 'success',
                'msg' => 'Template saved successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }
    }

}

