<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\MetaHelper;
use App\Models\Country;
use App\Models\User;
use App\Models\User_Details;
use App\Models\User_Documents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ApplyHelper {

    public static function index()
        {
            $countries = Country::all();
            return view('apply', compact('countries'));
        }


    public static function save(Request $request)
        {
            $rules = [
                // *************************************************

                'fname' => 'required|string|max:255',
                'sname' => 'required|string|max:255',
                'user_type' => 'required|in:admin,employee', 
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                
                // **************************************************
                'dob' => 'required|date',
                'gender' => 'required|in:MA,FE', // Male (MA) or Female (FE)
                'phone' => 'required|string|max:20',
                'birth_place' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'current_address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'postcode' => 'nullable|string|max:10',
                'emergency_contact_name' => 'nullable|string|max:255',
                'emergency_contact_relationship' => 'nullable|string|max:255',
                'emergency_contact_phone' => 'nullable|string|max:20',
                'living_since' => 'nullable|date',
                'ni_number' => 'nullable|string|max:20',
                // Emergency Contact Details
                'emergency_contact_name' => 'nullable|string|max:255',
                'emergency_contact_relationship' => 'nullable|string|max:255',
                'emergency_contact_phone' => 'nullable|string|max:20',

                // SIA License Type
                'sia_licence_type' => 'nullable|string|max:255',
                'sia_licence_number' => 'nullable|string|max:255',
                'sia_licence_expiry_date' => 'nullable|date',

                // Driving lINECSE

                'driving_licence_present' => 'nullable|boolean',
                'driving_licence_type' => 'nullable|string|max:255',
                'driving_licence_number' => 'nullable|string|max:255',
                'own_vehicle' => 'nullable|boolean',
                
                // CLEARANCE
                'criminal_offence_present' => 'nullable|boolean',
                'criminal_offence_details' => 'nullable|string',

                'share_code' => 'nullable|string|max:255',
                // *****************************************************
                'doc_type.*' => 'required|string|max:255',
                'link.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', 

               
                'status.*' => 'required|integer|in:0,1,2,3',
                'details.*' => 'nullable|string',
                'created_by.*' => 'required|exists:users,id',
                'updated_by.*' => 'nullable|exists:users,id',
                // ********************************************************
            ];
        
            $messages = [
                // Users Table
                'fname.required' => 'First name is required.',
                'sname.required' => 'Surname is required.',
                'user_type.required' => 'User type is required.',
                'user_type.in' => 'User type must be either admin or employee.',

                'email.required' => 'Email is required.',
                'email.email' => 'Email must be a valid email address.',
                'email.unique' => 'The email has already been taken.',

                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters long.',
                'password.confirmed' => 'Password confirmation does not match.',
            
                // User Details
                'dob.required' => 'Please select your date of birth.',
                'dob.date' => 'Please provide a valid date of birth.',
                'dob.before' => 'Date of birth must be before today.',
                'gender.required' => 'Please select a gender.',
                'gender.in' => 'Gender must be MA (male), FE (female), or OT (other).',
                'phone.required' => 'Please enter your phone number.',
                'phone.regex' => 'Phone number must be valid (e.g., +123456789).',
                'birth_place.string' => 'The birth place must be a valid string.',
                'birth_place.max' => 'The birth place cannot exceed 255 characters.',
                'nationality.string' => 'The nationality must be a valid string.',
                'nationality.max' => 'The nationality cannot exceed 255 characters.',
                'current_address.string' => 'The current address must be a valid string.',
                'current_address.max' => 'The current address cannot exceed 255 characters.',
                'city.string' => 'The city must be a valid string.',
                'city.max' => 'The city cannot exceed 255 characters.',
                'postcode.string' => 'The postcode must be a valid string.',
                'postcode.max' => 'The postcode cannot exceed 10 characters.',
                'living_since.before' => 'Living since date must be before today.',
                'ni_number.string' => 'The NI number must be a valid string.',
                'ni_number.max' => 'The NI number cannot exceed 20 characters.',

                // Emergency Contact
                'emergency_contact_name.string' => 'The emergency contact name must be a valid string.',
                'emergency_contact_name.max' => 'The emergency contact name cannot exceed 255 characters.',
            
                'emergency_contact_relationship.string' => 'The emergency contact relationship must be a valid string.',
                'emergency_contact_relationship.max' => 'The emergency contact relationship cannot exceed 255 characters.',
                
                'emergency_contact_phone.string' => 'The emergency contact phone must be a valid string.',
                'emergency_contact_phone.max' => 'The emergency contact phone cannot exceed 20 characters.',

                // SIA License Type
                'sia_licence_type.string' => 'The SIA licence type must be a valid string.',
                'sia_licence_type.max' => 'The SIA licence type cannot exceed 255 characters.',
                
                'sia_licence_number.string' => 'The SIA licence number must be a valid string.',
                'sia_licence_number.max' => 'The SIA licence number cannot exceed 255 characters.',
                
                'sia_licence_expiry_date.date' => 'The SIA licence expiry date must be a valid date.',
            
                // Driving Licence
                'driving_licence_present.boolean' => 'The driving licence present field must be true or false.',

                'driving_licence_type.string' => 'The driving licence type must be a valid string.',
                'driving_licence_type.max' => 'The driving licence type cannot exceed 255 characters.',

                'driving_licence_number.string' => 'The driving licence number must be a valid string.',
                'driving_licence_number.max' => 'The driving licence number cannot exceed 255 characters.',

                'own_vehicle.boolean' => 'The own vehicle field must be true or false.',
            
                // Criminal Background
                'criminal_offence_present.boolean' => 'The criminal offence present field must be true or false.',
                'criminal_offence_details.string' => 'The criminal offence details must be a valid string.',
                //Share Code
                'share_code.string' => 'The Right to work share code must be a valid string.',
                'share_code.max' => 'The share code may not be greater than 255 characters.',
                // User Documents
                'link.*.required' => 'Each document image is required.',
                'link.*.image' => 'Each file must be a valid image (jpg, jpeg, png, gif).',
                'link.*.mimes' => 'Each image must be one of the following formats: jpg, jpeg, png, gif.',
                'link.*.max' => 'Each image must not exceed 2MB in size.',

                'doc_type.*.required' => 'The document type is required.',
                'doc_type.*.string' => 'The document type must be a string.',
                'doc_type.*.max' => 'The document type may not be greater than 255 characters.',

                
                'status.*.required' => 'The document status is required.',
                'status.*.integer' => 'The document status must be an integer.',
                'status.*.in' => 'The document status must be one of the following values: 0, 1',
                
                'details.*.string' => 'The document details must be a valid string.',
                
                'created_by.*.required' => 'The created by field is required.',
                'created_by.*.exists' => 'The selected created by user does not exist.',
                
                'updated_by.*.exists' => 'The selected updated by user does not exist.',
                // Foreign Keys
            ];
            
        
        $validatedData = $request->validate($rules, $messages);

        DB::beginTransaction();

        try {
            DB::beginTransaction();  // Start transaction
        
            // Create the user
            $user = new User();
            $user->fname =  $validatedData['fname'];  // First name field
            $user->sname =  $validatedData['sname'];  // Surname field
            $user->user_type = $validatedData['user_type'];  // Surname field
            $user->email =  $validatedData['email'];  // Email field
            $user->password = bcrypt( $validatedData['password']);  // Password field
            $user->save();  // Save user
        
            // Create the user details
            $userDetails = new User_Details();
            $userDetails->user_id = $user->id;
            $userDetails->dob =  $validatedData['dob'];  // Date of birth
            $userDetails->gender =  $validatedData['gender'];  // Gender (male, female, other)
            $userDetails->phone =  $validatedData['phone'];  // Phone number
            $userDetails->birth_place =  $validatedData['birth_place'] ?? null;  // Birthplace
            $userDetails->nationality =  $validatedData['nationality'] ?? null;  // Nationality
            $userDetails->current_address =  $validatedData['current_address'] ?? null;  // Current address
            $userDetails->city =  $validatedData['city'] ?? null;  // Town
            $userDetails->postcode =  $validatedData['postcode'] ?? null;  // Postcode
            $userDetails->living_since =  $validatedData['living_since'] ?? null;  // Living since
            $userDetails->ni_number =  $validatedData['ni_number'] ?? null;  // National Insurance number
            $userDetails->emergency_contact_name =  $validatedData['emergency_contact_name'] ?? null;  // Emergency contact name
            $userDetails->emergency_contact_relationship =  $validatedData['emergency_contact_relationship'] ?? null;  // Emergency contact relationship
            $userDetails->emergency_contact_phone =  $validatedData['emergency_contact_phone'] ?? null;  // Emergency contact phone
            $userDetails->sia_licence_type =  $validatedData['sia_licence_type'] ?? null;  // SIA license type
            $userDetails->sia_licence_number =  $validatedData['sia_licence_number'] ?? null;  // SIA license number
            $userDetails->sia_licence_expiry_date =  $validatedData['sia_licence_expiry_date'] ?? null;  // SIA license expiry date
            $userDetails->driving_licence_present =  $validatedData['driving_licence_present'] ?? false;  // Driving license present (boolean)
            $userDetails->driving_licence_type =  $validatedData['driving_licence_type'] ?? null;  // Driving license type
            $userDetails->driving_licence_number =  $validatedData['driving_licence_number'] ?? null;  // Driving license number
            $userDetails->own_vehicle =  $validatedData['own_vehicle'] ?? false;  // Own vehicle (boolean)
            $userDetails->criminal_offence_present =  $validatedData['criminal_offence_present'] ?? false;  // Criminal offense present (boolean)
            $userDetails->criminal_offence_details =  $validatedData['criminal_offence_details'] ?? null;  // Criminal offense details
            $userDetails->share_code =  $validatedData['share_code'] ?? null;  // Share code for right to work
            $userDetails->created_by = Auth()->id();  // Created by (user ID)
            $userDetails->updated_by = Auth()->id();  // Updated by (user ID)
            $userDetails->save();  // Save user details
        
            
            // Then proceed with the code to save these documents
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $document) {
                    $documentType = $request->input('doc_type')[$index];
                    $documentStatus = $request->input('status')[$index];
                    $documentDetails = $request->input('details')[$index];
    
                    // Store document and save record
                    $documentName = time() . '_' . $document->getClientOriginalName();
                    $documentPath = $document->storeAs('public/documents', $documentName);
    
                    $userDocument = new User_Documents();
                    $userDocument->user_id = $user->id;
                    $userDocument->doc_type = $documentType;
                    $userDocument->status = $documentStatus;
                    $userDocument->details = $documentDetails;
                    $userDocument->link = $documentName;
                    $userDocument->save();
                }
            }


            DB::commit();  // Commit transaction
        
            return ['status' => 'success', 'msg' => 'User has been successfully inserted!'];
        
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback transaction in case of error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}










