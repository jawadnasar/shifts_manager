@extends('admin.layouts.admin')
@section('content')
    <div class="container-fluid">



        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class=" text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Users List</h6>

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

                                        <a href="{{route('admin.user_privileges.edit', $row->id)}}">Privileges</a>
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
    @endsection
