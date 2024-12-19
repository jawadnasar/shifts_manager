<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    $('#certificateForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission behavior
        var formData = new FormData(this);
        var imageFile = $('#logo')[0].files[0]; 
        formData.append('logo', imageFile); 

        $("#loading").show();

        $.ajax({
            type: "post",
            url: "{{ route('certificates.save') }}",
            data: formData,
            processData: false, // Prevent jQuery from automatically processing the data
            contentType: false, // Prevent jQuery from setting content type
            success: function(data) {
                $("#loading").hide();
                if (data.status === 'success') {
                    toastr.success('Done: ' + data.msg);
                    $('#AddCertificateModal').modal('hide');
                    $('#certificateForm')[0].reset();
                    reloadDataTable();
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

  
    //Delete Product Ajax Request
    $(document).on('click', '#delete-btn', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure to delete?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the deletion
                $("#loading").show();

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('certificates.delete') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $("#loading").hide();

                        if (data.status === 'success') {
                            toastr.success('Done: ' + data.msg);
                            window.reload();
                        } else {
                            toastr.error('Oops, Error: ' + data.msg);
                        }
                    },
                    error: function(request, status, error) {
                        $("#loading").hide();

                        toastr.error('Oops, Error: ' + request.responseText + ' :(');
                    }
                });
            }
        });
    });


</script>