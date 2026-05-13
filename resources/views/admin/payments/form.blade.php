@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">{{ $title }}</h5>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary">Back to list</a>
        </div>

        <div class="bg-light rounded p-4" style="max-width: 48rem;">
            <form method="POST"
                action="{{ $page_type === 'edit' ? route('admin.payments.update', $payment->transid) : route('admin.payments.store') }}">
                @csrf
                @if ($page_type === 'edit')
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="pmt_date" class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="pmt_date" id="pmt_date" class="form-control @error('pmt_date') is-invalid @enderror"
                        value="{{ old('pmt_date', $payment?->date?->format('Y-m-d') ?? now()->toDateString()) }}"
                        required>
                    @error('pmt_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dbt_accountid" class="form-label">Debit account <span class="text-danger">*</span></label>
                    <select name="dbt_accountid" id="dbt_accountid" class="form-select @error('dbt_accountid') is-invalid @enderror"
                        required>
                        <option value="" selected disabled>Select Debit Account</option>
                        @foreach ($accounts as $a)
                            <option value="{{ $a->accountid }}"
                                {{ (string) old('dbt_accountid', $payment?->debitac) === (string) $a->accountid ? 'selected' : '' }}>
                                {{ $a->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('dbt_accountid')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cdt_accountid" class="form-label">Credit account <span class="text-danger">*</span></label>
                    <select name="cdt_accountid" id="cdt_accountid" class="form-select @error('cdt_accountid') is-invalid @enderror"
                        required>
                        <option value="">Select</option>
                        @foreach ($accounts as $a)
                            <option value="{{ $a->accountid }}"
                                {{ (string) old('cdt_accountid', $payment?->creditac) === (string) $a->accountid ? 'selected' : '' }}>
                                {{ $a->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('cdt_accountid')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="user_id" class="form-label">User (If Salary (Select one))</label>
                    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                        <option value="">— None —</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}"
                                {{ (string) old('user_id', $payment?->user_id) === (string) $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deposit_amount" class="form-label">Amount <span class="text-danger">*</span></label>
                    <input type="number" step="0.0001" min="0" name="deposit_amount" id="deposit_amount"
                        class="form-control @error('deposit_amount') is-invalid @enderror"
                        value="{{ old('deposit_amount', $payment?->amount) }}" required>
                    @error('deposit_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="cheque_no" class="form-label">Cheque no.</label>
                    <input type="text" name="cheque_no" id="cheque_no" maxlength="30"
                        class="form-control @error('cheque_no') is-invalid @enderror"
                        value="{{ old('cheque_no', $payment?->cheque_no) }}">
                    @error('cheque_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cheque_date" class="form-label">Cheque date</label>
                    <input type="date" name="cheque_date" id="cheque_date"
                        class="form-control @error('cheque_date') is-invalid @enderror"
                        value="{{ old('cheque_date', $payment?->cheque_date?->format('Y-m-d')) }}">
                    @error('cheque_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="details" class="form-label">Details <span class="text-danger">*</span></label>
                    <textarea name="details" id="details" rows="3" class="form-control @error('details') is-invalid @enderror"
                        required>{{ old('details', $payment?->details) }}</textarea>
                    @error('details')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ $page_type === 'edit' ? 'Update' : 'Save' }}</button>
            </form>
        </div>
    </div>
@endsection
