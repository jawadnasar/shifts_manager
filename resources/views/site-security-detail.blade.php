
@extends('layouts.app')

@section('content')

@section('title', 'Site Security') <!-- Set the title for this page -->
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
          Site  Security
        </h2>
        <h5>Security - August 7, 2023</h5>
       
      </div>
  </div>
</section>
<div class="container my-5">

    <div class="row">
            <div class="col-12">
                <h2 class="mb-3"><b>Enhancing Security and Hospitality: TRK Protectors' Reception Services</b></h2>
                <p>
                    In today’s ever-evolving world, security isn’t just about protection; it’s also about creating an 
                    environment of trust and comfort. At TRK Protectors, we understand the critical role that reception 
                    services play in both security and hospitality. That’s why we take pride in offering reception 
                    services that seamlessly blend professionalism, warmth, and vigilance.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>The Reception's Dual Role</b></h3>
                <p>
                    Reception areas serve as the first point of contact for visitors, clients, and employees. This dual 
                    role of being a gateway to your premises and a representation of your organization’s values makes 
                    reception security a vital aspect of your overall security strategy.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4">A Warm Welcome with Vigilant Eyes</h3>
                <p>
                    Our reception services embody the perfect balance between hospitality and security. Our highly trained 
                    professionals not only extend a warm welcome to everyone who walks through your doors but also keep 
                    a watchful eye on any potential security threats.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>Key Benefits of TRK Protectors’ Reception Services</b></h3>
                <ul>
                    <li><strong>Expert Personnel:</strong> Our receptionists are trained to handle various situations with tact and professionalism. They excel in customer service while also being prepared to handle security challenges.</li>
                    <li><strong>Access Control:</strong> We implement strict access control measures to ensure that only authorized individuals gain entry to your premises. This helps prevent unauthorized access and maintains a secure environment.</li>
                    <li><strong>Emergency Response:</strong> Our reception team is trained to handle emergencies efficiently. Whether it’s a medical situation, a security breach, or any other crisis, they act promptly and effectively.</li>
                    <li><strong>Visitor Management:</strong> We manage visitor registration, identity verification, and visitor badges to keep track of who enters and exits your premises, enhancing overall security.</li>
                    <li><strong>Customization:</strong> We understand that every organization is unique. Our reception services are customizable to meet your specific needs, ensuring a seamless integration into your operations.</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>Beyond Security: Creating Positive Impressions</b></h3>
                <p>
                    While security remains our top priority, we also recognize the importance of leaving a positive 
                    impression on everyone who enters your space. A welcoming and secure reception area sets the tone 
                    for a successful and productive interaction, whether it’s a client meeting, a job interview, or a 
                    quick routine.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>Choose Confidence. Choose TRK Protectors.</b></h3>
                <p>
                    When you choose TRK Protectors for your reception security needs, you’re choosing a partner that values 
                    both your security and your reputation. We seamlessly blend our expertise in security with a commitment 
                    to providing a warm and welcoming experience for everyone.
                </p>
                <p>
                    Enhance your security and elevate your hospitality with TRK Protectors’ reception services. Contact us 
                    today to learn more about how we can create a secure and inviting environment for your premises.
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
