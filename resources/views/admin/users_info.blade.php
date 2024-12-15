<form action="" id='user_form' method="get">
    <div class="form-group">
        <label for="user_full_name">Name</label>
        <input type="text" class="form-control" id="user_full_name" name="user_full_name"
            value="{{ request()->user_full_name }}">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" id="user_email" name="user_email"
            value="{{ request()->user_email }}">
    </div>
    <div class="form-group col-sm-10">
        User Type
        <select class="form-control my-1 mr-sm-2" name='user_type' id="user_type">
            <option value="" disabled selected>Select Option</option>
            <option value="admin" {{ request()->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="compliance" {{ request()->user_type == 'compliance' ? 'selected' : '' }}>Compliance</option>
            <option value="employee" {{ request()->user_type == 'employee' ? 'selected' : '' }}>Employee</option>
        </select>
    </div>
    <div class="form-group col-sm-10">
        Gender
        <select class="form-control my-1 mr-sm-2" name='user_gender' id="user_gender">
            <option value="" disabled selected>Select Option</option>
            <option value="M" {{ request()->user_gender == 'M' ? 'selected' : '' }}>Male</option>
            <option value="F" {{ request()->user_gender == 'F' ? 'selected' : '' }}>Female</option>
            <option value="O" {{ request()->user_gender == 'O' ? 'selected' : '' }}>Other</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_postcode">Postcode</label>
        <input type="text" class="form-control" id="user_postcode" name="user_postcode"
            value="{{ request()->user_postcode }}">
    </div>
    <button type="submit">Search</button>
    <button type="button" onclick="resetForm()">Reset</button>
</form>

<script>
    function resetForm() {
        // Reset form fields
        document.getElementById('user_form').reset();

        // Redirect to the original URL without the query parameters
        window.location.href = window.location.origin + window.location.pathname;
    }
</script>

<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>User</th>
            <th>SIA</th>
            <th>Expiry</th>
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
                <td>{{ $det->sia_licence_type }} <br> {{ $det->sia_licence_number }}</td>
                <td>{{ $det->sia_licence_expiry_date }}</td>

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
