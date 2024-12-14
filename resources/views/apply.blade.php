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
      <div class="col-12">
        <h2 class="mb-4">Apply Form</h2>
      </div>
      
      <!-- User Information Section -->
      <div class="col-12 mb-5">
        <h3>User Information</h3>
        <form action="" method="POST">
          @csrf
          <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" required>
          </div>
          <div class="mb-3">
            <label for="sname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="sname" name="sname" required>
          </div>
          <div class="mb-3">
            <label for="user_type" class="form-label">User Type</label>
            <input type="text" class="form-control" id="user_type" name="user_type" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </form>
      </div>

      <!-- User Details Section -->
      <div class="col-12 mb-5">
        <h3>User Details</h3>
        <form action="" method="POST">
          @csrf
          <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
          </div>
          <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control" id="gender" name="gender" required>
              <option value="M">Male</option>
              <option value="F">Female</option>
              <option value="O">Other</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="mb-3">
            <label for="birth_place" class="form-label">Birth Place</label>
            <input type="text" class="form-control" id="birth_place" name="birth_place">
          </div>
          <div class="mb-3">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" class="form-control" id="nationality" name="nationality">
          </div>
          <!-- Add other fields as necessary -->
        </form>
      </div>

      <!-- User Documents Section -->
      <div class="col-12 mb-5">
        <h3>Upload Documents</h3>
        <form action="" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="doc_type" class="form-label">Document Type</label>
            <select class="form-control" id="doc_type" name="doc_type" required>
              <option value="national_idcard">National ID Card</option>
              <option value="security_licence">Security Licence</option>
              <option value="driving_licence">Driving Licence</option>
              <option value="passport">Passport</option>
              <option value="brp">BRP</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="link" class="form-label">Upload Document</label>
            <input type="file" class="form-control" id="link" name="link" required>
          </div>
          <div class="mb-3">
            <label for="details" class="form-label">Document Details</label>
            <textarea class="form-control" id="details" name="details"></textarea>
          </div>
        </form>
      </div>

      <!-- Submit Section -->
      <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary">Submit Application</button>
      </div>
    </div>
  </div>
</section>


  <!-- end about section -->

  <!-- end team section -->
  @endsection