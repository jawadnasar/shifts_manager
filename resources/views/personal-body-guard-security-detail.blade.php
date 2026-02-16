
@extends('layouts.app')

@section('content')

@section('title', 'Personal Body Guard') <!-- Set the title for this page -->
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
          Mobile Patrolling
        </h2>
        <h5>Security - January 7, 2026</h5>
      </div>
  </div>
</section>
<div class="container my-5">

    <div class="row">
            <div class="col-12">
                <h2 class="mb-3"><b>Your Shield of Protection: TRK Protectors’ Mobile Patrolling Services</b></h2>
                <p>
                  In an unpredictable world, personal safety takes precedence. Whether you’re a high-profile individual, a public figure, or someone seeking an extra layer of security, having mobile patrolling services is an essential step toward safeguarding yourself and your peace of mind. At TRK Protectors, we specialize in providing personalized and discreet mobile patrolling services that prioritize your safety above all else.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>Why Mobile Patrolling Services Matter</b></h3>
                <p>
                Personal safety extends beyond physical protection – it’s about the freedom to live your life confidently without constantly looking over your shoulder. Mobile patrolling services offer more than just a physical presence; they provide assurance, deterrence, and a sense of security in all aspects of your daily life.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>TRK Protectors’ Mobile Patrolling Expertise</b></h3>
                <p>
                Our mobile patrolling services go beyond the ordinary to deliver exceptional protection tailored to your unique needs:
                </p>
                <ul>
                    <li><strong>Trained Professionals:</strong> Our mobile patrolling officers are extensively trained, possessing the skills to assess threats, respond effectively, and ensure your safety in various situations.</li>
                    <li><strong>Discreet Protection:</strong> While your safety is our priority, we understand the importance of blending into your environment. Our mobile patrolling officers provide a protective shield without compromising your privacy.</li>
                    <li><strong>Threat Assessment:</strong> Our security experts conduct thorough threat assessments to identify potential risks and develop strategies to mitigate them, keeping you steps ahead of any potential dangers.</li>
                    <li><strong>24/7 Availability: </strong> Whether you’re traveling, attending events, or simply going about your day, our mobile patrolling services are available around the clock to ensure your safety.</li>
                    <li><strong>Customized Approach:</strong> We recognize that every individual’s security needs are unique. Our mobile patrolling services are tailored to your lifestyle, ensuring that you receive the highest level of protection.</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>More Than Protection: Empowerment</b></h3>
                <p>
                Mobile patrolling services offer more than just physical security – they empower you to live your life confidently, without fear or hesitation. Our goal is to create an environment where you can thrive and pursue your endeavors with peace of mind.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>Choose Confidence. Choose TRK Protectors.</b></h3>
                <p>
                When you choose TRK Protectors for your mobile patrolling services, you’re choosing a partner that not only understands the intricacies of personal security but also values your well-being above all else. We are dedicated to ensuring that you can navigate your world with the assurance of a capable shield by your side.

                Elevate your personal security to new heights. Contact us today to learn more about how TRK Protectors can be your trusted mobile patrolling service provider.
                </p>
            </div>
        </div>

        <!-- Leave A Reply Section -->
        <section class="reply_section layout_padding mt-5" style="background-color: #f0f0f0;">
  <div class="container">
    <div class="heading_container heading_center mb-2">
      <h2>
        Leave a Reply
      </h2>
    </div>
    <div class="">
      <div class="row">
        <div class="col-md-7 mx-auto">
        <form id="contact_form">
            @csrf
            <div class="reply_form-container">
              <div>
                <div>
                  <input type="text" placeholder="Your Full Name" name="name" class="form-control mb-3" />
                </div>
                <div>
                  <input type="email" placeholder="Your Email (Optional)" name="email" class="form-control mb-3" />
                </div>
                <div>
                <div>
                  <input type="text" placeholder="Your Phone" name="phone" class="form-control mb-3" />
                </div>
                  <textarea rows="5" placeholder="Your Comment" name="message" class="form-control mb-3"></textarea>
                </div>
                <div class="btn-box text-center">
                  <button type="submit" class="btn btn-primary">
                    Submit
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

</div>

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
  @endsection
