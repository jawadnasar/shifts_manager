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

    public static function save(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'company_name' => 'required|max:255|string',
                'logo' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            ], [
                'company_name.required' => 'Please enter company name.',
                'company_name.max' => 'The company name cannot exceed 255 characters.',
                'company_name.string' => 'The company name must be a valid string',
                'logo.required' => 'Please upload a certificate/logo.',
                'logo.mimes' => 'The image file must be a JPG, JPEG, or PNG.',
                'logo.max' => 'The image file size must not exceed 2MB.',
            ]);

            // Instantiate a new Certificate
            $certificate = new Certificate();
            $certificate->company_name = $validatedData['company_name'];
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                // $logoName = time() . '_' . $logo->getClientOriginalName();
                $logoName = $logo->getClientOriginalName();
                $logo->move(public_path('storage/certificates'), $logoName);
                $certificate->logo = $logoName;
            }

            // Save to database
            $certificate->save();

            return response()->json([
                'status' => 'success',
                'msg' => 'Company uploaded successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }
    }


    public static function delete(Request $request)
    {
        $id = $request->input('id');
       
       
        // Find and delete the term and condition
        $company = Certificate::find($id);
        if ($company) {
            $company->delete();
            // Return a success response with a message
            return ['status' => 'success', 'msg' => 'The company has been deleted successfully'];
        }

        // Return an error response if the term and condition is not found
        return ['status' => 'error', 'msg' => 'Item not found not found'];
    }

}

