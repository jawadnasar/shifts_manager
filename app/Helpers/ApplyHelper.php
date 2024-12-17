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
                // Users Table
                'fname' => 'required|string|max:255',
                'sname' => 'nullable|string|max:255',
                'user_type' => 'required|in:admin,employee',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
        
                // User Details Table
                'dob' => 'nullable|date|before:today',
                'gender' => 'required|in:MA,FE,OT',
                'phone' => 'nullable|string|max:20|regex:/^\+?[0-9\-]{7,20}$/',
                'birth_place' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'current_address' => 'nullable|string|max:255',
                'town' => 'nullable|string|max:255',
                'postcode' => 'nullable|string|max:10',
                'living_since' => 'nullable|date|before:today',
                'ni_number' => 'nullable|string|max:20',
        
                // Emergency Contact
                'emergency_contact_name' => 'nullable|string|max:255',
                'emergency_contact_relationship' => 'nullable|string|max:255',
                'emergency_contact_phone' => 'nullable|string|max:20|regex:/^\+?[0-9\-]{7,20}$/',
        
                // SIA Licence
                'sia_licence_type' => 'nullable|string|max:255',
                'sia_licence_number' => 'nullable|string|max:255',
                'sia_licence_expiry_date' => 'nullable|date|after:today',
        
                // Driving Licence
                'driving_licence_present' => 'nullable|boolean',
                'driving_licence_type' => 'nullable|string|max:255',
                'driving_licence_number' => 'nullable|string|max:255',
                'own_vehicle' => 'nullable|boolean',
        
                // Criminal Background
                'criminal_offence_present' => 'nullable|boolean',
                'criminal_offence_details' => 'nullable|string',
        
                // Right to Work
                'share_code' => 'nullable|string|max:255',
        
                // User Documents
                'doc_type' => 'required|array',  // Ensure it's an array
                'doc_type.*' => 'string|in:national_idcard,security_licence,driving_licence,passport,brp,other',  // Each item must be a valid string
                'images' => 'nullable|array',  // Optional, if uploading multiple images
                'images.*' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:2048',  // Image file validation
                'status' => 'required|array',  // Status must be an array
                'status.*' => 'in:0,1,2,3',  // Each status must be valid
                'details' => 'required|string',
        
                // Foreign Keys
                'created_by' => 'required|exists:users,id',
                'updated_by' => 'nullable|exists:users,id',
            ];
        
            $messages = [
                // Users Table
                'fname.required' => 'Please enter the first name.',
                'fname.max' => 'The first name cannot exceed 255 characters.',
                'sname.max' => 'The surname cannot exceed 255 characters.',
                'user_type.required' => 'Please specify the user type.',
                'user_type.in' => 'User type must be either admin or employee.',
                'email.required' => 'Please enter the email address.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already registered.',
                'password.required' => 'Please enter a password.',
                'password.min' => 'Password must be at least 6 characters long.',
        
                // User Details
                'dob.date' => 'Please provide a valid date of birth.',
                'dob.before' => 'Date of birth must be before today.',
                'gender.required' => 'Please select a gender.',
                'gender.in' => 'Gender must be MA (male), FE (female), or OT (other).',
                'phone.regex' => 'Phone number must be valid (e.g., +123456789).',
                'postcode.max' => 'Postcode cannot exceed 10 characters.',
                'living_since.before' => 'Living since date must be before today.',
                'ni_number.max' => 'NI Number cannot exceed 20 characters.',
        
                // Emergency Contact
                'emergency_contact_phone.regex' => 'Emergency contact phone must be valid (e.g., +123456789).',
        
                // SIA Licence
                'sia_licence_expiry_date.after' => 'SIA licence expiry date must be after today.',
        
                // Driving Licence
                'driving_licence_present.boolean' => 'Driving licence presence must be true or false.',
                'own_vehicle.boolean' => 'Own vehicle status must be true or false.',
        
                // Criminal Background
                'criminal_offence_present.boolean' => 'Criminal offence presence must be true or false.',
        
                // User Documents
                'doc_type.required' => 'Please specify the document type.',
                'doc_type.*.string' => 'Each document type must be a valid string.',
                'doc_type.*.in' => 'Document type must be one of the following: national_idcard, security_licence, driving_licence, passport, brp, or other.',
                'images.*.mimes' => 'Each uploaded image must be a valid file type (jpg, jpeg, png, or pdf).',
                'images.*.max' => 'Each uploaded image must not exceed 2MB in size.',
                'status.required' => 'Please specify the document status.',
                'status.*.in' => 'Each document status must be valid (0, 1).',
                'details.required' => 'The details field is required.',
                'details.string' => 'The details field must be a valid string.',
        
                // Foreign Keys
                'created_by.required' => 'Created by field is required.',
                'created_by.exists' => 'The creator must be a valid user.',
                'updated_by.exists' => 'The updater must be a valid user.',
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
        
            // Handle documents (user documents)
            $uploadedDocuments = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $index => $document) {
                    // Get the document details from the request
                    $documentType = $request->input('doc_type')[$index];  // Document type from the 'doc_type[]' field
                    $documentStatus = $request->input('status')[$index];  // Document status from the 'status[]' field
                    $documentDetails = $request->input('details')[$index];  // Document details from the 'details[]' field
                    
                    // Store the file in the 'public/documents' directory
                    $documentName = $document->getClientOriginalName();
                    $documentPath = $document->storeAs('public/documents', $documentName);
                    
                    // Push each document data into the array
                    $uploadedDocuments[] = [
                        'type' => $documentType,  // Document type (e.g., "ID", "Passport", etc.)
                        'link' => $documentPath,  // Store the path where the document is stored
                        'status' => $documentStatus,  // Document status (1 or 0)
                        'details' => $documentDetails,  // Optional: document details
                    ];
                }
            }

            // Then proceed with the code to save these documents
            foreach ($uploadedDocuments as $document) {
                $documentType = $document['type'];  // Document type (e.g., national ID, passport)
                $documentLink = $document['link'];  // Document link (file path or URL)
                $documentStatus = $document['status'];  // Document status
                $documentDetails = $document['details'];  // Document details (optional)

                // Create a new document entry
                $userDocument = new User_Documents();
                $userDocument->user_id = $user->id;  // Associated user ID
                $userDocument->doc_type = $documentType;  // Document type
                $userDocument->link = $documentLink;  // Document link
                $userDocument->status = $documentStatus;  // Document status (active or inactive)
                $userDocument->details = $documentDetails ?? '';  // Document details (optional)
                $userDocument->created_by = auth()->id();  // Created by (user ID)
                $userDocument->updated_by = auth()->id();  // Updated by (user ID)
                $userDocument->save();  // Save user document
            }


            DB::commit();  // Commit transaction
        
            return ['status' => 'success', 'msg' => 'User has been successfully inserted!'];
        
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback transaction in case of error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}










