@extends('layouts.app')

@section('content')

@section('title', 'Apply') <!-- Set the title for this page -->
<style>
  .hero_area {
  min-height: 60vh!important;
}
</style>
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
      <form id="applyForm" enctype="multipart/form-data">
        @csrf

    <!-- Personal Information Section -->
    <div class="heading_container heading_center">
        <h2>
          Personal Information 
        </h2>
      
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" value="">
        </div>
        <div class="form-group col-md-6">
            <label for="sname">Last Name</label>
            <input type="text" class="form-control" id="sname" name="sname" value="">
            <input type="hidden" class="form-control" id="user_type" name="user_type" value="employee">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="">
        </div>
    </div>
    
   <div class="row">
    <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group col-md-6">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
   </div>

    <!-- Date of Birth & Gender Section -->
    <h3>Date of Birth & Gender</h3>
   <div class="row">
        <div class="form-group col-md-6">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" max="{{ now()->toDateString() }}">
        </div>
        <div class="form-group col-md-6">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="" Disabaled Selected>Select Gender</option>
                <option value="MA">Male</option>
                <option value="FE">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        
       
   </div>

    <!-- Contact Information Section -->
    <div class="heading_container heading_center">
        <h2>
          Contact Information 
        </h2>
      
      </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="">
        </div>
        <div class="form-group col-md-6">
            <label for="birth_place">Birth Place</label>
            <select class="form-control" id="birth_place" name="birth_place">
                <option value="">Select Birth Place</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nationality">Nationality</label>
            <select class="form-control" id="nationality" name="nationality">
                <option value="">Select Nationality</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="current_address">Current Address</label>
            <input type="text" class="form-control" id="current_address" name="current_address" value="">
        </div>
    </div>
   <div class="row">
    <div class="form-group col-md-6">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" value="">
        </div>
        <div class="form-group col-md-6">
            <label for="postcode">Postcode</label>
            <input type="text" class="form-control" id="postcode" name="postcode" value="">
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
            <label for="emergency_contact_name">Contact Name</label>
            <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="">
        </div>
        <div class="form-group col-md-4">
            <label for="emergency_contact_relationship">Contact Relationship</label>
            <input type="text" class="form-control" id="emergency_contact_relationship" name="emergency_contact_relationship" value="">
        </div>
        <div class="form-group col-md-4">
            <label for="emergency_contact_phone">Contact Number</label>
            <input type="text" class="form-control" id="emergency_contact_phone" name="emergency_contact_phone" value="">
        </div>
    </div>

    <!-- SIA Licence Section -->
   
    <div class="heading_container heading_center">
        <h2>
        SIA Licence
        </h2>
      
      </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="sia_licence_type">Licence Type</label>
            <input type="text" class="form-control" id="sia_licence_type" name="sia_licence_type" value="">
        </div>
        <div class="form-group  col-md-6">
            <label for="sia_licence_number">Licence Number</label>
            <input type="text" class="form-control" id="sia_licence_number" name="sia_licence_number" value="">
        </div>
        <div class="form-group  col-md-6">
            <label for="sia_licence_expiry_date">Expiry Date</label>
            <input type="date" class="form-control" id="sia_licence_expiry_date" name="sia_licence_expiry_date" min="{{ now()->toDateString() }}">
        </div>
    </div>

    <!-- Driving Licence Section -->
    <div class="heading_container heading_center">
        <h2>
        Driving Licence
        </h2>
      
      </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="driving_licence_present">Driving Licence Present</label>
            <select class="form-control" id="driving_licence_present" name="driving_licence_present">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="driving_licence_type">Driving Licence Type</label>
            <input type="text" class="form-control" id="driving_licence_type" name="driving_licence_type" value="">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="driving_licence_number">Driving Licence Number</label>
            <input type="text" class="form-control" id="driving_licence_number" name="driving_licence_number" value="">
        </div>
        <div class="form-group col-md-6">
            <label for="user_own_vehicle">Own Vehicle</label>
            <select class="form-control" id="user_own_vehicle" name="user_own_vehicle">
                <option value="1">Yes</option>
                <option value="0">No</option>
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
            <label for="criminal_offence_present">Criminal Offence Present</label>
            <select class="form-control" id="criminal_offence_present" name="criminal_offence_present">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="criminal_offence_details">Criminal Offence Details</label>
            <input type="text" class="form-control" id="criminal_offence_details" name="criminal_offence_details" value="">
        </div>
    </div>

    <!-- Documents Section -->
    <div class="heading_container heading_center">
        <h2>
        Documents
        </h2>
      
      </div>
   
      <div id="document_section_container">
          <div class="document-row mb-3">
              <div class="form-row">
                 <!-- Upload Document -->

                  <!-- Document Type -->
                  <div class="form-group col-md-3">
                      <label for="doc_type">Document Type</label>
                        <select class="form-control" name="doc_type[]">
                            <option value="" disabled selected>Select a Document</option>
                            <option value="national_idcard">National ID Card</option>
                            <option value="security_licence">Security Licence</option>
                            <option value="driving_licence">Driving Licence</option>
                            <option value="passport">Passport</option>
                            <option value="brp">BRP</option>
                        </select>
                  </div>

                  <div class="form-group col-md-3">
                      <label for="link">Upload Document</label>
                      <input type="file" class="form-control" name="link[]" accept="image/*">
                  </div>

                 

                  <!-- Document Status -->
                  <div class="form-group col-md-3">
                      <label for="status">Document Status</label>
                      <select class="form-control" name="status[]">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>

                  <!-- Details -->
                  <div class="form-group col-md-3">
                      <label for="details">Details</label>
                      <input type="text" class="form-control" name="details[]" placeholder="Enter Details">
                  </div>

                  <!-- Remove Button -->
                  <div class="form-group col-md-12 text-right">
                      <button type="button" class="btn btn-danger btn-sm remove-document-row">
                      <i class="fa fa-trash-o"></i> Remove
                      </button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Add Document Button -->
     
      <div class="form-group text-right">
        <button type="button" class="btn btn-sm btn-success" id="add_document_row">
            <i class="fa fa-plus"></i></i>&nbsp; Add Document
        </button>
      </div>



    <div class="btn-box">
                    <button type="submit" class="btn-2">
                      Apply
                    </button>
                  </div>

   
     
    
      </form>
      
      </div>
    </div>
  </div>
</section>
<script>
  $(document).ready(function() {
    // Add new document row
    $('#add_document_row').click(function() {
        var newDocumentRow = `
            <div class="document-row mb-3">
                <div class="form-row">
                     <!-- Upload Document -->
                    <div class="form-group col-md-3">
                        <label for="link">Upload Document</label>
                        <input type="file" class="form-control" name="link[]" accept="image/*">
                    </div>
                    <!-- Document Type -->
                    <div class="form-group col-md-3">
                        <label for="doc_type">Document Type</label>
                        <input type="text" class="form-control" name="doc_type[]" placeholder="Enter Document Type">
                    </div>

                   

                    <!-- Document Status -->
                    <div class="form-group col-md-3">
                        <label for="status">Document Status</label>
                        <select class="form-control" name="status[]">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- Details -->
                    <div class="form-group col-md-3">
                        <label for="details">Details</label>
                        <input type="text" class="form-control" name="details[]" placeholder="Enter Details">
                    </div>

                    <!-- Remove Button -->
                    <div class="form-group col-md-12 text-right">
                        <button type="button" class="btn btn-danger btn-sm remove-document-row">
                            <i class="bi bi-trash3"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
        `;

        $('#document_section_container').append(newDocumentRow);
    });

    // Remove document row
    $(document).on('click', '.remove-document-row', function() {
        $(this).closest('.document-row').remove();
    });
});



// Form Submission
$('#applyForm').on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);

            $("#loading").show();
            $.ajax({
                type: "POST",
                url: "{{ route('apply.save') }}",
                dataType: 'json',
                data: formData,
                processData: false, // Prevent jQuery from automatically transforming the data into a query string
                contentType: false, // Prevent jQuery from overriding the Content-Type header
                success: function(data) {
                    $("#loading").hide();
                    if (data.status === 'success') {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.msg,
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = "{{ route('apply') }}";
                        });
                       
                    } else {
                        toastr.error('Oops, Error: ' + data.msg);
                    }
                },
                error: function(request, status, error) {
                    $("#loading").hide();
                    toastr.error('Oops, Error: ' + request.responseText + ' :(');
                }
            });
    });

</script>
  @endsection