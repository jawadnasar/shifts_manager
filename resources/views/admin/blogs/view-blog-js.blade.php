<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var previousValue = $('#is_active').val();
$('#is_active').change(function() {
    // Show confirmation dialog
    Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'Changing the status will update the blog status. Do you want to proceed?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form
            submitForm();
        }else {
            // Reset the value of the select element
            $('#is_active').val(previousValue);
        }
    });
});

function submitForm() {
    // Show loading indicator
    $("#loading").show();

    // Serialize form data
    var formData = $('#change_status_form').serialize();

    // Send AJAX request
    $.ajax({
        type: "POST",
        url: "{{ route('blogs.update_status') }}",
        dataType: 'json',
        data: formData,
        success: function(data) {
            $("#loading").hide(); // Hide loading indicator

            if (data.status === 'success') {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.msg,
                    allowOutsideClick: false,
                    confirmButtonText: 'OK'
                }).then(function() {
                    // Redirect to the order detail page
                  
                    // window.location.reload();
                    window.location.href = "{{ route('blogs.index') }}";
                });
            } else {
                // Show error message
                toastr.error('Oops, Error: ' + data.msg);
            }
        },
        error: function(request, status, error) {
            $("#loading").hide(); // Hide loading indicator
            toastr.error('Oops, Error: ' + request.responseText + ' :('); // Show error message
        }
    });
}

</script>