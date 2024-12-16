<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\MetaHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AboutHelper {

    public static function index()
        {
            return view('about');
        }

        public static function add(Request $request)
        {
            // Validation rules and messages
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'message' => ['required', 'string', 'max:1000'],
            ];
    
            $messages = [
                'name.required' => 'Please enter your name.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name cannot exceed 255 characters.',
    
                'email.required' => 'Please enter your email address.',
                'email.string' => 'The email must be a string.',
                'email.email' => 'Please enter a valid email address.',
                'email.max' => 'The email address cannot exceed 255 characters.',
    
                'title.required' => 'Please enter your message title.',
                'title.string' => 'The title must be a string.',
                'title.max' => 'The title cannot exceed 255 characters.',
    
                'message.required' => 'Please enter your detail message.',
                'message.string' => 'The message must be in a valid form.',
                'message.max' => 'The max limit for message is 1000 characters',
            ];
    
            // Validate the request data
            $validatedData = $request->validate($rules, $messages);
    
            try {
                // Create a new user object
                $contact = new Contact();
                $contact->name = $validatedData['name'];
                $contact->email = $validatedData['email'];
                $contact->title = $validatedData['title'];
                $contact->message = $validatedData['message'];
                
    
                $contact->save();
    
                return ['status' => 'success', 'msg' => 'The message has been sent successfully!'];
            } catch (\Exception $e) {
                return ['status' => 'error', 'msg' => $e->getMessage()];
            }
        }
}










