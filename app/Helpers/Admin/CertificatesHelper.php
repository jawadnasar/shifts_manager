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
            'logo' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ], [
            'logo.required' => 'Please upload a certificate/logo.',
            'logo.mimes' => 'The file must be a JPG, JPEG, or PNG.',
            'logo.max' => 'The file size must not exceed 2MB.',
        ]);

        // Instantiate a new Certificate
        $certificate = new Certificate();

        // Handle file upload
       

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName(); // Ensure unique filename
            $logoPath = $logo->storeAs('public/certificates', $logoName);
            $certificate->logo = $logoName; // Save the filename to the database
        }

        // Save to database
        $certificate->save();

        return response()->json([
            'status' => 'success',
            'msg' => 'Certificate/logo uploaded successfully!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'msg' => $e->getMessage(),
        ]);
    }
}

}

