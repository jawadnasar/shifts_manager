<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    var dataTable;
    // Initialize DataTable
    function initializeDataTable(data) {
        if (dataTable) {
            // Destroy it first
            dataTable.destroy();
        }

        // Add serial number to each row of data
        data.forEach((item, index) => {
            item.serialNumber = index + 1;
        });

        dataTable = $('#certificatesTable').DataTable({
            processing: true,
            serverside: true,
            data: data,
            columns: [
                { data: 'serialNumber', title: 'Sr.#' }, // Add serial number column
                { 
                    data: 'logo', title: 'Image',
                    render: function(data, type, full, meta) {
                            // Display the logo image
                            return '<img src="' + '{{ asset('storage/images/certificates') }}/' + data + '" alt="Company Logo" style="max-width: 100px;">';
                    }
                },
               
            
                {
                    data: 'id',
                    render: function(data, type, full, meta) {
                        return `<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="actionDropdown-${data}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="actionDropdown-${data}">
                                    <li><a id="edit-company-btn" class="dropdown-item edit-term-btn" data-id="${data}" data-logo="${full.logo}" data-company-name="${full.company_name}" data-company-phone="${full.company_phone}" data-company-email="${full.company_email}" data-company-address="${full.company_address}">Edit</a></li>
                                    <li><a id="delete-btn" class="dropdown-item delete-term-btn text-danger" data-id="${data}" href="#">Delete</a></li>
                                </ul>`;
                    }
                }
            ]
        });
    }

    // Function to fetch data and initialize DataTable
    function fetchDataAndInitializeTable() {
        $("#loading").show();

        $.ajax({
            type: "get",
            url: "{{ route('certificates.getall') }}",
            success: function(data) {
             $("#loading").hide();

                if (data.error) {
                    toastr.error('Oops, Error: ' + data.error);
                } else {
                    initializeDataTable(data.data);
                }
            },
            error: function(request, status, error) {
                $("#loading").hide();

                toastr.error('Oops, Error: ' + request.responseText + ' :(');
            }
        });
    }

    $(document).ready(function() {
        // Call the function to fetch data and initialize DataTable on page load
        fetchDataAndInitializeTable();

    });

       // Function to reload DataTable after add, edit and delete processes
    function reloadDataTable() {
        // Clear & Redraw 
        dataTable.clear().rows.add(fetchDataAndInitializeTable()).draw(false);
    }

    //Add New User AJAX
    

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





     // Edit Role Process

     $(document).on('click', '#edit-company-btn', function() {
        // Get the data attributes from the button
        var id = $(this).data('id');
        var logo = $(this).data('logo');
        var logoPath = '{{ asset('storage/images/certificates') }}/' + logo; 
        $('#old_logo').attr('src', logoPath);

       

        // Set the values in the modal fields
        $('#id').val(id);
       
        
        // Set the selected product in the dropdown
        $('#old_logo')

        // Show the modal
        $('#EditCompanyModal').modal('show');
    });


    //Edit Product Ajax Request
    $('#EditForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        // Check if image file exists
        if ($('#logo')[0].files.length > 0) {
            var imageFile = $('#logo')[0].files[0];
            formData.append('logo', imageFile);
        }

        $("#loading").show();
        $.ajax({
            type: "post",
            url: "{{ route('certificates.edit') }}", // Correct route name
            dataType: 'json',
            data: formData,
            processData: false,  // Important: Don't process data
            contentType: false,  // Important: Don't set content type
            success: function(data) {
                $("#loading").hide();
                if (data.status === 'success') {
                    toastr.success('Done: ' + data.msg);
                    $('#EditCompanyModal').modal('hide');
                    $('#EditForm')[0].reset();
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
            }
        });
    });


</script>