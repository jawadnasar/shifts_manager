<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_Privileges_Controller extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        if (Auth::user()->pri_setprivileges) {
            $user = User::find($id);
            return view('admin.user_privileges', compact('user'));
        } else {
            return abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->pri_setprivileges) {
            $user = User::find($id);
            $user->pri_setprivileges = $request->has('pri_setprivileges');
            $user->pri_addreceipt = $request->has('pri_addreceipt');
            $user->pri_editreceipt = $request->has('pri_editreceipt');
            $user->pri_addjournal = $request->has('pri_addjournal');
            $user->pri_editjournal = $request->has('pri_editjournal');
            $user->pri_addpayment = $request->has('pri_addpayment');
            $user->pri_editpayment = $request->has('pri_editpayment');
            $user->pri_addexpenses = $request->has('pri_addexpenses');
            $user->pri_editexpenses = $request->has('pri_editexpenses');
            $user->pri_adduser = $request->has('pri_adduser');

            $user->save();
            if ($user->wasChanged()) {
                return redirect()->route('admin.user_privileges.edit', $id)->with('success', 'User privileges updated successfully');
            } else {
                return redirect()->route('admin.user_privileges.edit', $id)->with('info', 'No changes were made');
            }
        } else {
            return abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
