extends('admin.layouts.admin')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">FTFT PAY | Creating Account</h5>
        </div>
        <form method="POST" action="{{ route('accounts.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="actype" class="form-label">Account Type <span class="text-danger">*</span></label>
                    <select name="actype" id="actype" class="form-select" required>
                        <option value="">Please Select</option>
                        <option value="1" {{ old('actype') == '1' ? 'selected' : '' }}>Asset</option>
                        <option value="2" {{ old('actype') == '2' ? 'selected' : '' }}>Liability</option>
                        <option value="3" {{ old('actype') == '3' ? 'selected' : '' }}>Income</option>
                        <option value="4" {{ old('actype') == '4' ? 'selected' : '' }}>Expense</option>
                        <option value="5" {{ old('actype') == '5' ? 'selected' : '' }}>Equity</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" name="company" id="company" class="form-control" value="{{ old('company') }}">
                </div>
                <div class="col-12">
                    <label for="name" class="form-label">Account Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" rows="4" class="form-control">{{ old('address') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="col-12">
                    <label for="details" class="form-label">Details</label>
                    <textarea name="details" id="details" rows="3" class="form-control">{{ old('details') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label for="is_active" class="form-label">Status</label>
                    <select name="is_active" id="is_active" class="form-select">
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-danger px-4">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection