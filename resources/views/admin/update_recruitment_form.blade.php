@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="text-center rounded p-4 shadow-lg">
            <h2 class="font-weight-bold text-success mb-3">Update Recruitment Form</h2>
            <hr class="border-success">

            <form action="{{ route('admin.recruitment_form.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Personal Information -->
                <h4 class="text-info">Personal Information</h4>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="user_fname">First Name</label>
                        <input type="text" class="form-control" id="user_fname" name="user_fname" value="{{ $user->fname }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user_sname">Last Name</label>
                        <input type="text" class="form-control" id="user_sname" name="user_sname" value="{{ $user->sname }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="user_email">Email</label>
                        <input type="email" class="form-control" id="user_email" name="user_email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user_password">Password</label>
                        <input type="password" class="form-control" id="user_password" name="user_password">
                        <small class="text-muted">Leave blank to keep the current password.</small>
                    </div>
                </div>

                <!-- Date of Birth & Gender -->
                <h4 class="text-info">Date of Birth & Gender</h4>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="user_dob">Date of Birth</label>
                        <input type="date" class="form-control" id="user_dob" name="user_dob" value="{{ $details->dob }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user_gender">Gender</label>
                        <select class="form-control" id="user_gender" name="user_gender" required>
                            <option value="M" {{ $details->gender == 'M' ? 'selected' : '' }}>Male</option>
                            <option value="F" {{ $details->gender == 'F' ? 'selected' : '' }}>Female</option>
                            <option value="O" {{ $details->gender == 'O' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <!-- Disability Information -->
                <h4 class="text-info">Disability Information</h4>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="is_disabled">Do you have a disability?</label>
                        <select class="form-control" id="is_disabled" name="is_disabled" required>
                            <option value="0" {{ $details->is_disabled == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $details->is_disabled == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6" id="disabilities-container" style="{{ $details->is_disabled == '1' ? '' : 'display: none;' }}">
                        <label for="disabilities">Please specify your disabilities</label>
                        <textarea class="form-control" id="disabilities" name="disabilities" rows="4">{{ $details->disabilities }}</textarea>
                    </div>
                </div>

                <!-- Contact Information -->
                <h4 class="text-info">Contact Information</h4>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="user_phone">Phone</label>
                        <input type="text" class="form-control" id="user_phone" name="user_phone" value="{{ $details->phone }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user_current_address">Current Address</label>
                        <input type="text" class="form-control" id="user_current_address" name="user_current_address" value="{{ $details->current_address }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="user_city">City</label>
                        <input type="text" class="form-control" id="user_city" name="user_city" value="{{ $details->city }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user_postcode">Postcode</label>
                        <input type="text" class="form-control" id="user_postcode" name="user_postcode" value="{{ $details->postcode }}" required>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <h4 class="text-info">Emergency Contact</h4>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="user_emergency_contact_name">Contact Name</label>
                        <input type="text" class="form-control" id="user_emergency_contact_name" name="user_emergency_contact_name" value="{{ $details->emergency_contact_name }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user_emergency_contact_phone">Contact Phone</label>
                        <input type="text" class="form-control" id="user_emergency_contact_phone" name="user_emergency_contact_phone" value="{{ $details->emergency_contact_phone }}" required>
                    </div>
                </div>

                <!-- SIA Licence -->
                <h4 class="text-info">SIA Licence</h4>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="user_sia_licence_type">Licence Type</label>
                        <input type="text" class="form-control" id="user_sia_licence_type" name="user_sia_licence_type" value="{{ $details->sia_licence_type }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user_sia_licence_number">Licence Number</label>
                        <input type="text" class="form-control" id="user_sia_licence_number" name="user_sia_licence_number" value="{{ $details->sia_licence_number }}" required>
                    </div>
                </div>

                <!-- Driving Licence -->
                <h4 class="text-info">Driving Licence</h4>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="user_driving_licence_present">Driving Licence</label>
                        <select class="form-control" id="user_driving_licence_present" name="user_driving_licence_present" required>
                            <option value="1" {{ $details->driving_licence_present == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $details->driving_licence_present == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user_own_vehicle">Own Vehicle</label>
                        <select class="form-control" id="user_own_vehicle" name="user_own_vehicle">
                            <option value="1" {{ $details->own_vehicle == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $details->own_vehicle == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>

                <!-- Bank Details -->
                <h4 class="text-info">Bank Details</h4>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="bank_name">Name of Bank</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ $details->bank_name }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bank_address">Bank Address</label>
                        <input type="text" class="form-control" id="bank_address" name="bank_address" value="{{ $details->bank_address }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="account_holder_name">Name of Account Holder</label>
                        <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="{{ $details->account_holder_name }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sort_code">Sort Code</label>
                        <input type="text" class="form-control" id="sort_code" name="sort_code" value="{{ $details->sort_code }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="account_number">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $details->account_number }}" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('is_disabled').addEventListener('change', function() {
            var disabilitiesContainer = document.getElementById('disabilities-container');
            if (this.value == '1') {
                disabilitiesContainer.style.display = 'block';
            } else {
                disabilitiesContainer.style.display = 'none';
            }
        });
    </script>
@endsection
