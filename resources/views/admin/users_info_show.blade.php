@extends('admin.layouts.admin')
@section('content')
    <div class="container-fluid">



        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="text-center rounded p-4 shadow-lg">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0 text-primary">Users List</h6>
                </div>

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
                    <div><b>Criminal Offence Present:</b> {{ $details->criminal_offence_present == '1' ? 'Yes' : 'No' }}</div>
                    <div><b>Criminal Offence Details:</b> {{ $details->criminal_offence_details }}</div>

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
                                        <img src="{{asset('storage/'.$doc->link)}}" width="200px" height="200px" alt="Document Image">
                                    </li>
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
