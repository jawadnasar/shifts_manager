@extends('admin.layouts.admin')
@section('content')

<div class="container-fluid">
            <!-- Recent Sales Start -->
            
                <div class=" text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Accredation Certificates</h6>
                      
                    </div>
                    <div class="row row-on-table-top btns-right mb-3">
                        <div class="col-lg-12 text-left">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCertificateModal"><i class="fa fa-plus"></i>&nbsp;Add Certificate</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="certificatesTable" class="table main_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.#</th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($certificates as $key => $certificate)
                                            <tr>
                                                <td>{{ $key + 1 }}</td> <!-- Serial number -->
                                                <td>
                                                    {{ $certificate->company_name }}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('storage/certificates/' . $certificate->logo) }}" alt="Certificate Logo" width="100" height="auto">
                                                </td>
                                                <td>
                                                    <button id="delete-btn" class="delete-term-btn btn btn-primary" data-id="{{ $certificate->id }}">Delete</button>
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

            



<!-- Modals to add and edit certificates -->
<div class="modal fade" id="AddCertificateModal" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_header">Add New Certificate</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="certificateForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter company name">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label for="logo">Certificate/Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary" id="productFormBtn">Submit</button>
        </div>
    </form>
    </div>
  </div>
</div><!-- Add Product Modal Ends-->

@endsection

@section('javascript')
  @include('admin.certificates-js')                   
@endsection



