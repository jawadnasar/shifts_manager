<?php
namespace App\Helpers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ContactHelper
{

    public static function index()
    {
        return view('contact');
    }

    public static function add(Request $request)
    {
        // Validation rules and messages
        $rules = [
            'name'               => ['required', 'string', 'max:255'],
            'email'              => ['nullable', 'string', 'email', 'max:255'],
            'company_name'       => ['nullable', 'string', 'max:255'],
            'phone'              => ['required', 'string', 'max:255'],
            'message'            => ['required', 'string', 'max:1000'],
            'g-recaptcha-response' => ['required', 'string'],
        ];

        $messages = [
            'name.required'    => 'Please enter your name.',
            'name.string'      => 'The name must be a valid string.',
            'name.max'         => 'The name cannot exceed 255 characters.',

            'email.email'      => 'Please enter a valid email address.',
            'email.max'        => 'The email address cannot exceed 255 characters.',

            'phone.required'   => 'Please enter your phone number.',
            'phone.string'     => 'The phone number must be a valid string.',
            'phone.max'        => 'The phone number cannot exceed 255 characters.',

            'company_name.string' => 'The company name must be a valid string.',
            'company_name.max'    => 'The company name cannot exceed 255 characters.',

            'message.required' => 'Please enter your message.',
            'message.string'   => 'The message must be a valid string.',
            'message.max'      => 'The message cannot exceed 1000 characters.',

            'g-recaptcha-response.required' => 'Please complete the CAPTCHA to prove you are human.',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules, $messages);

        /* Server-side reCAPTCHA verification start */
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
        $recaptchaResponse = $validatedData['g-recaptcha-response'] ?? null;

        if (!$recaptchaSecret || !$recaptchaResponse) {
            return ['status' => 'error', 'msg' => 'Captcha configuration is missing.'];
        }

        $recaptchaResult = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ]);

        if (!$recaptchaResult->successful() || !$recaptchaResult->json('success')) {
            return ['status' => 'error', 'msg' => 'Captcha verification failed. Please try again.'];
        }
        /* Server-side reCAPTCHA verification end */

        try {
            // Create a new contact object
            $contact          = new Contact();
            $contact->name    = $validatedData['name'];
            $contact->email   = $validatedData['email'] ?? null;
            $contact->company_name = $validatedData['company_name'] ?? null;
            $contact->phone   = $validatedData['phone'];
            $contact->message = $validatedData['message'];

            $contact->save();

            // Send a simple email notification to the company email
            Mail::to(config('app.company.email'))
                ->cc(env('COMPANY_CC_EMAIL')) // Optional: CC to another email address
                ->send(
                    new class extends \Illuminate\Mail\Mailable
                    {
                        public function build()
                        {
                            return $this->subject('New Contact Us Message')
                                ->text('emails.feedback'); // Blade view (optional)
                        }
                    }
                );

            return ['status' => 'success', 'msg' => 'The message has been sent successfully!'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'msg' => $e->getMessage()];
        }
    }

}
