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
      <form action="{{ route('agency_recruitment_form.store') }}" method="post">
    @csrf

    <!-- Personal Information Section -->
    <div class="heading_container heading_center">
        <h2>
          Personal Information 
        </h2>
      
      </div>
    <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" class="form-control" id="fname" name="fname" value="">
    </div>
    <div class="form-group">
        <label for="sname">Last Name</label>
        <input type="text" class="form-control" id="sname" name="sname" value="">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>

    <!-- Date of Birth & Gender Section -->
    <h3>Date of Birth & Gender</h3>
    <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" class="form-control" id="dob" name="dob" max="{{ now()->toDateString() }}">
    </div>
    <div class="form-group">
        <label for="gender">Gender</label>
        <select class="form-control" id="gender" name="gender">
            <option value="" disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- Contact Information Section -->
    <div class="heading_container heading_center">
        <h2>
          Contact Information 
        </h2>
      
      </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="">
    </div>
    <div class="form-group">
        <label for="birth_place">Birth Place</label>
        <select class="form-control" id="birth_place" name="birth_place">
            <option value="">Select Birth Place</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="nationality">Nationality</label>
        <select class="form-control" id="nationality" name="nationality">
            <option value="">Select Nationality</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="current_address">Current Address</label>
        <input type="text" class="form-control" id="current_address" name="current_address" value="">
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" class="form-control" id="city" name="city" value="">
    </div>
    <div class="form-group">
        <label for="postcode">Postcode</label>
        <input type="text" class="form-control" id="postcode" name="postcode" value="">
    </div>

    <!-- Emergency Contact Section -->
    <div class="heading_container heading_center">
        <h2>
          Emergency Contact Information 
        </h2>
      
      </div>
    <div class="form-group">
        <label for="emergency_contact_name">Contact Name</label>
        <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="">
    </div>
    <div class="form-group">
        <label for="emergency_contact_relationship">Contact Relationship</label>
        <input type="text" class="form-control" id="emergency_contact_relationship" name="emergency_contact_relationship" value="">
    </div>
    <div class="form-group">
        <label for="emergency_contact_phone">Contact Number</label>
        <input type="text" class="form-control" id="emergency_contact_phone" name="emergency_contact_phone" value="">
    </div>

    <!-- SIA Licence Section -->
   
    <div class="heading_container heading_center">
        <h2>
        SIA Licence
        </h2>
      
      </div>
    <div class="form-group">
        <label for="sia_licence_type">Licence Type</label>
        <input type="text" class="form-control" id="sia_licence_type" name="sia_licence_type" value="">
    </div>
    <div class="form-group">
        <label for="sia_licence_number">Licence Number</label>
        <input type="text" class="form-control" id="sia_licence_number" name="sia_licence_number" value="">
    </div>
    <div class="form-group">
        <label for="sia_licence_expiry_date">Expiry Date</label>
        <input type="date" class="form-control" id="sia_licence_expiry_date" name="sia_licence_expiry_date" min="{{ now()->toDateString() }}">
    </div>

    <!-- Driving Licence Section -->
    <div class="heading_container heading_center">
        <h2>
        Driving Licence
        </h2>
      
      </div>
    <div class="form-group">
        <label for="driving_licence_present">Driving Licence Present</label>
        <select class="form-control" id="driving_licence_present" name="driving_licence_present">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>
    <div class="form-group">
        <label for="driving_licence_type">Driving Licence Type</label>
        <input type="text" class="form-control" id="driving_licence_type" name="driving_licence_type" value="">
    </div>
    <div class="form-group">
        <label for="driving_licence_number">Driving Licence Number</label>
        <input type="text" class="form-control" id="driving_licence_number" name="driving_licence_number" value="">
    </div>
    <div class="form-group">
        <label for="user_own_vehicle">Own Vehicle</label>
        <select class="form-control" id="user_own_vehicle" name="user_own_vehicle">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>

    <!-- Clearance Section -->
    <div class="heading_container heading_center">
        <h2>
        Clearance
        </h2>
      
      </div>
    <div class="form-group">
        <label for="criminal_offence_present">Criminal Offence Present</label>
        <select class="form-control" id="criminal_offence_present" name="criminal_offence_present">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>
    <div class="form-group">
        <label for="criminal_offence_details">Criminal Offence Details</label>
        <input type="text" class="form-control" id="criminal_offence_details" name="criminal_offence_details" value="">
    </div>

    <!-- Documents Section -->
    <div class="heading_container heading_center">
        <h2>
        Documents
        </h2>
      
      </div>
    <div class="form-group">
        <label for="doc_type">Document Type</label>
        <input type="text" class="form-control" id="doc_type" name="doc_type" value="">
    </div>
    <div class="form-group">
        <label for="link">Document Link</label>
        <input type="text" class="form-control" id="link" name="link" value="">
    </div>
    <div class="form-group">
        <label for="status">Document Status</label>
        <select class="form-control" id="status" name="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>
    <div class="form-group">
      <label for="user_sia_licence_number">Details</label>
      <input type="text" class="form-control" id="details" name="details"
        value="">
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


  <!-- end about section -->

  <!-- end team section -->
  @endsection