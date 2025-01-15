<?php

namespace App\Helpers\Admin;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EmailTemplateHelper {

    public static function index(){
        $templates  = EmailTemplate::all();
        return view('admin.email_templates', compact('templates'));
    }

    public static function save(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'template_name' => 'required|max:255|string|unique:email_templates,template_name',
                'subject_line' => 'required|string|max:255',
                'body' => 'required|string',
                'footer' => 'required|string',
                'image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            ], [
                'template_name.required' => 'Please enter a template name.',
                'template_name.unique' => 'This template name already exists. Please choose another.',
                'subject_line.required' => 'Please enter a subject line.',
                'body.required' => 'Please enter the email body.',
                'footer.required' => 'Please enter the email footer.',
                'image.required' => 'Please upload an image.',
                'image.mimes' => 'The image must be a file of type: jpg, jpeg, png.',
                'image.max' => 'The image size must not exceed 2MB.',
            ]);

            // Create a new EmailTemplate
            $template = new EmailTemplate();
            $template->template_name = $validatedData['template_name'];
            $template->subject_line = $validatedData['subject_line'];
            $template->body = $validatedData['body'];
            $template->footer = $validatedData['footer'];

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage/email_templates'), $imageName);
                $template->image = $imageName;
            }

            // Save to database
            $template->save();

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

    public static function edit(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'template_id' => 'required|exists:email_templates,id',
                'template_name' => 'required|max:255|string|unique:email_templates,template_name,' . $request->template_id,
                'subject_line' => 'required|string|max:255',
                'body' => 'required|string',
                'footer' => 'required|string',
                'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Make 'image' nullable
            ], [
                'template_name.required' => 'Please enter a template name.',
                'template_name.unique' => 'This template name already exists. Please choose another.',
                'subject_line.required' => 'Please enter a subject line.',
                'body.required' => 'Please enter the email body.',
                'footer.required' => 'Please enter the email footer.',
                'image.mimes' => 'The image must be a file of type: jpg, jpeg, png.',
                'image.max' => 'The image size must not exceed 2MB.',
            ]);

            // Find the existing template
            $template = EmailTemplate::findOrFail($validatedData['template_id']);
            $template->template_name = $validatedData['template_name'];
            $template->subject_line = $validatedData['subject_line'];
            $template->body = $validatedData['body'];
            $template->footer = $validatedData['footer'];

            // Check if a new image is uploaded
            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($template->image && file_exists(public_path('storage/email_templates/' . $template->image))) {
                    unlink(public_path('storage/email_templates/' . $template->image));
                }

                // Upload new image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage/email_templates'), $imageName);
                $template->image = $imageName;
            } else {
                // Use the existing image filename from the hidden input
                if ($request->has('existing_image') && $request->existing_image) {
                    $template->image = $request->existing_image;
                }
            }

            // Save the updated template
            $template->save();

            return response()->json([
                'status' => 'success',
                'msg' => 'Template updated successfully!',
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
        $template = EmailTemplate::find($id);
        if ($template) {
            $template->delete();
            // Return a success response with a message
            return ['status' => 'success', 'msg' => 'The email template has been deleted successfully'];
        }

        // Return an error response if the term and condition is not found
        return ['status' => 'error', 'msg' => 'Template not found not found'];
    }

    




}

