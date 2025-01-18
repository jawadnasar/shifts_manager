@extends('admin.layouts.admin')
@section('content')

<div class="container-fluid">
    <!-- Recent Sales Start -->
    <div class="container-fluid">
        <div class="text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Users Templates</h6>
                <!-- Button to trigger Add New Template Modal -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTemplateModal">Add New Template</button>
            </div>

            <br>
            <div class="row">
            <div class="table-responsive">
                <table id="templateTable" class="table main_table">
                    <thead>
                        <tr>
                            <th scope="col">Sr.#</th>
                            <th scope="col">Template Name</th>
                            <th scope="col">Subject Line</th>
                            <th scope="col">Email Body</th>
                            <th scope="col">Email Footer</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $key => $template)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $template->template_name }}</td>
                                <td>{{ $template->subject_line ?? 'N/A' }}</td>
                                <td>{{ $template->body }}</td>
                                <td>{{ $template->footer }}</td>
                                <td>
                                    <a href="{{ route('preview_email_template', ['template_id'=>1]) }}" class="btn btn-primary">Use</a>
                                    {{-- <button class="btn btn-primary edit-template-btn" data-id="{{ $template->id }}"> --}}

                                <button 
                                        class="btn btn-danger delete-template-btn" 
                                        data-id="{{ $template->id }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteConfirmationModal">
                                        Delete
                                    </button>

                                    <button 
                                        class="btn btn-primary edit-template-btn" 
                                        data-id="{{ $template->id }}" 
                                        data-template_name="{{ $template->template_name }}" 
                                        data-subject_line="{{ $template->subject_line }}" 
                                        data-body="{{ $template->body }}" 
                                        data-footer="{{ $template->footer }}" 
                                        data-image="{{ $template->image }}"> <!-- Update the path as per your setup -->
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    <!-- Add New Template Modal -->
    <div class="modal fade" id="addTemplateModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="template_form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="template_name" class="form-label">Template Name</label>
                            <input type="text" name="template_name" id="template_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="subject_line" class="form-label">Subject Line</label>
                            <input type="text" name="subject_line" id="subject_line" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Email Body</label>
                            <textarea name="body" id="body" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="footer" class="form-label">Email Footer</label>
                            <textarea name="footer" id="footer" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="subject_line" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Template</button>
                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Email Template Modal -->
    <div class="modal fade" id="editTemplateModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit_template_form">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="template_id" id="edit_template_id">
                        <div class="mb-3">
                            <label for="edit_template_name" class="form-label">Template Name</label>
                            <input type="text" name="template_name" id="edit_template_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_subject_line" class="form-label">Subject Line</label>
                            <input type="text" name="subject_line" id="edit_subject_line" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_body" class="form-label">Email Body</label>
                            <textarea name="body" id="edit_body" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_footer" class="form-label">Email Footer</label>
                            <textarea name="footer" id="edit_footer" class="form-control" rows="2"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit_image" class="form-label">Image</label>
                            <input type="file" name="image" id="edit_image" class="form-control">
                            <small class="form-text text-muted">Leave empty to keep the current image.</small>
                            <div id="edit_current_image_preview" class="mt-2">
                                <!-- Placeholder for displaying current image -->
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Template</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</div>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    $('#template_form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission behavior
        var formData = new FormData(this);
        var imageFile = $('#image')[0].files[0]; 
        formData.append('image', imageFile); 

        $("#loading").show();

        $.ajax({
            type: "post",
            url: "{{ route('templates.save') }}",
            data: formData,
            processData: false, // Prevent jQuery from automatically processing the data
            contentType: false, // Prevent jQuery from setting content type
            success: function(data) {
                $("#loading").hide();
                if (data.status === 'success') {
                    toastr.success('Done: ' + data.msg);
                    $('#addTemplateModal').modal('hide');
                    $('#template_form')[0].reset();
                    location.reload(); // Refresh the page
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

    // Edit modal opening
    $(document).on('click', '.edit-template-btn', function() {
        // Retrieve data attributes from the button
        const templateId = $(this).data('id');
        const templateName = $(this).data('template_name');
        const subjectLine = $(this).data('subject_line');
        const body = $(this).data('body');
        const footer = $(this).data('footer');
        const image = $(this).data('image'); // Get the image file name

        // Populate modal fields
        $('#edit_template_id').val(templateId);
        $('#edit_template_name').val(templateName);
        $('#edit_subject_line').val(subjectLine);
        $('#edit_body').val(body);
        $('#edit_footer').val(footer);

        // Display the current image
        const imagePreview = $('#edit_current_image_preview');
        if (image) {
            const imageUrl = `/storage/email_templates/${image}`;
            imagePreview.html(
                `<img src="${imageUrl}" alt="Template Image" class="img-fluid rounded" width="100" height="auto">`
            );
            $('#existing_image').val(image); // Set hidden input for existing image
        } else {
            imagePreview.html('<p>No image available.</p>');
            $('#existing_image').val(''); // Clear the hidden input for existing  image
        }

        // Show the modal
        $('#editTemplateModal').modal('show');
    });



    $('#edit_template_form').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission behavior
        var formData = new FormData(this);

        $("#loading").show();

        $.ajax({
            type: "post",
            url: "{{ route('templates.edit') }}",
            data: formData,
            processData: false, // Prevent jQuery from automatically processing the data
            contentType: false, // Prevent jQuery from setting content type
            success: function (data) {
                $("#loading").hide();
                if (data.status === 'success') {
                    toastr.success('Done: ' + data.msg);
                    $('#editTemplateModal').modal('hide');
                    $('#edit_template_form')[0].reset();
                    location.reload(); // Refresh the page
                } else {
                    toastr.error('Oops, Error: ' + data.msg);
                }
            },
            error: function (request, status, error) {
                $("#loading").hide();
                toastr.error('Oops, Error: ' + request.responseText + ' :(');
            }
        });
    });





    // old js:
    $(document).on('click', '.delete-template-btn', function() {
    var id = $(this).data('id');  // Get the template ID from the button's data attribute

    Swal.fire({
        title: 'Are you sure you want to delete this template?',
        text: 'You won\'t be able to revert this action!',
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
                url: "{{ route('templates.delete') }}",  // Adjust the route for template deletion
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $("#loading").hide();

                    if (data.status === 'success') {
                        toastr.success('Template deleted successfully!');
                        window.location.reload();  // Refresh the page to reflect the change
                    } else {
                        toastr.error('Oops, Error: ' + data.msg);
                    }
                },
                error: function(request, status, error) {
                    $("#loading").hide();
                    toastr.error('Oops, Error: ' + request.responseText);
                }
            });
        }
    });
});



</script>
@endsection
