<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_Details;
use App\Models\User_Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class Users_Info_Controller extends Controller
{

    /**
     * This class will handle all the infomation regarding users
     */

    // Show the users page where we can search for users and their info
    public function index(Request $request)
    {
        $users_data = $this->get_users($request);
        return View('admin.users_info')->with(compact('users_data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'sname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'user_type' => 'required|in:admin,compliance,employee',
            'dob' => 'required|date',
            'gender' => 'required|in:M,F,O',
            'phone' => 'required|string|max:20',
            'city' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'sia_licence_type' => 'nullable|string|max:255',
            'sia_licence_number' => 'nullable|string|max:255',
            'sia_licence_expiry_date' => 'nullable|date',
            'user_doc_type.*' => 'nullable|string|max:255',
            'user_file_link.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
            'user_doc_details.*' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'fname' => $request->fname,
                'sname' => $request->sname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type,
                'ip_address' => $request->ip(),
            ]);

            $details = new User_Details();
            $details->user_id = $user->id;
            $details->dob = $request->dob;
            $details->gender = $request->gender;
            $details->phone = $request->phone;
            $details->city = $request->city;
            $details->postcode = $request->postcode;
            $details->sia_licence_type = $request->sia_licence_type;
            $details->sia_licence_number = $request->sia_licence_number;
            $details->sia_licence_expiry_date = $request->sia_licence_expiry_date;
            $details->created_by = Auth::id();
            $details->save();

            if ($request->hasFile('user_file_link')) {
                foreach ($request->file('user_file_link') as $index => $document) {
                    if (! $document) {
                        continue;
                    }

                    $documentName = time() . '_' . $document->getClientOriginalName();
                    $documentPath = $document->storeAs('documents', $documentName, 'public');
                    $fullPath = storage_path("app/public/{$documentPath}");

                    if (filesize($fullPath) > 1048576) {
                        $optimizerChain = OptimizerChainFactory::create([
                            'jpegoptim' => ['--strip-all', '--all-progressive', '--max=70'],
                            'optipng' => ['-o7'],
                            'pngquant' => ['--quality=60-80'],
                            'gifsicle' => ['-O3'],
                            'svgo' => ['--disable=cleanupIDs'],
                        ]);
                        $optimizerChain->optimize($fullPath);
                    }

                    $doc = new User_Documents();
                    $doc->user_id = $user->id;
                    $doc->doc_type = $request->input('user_doc_type')[$index] ?? 'other';
                    $doc->status = 1;
                    $doc->details = $request->input('user_doc_details')[$index] ?? '';
                    $doc->link = $documentPath;
                    $doc->created_by = Auth::id();
                    $doc->save();
                }
            }
        });

        return redirect()->route('users_info')
            ->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        $details = $user->relate_user_details;
        $documents = $user->relate_user_documents->where('status', 1);
        $employment_history = $user->relate_user_employment_history()->orderBy('from_date', 'desc')->get();
        return View('admin.users_info_show')->with(compact('user', 'details', 'documents', 'employment_history'));
    }

    private function get_users($request)
    {
        $query = User::with('relate_user_details');

        if ($request->filled('user_full_name')) {
            $query->whereRaw("CONCAT(fname, ' ', sname) LIKE ?", ['%' . $request->user_full_name . '%']);
        }

        if ($request->filled('user_email')) {
            $query->where('email', $request->user_email);
        }

        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }

        if ($request->filled('user_postcode')) {
            $query->whereHas('relate_user_details', function ($q) use ($request) {
                $q->where('postcode', $request->user_postcode);
            });
        }

        if ($request->filled('user_gender')) {
            $query->whereHas('relate_user_details', function ($q) use ($request) {
                $q->where('gender', $request->user_gender);
            });
        }

        $data = $query->paginate(10);
        return $data;
    }
}
