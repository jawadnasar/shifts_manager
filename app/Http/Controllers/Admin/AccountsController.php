<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\GLcode;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::with('account_glcode')->paginate(20);
        $glcodes = GLcode::orderBy('actype')->get();

        return view('admin.accounts.index', compact('accounts', 'glcodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('admin.accounts.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'actype' => 'required|integer|exists:glcodes,actype',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'details' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active') ? (bool) $request->input('is_active') : true;
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        Account::create($data);

        return redirect()->route('admin.accounts.index')
            ->with('success', 'Account created successfully.');
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
        $account = Account::findOrFail($id);

        if (request()->ajax()) {
            return response()->json($account);
        }

        $glcodes = GLcode::orderBy('actype')->get();

        return view('admin.accounts.edit', compact('account', 'glcodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = Account::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:accounts,name,' . $id . ',accountid',
            'actype' => 'required|integer|exists:glcodes,actype',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'details' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active') ? (bool) $request->input('is_active') : $account->is_active;
        $data['updated_by'] = auth()->id();

        $account->update($data);

        return redirect()->route('admin.accounts.index')
            ->with('success', 'Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
