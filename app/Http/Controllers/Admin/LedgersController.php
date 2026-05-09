<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Acctran;
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
}
