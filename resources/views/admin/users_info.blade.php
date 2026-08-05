@extends('admin.layouts.admin')

@section('errors')
    @if ($errors->any() && old('_form') !== 'add_user')
        <div class="alert alert-danger">
            {!! $errors->first() !!}
        </div>
    @endif
@endsection

@section('content')
    <div class="container-fluid">



        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class=" text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Users List</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fa fa-plus me-1"></i> Add User
                    </button>
                </div>
                <form action="" id='user_form' method="get" class="p-3 bg-light rounded shadow-sm">
                    <div class="row g-3">
                        <div class="form-group col-md-4">
                            <label for="user_full_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user_full_name" name="user_full_name"
                                placeholder="Enter name" value="{{ request()->user_full_name }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="user_email" name="user_email"
                                placeholder="Enter email" value="{{ request()->user_email }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_type" class="form-label">User Type</label>
                            <select class="form-select" name='user_type' id="user_type">
                                <option value="" disabled selected>Select User Type</option>
                                <option value="admin" {{ request()->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="compliance" {{ request()->user_type == 'compliance' ? 'selected' : '' }}>Compliance</option>
                                <option value="employee" {{ request()->user_type == 'employee' ? 'selected' : '' }}>Employee</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_gender" class="form-label">Gender</label>
                            <select class="form-select" name='user_gender' id="user_gender">
                                <option value="" disabled selected>Select Gender</option>
                                <option value="M" {{ request()->user_gender == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ request()->user_gender == 'F' ? 'selected' : '' }}>Female</option>
                                <option value="O" {{ request()->user_gender == 'O' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_postcode" class="form-label">Postcode</label>
                            <input type="text" class="form-control" id="user_postcode" name="user_postcode"
                                placeholder="Enter postcode" value="{{ request()->user_postcode }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-50 me-2">Search</button>
                            <button type="button" class="btn btn-secondary w-50" onclick="resetForm()">Reset</button>
                        </div>
                    </div>
                </form>


                <script>
                    function resetForm() {
                        // Reset form fields
                        document.getElementById('user_form').reset();

                        // Redirect to the original URL without the query parameters
                        window.location.href = window.location.origin + window.location.pathname;
                    }
                </script>
                <div class="table-responsive">
                    <table class="table main_table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>User</th>
                                <th>SIA</th>
                                <th>Expiry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users_data as $key => $row)
                                @php
                                    $det = $row->relate_user_details;
                                @endphp
                                <tr>
                                    <td>{{ $users_data->firstItem() + $loop->index }}</td>
                                    <td>{{ $row->full_name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $det->city ?? '' }}</td>
                                    <td>{{ $row->user_type }}</td>
                                    <td>{{ $det->sia_licence_type ?? '' }} <br> {{ $det->sia_licence_number ?? '' }}</td>
                                    <td>{{ $det->sia_licence_expiry_date ?? '' }}</td>
                                    <td>
                                        <a href="{{route('admin.users_info.show', $row->id)}}" class="btn btn-sm btn-primary">Show</a>
                                        <a href="{{route('security_agency_recruitment_form.edit', $row->id)}}" class="btn btn-sm btn-primary">Update</a>
                                        <a href="{{route('admin.user_privileges.edit', $row->id)}}" class="btn btn-sm btn-primary">Privileges</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($users_data)
                                {{ $users_data->appends(request()->query())->links('pagination::bootstrap-5') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->

        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.users_info.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_form" value="add_user">
                        <div class="modal-body">
                            @if ($errors->any() && old('_form') === 'add_user')
                                <div class="alert alert-danger text-start">
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 ps-3 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h6 class="text-muted mb-3">Account</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label for="add_fname" class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="fname" id="add_fname" class="form-control @error('fname') is-invalid @enderror" value="{{ old('fname') }}" required>
                                    @error('fname')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_sname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="sname" id="add_sname" class="form-control @error('sname') is-invalid @enderror" value="{{ old('sname') }}" required>
                                    @error('sname')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="add_email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="add_password" class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_user_type" class="form-label">User Type <span class="text-danger">*</span></label>
                                    <select name="user_type" id="add_user_type" class="form-select @error('user_type') is-invalid @enderror" required>
                                        <option value="">Select type</option>
                                        <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="compliance" {{ old('user_type') == 'compliance' ? 'selected' : '' }}>Compliance</option>
                                        <option value="employee" {{ old('user_type', 'employee') == 'employee' ? 'selected' : '' }}>Employee</option>
                                    </select>
                                    @error('user_type')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="text-muted mb-3">Details</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label for="add_dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" name="dob" id="add_dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}" required>
                                    @error('dob')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select name="gender" id="add_gender" class="form-select @error('gender') is-invalid @enderror" required>
                                        <option value="">Select gender</option>
                                        <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Male</option>
                                        <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female</option>
                                        <option value="O" {{ old('gender') == 'O' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="add_phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_city" class="form-label">City</label>
                                    <input type="text" name="city" id="add_city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}">
                                    @error('city')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_postcode" class="form-label">Postcode</label>
                                    <input type="text" name="postcode" id="add_postcode" class="form-control @error('postcode') is-invalid @enderror" value="{{ old('postcode') }}">
                                    @error('postcode')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_sia_licence_type" class="form-label">SIA Licence Type</label>
                                    <input type="text" name="sia_licence_type" id="add_sia_licence_type" class="form-control @error('sia_licence_type') is-invalid @enderror" value="{{ old('sia_licence_type') }}">
                                    @error('sia_licence_type')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_sia_licence_number" class="form-label">SIA Licence Number</label>
                                    <input type="text" name="sia_licence_number" id="add_sia_licence_number" class="form-control @error('sia_licence_number') is-invalid @enderror" value="{{ old('sia_licence_number') }}">
                                    @error('sia_licence_number')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="add_sia_licence_expiry_date" class="form-label">SIA Expiry Date</label>
                                    <input type="date" name="sia_licence_expiry_date" id="add_sia_licence_expiry_date" class="form-control @error('sia_licence_expiry_date') is-invalid @enderror" value="{{ old('sia_licence_expiry_date') }}">
                                    @error('sia_licence_expiry_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="text-muted mb-0">Documents <small class="text-muted">(optional)</small></h6>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addDocumentRow">
                                    <i class="fa fa-plus me-1"></i> Add Document
                                </button>
                            </div>
                            <div id="documentRows">
                                <div class="row g-3 document-row mb-2">
                                    <div class="col-md-4">
                                        <label class="form-label">Document Type</label>
                                        <select name="user_doc_type[]" class="form-select">
                                            <option value="">Select type</option>
                                            <option value="driving_licence">Driving Licence</option>
                                            <option value="passport">Passport</option>
                                            <option value="proof_of_address">Proof of Address</option>
                                            <option value="right_to_work">Right to Work</option>
                                            <option value="security_licence">Security Licence</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">File</label>
                                        <input type="file" name="user_file_link[]" class="form-control" accept="image/*">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Details</label>
                                        <input type="text" name="user_doc_details[]" class="form-control" placeholder="Optional notes">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-document-row" title="Remove">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($errors->any() && old('_form') === 'add_user')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    new bootstrap.Modal(document.getElementById('addUserModal')).show();
                });
            </script>
        @endif

        <script>
            document.getElementById('addDocumentRow').addEventListener('click', function() {
                const row = document.querySelector('.document-row').cloneNode(true);
                row.querySelectorAll('input, select').forEach(function(el) {
                    el.value = '';
                });
                document.getElementById('documentRows').appendChild(row);
            });

            document.getElementById('documentRows').addEventListener('click', function(e) {
                const btn = e.target.closest('.remove-document-row');
                if (!btn) return;
                const rows = document.querySelectorAll('.document-row');
                if (rows.length > 1) {
                    btn.closest('.document-row').remove();
                }
            });
        </script>
    @endsection
