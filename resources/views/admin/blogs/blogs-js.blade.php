<script>
    $(document).on('click', '.delete-blog', function(e) {
        e.preventDefault(); // Prevent the default link behavior

        var blogId = $(this).data('id'); // Get the category ID from the data attribute

        // Call the deleteCategory function with the category ID
        deleteSubCategory(blogId);
    });

    // New funtion for deleting sub category
    function deleteSubCategory(blogId) {
    // Show confirmation dialog
    Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'This action cannot be undone. Do you want to proceed?',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'No, cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#loading').show(); // Show the loader
            // Send AJAX request to delete the subcategory
            $.ajax({
                type: "DELETE",
                url: "{{ route('blogs.destroy', ':id') }}".replace(':id', blogId),
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#loading').hide(); // Hide the loader
                    if (data.status === 'success') {
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.msg,
                            confirmButtonText: 'OK'
                        }).then(function() {
                            // Reload the page or perform any other action
                            window.location.reload();
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.msg,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(request, status, error) {
                    $('#loading').hide(); // Hide the loader
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while deleting the blog.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
}


// filter

function fetchFilteredBlogs() {
    var formData = $('#blog_filter_form').serialize();

    $('#loading').show(); // optional: loader

    $.ajax({
        type: "GET",
        url: "{{ route('blogs.getall_filtered') }}",
        data: formData,
        success: function(html) {
            $('#loading').hide();
            $('#blogs_table_container').html(html); // replace table container
        },
        error: function(xhr) {
            $('#loading').hide();
            toastr.error('An error occurred: ' + xhr.responseText);
        }
    });
}

$('#blog_filter_form').submit(function(e) {
    e.preventDefault();
    fetchFilteredBlogs();
});

function resetBlogFilters() {
    $('#blog_filter_form')[0].reset();
    fetchFilteredBlogs();
}

</script>