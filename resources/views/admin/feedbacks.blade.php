
@extends('admin.layouts.admin')
@section('content')

<div class="container-fluid">
            <!-- Recent Sales Start -->
            <div class="container-fluid">
                <div class=" text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Users Feedbacks</h6>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="feedbackTable" class="table main_table">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedbacks as $key => $feedback)
                                    <tr>
                                        <td>{{ $key + 1 }}</td> <!-- Serial number -->
                                        <td>{{ $feedback->name }}</td>
                                        <td>{{ $feedback->email ?? 'N/A' }}</td> <!-- Display 'N/A' if email is null -->
                                        <td>{{ $feedback->phone }}</td>
                                        <td>{{ $feedback->message }}</td>
                                        <td>
                                            <button 
                                                class="btn btn-primary view-details-btn" 
                                                data-name="{{ $feedback->name }}" 
                                                data-email="{{ $feedback->email }}" 
                                                data-phone="{{ $feedback->phone }}" 
                                                data-message="{{ $feedback->message }}"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailsModal">
                                                View Details
                                            </button>                                    
                                            <!-- <form action="{{ route('feedbacks.delete', $feedback->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->

<div class="modal fade" id="detailsModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_header">Feedback Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <strong>Name:</strong> <span id="feedback-name"></span>
                </div>
                <div class="mb-3">
                    <strong>Email:</strong> <span id="feedback-email"></span>
                </div>
                <div class="mb-3">
                    <strong>Phone:</strong> <span id="feedback-phone"></span>
                </div>
                <div class="mb-3">
                    <strong>Message:</strong>
                    <p id="feedback-message"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '.view-details-btn', function () {
    // Get data attributes from the button
    const name = $(this).data('name');
    const email = $(this).data('email');
    const phone = $(this).data('phone');
    const message = $(this).data('message');

    // Set the modal content
    $('#feedback-name').text(name);
    $('#feedback-email').text(email ? email : 'N/A'); // Display 'N/A' if email is null
    $('#feedback-phone').text(phone);
    $('#feedback-message').text(message);
});

</script>
@endsection

