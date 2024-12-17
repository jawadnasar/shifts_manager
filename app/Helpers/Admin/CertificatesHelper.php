<?php

namespace App\Helpers\Admin;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CertificatesHelper {

    public static function index(){
        $certificates  = Certificate::all();
        return view('admin.certificates', compact('certificates'));
    }

    public static function getall(Request $request)
    {
    
        $certificates = Certificate::all();
        
        
        $formattedData = $certificates->map(function ($item) {
            return [ 
                'id' => $item->id ?? '--',
                'logo' => $item->logo ?? '--',
            ];
        });

        return ['data' => $formattedData];
    }

    public static function add(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
             
                'logo' => 'required|file|mimes:jpg,png|max:2048',
            ], [
                'logo.required' => 'Please upload company logo.',
                'logo.file' => 'Invalid file format for the company logo.',
                'logo.mimes' => 'The company logo must be a JPG or PNG file.',
                'logo.max' => 'The company logo size cannot exceed 2MB.',

            ]);

            // Create a new company instance
            $company = new Certificate();
          

            // Handle the file upload
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = time() . '_' . $logo->getClientOriginalName(); // Ensure a unique filename
                $logoPath = $logo->storeAs('public/images/certificates', $logoName);

                if (!$logoPath) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'Failed to store the company logo. Please try again.'
                    ], 500);
                }

                $company->logo = $logoName; // Save the filename to the database
            }

            // Save the company details to the database
            $company->save();

            // Return a success response with a message
            return response()->json([
                'status' => 'success',
                'msg' => 'Certificate has been successfully inserted!'
            ]);

        } catch (\Exception $e){
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}

