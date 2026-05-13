<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptsController extends Controller
{
    /**
     * Incoming money / receipts issued (mirrors payments list filters).
     */
    public function index(Request $request)
    {
        $fromdate = $request->fromdate;
        $todate = $request->todate;
        $transid = $request->receipt_transid;
        $debit_ac = $request->debit_account;
        $credit_ac = $request->credit_account;

        if ($transid) {
            $data = Receipt::query()
                ->where('transid', $transid)
                ->with(['user', 'debitAccount', 'creditAccount'])
                ->paginate(5);
        } else {
            $query = Receipt::query()
                ->select('receipts.*')
                ->selectRaw('(SELECT name FROM accounts WHERE accountid = receipts.creditac) AS credit_account')
                ->selectRaw('(SELECT name FROM accounts WHERE accountid = receipts.debitac) AS debit_account')
                ->when($fromdate, function ($q) use ($fromdate) {
                    $q->whereRaw('DATE(`date` + INTERVAL 1 DAY) > ?', [$fromdate]);
                })
                ->when($todate, function ($q) use ($todate) {
                    $q->whereRaw('DATE(`date` - INTERVAL 1 DAY) < ?', [$todate]);
                })
                ->when($credit_ac, function ($q) use ($credit_ac) {
                    $q->where('creditac', $credit_ac);
                })
                ->when($debit_ac, function ($q) use ($debit_ac) {
                    $q->where('debitac', $debit_ac);
                })
                ->with(['user']);

            $data = $query->orderByDesc('updated_at')->paginate(10);
        }

        $accounts = Account::query()->select('accountid', 'name')->orderBy('name')->get();

        return view('admin.receipts.index', compact('accounts', 'data'));
    }

    public function create()
    {
        if (!Auth::user()->pri_addreceipt) {
            abort(403);
        }

        return view('admin.receipts.form', [
            'title' => 'New receipt',
            'page_type' => 'create',
            'accounts' => Account::query()->select('accountid', 'name')->orderBy('name')->get(),
            'users' => User::query()->orderBy('name')->get(),
            'receipt' => null,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::user()->pri_addreceipt) {
            abort(403);
        }

        $validated = $request->validate([
            'rcpt_date' => ['required', 'date'],
            'cdt_accountid' => ['required', 'numeric'],
            'dbt_accountid' => ['required', 'numeric'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'details' => ['required', 'string', 'max:65535'],
        ]);

        $receipt = new Receipt;
        $receipt->date = $validated['rcpt_date'];
        $receipt->debitac = $validated['dbt_accountid'];
        $receipt->creditac = $validated['cdt_accountid'];
        $receipt->amount = $validated['deposit_amount'];
        $receipt->user_id = $validated['user_id'] ?? null;
        $receipt->details = $validated['details'];
        $receipt->created_by = Auth::id();
        $receipt->save();

        return redirect()->route('admin.receipts.index')->with('success', 'Receipt created.');
    }

    public function show(Receipt $receipt)
    {
        $receipt->load(['user', 'debitAccount', 'creditAccount', 'createdByUser', 'updatedByUser']);

        return view('admin.receipts.show', compact('receipt'));
    }

    public function edit(Receipt $receipt)
    {
        if (!Auth::user()->pri_editreceipt) {
            abort(403);
        }

        if (!$receipt->canEdit()) {
            return redirect()
                ->route('admin.receipts.index')
                ->with('error', 'This receipt is older than one week and can no longer be edited.');
        }

        return view('admin.receipts.form', [
            'title' => 'Edit receipt',
            'page_type' => 'edit',
            'accounts' => Account::query()->select('accountid', 'name')->orderBy('name')->get(),
            'users' => User::query()->orderBy('name')->get(),
            'receipt' => $receipt,
        ]);
    }

    public function update(Request $request, Receipt $receipt)
    {
        if (!Auth::user()->pri_editreceipt) {
            abort(403);
        }

        if (!$receipt->canEdit()) {
            return redirect()
                ->route('admin.receipts.index')
                ->with('error', 'This receipt is older than one week and can no longer be edited.');
        }

        $validated = $request->validate([
            'rcpt_date' => ['required', 'date'],
            'cdt_accountid' => ['required', 'numeric'],
            'dbt_accountid' => ['required', 'numeric'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'details' => ['required', 'string', 'max:65535'],
        ]);

        $receipt->date = $validated['rcpt_date'];
        $receipt->debitac = $validated['dbt_accountid'];
        $receipt->creditac = $validated['cdt_accountid'];
        $receipt->amount = $validated['deposit_amount'];
        $receipt->user_id = $validated['user_id'] ?? null;
        $receipt->details = $validated['details'];
        $receipt->updated_by = Auth::id();
        $receipt->save();

        return redirect()->route('admin.receipts.index')->with('success', 'Receipt updated successfully.');
    }

    public function destroy(Receipt $receipt)
    {
        if (!Auth::user()->pri_editreceipt) {
            abort(403);
        }

        if (!$receipt->canDelete()) {
            return redirect()
                ->route('admin.receipts.index')
                ->with('error', 'This receipt is older than two days and can no longer be deleted.');
        }

        $receipt->delete();

        return redirect()->route('admin.receipts.index')->with('success', 'Receipt deleted.');
    }
}
