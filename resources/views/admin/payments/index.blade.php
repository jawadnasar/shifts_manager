@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Payments</h5>
            @if (Auth::user()->pri_addpayment)
                <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-1"></i> New payment
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="bg-light rounded p-4 mb-3">
            <form method="GET" action="{{ route('admin.payments.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label" for="fromdate">From date</label>
                        <input type="date" name="fromdate" id="fromdate" class="form-control"
                            value="{{ request('fromdate') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="todate">To date</label>
                        <input type="date" name="todate" id="todate" class="form-control" value="{{ request('todate') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="payment_transid">Trans ID</label>
                        <input type="text" name="payment_transid" id="payment_transid" class="form-control"
                            value="{{ request('payment_transid') }}" placeholder="Exact ID">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="debit_account">Debit account</label>
                        <select name="debit_account" id="debit_account" class="form-select">
                            <option value="">Any</option>
                            @foreach ($accounts as $a)
                                <option value="{{ $a->accountid }}"
                                    {{ (string) request('debit_account') === (string) $a->accountid ? 'selected' : '' }}>
                                    {{ $a->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="credit_account">Credit account</label>
                        <select name="credit_account" id="credit_account" class="form-select">
                            <option value="">Any</option>
                            @foreach ($accounts as $a)
                                <option value="{{ $a->accountid }}"
                                    {{ (string) request('credit_account') === (string) $a->accountid ? 'selected' : '' }}>
                                    {{ $a->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-light rounded p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Trans ID</th>
                            <th>Date</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>User</th>
                            <th class="text-end">Amount</th>
                            <th>Details</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $row)
                            <tr>
                                <td>{{ $row->transid }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->date)->format('Y-m-d') }}</td>
                                <td>{{ $row->debit_account ?? $row->debitAccount?->name ?? '—' }}</td>
                                <td>{{ $row->credit_account ?? $row->creditAccount?->name ?? '—' }}</td>
                                <td>{{ $row->user?->name ?? '—' }}</td>
                                <td class="text-end">{{ number_format((float) $row->amount, 2) }}</td>
                                <td class="text-truncate" style="max-width: 12rem;">{{ $row->details }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('admin.payments.show', $row->transid) }}"
                                        class="btn btn-sm btn-outline-secondary">View</a>
                                    @if (Auth::user()->pri_editpayment && $row->canEdit())
                                        <a href="{{ route('admin.payments.edit', $row) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                    @endif
                                    @if (Auth::user()->pri_editpayment && $row->canDelete())
                                        <form action="{{ route('admin.payments.destroy', $row) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Delete this payment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No payments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
