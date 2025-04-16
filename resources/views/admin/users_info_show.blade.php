@extends('admin.layouts.admin')
@section('content')
    <div class="container-fluid">



        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="text-center rounded p-4 shadow-lg">

                <div>
                    <h2 class="font-weight-bold text-success mb-3">User Details</h2>
                    <hr class="border-success">

                    <!-- Personal Information -->
                    <h4 class="text-info">Personal Information</h4>
                    <div><b>Name:</b> {{ $user->fname }} {{ $user->sname }}</div>
                    <div><b>Email:</b> {{ $user->email }}</div>

                    <hr class="border-info">

                    <!-- Date of Birth & Gender -->
                    <h4 class="text-info">Date of Birth & Gender</h4>
                    <div><b>Date of Birth:</b> {{ $details->dob ? $details->dob : '--' }}</div>
                    <div><b>Gender:</b> {{ $details->gender }}</div>

                    <hr class="border-info">

                    <!-- Contact Information -->
                    <h4 class="text-info">Contact Information</h4>
                    <div><b>Phone:</b> {{ $details->phone }}</div>
                    <div><b>Nationality:</b> {{ $details->country->name }}</div>
                    <div><b>Current Address:</b> {{ $details->current_address }}</div>
                    <div><b>City:</b> {{ $details->city }}</div>
                    <div><b>Postcode:</b> {{ $details->postcode }}</div>

                    <hr class="border-info">

                    <!-- Other Personal Information -->
                    <h4 class="text-info">Other Personal Information</h4>
                    <div><b>NI Number:</b> {{ $details->ni_number }}</div>
                    <div><b>Right to work share code:</b> {{ $details->share_code }}</div>

                    <hr class="border-info">

                    <!-- Bank Details -->
                    <h4 class="text-info">Bank Details</h4>
                    <div><b>Name of Bank:</b> {{ $details->bank_name }}</div>
                    <div><b>Bank Address:</b> {{ $details->bank_address }}</div>
                    <div><b>Name of Account Holder:</b> {{ $details->account_holder_name }}</div>
                    <div><b>Sort Code:</b> {{ $details->sort_code }}</div>
                    <div><b>Account Number:</b> {{ $details->account_number }}</div>

                    <hr class="border-info">

                    <!-- Emergency Contact Information -->
                    <h4 class="text-info">Emergency Contact Information</h4>
                    <div><b>Contact Name:</b> {{ $details->emergency_contact_name }}</div>
                    <div><b>Relationship:</b> {{ $details->emergency_contact_relationship }}</div>
                    <div><b>Contact Number:</b> {{ $details->emergency_contact_phone }}</div>

                    <hr class="border-info">

                    <!-- SIA Licence -->
                    <h4 class="text-info">SIA Licence</h4>
                    <div><b>Licence Type:</b> {{ $details->sia_licence_type }}</div>
                    <div><b>Licence Number:</b> {{ $details->sia_licence_number }}</div>
                    <div><b>Expiry Date:</b> {{ $details->sia_licence_expiry_date }}</div>

                    <hr class="border-info">

                    <!-- Driving Licence -->
                    <h4 class="text-info">Driving Licence</h4>
                    <div><b>Driving Licence:</b> {{ $details->driving_licence_present == '1' ? 'Yes' : 'No' }}</div>
                    <div><b>Licence Type:</b> {{ $details->driving_licence_type }}</div>
                    <div><b>Licence Number:</b> {{ $details->driving_licence_number }}</div>
                    <div><b>Own Vehicle:</b> {{ $details->own_vehicle == '1' ? 'Yes' : 'No' }}</div>

                    <hr class="border-info">

                    <!-- Clearance -->
                    <h4 class="text-info">Clearance</h4>
                    <div><b>Criminal Offence Present:</b> {{ $details->criminal_offence_present == '1' ? 'Yes' : 'No' }}
                    </div>
                    <div><b>Criminal Offence Details:</b> {{ $details->criminal_offence_details }}</div>

                    <hr class="border-info">

                    <!-- Employment History -->
                    <h4 class="text-info">Employment History</h4>
                    @if (isset($employment_history) && count($employment_history) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Company</th>
                                        <th>Position</th>
                                        <th>Employer</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employment_history as $history)
                                        <tr>
                                            <td>{{ $history->from_date }}</td>
                                            <td>{{ $history->to_date }}</td>
                                            <td>
                                                <b>{{ $history->company_name }}</b><br>
                                                <small>{{ $history->company_address }}</small>
                                            </td>
                                            <td>{{ $history->position_held }}</td>
                                            <td>{{ $history->employer_name }}</td>
                                            <td>
                                                <b>Phone:</b> {{ $history->company_phone }}<br>
                                                <b>Email:</b> {{ $history->company_email }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No employment history available.</p>
                    @endif

                    <hr class="border-info">

                    <!-- Documents -->
                    <h4 class="text-info">Documents</h4>
                    <div>
                        @if (isset($documents) && count($documents) > 0)
                            <ul class="list-unstyled">
                                @foreach ($documents as $doc)
                                    <li class="border p-2 mb-2 rounded">
                                        <b>{{ $doc->doc_type }}</b> (Uploaded on: {{ $doc->created_at }})<br>
                                        {{ $doc->details }}
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#imageModal{{ $loop->index }}">
                                            <img src="{{ asset('storage/' . $doc->link) }}" width="200px" height="200px"
                                                alt="Document Image">
                                        </a>
                                    </li>

                                    <!-- Modal -->
                                    <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1"
                                        aria-labelledby="imageModalLabel{{ $loop->index }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imageModalLabel{{ $loop->index }}">
                                                        {{ $doc->doc_type }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $doc->link) }}" class="img-fluid"
                                                        alt="Document Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @else
                            <p>No documents uploaded.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Sales End -->
    @endsection

    <!-- Include Bootstrap JS if not already included -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
