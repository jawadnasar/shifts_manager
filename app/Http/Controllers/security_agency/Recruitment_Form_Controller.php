<?php

namespace App\Http\Controllers\security_agency;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_Details;
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
                'user_dob' => 'required|date|before_or_equal:today',
                'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
                'user_gender' => 'string|required',
                'user_phone' => 'string|required',
                'user_birth_place' => 'string|required',
                'user_phone' => 'string|required',
                'user_nationality' => 'string|required',
                'user_current_address' => 'string|required',
                'user_postcode' => 'string|required',
                'user_living_since' => 'required|date|before_or_equal:today',
                'user_ni_number' => 'string|required',
                'user_emergency_contact_name' => 'string|required',
                'user_emgergency_contact_relationship' => 'string|required',
                'user_emgergency_contact_phone' => 'string|required',
                'user_sia_licence_type' => 'string|required',
                'user_sia_licence_number' => 'string|required',
                'user_sia_licence_expiry_date' => 'string|required',
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

            $det = new User_Details();          // det -> details 
            $det->user_id = $rec->id;
            $det->dob = $request->user_dob;
            $det->gender = $request->user_gender;
            $det->phone = $request->user_phone;
            $det->birth_place = $request->user_birth_place;
            $det->nationality = $request->user_nationality;
            $det->current_address = $request->user_current_address;
            $det->town = $request->user_town;
            $det->postcode = $request->user_postcode;
            $det->living_since = $request->user_living_since;
            $det->ni_number = $request->user_ni_number;

            $det->emergency_contact_name = $request->user_emergency_contact_name;
            $det->emergency_contact_relationship = $request->user_emergency_contact_relationship;
            $det->emergency_contact_phone = $request->user_emergency_contact_phone;

            $det->sia_licence_type = $request->user_sia_licence_type;
            $det->sia_licence_number = $request->user_sia_licence_number;
            $det->sia_licence_expiry_date = $request->user_sia_licence_expiry_date;

            $det->driving_licence_present = $request->user_driving_licence_present;
            $det->driving_licence_type = $request->user_driving_licence_type;
            $det->driving_licence_number = $request->user_driving_licence_number;

            $det->own_vehicle = $request->user_own_vehicle;

            $det->criminal_offence_present = $request->user_criminal_offence_present;
            $det->criminal_offence_details = $request->user_criminal_offence_details;

            $det->share_code = $request->user_share_code;

            $det->save();
            return redirect()->route('agency_recruitment_form.show', $rec->id);

        } else {
            return back()->with('error', "You are already registered with this email. Please try again.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo 'stored';
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
