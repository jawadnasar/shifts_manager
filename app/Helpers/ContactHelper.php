<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\MetaHelper;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ContactHelper {

    public static function index()
        {
            return view('contact');
        }

        public static function add(Request $request)
        {
            // Validation rules and messages
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'message' => ['required', 'string', 'max:1000'],
            ];
            
            $messages = [
                'name.required' => 'Please enter your name.',
                'name.string' => 'The name must be a valid string.',
                'name.max' => 'The name cannot exceed 255 characters.',
            
                'email.email' => 'Please enter a valid email address.',
                'email.max' => 'The email address cannot exceed 255 characters.',
            
                'phone.required' => 'Please enter your phone number.',
                'phone.string' => 'The phone number must be a valid string.',
                'phone.max' => 'The phone number cannot exceed 255 characters.',
            
                'message.required' => 'Please enter your message.',
                'message.string' => 'The message must be a valid string.',
                'message.max' => 'The message cannot exceed 1000 characters.',
            ];
        
            // Validate the request data
            $validatedData = $request->validate($rules, $messages);
        
            try {
                // Create a new contact object
                $contact = new Contact();
                $contact->name = $validatedData['name'];
                $contact->email = $validatedData['email'] ?? null;
                $contact->phone = $validatedData['phone'];
                $contact->message = $validatedData['message'];
        
                $contact->save();
        
                return ['status' => 'success', 'msg' => 'The message has been sent successfully!'];
            } catch (\Exception $e) {
                return ['status' => 'error', 'msg' => $e->getMessage()];
            }
        }
        
}





