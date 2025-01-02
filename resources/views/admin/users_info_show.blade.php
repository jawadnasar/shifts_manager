@extends('admin.layouts.admin')
@section('content')
    <div class="container-fluid">



        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class=" text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Users List</h6>

                </div>

                <div>
                    <div>
                        <h2>User Details</h2>
                        <hr>

                        <!-- Personal Information -->
                        <h4>Personal Information</h4>
                        <div>Name: {{ $user->fname }} {{ $user->sname }}</div>
                        <div>Email: {{ $user->email }}</div>

                        <hr>

                        <!-- Date of Birth & Gender -->
                        <h4>Date of Birth & Gender</h4>
                        <div>Date of Birth: {{ $details->dob }}</div>
                        <div>Gender: {{ $details->gender }}</div>

                        <hr>

                        <!-- Contact Information -->
                        <h4>Contact Information</h4>
                        <div>Phone: {{ $details->phone }}</div>
                        <div>Birth Place: {{ $details->birth_place }}</div>
                        <div>Nationality: {{ $details->nationality }}</div>
                        <div>Current Address: {{ $details->current_address }}</div>
                        <div>City: {{ $details->city }}</div>
                        <div>Postcode: {{ $details->postcode }}</div>

                        <hr>

                        <!-- Other Personal Information -->
                        <h4>Other Personal Information</h4>
                        <div>NI Number: {{ $details->ni_number }}</div>
                        <div>Share Code: {{ $details->share_code }}</div>

                        <hr>

                        <!-- Emergency Contact Information -->
                        <h4>Emergency Contact Information</h4>
                        <div>Contact Name: {{ $details->emergency_contact_name }}</div>
                        <div>Relationship: {{ $details->emergency_contact_relationship }}</div>
                        <div>Contact Number: {{ $details->emergency_contact_phone }}</div>

                        <hr>

                        <!-- SIA Licence -->
                        <h4>SIA Licence</h4>
                        <div>Licence Type: {{ $details->sia_licence_type }}</div>
                        <div>Licence Number: {{ $details->sia_licence_number }}</div>
                        <div>Expiry Date: {{ $details->sia_licence_expiry_date }}</div>

                        <hr>

                        <!-- Driving Licence -->
                        <h4>Driving Licence</h4>
                        <div>Driving Licence: {{ $details->driving_licence_present == '1' ? 'Yes' : 'No' }}</div>
                        <div>Licence Type: {{ $details->driving_licence_type }}</div>
                        <div>Licence Number: {{ $details->driving_licence_number }}</div>
                        <div>Own Vehicle: {{ $details->own_vehicle == '1' ? 'Yes' : 'No' }}</div>

                        <hr>

                        <!-- Clearance -->
                        <h4>Clearance</h4>
                        <div>Criminal Offence Present: {{ $details->criminal_offence_present == '1' ? 'Yes' : 'No' }}</div>
                        <div>Criminal Offence Details: {{ $details->criminal_offence_details }}</div>

                        <hr>

                        <!-- Documents -->
                        <h4>Documents</h4>
                        <div>
                            @if (isset($documents) && count($documents) > 0)
                                <ul>
                                    @foreach ($documents as $doc)
                                        <li>{{ $doc->doc_type }} (Uploaded on: {{ $doc->created_at }})
                                            {{ $doc->details }}
                                            <img src="{{asset('storage/'.$doc->link)}}" width="200px" height="200px" alt="" srcset="">
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
        </div>
        <!-- Recent Sales End -->
    @endsection
