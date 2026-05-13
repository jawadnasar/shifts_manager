<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    /**
     * List payments with optional filters (matches legacy date window behaviour).
     */
    public function index(Request $request)
    {
        $fromdate = $request->fromdate;
        $todate = $request->todate;
        $transid = $request->payment_transid;
        $debit_ac = $request->debit_account;
        $credit_ac = $request->credit_account;

        if ($transid) {
            $data = Payment::query()
                ->where('transid', $transid)
                ->with(['user', 'debitAccount', 'creditAccount'])
                ->paginate(5);
        } else {
            $query = Payment::query()
                ->select('payments.*')
                ->selectRaw('(SELECT name FROM accounts WHERE accountid = payments.creditac) AS credit_account')
                ->selectRaw('(SELECT name FROM accounts WHERE accountid = payments.debitac) AS debit_account')
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

        return view('admin.payments.index', compact('accounts', 'data'));
    }

    public function create()
    {
        if (!Auth::user()->pri_addpayment) {
            abort(403);
        }

        $title = 'New Payment';
        $page_type = 'create';
        $accounts = Account::query()->select('accountid', 'name')->orderBy('name')->get();
        $users = User::query()->orderBy('name')->get();

        return view('admin.payments.form', [
            'title' => $title,
            'page_type' => $page_type,
            'accounts' => $accounts,
            'users' => $users,
            'payment' => null,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::user()->pri_addpayment) {
            abort(403);
        }

        $validated = $request->validate([
            'pmt_date' => ['required', 'date'],
            'cdt_accountid' => ['required', 'numeric'],
            'dbt_accountid' => ['required', 'numeric'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'cheque_no' => ['nullable', 'string', 'max:30'],
            'cheque_date' => ['nullable', 'date'],
            'details' => ['required', 'string', 'max:65535'],
        ]);

        $payment = new Payment;
        $payment->date = $validated['pmt_date'];
        $payment->debitac = $validated['dbt_accountid'];
        $payment->creditac = $validated['cdt_accountid'];
        $payment->amount = $validated['deposit_amount'];
        $payment->user_id = $validated['user_id'] ?? null;
        $payment->details = $validated['details'];
        $payment->cheque_no = $validated['cheque_no'] ?? null;
        $payment->cheque_date = $validated['cheque_date'] ?? null;
        $payment->created_by = Auth::id();
        $payment->save();

        return redirect()->route('admin.payments.index')->with('success', 'Payment created.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['user', 'debitAccount', 'creditAccount', 'createdByUser', 'updatedByUser']);

        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        if (!Auth::user()->pri_editpayment) {
            abort(403);
        }

        if (!$payment->canEdit()) {
            return redirect()
                ->route('admin.payments.index')
                ->with('error', 'This payment is older than one week and can no longer be edited.');
        }

        $title = 'Edit Payment';
        $page_type = 'edit';
        $accounts = Account::query()->select('accountid', 'name')->orderBy('name')->get();
        $users = User::query()->orderBy('name')->get();

        return view('admin.payments.form', compact('title', 'page_type', 'accounts', 'users', 'payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        if (!Auth::user()->pri_editpayment) {
            abort(403);
        }

        if (!$payment->canEdit()) {
            return redirect()
                ->route('admin.payments.index')
                ->with('error', 'This payment is older than one week and can no longer be edited.');
        }

        $validated = $request->validate([
            'pmt_date' => ['required', 'date'],
            'cdt_accountid' => ['required', 'numeric'],
            'dbt_accountid' => ['required', 'numeric'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'cheque_no' => ['nullable', 'string', 'max:30'],
            'cheque_date' => ['nullable', 'date'],
            'details' => ['required', 'string', 'max:65535'],
        ]);

        $payment->date = $validated['pmt_date'];
        $payment->debitac = $validated['dbt_accountid'];
        $payment->creditac = $validated['cdt_accountid'];
        $payment->amount = $validated['deposit_amount'];
        $payment->user_id = $validated['user_id'] ?? null;
        $payment->details = $validated['details'];
        $payment->cheque_no = $validated['cheque_no'] ?? null;
        $payment->cheque_date = $validated['cheque_date'] ?? null;
        $payment->updated_by = Auth::id();
        $payment->save();

        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        if (!Auth::user()->pri_editpayment) {
            abort(403);
        }

        if (!$payment->canDelete()) {
            return redirect()
                ->route('admin.payments.index')
                ->with('error', 'This payment is older than two days and can no longer be deleted.');
        }

        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted.');
    }
}
