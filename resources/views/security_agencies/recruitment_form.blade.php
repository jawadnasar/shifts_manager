<form action="{{ route('agency_recruitment_form.store') }}" method="post">
    @csrf
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="form-group">
        <label for="fname">First name</label>
        <input type="text" class="form-control" id="fname" name="fname"
            value="{{ old('fname', isset($udata) ? $udata->fname : '') }}" required>
    </div>
    <div class="form-group">
        <label for="sname">Last name</label>
        <input type="text" class="form-control" id="sname" name="sname"
            value="{{ old('sname', isset($udata) ? $udata->sname : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_dob">Date of Birth</label>
        <input type="date" class="form-control" id="user_dob" name="user_dob" max="{{ now()->toDateString() }}"
            value="{{ old('user_dob', isset($udata) ? $udata->dob : '') }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email"
            value="{{ old('email', isset($udata) ? $udata->email : '') }}" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
    </div>

    <!-- Confirm Password Field -->
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    <div class="form-group col-sm-10">
        <select class="form-control my-1 mr-sm-2" name='user_gender' id="user_gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="M" @if (old('user_gender', isset($udata) ? $udata->gender : '') == 'M') {{ 'selected' }} @endif>Male
            </option>
            <option value="F" @if (old('user_gender', isset($udata) ? $udata->gender : '') == 'F') {{ 'selected' }} @endif>Female
            </option>
            <option value="O" @if (old('user_gender', isset($udata) ? $udata->gender : '') == 'O') {{ 'selected' }} @endif>Other
            </option>
        </select>
        <span class="text-danger">
            @error('user_gender')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="form-group">
        <label for="user_phone" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
            <input type="text" name="user_phone" id='user_phone' class="form-control"
                value="{{ old('user_phone', isset($udata) ? $udata->phone : '') }}">
            <span class="text-danger">
                @error('user_phone')
                    {{ $message }}
                @enderror
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="user_birth_place">Birth Place</label>
        <input type="text" class="form-control" id="user_birth_place" name="user_birth_place"
            value="{{ old('user_birth_place', isset($udata) ? $udata->birth_place : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_nationality">Nationality</label>
        <input type="text" class="form-control" id="user_nationality" name="user_nationality"
            value="{{ old('user_nationality', isset($udata) ? $udata->nationality : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_current_address">Current Address</label>
        <input type="text" class="form-control" id="user_current_address" name="user_current_address"
            value="{{ old('user_current_address', isset($udata) ? $udata->current_address : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_city">City</label>
        <input type="text" class="form-control" id="user_city" name="user_city"
            value="{{ old('user_city', isset($udata) ? $udata->city : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_postcode">Postcode</label>
        <input type="text" class="form-control" id="user_postcode" name="user_postcode"
            value="{{ old('user_postcode', isset($udata) ? $udata->postcode : '') }}" required>
    </div>
    {{-- <div class="form-group">
        <label for="user_living_since">Living Since</label>
        <input type="date" class="form-control" id="user_living_since" name="user_living_since" max="{{ now()->toDateString() }}" 
            value="{{ old('user_living_since', isset($udata) ? $udata->living_since : '') }}" required>
    </div> --}}
    <div class="form-group">
        <label for="user_ni_number">NI Number</label>
        <input type="text" class="form-control" id="user_ni_number" name="user_ni_number"
            value="{{ old('user_ni_number', isset($udata) ? $udata->ni_number : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_share_code">Share code</label>
        <input type="text" class="form-control" id="user_share_code" name="user_share_code"
            value="{{ old('user_share_code', isset($udata) ? $udata->user_share_code : '') }}" required>
    </div>
    <div>
        <h5>Emergency Contact</h5>
    </div>
    <div class="form-group">
        <label for="user_emergency_contact_name">Contact Name</label>
        <input type="text" class="form-control" id="user_emergency_contact_name" name="user_emergency_contact_name"
            value="{{ old('user_emergency_contact_name', isset($udata) ? $udata->emergency_contact_name : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_emgergency_contact_relationship">Relationship</label>
        <input type="text" class="form-control" id="user_emgergency_contact_relationship" name="user_emgergency_contact_relationship"
            value="{{ old('user_emgergency_contact_relationship', isset($udata) ? $udata->emgergency_contact_relationship : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_emgergency_contact_phone">Contact Number</label>
        <input type="text" class="form-control" id="user_emgergency_contact_phone" name="user_emgergency_contact_phone"
            value="{{ old('user_emgergency_contact_phone', isset($udata) ? $udata->emgergency_contact_phone : '') }}" required>
    </div>
    <div>
        <h5>SIA Licence</h5>
    </div>
    <div class="form-group">
        <label for="user_sia_licence_type">Licence Type</label>
        <input type="text" class="form-control" id="user_sia_licence_type" name="user_sia_licence_type"
            value="{{ old('user_sia_licence_type', isset($udata) ? $udata->sia_licence_type : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_sia_licence_number">Licence Number</label>
        <input type="text" class="form-control" id="user_sia_licence_number" name="user_sia_licence_number"
            value="{{ old('user_sia_licence_number', isset($udata) ? $udata->sia_licence_number : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user_sia_licence_expiry_date">Expiry Date</label>
        <input type="date" class="form-control" id="user_sia_licence_expiry_date" name="user_sia_licence_expiry_date" min="{{ now()->toDateString() }}"
            value="{{ old('user_sia_licence_expiry_date', isset($udata) ? $udata->sia_licence_expiry_date : '') }}" required>
    </div>
Own vehicle
    <div class="form-group col-sm-10">
        <select class="form-control my-1 mr-sm-2" name='user_own_vehicle' id="user_own_vehicle" required>
            <option value="" disabled selected>Select Option</option>
            <option value="1" @if (old('user_own_vehicle', isset($udata) ? $udata->own_vehicle : '') == '1') {{ 'selected' }} @endif>True
            </option>
            <option value="0" @if (old('user_own_vehicle', isset($udata) ? $udata->own_vehicle : '') == '0') {{ 'selected' }} @endif>False
            </option>
        </select>
        <span class="text-danger">
            @error('user_own_vehicle')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="text-center mt-2">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>
