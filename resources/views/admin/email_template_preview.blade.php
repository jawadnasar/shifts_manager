@extends('admin.layouts.admin')
@section('content')
    <!-- Recent Sales Start -->
<div class="container-fluid">
    <!-- Email Editing Section -->
    <div class="text-center rounded p-4 mt-5">
        <form id="send_email_form" action="{{route('send_email')}}"  method="POST">
            @csrf <!-- CSRF token for security -->

            <div class="row mb-3">
                <div class="col-md-10">
                    <img src="{{ asset('front-theme/images/main_logo.png') }}" alt=""
                    style="width:120px;height:120px;">
                </div>
            </div>
<!-- 
            <div class="row mb-3">
                <label for="from_email" class="col-form-label col-md-2 text-left">From:</label>
                <div class="col-md-10">
                    <input type="email" name="from_email" id="from_email" class="form-control" 
                           value="{{ env('MAIL_FROM_ADDRESS') }}">
                </div>
            </div> -->

            <div class="row mb-3">
                <label for="email" class="col-form-label col-md-2 text-left">To:</label>
                <div class="col-md-10">
                    <input type="text" name="to_email" id="to_email" class="form-control" 
                           placeholder="For many emails, separate them with a semicolon">
                </div>
            </div>

            <div class="row mb-3">
                <label for="subject" class="col-form-label col-md-2 text-left">Subject:</label>
                <div class="col-md-10">
                    <input type="text" name="subject" id="subject" class="form-control" 
                           value="{{ $template->subject_line }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="subject" class="col-form-label col-md-2 text-left">Attached Image:</label>
                <div class="col-md-10">
                    <input type="hidden" name="image" value="{{ $template->image }}">

                    <img src="{{ asset('storage/email_templates/' . $template->image) }}" alt="Image"
                    style="width:120px;height:120px;">
                </div>
            </div>


            <div class="row mb-3">
                <label for="email_body" class="col-form-label col-md-2 text-left">Body:</label>
                <div class="col-md-10">
                    <textarea name="email_body" id="email_body" class="form-control" rows="5">
                        {{ $template->body }} {{ Auth::user()->name }}
                    </textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="email_footer" class="col-form-label col-md-2 text-left">Footer:</label>
                <div class="col-md-10">
                    <input type="text" name="email_footer" id="email_footer" class="form-control" value=" {{ $template->footer }}">
                       
                </div>
            </div>

            <div name='email_company_info_footer' contenteditable="true" class="row">
                <div class="col-md-10">
                    <div style="text-align:center;">
                        <p>
                            <img src="{{ asset('front-theme/images/main_logo.png') }}" alt=""
                            style="width:120px;height:120px;">
                        </p>
                        <p>
                            Follow us:
                            <a href="#"><img src="{{ asset('front-theme/images/fb.png') }}" alt="Facebook"></a>
                            <a href="#"><img src="{{ asset('front-theme/images/x.png') }}" alt="Twitter"></a>
                        </p>
                        <p>&copy; {{ date('Y') }} TRK Protectors. All rights reserved.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#send_email_form').on('submit', function(e) {
     e.preventDefault(); // Prevent default form submission behavior

     var formData = new FormData(this);

     $("#loading").show();

//      $.ajax({
//          type: "post",
//          url: "{{ route('send_email') }}",
//          data: formData,
//          processData: false, // Prevent jQuery from automatically processing the data
//          contentType: false, // Prevent jQuery from setting content type
//          success: function(data) {
//              $("#loading").hide();
//              if (data.status === 'success') {
//                  toastr.success('Done: ' + data.msg);
//                  $('#send_email_form')[0].reset();
//                  location.reload(); // Refresh the page
//              } else {
//                  toastr.error('Oops, Error: ' + data.msg);
//              }
//          },
//          error: function(request, status, error) {
//              $("#loading").hide();
//              toastr.error('Oops, Error: ' + request.responseText + ' :(');
//          }
//      });
//  });

</script>

@endsection
