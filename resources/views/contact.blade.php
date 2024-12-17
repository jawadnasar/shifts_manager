@extends('layouts.app')

@section('content')

@section('title', 'Contact') <!-- Set the title for this page -->
<style>
  .hero_area {
  min-height: 60vh!important;
}
</style>
  <!-- contact section -->
  <div class="row mb-3 mt-4">
    <div class="col-lg-12">
        <div class="container">
            <section class="contact-section">
                <h2>Contact 24/7</h2>
                <div class="contact-info">
                    
                    <div>
                        <img src="{{ asset('front-theme/images/phone.png') }}" alt="Phone">
                        <span>Now +44 7404 989621</span>
                        &nbsp;&nbsp;&nbsp;
                        <img src="{{ asset('front-theme/images/email.png') }}" alt="Email">
                        <span>trkprotectors@gmail.com</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

  <section class="contact_section layout_padding">
    <div class="contact_bg_box">
      <div class="img-box">
        <img src="{{ asset('front-theme/images/contact-bg.jpg') }}" alt="">
      </div>
    </div>
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
        Send us a Message
        </h2>
        
      </div>
      <div class="">
        <div class="row">
          <div class="col-md-7 mx-auto">
          <form id="contact_form">
              @csrf
              <div class="contact_form-container">
                <div>
                  <div>
                    <input type="text" name="name" placeholder="Your Full Name" />
                  </div>
                  <div>
                  <input type="email" name="email" placeholder="Your Email (Optional)" />

                  </div>
                  <div>
                    <input type="text" name="phone" placeholder="Your Phone Number" />
                  </div>
                  <div class="">
                    <input type="text" name="message" placeholder="Your Message" class="message_input" />
                  </div>
                  <div class="btn-box ">
                    <button type="submit">
                      Send
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
<br><br><br>
<script>
    $(document).ready(function() {
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#contact_form').on('submit', function(e) {
          
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "{{ route('contact.add') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.msg,
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = "{{ route('home') }}";
                        });
                    } else {
                        toastr.error('Oops, Error: ' + data.msg);
                    }
                },
                error: function(request, status, error) {
                    $("#loading").hide();

                    if(request.status === 422) {
                        var errors = request.responseJSON.errors;
                        console.log(errors); // Debugging: log errors to console
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]); // Display the first validation message
                            $('#' + key).focus();
                            return false; // Focus on the first error field and break the loop
                        });
                    } else {
                        toastr.error('Oops, Error: ' + request.responseText + ' :(');
                    }
                }
            });
        });
    });
</script>
 

  <!-- end team section -->
  @endsection

  