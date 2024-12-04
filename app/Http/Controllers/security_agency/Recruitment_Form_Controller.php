<?php

namespace App\Http\Controllers\security_agency;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Recruitment_Form_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('security_agencies/recruitment_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'fname' => 'string|required',
                'sname' => 'string|required',
                'email' => 'email|required',
                'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            ]
        );
        
        $existing_user = User::where('email', $request->email)->first();

        if (!$existing_user) {
            $rec = new User(); //rec -> new recruit
            $rec->fname = $request->fname;
            $rec->sname = $request->sname;
            $rec->email = $request->email;
            $rec->password = Hash::make($request->password);
            $rec->save();
        } else {
            return back()->with('error', "You are already registered with this email. Please try again.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
