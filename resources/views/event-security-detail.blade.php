
@extends('layouts.app')

@section('content')

@section('title', 'Event Security Services | TRK Protectors UK')

@section('meta_description', 'Ensure safe and successful events with TRK Protectors’ professional event security services across the UK. Our SIA-licensed team provides crowd management, access control, and 24/7 protection for concerts, corporate events, private parties, and public gatherings.')
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
          Events  Security
        </h2>
        <h5>Security - January 7, 2026</h5>
       
      </div>
  </div>
</section>
<div class="container my-5">

    <div class="row">
            <div class="col-12">
                <h2 class="mb-3"><b>Ensuring Seamless Celebrations: TRK Protectors’ Events Security Services</b></h2>
                <p>
                From grand galas to intimate gatherings, events bring people together to celebrate, connect, and create memories. However, the success of any event relies on more than just the festivities – it hinges on the safety and security of all attendees. At TRK Protectors, we specialize in providing comprehensive events security services that ensure your gatherings are not only enjoyable but also secure.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>The Essence of Events Security</b></h3>
                <p>
                Events of all sizes and types present unique security challenges. Large crowds, varying entry points, and potential risks call for a strategic security approach that maintains a safe environment without dampening the festive spirit.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4">TRK Protectors’ Expertise in Events Security</h3>
                <p>
                Our events security services are designed to seamlessly blend security measures with the vibrant atmosphere of your event:
                </p>
                <ul>
                    <li><strong>Crowd Management:</strong>  From directing traffic to ensuring smooth entry and exit, our security personnel are skilled in managing crowds while maintaining order and safety.</li>
                    <li><strong>Access Control:</strong> We implement controlled access points to prevent unauthorized entry, ensuring that only invited guests enjoy the festivities.</li>
                    <li><strong>Risk Assessment:</strong> Our security experts conduct thorough risk assessments to identify potential vulnerabilities and develop strategies to mitigate them.</li>
                    <li><strong>Emergency Response:</strong> In case of emergencies, our team is trained to react swiftly and effectively, ensuring the safety of all attendees.</li>
                    <li><strong>Guest Safety:</strong> We prioritize the safety of your guests, offering a discreet yet vigilant presence that assures everyone can enjoy the event without worry.</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>More Than Security: Peace of Mind</b></h3>
                <p>
                While our primary focus is security, our events services extend beyond protection. By ensuring a secure environment, we enable you to host an event that leaves a lasting positive impression on your guests, enhancing their overall experience.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>Choose Confidence. Choose TRK Protectors.</b></h3>
                <p>
                  When you choose TRK Protectors for your events security needs, you’re choosing a partner that understands the intricate balance between celebration and safety. Our commitment to excellence ensures that your event remains a joyful and secure occasion for all.

                  Elevate your event security to the highest standard. Contact us today to learn more about how TRK Protectors can help you create memorable and secure events.
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
