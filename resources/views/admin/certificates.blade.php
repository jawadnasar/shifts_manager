@extends('admin.layouts.admin')
@section('content')

<div class="container-fluid">
            
            <!-- Recent Sales Start -->
            <div class="container-fluid">
                <div class=" text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Accredation Certificates</h6>
                      
                    </div>
                    <div class="row text-left">
                        <div class="col-lg-12 text-left">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCertificateModal">Add Certificate</button>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="certificatesTable" class="table main_table">
                            <thead>
                                <tr>
                                <th scope="col">Sr.#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        
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

<div class="modal fade" id="EditCertificateModal" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_header">Edit Certificate</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="EditForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
           

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label for="logo">Existing Image</label>
                    <img id="old_logo" alt="" class="w-100">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary" id="productFormBtn">Update</button>
        </div>
    </form>

    </div>
  </div>
</div>

@endsection

@section('javascript')
  @include('admin.certificates-js')                   
@endsection



