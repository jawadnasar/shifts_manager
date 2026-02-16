
@extends('layouts.app')

@section('content')

@section('title', 'Shopping Mall') <!-- Set the title for this page -->
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
          Shopping Malls
        </h2>
        <h5>Security - January 7, 2026</h5>
       
      </div>
  </div>
</section>
<div class="container my-5">

    <div class="row">
            <div class="col-12">
                <h2 class="mb-3"><b>Shop with Confidence: TRK Protectors’ Unwavering Shopping Mall Security</b></h2>
                <p>
                Amidst the bustling aisles, vibrant displays, and shoppers seeking their latest treasures, the importance of safety in shopping malls cannot be overstated. A secure shopping environment isn’t just a luxury – it’s a fundamental necessity that ensures visitors can explore, shop, and unwind without worry. At TRK Protectors, we specialize in providing comprehensive shopping mall security services that transform your mall into a haven of safety and comfort.
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
                <h3 class="mt-4">The Crucial Role of Shopping Mall Security</h3>
                <p>
                Shopping malls are not just retail spaces; they are thriving hubs of activity, attracting diverse crowds. With such foot traffic, it becomes imperative to address security concerns effectively. From preventing theft to responding swiftly in emergencies, shopping mall security is a multifaceted challenge.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>TRK Protectors’ Expertise in Shopping Mall Security</b></h3>
                <p>
                Our shopping mall security services are meticulously designed to cater to the unique demands of retail environments:
                </p>
                <ul>
                    <li><strong>Crowd Management:</strong> We specialize in crowd control, ensuring that the flow of visitors remains smooth and safe during peak hours and events.</li>
                    <li><strong>Loss Prevention:</strong> Our security personnel are trained to detect and deter theft, safeguarding both retailers’ assets and shoppers’ belongings.</li>
                    <li><strong>Emergency Response:</strong>  In the event of incidents such as accidents or medical emergencies, our team is equipped to provide prompt assistance, maintaining a safe atmosphere.</li>
                    <li><strong>Surveillance Solutions:</strong> Our advanced surveillance technology keeps a vigilant eye on all corners of the mall, deterring potential threats and ensuring a secure environment.</li>
                    <li><strong>Retailer Collaboration:</strong>We work closely with retailers to establish a collaborative security approach, ensuring a unified effort to maintain safety and address any challenges.</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>Creating a Pleasant Shopping Experience</b></h3>
                <p>
                While security is at the forefront of our services, we understand that a positive shopping experience goes hand in hand with safety. By ensuring a secure environment, we contribute to an atmosphere where shoppers can explore, shop, and enjoy their time without concerns.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mt-4"><b>Choose Confidence. Choose TRK Protectors.</b></h3>
                <p>
                When you choose TRK Protectors for your shopping mall security needs, you’re choosing a partner that not only understands the intricacies of mall security but also values the well-being of your visitors. Our commitment to excellence ensures that your mall remains a welcoming destination where safety and enjoyment coexist harmoniously.

                Elevate your shopping mall’s security to a new standard. Contact us today to learn more about how TRK Protectors can help create a secure and thriving shopping environment.
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
