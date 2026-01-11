<!-- If you're using Summernote or any rich text editor -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });


    // submitting the form
    $('#blogForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#loading").show();
        $.ajax({
            type: "post",
            url: "{{ route('blogs.update') }}",
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
            success: function(data) {
                $("#loading").hide();
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.msg,
                        allowOutsideClick: false,
                        confirmButtonText: 'OK'
                    }).then(function() {
                        $('#blogForm')[0].reset();
                        window.location.href = "{{ route('blogs.index') }}";
                    });
                } else {
                    toastr.error('Oops, Error: ' + data.msg);
                }
            },
            error: function(request, status, error) {
                $("#loading").hide();
                toastr.error('Oops, Error: ' + request.responseText + ' :(');
            }
        });
    });
</script>