@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0">Accounts</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
            <i class="fa fa-plus me-1"></i> Add Account
        </button>
    </div>

    <div class="bg-light rounded p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Account Type</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>

                    @if(isset($accounts) && $accounts->count())
                        @foreach($accounts as $account)
                            <tr>
                                <td>{{ $loop->iteration + (isset($accounts) && method_exists($accounts, 'currentPage') ? ($accounts->currentPage() - 1) * $accounts->perPage() : 0) }}</td>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->account_glcode->name }}</td>
                                <td>{{ $account->company }}</td>
                                <td>{{ $account->email }}</td>
                                <td>{{ $account->phone }}</td>
                                <td>{{ $account->address }}</td>
                                <td>{{ $account->details }}</td>
                                <td>{{ $account->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>{{ optional($account->created_at)->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center py-4">No accounts found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if(isset($accounts) && method_exists($accounts, 'links'))
            <div class="mt-3">
                {{ $accounts->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Add Account Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAccountModalLabel">Add New Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.accounts.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="actype" class="form-label">Account Type <span class="text-danger">*</span></label>
                            <select name="actype" id="actype" class="form-select" required>
                                <option value="">Select type</option>
                                @foreach($glcodes ?? [] as $g)
                                    <option value="{{ $g->actype }}" {{ (string) old('actype') === (string) $g->actype ? 'selected' : '' }}>
                                        {{ $g->name }}
                                    </option>
                                @endforeach
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
                            <textarea name="address" id="address" rows="3" class="form-control">{{ old('address') }}</textarea>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
