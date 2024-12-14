@extends('layouts.app')

@section('content')

@section('title', 'Apply') <!-- Set the title for this page -->

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
          
          <div class="form-group">
              <label for="fname">First name</label>
              <input type="text" class="form-control" id="fname" name="fname"
                  value="" >
          </div>
          <div class="form-group">
              <label for="sname">Last name</label>
              <input type="text" class="form-control" id="sname" name="sname"
                  value="">
          </div>
         
          <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email"
                  value="" >
          </div>
          <div>
              <label for="password">Password</label>
              <input type="password" name="password" id="password">
          </div>
      
          <!-- Confirm Password Field -->
          <div>
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation">
          </div>

          <!-- #################################################################################################### -->
          <div class="form-group">
              <label for="user_dob">Date of Birth</label>
              <input type="date" class="form-control" id="dob" name="dob" max="{{ now()->toDateString() }}"
                  value="">
          </div>

          <div class="form-group col-sm-10">
              <select class="form-control my-1 mr-sm-2" name='gender' id="gender">
                  <option value="" disabled selected>Select Gender</option>
                  <option value="Male">Male
                  </option>
                  <option value="Female">Female
                  </option>
                  <option value="Other">Other
                  </option>
              </select>
             
          </div>
          <div class="form-group">
              <label for="user_phone" class="col-sm-3 col-form-label">Phone</label>
              <div class="col-sm-9">
                  <input type="text" name="phone" id='phone' class="form-control"
                      value="">
                 
              </div>
          </div>
          <div class="form-group">
            <label for="user_nationality">Birth Place</label>
            <select class="form-control" id="birth_place" name="birth_place">
                <option value="">Select Birth Place</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
          </div>
        
          <div class="form-group">
            <label for="user_nationality">Nationality</label>
            <select class="form-control" id="nationality" name="nationality">
                <option value="">Select Nationality</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
          </div>
        
          <div class="form-group">
              <label for="user_current_address">Current Address</label>
              <input type="text" class="form-control" id="current_address" name="current_address"
                  value="">
          </div>
          <div class="form-group">
              <label for="user_city">City</label>
              <input type="text" class="form-control" id="city" name="city"
                  value="">
          </div>
          <div class="form-group">
              <label for="user_postcode">Postcode</label>
              <input type="text" class="form-control" id="postcode" name="postcode"
                  value="">
          </div>
          {{-- <div class="form-group">
              <label for="user_living_since">Living Since</label>
              <input type="date" class="form-control" id="living_since" name="living_since" max="{{ now()->toDateString() }}" 
                  value="" required>
          </div> --}}
          <div class="form-group">
              <label for="user_ni_number">NI Number</label>
              <input type="text" class="form-control" id="ni_number" name="ni_number"
                  value="" >
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
              <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name"
                  value="">
          </div>
          <div class="form-group">
              <label for="user_emgergency_contact_relationship">Contact Relationship</label>
              <input type="text" class="form-control" id="emgergency_contact_relationship" name="emgergency_contact_relationship"
                  value="">
          </div>
          <div class="form-group">
              <label for="emgergency_contact_phone">Contact Number</label>
              <input type="text" class="form-control" id="emgergency_contact_phone" name="emgergency_contact_phone"
                  value="" required>
          </div>
          <!-- ###################################################################################### -->
          <div>
              <h5>SIA Licence</h5>
          </div>
          <div class="form-group">
              <label for="user_sia_licence_type">Licence Type</label>
              <input type="text" class="form-control" id="sia_licence_type" name="sia_licence_type"
                  value="" required>
          </div>
          <div class="form-group">
              <label for="user_sia_licence_number">Licence Number</label>
              <input type="text" class="form-control" id="sia_licence_number" name="sia_licence_number"
                  value="" required>
          </div>
          <div class="form-group">
              <label for="user_sia_licence_expiry_date">Expiry Date</label>
              <input type="date" class="form-control" id="sia_licence_expiry_date" name="sia_licence_expiry_date" min="{{ now()->toDateString() }}"
                  value="">
          </div>

          <div>
            <h5>Driving Licence</h5>
        </div>
        <div class="form-group">
            <label for="user_sia_licence_type">Driving Licence Present</label>
            <input type="text" class="form-control" id="driving_licence_present" name="driving_licence_present"
                value="" required>
        </div>
        <div class="form-group">
            <label for="user_sia_licence_number">Driving Licence Type</label>
            <input type="text" class="form-control" id="driving_licence_type" name="driving_licence_type"
                value="" required>
        </div>
        <div class="form-group">
          <label for="user_sia_licence_number">Driving Licence Number</label>
          <input type="text" class="form-control" id="driving_licence_number" name="driving_licence_number"
              value="" required>
      </div>
      
            Own vehicle
      <div class="form-group col-sm-10">
              <select class="form-control my-1 mr-sm-2" name='user_own_vehicle' id="user_own_vehicle" >
                  <option value="" disabled selected>Select Option</option>
                  <option value="1">Yes
                  </option>
                  <option value="0">No
                  </option>
              </select>
             
        </div>
        <div>
          <h5>Clearance</h5>
          <div class="form-group col-sm-10">
            <label for="user_sia_licence_number">Criminal Offence Present</label>
            <select class="form-control my-1 mr-sm-2" name='criminal_offence_present' id="criminal_offence_present" >
                <option value="" disabled selected>Select Option</option>
                <option value="1">Yes
                </option>
                <option value="0">No
                </option>
            </select>
           
        </div>

          <div class="form-group col-sm-10">
            <label for="user_sia_licence_number">Criminal Offence Details</label>
            <input type="text" class="form-control" id="criminal_offence_details" name="criminal_offence_details"
              value="">
          
        </div>

        <div class="form-group col-sm-10">
          <label for="user_sia_licence_number">Share Code</label>
          <input type="text" class="form-control" id="share_code" name="share_code"
            value="">
        
      </div>
      <h5>Documents</h5>
      <div class="form-group col-sm-10">
        <label for="user_sia_licence_number">Document Type</label>
        <input type="text" class="form-control" id="doc_type" name="doc_type"
          value="">
      
    </div>
    <div class="form-group col-sm-10">
      <label for="user_sia_licence_number">Link</label>
      <input type="text" class="form-control" id="link" name="link"
        value="">
    
    </div>

    <div class="form-group col-sm-10">
      <label for="user_sia_licence_number">Status</label>
      <select class="form-control my-1 mr-sm-2" name='status' id="status" >
          <option>Select Option</option>
          <option value="1" selected>Yes
          </option>
          <option value="0">No
          </option>
      </select>
     
    </div>

    <div class="form-group col-sm-10">
      <label for="user_sia_licence_number">Details</label>
      <input type="text" class="form-control" id="details" name="details"
        value="">
    
    </div>
     
      <div class="text-center mt-2">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
      
      </div>
    </div>
  </div>
</section>


  <!-- end about section -->

  <!-- end team section -->
  @endsection