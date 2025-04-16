<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
