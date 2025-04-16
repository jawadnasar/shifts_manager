@extends('layouts.app')

@section('content')

@section('title', 'Apply') <!-- Set the title for this page -->

@php
    $today = \Carbon\Carbon::now()->toDateString();
@endphp

<style>
    .hero_area {
        min-height: 60vh !important;
    }
</style>
<section id='form_errors'>

</section>
<section class="sponsors-section py-5">
    <div class="container text-center">
        <!-- Title -->
        <div class="heading_container heading_center">
            <h2>
                Apply
            </h2>
            <p>
                Apply here by filling the below form
            </p>
        </div>
    </div>
</section>

<section class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">

                <form action="{{ route('security_agency_recruitment_form.store') }}" method="post"
                    enctype="multipart/form-data" id="recruitment_form">
                    @csrf
                    <!-- Personal Information Section -->
                    <div class="heading_container heading_center">
                        <h2>
                            Personal Information
                        </h2>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_fname">First name</label>
                            <input type="text" class="form-control" id="user_fname" name="user_fname"
                                value="{{ old('user_fname', isset($udata) ? $udata->fname : '') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_sname">Last name</label>
                            <input type="text" class="form-control" id="user_sname" name="user_sname"
                                value="{{ old('user_sname', isset($udata) ? $udata->sname : '') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_email">Email</label>
                            <input type="text" class="form-control" id="user_email" name="user_email"
                                value="{{ old('user_email', isset($udata) ? $udata->email : '') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_password">Password</label>
                            <input type="password" class="form-control" name="user_password" id="user_password"
                                required>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group col-md-6">
                            <label for="user_password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="user_password_confirmation"
                                id="user_password_confirmation" required>
                        </div>
                    </div>

                    <!-- Date of Birth & Gender Section -->

                    <div class="heading_container heading_center">
                        <h2>
                            Date of Birth & Gender
                        </h2>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_dob">Date of Birth</label>
                            <input type="date" class="form-control" id="user_dob" name="user_dob"
                                max="{{ now()->toDateString() }}"
                                value="{{ old('user_dob', isset($udata) ? $udata->dob : '') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_gender">Gender</label>
                            <select class="form-control" name='user_gender' id="user_gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="M" @if (old('user_gender', isset($udata) ? $udata->gender : '') == 'M') {{ 'selected' }} @endif>Male
                                </option>
                                <option value="F" @if (old('user_gender', isset($udata) ? $udata->gender : '') == 'F') {{ 'selected' }} @endif>
                                    Female
                                </option>
                                <option value="O" @if (old('user_gender', isset($udata) ? $udata->gender : '') == 'O') {{ 'selected' }} @endif>
                                    Other
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="heading_container heading_center">
                        <h2>
                            Disability Information
                        </h2>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="is_disabled">Do you have a disability?</label>
                        <select class="form-control" id="is_disabled" name="is_disabled" required>
                            <option value="Please Select" selected disabled></option>
                            <option value="0" @if (old('is_disabled', isset($udata) ? $udata->is_disabled : '') == '0') {{ 'selected' }} @endif>No
                            </option>
                            <option value="1" @if (old('is_disabled', isset($udata) ? $udata->is_disabled : '') == '1') {{ 'selected' }} @endif>Yes
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6" id="disabilities-container" style="display: none;">
                        <label for="disabilities">Please specify your disabilities</label>
                        <textarea class="form-control" id="disabilities" name="disabilities" rows="4"
                            placeholder="Enter your disabilities here, separated by commas (e.g., Diabetes, Hypertension, etc.)"></textarea>
                    </div>



                    <!-- Contact Information Section -->
                    <div class="heading_container heading_center">
                        <h2>
                            Contact Information
                        </h2>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_phone">Phone</label>
                            <input type="text" name="user_phone" id='user_phone' class="form-control"
                                value="{{ old('user_phone', isset($udata) ? $udata->phone : '') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_birth_place">Birth Place</label>
                            <select class="form-control" id="user_birth_place" name="user_birth_place" required>
                                <option value="" selected disabled>Select Birth Place</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @if (old('user_birth_place', isset($udata) ? $udata->id : '') == $country->id) {{ 'selected' }} @endif>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_nationality">Nationality</label>
                            <select class="form-control" id="user_nationality" name="user_nationality" required>
                                <option value="" selected disabled>Select Birth Place</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @if (old('user_nationality', isset($udata) ? $udata->id : '') == $country->id) {{ 'selected' }} @endif>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_current_address">Current Address</label>
                            <input type="text" class="form-control" id="user_current_address"
                                name="user_current_address"
                                value="{{ old('user_current_address', isset($udata) ? $udata->current_address : '') }}"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_city">City</label>
                            <input type="text" class="form-control" id="user_city" name="user_city"
                                value="{{ old('user_city', isset($udata) ? $udata->city : '') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_postcode">Postcode</label>
                            <input type="text" class="form-control" id="user_postcode" name="user_postcode"
                                value="{{ old('user_postcode', isset($udata) ? $udata->postcode : '') }}" required>
                        </div>
                    </div>
                    {{-- 
                        <div class="form-group">
                            <label for="user_living_since">Living Since</label>
                            <input type="date" class="form-control" id="user_living_since" name="user_living_since" max="{{ now()->toDateString() }}" 
                                value="{{ old('user_living_since', isset($udata) ? $udata->living_since : '') }}" required>
                        </div> 
                    --}}
                    <!-- Emergency Contact Section -->
                    <div class="heading_container heading_center">
                        <h2>
                            Other Personal Information
                        </h2>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="user_ni_number">NI Number</label>
                            <input type="text" class="form-control" id="user_ni_number" name="user_ni_number"
                                value="{{ old('user_ni_number', isset($udata) ? $udata->ni_number : '') }}"
                                placeholder="Please enter your national insurace number" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_share_code">Share code (Right to work)</label>
                            <input type="text" class="form-control" id="user_share_code" name="user_share_code"
                                value="{{ old('user_share_code', isset($udata) ? $udata->user_share_code : '') }}"
                                placeholder="Right to work share code" required>
                        </div>
                    </div>

                    <!-- Emergency Contact Section -->
                    <div class="heading_container heading_center">
                        <h2>
                            Emergency Contact Information
                        </h2>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="user_emergency_contact_name">Contact Name</label>
                            <input type="text" class="form-control" id="user_emergency_contact_name"
                                name="user_emergency_contact_name"
                                value="{{ old('user_emergency_contact_name', isset($udata) ? $udata->emergency_contact_name : '') }}"
                                required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_emergency_contact_relationship">Relationship</label>
                            <input type="text" class="form-control" id="user_emergency_contact_relationship"
                                name="user_emergency_contact_relationship"
                                value="{{ old('user_emergency_contact_relationship', isset($udata) ? $udata->emergency_contact_relationship : '') }}"
                                required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_emergency_contact_phone">Contact Number</label>
                            <input type="text" class="form-control" id="user_emergency_contact_phone"
                                name="user_emergency_contact_phone"
                                value="{{ old('user_emergency_contact_phone', isset($udata) ? $udata->emergency_contact_phone : '') }}"
                                required>
                        </div>
                    </div>
                    <!-- SIA Licence Section -->

                    <div class="heading_container heading_center">
                        <h2>
                            SIA Licence
                        </h2>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="user_sia_licence_type">Licence Type</label>
                            <input type="text" class="form-control" id="user_sia_licence_type"
                                name="user_sia_licence_type"
                                value="{{ old('user_sia_licence_type', isset($udata) ? $udata->sia_licence_type : '') }}"
                                required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_sia_licence_number">Licence Number</label>
                            <input type="text" class="form-control" id="user_sia_licence_number"
                                name="user_sia_licence_number"
                                value="{{ old('user_sia_licence_number', isset($udata) ? $udata->sia_licence_number : '') }}"
                                required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_sia_licence_expiry_date">Expiry Date</label>
                            <input type="date" class="form-control" id="user_sia_licence_expiry_date"
                                name="user_sia_licence_expiry_date" min="{{ now()->toDateString() }}"
                                value="{{ old('user_sia_licence_expiry_date', isset($udata) ? $udata->sia_licence_expiry_date : '') }}"
                                required>
                        </div>
                    </div>
                    <!-- Driving Licence Section -->
                    <div class="heading_container heading_center">
                        <h2>
                            Driving Licence
                        </h2>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="user_driving_licence_present">Driving Licence</label>
                            <select class="form-control" name='user_driving_licence_present'
                                id="user_driving_licence_present" required>
                                <option value="" disabled selected>Select Option</option>
                                <option value="1" @if (old('user_driving_licence_present', isset($udata) ? $udata->driving_licence_present : '') == '1') {{ 'selected' }} @endif>
                                    Yes
                                </option>
                                <option value="0" @if (old('user_driving_licence_present', isset($udata) ? $udata->driving_licence_present : '') == '0') {{ 'selected' }} @endif>
                                    No
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="user_driving_licence_type">Driving Licence Type</label>
                            <input type="text" class="form-control" id="user_driving_licence_type"
                                name="user_driving_licence_type"
                                value="{{ old('user_driving_licence_type', isset($udata) ? $udata->driving_licence_type : '') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="user_driving_licence_number">Driving Licence Number</label>
                            <input type="text" class="form-control" id="user_driving_licence_number"
                                name="user_driving_licence_number"
                                value="{{ old('user_driving_licence_number', isset($udata) ? $udata->driving_licence_number : '') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="user_own_vehicle">Own Vehicle</label>
                            <select class="form-control" id="user_own_vehicle" name="user_own_vehicle">
                                <option value="" disabled selected>Select Option</option>
                                <option value="1" @if (old('user_own_vehicle', isset($udata) ? $udata->own_vehicle : '') == '1') {{ 'selected' }} @endif>
                                    Yes
                                </option>
                                <option value="0" @if (old('user_own_vehicle', isset($udata) ? $udata->own_vehicle : '') == '0') {{ 'selected' }} @endif>
                                    No
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Clearance Section -->
                    <div class="heading_container heading_center">
                        <h2>
                            Clearance
                        </h2>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_criminal_offence_present">Criminal Offence Present</label>
                            <select class="form-control" id="user_criminal_offence_present"
                                name="user_criminal_offence_present">
                                <option value="" disabled selected>Select Option</option>
                                <option value="1" @if (old('user_criminal_offence_present', isset($udata) ? $udata->criminal_offence_present : '') == '1') {{ 'selected' }} @endif>
                                    Yes
                                </option>
                                <option value="0" @if (old('user_criminal_offence_present', isset($udata) ? $udata->criminal_offence_present : '') == '0') {{ 'selected' }} @endif>
                                    No
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_criminal_offence_details">Criminal Offence Details</label>
                            <input type="text" class="form-control" id="user_criminal_offence_details"
                                name="user_criminal_offence_details"
                                value="{{ old('user_criminal_offence_details', isset($udata) ? $udata->criminal_offence_details : '') }}">
                        </div>
                    </div>

                    {{-- Five Years Employment History --}}
                    <div class="heading_container heading_center">
                        <h2>
                            Employment History
                        </h2>
                    </div>
                    <div class="row">
                        <p id='screening' style="font-size: 0.9em; font-style: italic; color: #555;">As part of the
                            security screening process, we must verify your personal history for the past
                            five (5) years. Please provide comprehensive details of your history over this period,
                            including all instances of employment, self-employment, education, and any periods of
                            unemployment (registered or unregistered). Please note that any gaps exceeding 31 days will
                            require verification.
                            <br>
                            Start with your most recent employment and add all previous records by clicking the 'Add
                            History' button."
                        </p>
                    </div>
                    <div id="five_years_history_container">
                        <!-- Inputs are added here -->
                    </div>
                    <div class="">
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-sm btn-success" id="add_history_row">
                                <i class="fa fa-plus"></i></i>&nbsp; Add History
                            </button>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div>
                        <div class="heading_container heading_center">
                            <h2>
                                Documents
                            </h2>

                        </div>

                        <div id="document_section_container">
                            <!-- Document Row dynamically coming here-->
                        </div>

                        <!-- Add Document Button -->

                        <div class="form-group text-right">
                            <button type="button" class="btn btn-sm btn-success" id="add_document_row">
                                <i class="fa fa-plus"></i></i>&nbsp; Add Document
                            </button>
                        </div>
                    </div>

                    <div class="text-center mt-2">
                        <div class="btn-box">

                            <button type="submit" class="btn btn-2">Save</button>

                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        addDocumentRow(); // Adding first document row
        add_5_years_history_row(true); // Adding first 5 years history row


        // Add new document row
        $('#add_document_row').click(function() {
            addDocumentRow(); // Add new document row
        });

        // Remove document row
        $(document).on('click', '.remove-document-row', function() {
            $(this).closest('.document-row').remove();
        });

        $('#add_history_row').on('click', function() {
            add_5_years_history_row(); // Add new 5 years history row
        });


        // Add new document row function
        function addDocumentRow() {
            var newDocumentRow = `
                <div class="document-row mb-3">
                    <div class="form-row">
                        <!-- Upload Document -->

                        <!-- Document Type -->
                        <div class="form-group col-md-3">
                            <label for="user_doc_type">Document Type</label>
                            <select class="form-control" name="user_doc_type[]" required>
                                <option value="" disabled selected>Select a Document</option>
                                <option value="driving_licence">Driving Licence</option>
                                <option value="passport">Passport</option>
                                <option value="proof_of_address">Proof of Address</option>
                                <option value="right_to_work">Right to work</option>
                                <option value="security_licence">Security Licence</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="user_file_link">Upload Document</label>
                            <input type="file" class="form-control" name="user_file_link[]"
                                accept="image/*" required>
                        </div>

                        <!-- Details -->
                        <div class="form-group col-md-3">
                            <label for="user_doc_details">Details</label>
                            <input type="text" class="form-control" name="user_doc_details[]"
                                placeholder="Enter Details" required>
                        </div>

                        <!-- Remove Button -->
                        <div class="form-group col-md-12 text-right">
                            <button type="button" class="btn btn-danger btn-sm remove-document-row">
                                <i class="fa fa-trash-o"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            `;

            $('#document_section_container').append(newDocumentRow);
        }

        $('form').on('submit', function(event) {

            // return
            event.preventDefault(); // Prevent default form submission

            $('#form_errors').empty(); // Clear previous errors
            let formData = new FormData(this); // Use FormData to handle file uploads and all fields
            let csrfToken = $('meta[name="csrf-token"]').attr(
                'content'); // Get CSRF token from meta tag

            $.ajax({
                url: $(this).attr('action'), // Get the form action URL
                type: $(this).attr('method'), // Get the form method (POST/GET)
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in the request headers FOR SENDING PHOTOS TO SERVER
                },
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                success: function(response) {
                    // Handle success response
                    console.log('Form submitted successfully!');
                    window.location = response.redirect_url;
                },
                error: function(xhr) {
                    console.log('xhr:', xhr.responseText)
                    try {
                        var res = JSON.parse(xhr.responseText);
                        const errors = res.errors;
                        let errorMessage = '';
                        for (const field in errors) {
                            errorMessage += `${field}:\n`;
                            errors[field].forEach(error => {
                                errorMessage += `  - ${error}<br>`;
                            });
                        }
                        $('#form_errors').append(`<div class="alert alert-danger">` +
                            errorMessage + `</div>`);
                        $('html, body').animate({
                            scrollTop: $('#form_errors').offset().top - 100
                        }, 500);
                        $('#form_errors').focus();
                    } catch (e) {
                        // Handle error response
                        console.log('Error: ' + e);
                        console.log('Response: ' + xhr.responseText);
                        alert(xhr.responseText);
                    }
                }
            });
        });

        // Manage Disablity Options:
        document.getElementById('is_disabled').addEventListener('change', function() {
            var disabilitiesContainer = document.getElementById('disabilities-container');
            if (this.value == '1') {
                disabilitiesContainer.style.display = 'block';
            } else {
                disabilitiesContainer.style.display = 'none';
            }
        });

        // // Add a button to trigger the function
        // const testButton = $('<button type="button" class="btn btn-primary">Fill Test Data</button>');
        // testButton.on('click', fillTestData);
        // $('form').prepend(testButton);
        // fillTestData();

        // function fillTestData() {
        //     // Fill text inputs
        //     $('input[type="text"]').each(function() {
        //         $(this).val('Test ' + $(this).attr('name'));
        //     });

        //     // Fill date inputs
        //     $('input[type="date"]').each(function() {
        //         $(this).val('2023-01-01');
        //     });

        //     // Fill select inputs
        //     $('select').each(function() {
        //         $(this).val($(this).find('option').not(':disabled').first().val());
        //     });

        //     // Fill textareas
        //     $('textarea').each(function() {
        //         $(this).val('Test data for ' + $(this).attr('name'));
        //     });

        //     // Check checkboxes and radio buttons
        //     $('input[type="checkbox"], input[type="radio"]').each(function() {
        //         $(this).prop('checked', true);
        //     });

        //     $('#user_email').val(Math.random() * 11224 + 'test@gmail.cij')
        //     $('#user_password_confirmation').val('jhjh2222');
        //     $('#user_password').val('jhjh2222');
        //     $('#user_sia_licence_expiry_date').val('2027-01-01');
        //     $('#is_disabled').val(0);
        //     $('#user_postcode').val(4444)

        //     console.log('Test data has been filled in all fields!');
        // }
    });

    // Add 5 years histoy row
    function add_5_years_history_row(doc_loaded) {
        var hist_row;
        hist_row = doc_loaded ? '' : '<hr class="my-4">'; // if first row is true we donot need to separate the rows 
        hist_row += `
            <div class='row'>
                <div class="form-group col-md-3">
                    <label for="emp_from_date[]">From Date</label>
                    <input type="date" class="form-control" id="emp_from_date[]" name="emp_from_date[]" max="{{ $today }}" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="emp_to_date[]">To Date</label>
                    <input type="date" class="form-control" id="emp_to_date[]" name="emp_to_date[]" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="company_name[]">Company Name</label>
                    <input type="text" class="form-control" id="company_name[]" name="company_name[]" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="company_address[]">Company Address</label>
                    <input type="text" class="form-control" id="company_address[]" name="company_address[]" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="position_held[]">Position Held</label>
                    <input type="text" class="form-control" id="position_held[]" name="position_held[]" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="employer_name[]">Employer Name</label>
                    <input type="text" class="form-control" id="employer_name[]" name="employer_name[]" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="company_phone[]">Company Phone</label>
                    <input type="text" class="form-control" id="company_phone[]" name="company_phone[]" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="company_email[]">Company Email</label>
                    <input type="text" class="form-control" id="company_email[]" name="company_email[]" required>
                </div>
            </div>
        `;
        $('#five_years_history_container').append(hist_row);

    }
</script>

@endsection
