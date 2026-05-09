@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid pt-4 px-4">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Ledger</h5>
        </div>

        {{-- Filters --}}
        <div class="bg-light rounded p-4 mb-3">
            <form method="GET" action="{{ route('admin.ledgers.ledger') }}">
                <div class="row g-3 align-items-end">

                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Date From</label>
                        <input type="date" name="date_from" id="date_from" class="form-control"
                            value="{{ request('date_from', $dateFrom) }}">
                    </div>

                    <div class="col-md-3">
                        <label for="date_to" class="form-label">Date To</label>
                        <input type="date" name="date_to" id="date_to" class="form-control"
                            value="{{ request('date_to', $dateTo) }}">
                    </div>

                    <div class="col-md-4">
                        <label for="account_id" class="form-label">Account</label>

                        <select name="account_id" id="account_id" class="form-select">
                            <option value="">All Accounts</option>

                            @foreach ($accounts as $account)
                                <option value="{{ $account->accountid }}"
                                    {{ (string) request('account_id') === (string) $account->accountid ? 'selected' : '' }}>
                                    {{ $account->company ?: $account->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            Apply Filters
                        </button>

                        <a href="{{ route('admin.ledgers.ledger') }}" class="btn btn-outline-secondary">
                            Clear
                        </a>
                    </div>

                </div>
            </form>
        </div>

        {{-- Ledger Table --}}
        <div class="bg-light rounded p-4">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>Trans ID</th>
                            <th>Date</th>
                            <th>VType</th>
                            <th>Details</th>
                            <th class="text-end">Debit</th>
                            <th class="text-end">Credit</th>
                            <th class="text-end">Balance</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php
                            $runningBalance = $opening_balance;
                        @endphp

                        {{-- Opening Balance --}}
                        <tr class="{{ $opening_balance < 0 ? 'table-danger' : '' }}">

                            <td colspan="4" class="text-center">
                                <strong>Opening Balance</strong>
                            </td>

                            <td class="text-end">
                                {{ $opening_balance > 0 ? number_format($opening_balance, 2) : '' }}
                            </td>

                            <td class="text-end">
                                {{ $opening_balance < 0 ? number_format(abs($opening_balance), 2) : '' }}
                            </td>

                            <td class="text-end fw-bold {{ $opening_balance < 0 ? 'text-danger' : 'text-success' }}">
                                {{ number_format($opening_balance, 2) }}
                            </td>

                        </tr>

                        {{-- Ledger Entries --}}
                        @foreach ($account_ledger as $ledger)
                            @php
                                $runningBalance = $runningBalance + $ledger->debit - $ledger->credit;
                            @endphp

                            <tr class="{{ $runningBalance < 0 ? 'table-warning' : '' }}">

                                <td>{{ $ledger->transid }}</td>

                                <td>{{ \Carbon\Carbon::parse($ledger->date)->format('d/m/Y') }}</td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $ledger->vtype }}
                                    </span>
                                </td>

                                <td>{{ $ledger->details }}</td>

                                {{-- Debit --}}
                                <td class="text-end">
                                    {{ is_numeric($ledger->debit) && $ledger->debit != 0 ? number_format($ledger->debit, 2) : '' }}
                                </td>

                                {{-- Credit --}}
                                <td class="text-end">
                                    {{ is_numeric($ledger->credit) && $ledger->credit != 0 ? number_format($ledger->credit, 2) : '' }}
                                </td>

                                {{-- Running Balance --}}
                                <td class="text-end fw-bold {{ $runningBalance < 0 ? 'text-danger' : 'text-success' }}">

                                    @if ($runningBalance < 0)
                                        <span class="badge bg-danger">
                                            {{ number_format($runningBalance, 2) }}
                                        </span>
                                    @else
                                        {{ number_format($runningBalance, 2) }}
                                    @endif

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
```
