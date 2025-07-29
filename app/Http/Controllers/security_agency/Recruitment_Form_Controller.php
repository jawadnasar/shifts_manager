<?php
namespace App\Http\Controllers\security_agency;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Models\User_Details;
use App\Models\User_Documents;
use App\Models\User_Employment_History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\ImageOptimizer\OptimizerChainFactory;

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
        $countries = Country::all();
        return view('security_agencies/recruitment_form')->with(compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'user_fname'                          => 'string|required',
                'user_sname'                          => 'string|required',
                'user_email'                          => 'email|required',
                'user_dob'                            => 'required|date|before_or_equal:' . now()->subYears(18)->toDateString(),
                'is_disabled'                         => 'boolean|required',
                'disabilities'                        => 'string|nullable',
                'user_password'                       => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
                'user_gender'                         => 'string|required',
                'user_phone'                          => 'string|required',
                'user_birth_place'                    => 'string|required',
                'user_phone'                          => 'string|required',
                'user_nationality'                    => 'string|required',
                'user_current_address'                => 'string|required',
                'user_postcode'                       => 'string|required',
                // 'user_living_since' => 'required|date|before_or_equal:today',
                'user_ni_number'                      => 'string|required',
                'user_emergency_contact_name'         => 'string|required',
                'user_emergency_contact_relationship' => 'string|required',
                'user_emergency_contact_phone'        => 'string|required',
                'user_sia_licence_type'               => 'string|required',
                'user_sia_licence_number'             => 'string|required',
                'user_sia_licence_expiry_date'        => 'string|required',
                'user_doc_type.*'                     => 'required|string|max:255',
                'user_file_link.*'                    => 'required|image|mimes:jpg,jpeg,png,gif|max:5000',
                /** User Employment History */
                'emp_from_date.*'                     => 'required|date|before_or_equal:today',
                'emp_to_date.*'                       => 'required|date',
                'emp_company_name.*'                  => 'required|string|max:255',
                'emp_job_title.*'                     => 'required|string|max:255',
                'emp_job_description.*'               => 'required|string|max:255',
                /** Bank Details */
                'bank_name'                           => 'string|required',
                'bank_address'                        => 'string|required',
                'account_holder_name'                 => 'string|required',
                'sort_code'                           => 'string|required',
                'account_number'                      => 'string|required',
            ], [
                'user_file_link.*.required' => 'Please upload the document image.',
                'user_file_link.*.image'    => 'Each uploaded file must be an image.',
                'user_file_link.*.mimes'    => 'Allowed file types are jpg, jpeg, png, and gif.',
                'user_file_link.*.max'      => 'Each image must not exceed 5MB.',
                'user_dob.before_or_equal' => 'You must be at least 18 years old to apply.',
            ], // custom messages, leave empty if none
            [
                'user_file_link.*' => 'Document Images', // <-- This is the friendly name shown in errors
            ]
        );

        $existing_user = User::where('email', $request->user_email)->first();

        if (! $existing_user) {
            $rec            = new User(); //rec -> new recruit
            $rec->fname     = $request->user_fname;
            $rec->sname     = $request->user_sname;
            $rec->email     = $request->user_email;
            $rec->user_type = 'employee';
            $rec->password  = Hash::make($request->user_password);
            $rec->ip_address = $request->ip();
            $rec->save();

            $det               = new User_Details(); // det -> details
            $det->user_id      = $rec->id;
            $det->dob          = $request->user_dob;
            $det->is_disabled  = $request->is_disabled;
            $det->disabilities = $request->disabilities;

            $det->gender          = $request->user_gender;
            $det->phone           = $request->user_phone;
            $det->birth_place     = $request->user_birth_place;
            $det->nationality     = $request->user_nationality;
            $det->current_address = $request->user_current_address;
            $det->city            = $request->user_city;
            $det->postcode        = $request->user_postcode;
            $det->living_since    = $request->user_living_since;
            $det->ni_number       = $request->user_ni_number;

            $det->emergency_contact_name         = $request->user_emergency_contact_name;
            $det->emergency_contact_relationship = $request->user_emergency_contact_relationship;
            $det->emergency_contact_phone        = $request->user_emergency_contact_phone;

            $det->sia_licence_type        = $request->user_sia_licence_type;
            $det->sia_licence_number      = $request->user_sia_licence_number;
            $det->sia_licence_expiry_date = $request->user_sia_licence_expiry_date;

            $det->driving_licence_present = $request->user_driving_licence_present;
            $det->driving_licence_type    = $request->user_driving_licence_type;
            $det->driving_licence_number  = $request->user_driving_licence_number;

            $det->own_vehicle = $request->user_own_vehicle;

            $det->criminal_offence_present = $request->user_criminal_offence_present;
            $det->criminal_offence_details = $request->user_criminal_offence_details;

            $det->share_code = $request->user_share_code;

            // Add bank details
            $det->bank_name           = $request->bank_name;
            $det->bank_address        = $request->bank_address;
            $det->account_holder_name = $request->account_holder_name;
            $det->sort_code           = $request->sort_code;
            $det->account_number      = $request->account_number;

            $det->created_by = $rec->id;

            $det->save();

            // Store employment history
            foreach ($request->emp_from_date as $i => $eHistory) {
                $ueh                  = new User_Employment_History();
                $ueh->user_id         = $rec->id;
                $ueh->from_date       = $request->emp_from_date[$i];
                $ueh->to_date         = $request->emp_to_date[$i];
                $ueh->company_name    = $request->company_name[$i];
                $ueh->company_address = $request->company_address[$i];
                $ueh->company_phone   = $request->company_phone[$i];
                $ueh->position_held   = $request->position_held[$i];
                $ueh->employer_name   = $request->employer_name[$i];
                $ueh->company_email   = $request->company_email[$i];
                $ueh->created_by      = $rec->id;
                $ueh->save();
            }

            // Store documents
            if ($request->hasFile('user_file_link')) {
                foreach ($request->file('user_file_link') as $index => $document) {
                    $documentName = time() . '_' . $document->getClientOriginalName();
                    $documentPath = $document->storeAs('documents', $documentName, 'public');

                    $fullPath = storage_path("app/public/{$documentPath}");

                    // Compress if file is over 1MB
                    if (filesize($fullPath) > 1048576) {
                        $optimizerChain = OptimizerChainFactory::create([
                            // fine-tuned flags for smaller output
                            'jpegoptim' => [
                                '--strip-all',
                                '--all-progressive',
                                '--max=70', // reduce quality to approx. target 1MB
                            ],
                            'optipng'   => ['-o7'],
                            'pngquant'  => ['--quality=60-80'],
                            'gifsicle'  => ['-O3'],
                            'svgo'      => ['--disable=cleanupIDs'],
                        ]);

                        $optimizerChain->optimize($fullPath);
                    }

                    $doc             = new User_Documents();
                    $doc->user_id    = $rec->id;
                    $doc->doc_type   = $request->input('user_doc_type')[$index];
                    $doc->status     = 1;
                    $doc->details    = $request->input('user_doc_details')[$index];
                    $doc->link       = $documentPath;
                    $doc->created_by = $rec->id;
                    $doc->save();
                }
            }
            // return redirect()->route('security_agency_recruitment_form.show', $rec->id);
            return response()->json(['redirect_url' => route('security_agency_recruitment_form.show', $rec->id)]);

        } else {
            return response()->json(['errors' => ['You are already registered with this email. Please try again.']], 422);
            // return back()->withInput()->with('error', "You are already registered with this email. Please try again.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //
        $user = User::where('id', $id)->get();
        // dd($user);

        // dd('authorization going on');
        // if(auth()->user()->id){
        //     return redirect()->route('security_agency_recruitment_form.show', auth()->user()->id);
        // }
        // $recruit = User::find($id);
        // $recruit_details = User_Details::where('user_id', $id)->first();
        // return view('security_agencies/recruited_user_dashboard')->with(compact('recruit', 'recruit_details'));

        return redirect()->route('confirm');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // $user = User::where('id', $id)->get();
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

    public function confirm()
    {
        return view('security_agencies/thankyou');
    }
}
