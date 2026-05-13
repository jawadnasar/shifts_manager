<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Acctran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LedgersController extends Controller
{

    public function ledger(Request $request){
        $accounts = Account::where('is_active', true)->get();       // ACCOUNTS

        $ledgerData = $this->balance_and_ledger_calculator($request);

        return view('admin.ledgers.ledger', [
            'accounts' => $accounts,
            'opening_balance' => $ledgerData['opening_balance'],
            'account_ledger' => $ledgerData['account_ledger'],
            'dateFrom' => $request->date_from,
            'dateTo' => $request->date_to,
        ]);
    }

    /**
     * Balance and ledger
     */

     private function balance_and_ledger_calculator(Request $request){
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;

        $openingBalance = Acctran::whereRaw('DATE(date) < ?', [$request->date_from])
                    ->where('accountid', $request->account_id)
                    ->selectRaw('COALESCE(SUM(debit), 0) - COALESCE(SUM(credit), 0) as balance')
                    ->first()
                    ->balance;

        $accountLedger = Acctran::whereRaw("(date + INTERVAL 1 DAY)>'$dateFrom' AND (date - INTERVAL 1 DAY)<'$dateTo'")
                                ->where('accountid', $request->account_id)
                                ->orderBy('date')
                                ->get();
                        // dd($accountLedger);

        return [
            'opening_balance' => $openingBalance,
            'account_ledger' => $accountLedger
        ];
     }

    public function accounts_summary(Request $request)
    {
        $validated = $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        $dateFrom = !empty($validated['date_from'])
            ? Carbon::parse($validated['date_from'])->startOfDay()
            : now()->startOfMonth();
        $dateTo = !empty($validated['date_to'])
            ? Carbon::parse($validated['date_to'])->endOfDay()
            : now()->endOfDay();

        $windowFrom = $dateFrom->copy()->subDay()->toDateString();
        $windowTo = $dateTo->copy()->addDay()->toDateString();

        $ledgers = Account::query()
            ->select('accounts.accountid', 'accounts.name', 'accounts.company')
            ->selectRaw(
                'COALESCE((SELECT SUM(a.debit - a.credit) FROM acctran a WHERE a.accountid = accounts.accountid AND a.date < ?), 0) AS starting_balance',
                [$windowFrom]
            )
            ->selectRaw(
                'COALESCE((SELECT SUM(a.debit - a.credit) FROM acctran a WHERE a.accountid = accounts.accountid AND a.date <= ?), 0) AS end_balance',
                [$windowTo]
            )
            ->selectRaw(
                'COALESCE((SELECT SUM(a.debit - a.credit) FROM acctran a WHERE a.accountid = accounts.accountid AND a.date >= ? AND a.date <= ?), 0) AS actual_balance',
                [$windowFrom, $windowTo]
            )
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('acctran')
                    ->whereColumn('acctran.accountid', 'accounts.accountid');
            })
            ->orderBy('accounts.company')
            ->orderBy('accounts.name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.ledgers.accounts_summary', [
            'ledgers' => $ledgers,
            'dateFrom' => $dateFrom->toDateString(),
            'dateTo' => $dateTo->toDateString(),
        ]);
    }

    /** Employee shift pay from ledger (acctran account 42 — Paying User / SFT). */
    public function employee_salaries(Request $request)
    {
        $validated = $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        $dateFrom = !empty($validated['date_from'])
            ? Carbon::parse($validated['date_from'])->startOfDay()
            : now()->startOfMonth();
        $dateTo = !empty($validated['date_to'])
            ? Carbon::parse($validated['date_to'])->endOfDay()
            : now()->endOfDay();

        $dateFromStr = $dateFrom->toDateString();
        $dateToStr = $dateTo->toDateString();

        $salaryEmployeeAccountId = 42;

        $baseQuery = Acctran::query()
            ->where('accountid', $salaryEmployeeAccountId)
            ->where('vtype', 'SFT')
            ->where('details', 'Paying User')
            ->whereNotNull('user_id')
            ->whereBetween('date', [$dateFromStr, $dateToStr])
            ->when($validated['user_id'] ?? null, function ($q, $userId) {
                $q->where('user_id', $userId);
            });

        $grandTotal = (clone $baseQuery)->sum('debit');

        $lines = (clone $baseQuery)
            ->with('user')
            ->orderByDesc('date')
            ->orderByDesc('transid')
            ->paginate(50)
            ->withQueryString();

        $perEmployee = DB::table('acctran')
            ->join('users', 'users.id', '=', 'acctran.user_id')
            ->where('acctran.accountid', $salaryEmployeeAccountId)
            ->where('acctran.vtype', 'SFT')
            ->where('acctran.details', 'Paying User')
            ->whereNotNull('acctran.user_id')
            ->whereBetween('acctran.date', [$dateFromStr, $dateToStr])
            ->when($validated['user_id'] ?? null, function ($q, $userId) {
                $q->where('acctran.user_id', $userId);
            })
            ->selectRaw('users.id as user_id, users.name as employee_name, SUM(acctran.debit) as total_pay, COUNT(*) as shift_count')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_pay')
            ->get();

        $employees = User::query()
            ->whereIn('id', function ($q) use ($salaryEmployeeAccountId) {
                $q->select('user_id')
                    ->from('acctran')
                    ->where('accountid', $salaryEmployeeAccountId)
                    ->whereNotNull('user_id')
                    ->distinct();
            })
            ->orderBy('name')
            ->get();

        return view('admin.ledgers.employee_salaries', [
            'lines' => $lines,
            'perEmployee' => $perEmployee,
            'grandTotal' => $grandTotal,
            'dateFrom' => $dateFromStr,
            'dateTo' => $dateToStr,
            'employees' => $employees,
        ]);
    }
}
