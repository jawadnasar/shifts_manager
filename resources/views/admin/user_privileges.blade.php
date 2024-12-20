@extends('admin.layouts.admin')
@section('content')
    <div class="container-fluid">
        
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class=" text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Users List</h6>

                </div>
                <h2>User Privileges</h2>
                <form action="{{ route('admin.user_privileges.update', $user->id) }}" method="POST">
                    @method('patch')
                    @csrf
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_setprivileges">Set Privileges</label>
                                    <input type="checkbox" id="pri_setprivileges" name="pri_setprivileges" @if($user->pri_setprivileges) checked @endif>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_addreceipt">Add Receipt</label>
                                    <input type="checkbox" id="pri_addreceipt" name="pri_addreceipt" @if($user->pri_addreceipt) checked @endif>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_editreceipt">Edit Receipt</label>
                                    <input type="checkbox" id="pri_editreceipt" name="pri_editreceipt" @if($user->pri_editreceipt) checked @endif>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_addjournal">Add Journal</label>
                                    <input type="checkbox" id="pri_addjournal" name="pri_addjournal" @if($user->pri_addjournal) checked @endif>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_editjournal">Edit Journal</label>
                                    <input type="checkbox" id="pri_editjournal" name="pri_editjournal" @if($user->pri_editjournal) checked @endif>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_addpayment">Add Payment</label>
                                    <input type="checkbox" id="pri_addpayment" name="pri_addpayment" @if($user->pri_addpayment) checked @endif>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_editpayment">Edit Payment</label>
                                    <input type="checkbox" id="pri_editpayment" name="pri_editpayment" @if($user->pri_editpayment) checked @endif>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_addexpenses">Add Expenses</label>
                                    <input type="checkbox" id="pri_addexpenses" name="pri_addexpenses" @if($user->pri_addexpenses) checked @endif>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_editexpenses">Edit Expenses</label>
                                    <input type="checkbox" id="pri_editexpenses" name="pri_editexpenses" @if($user->pri_editexpenses) checked @endif>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="pri_adduser">Add User</label>
                                    <input type="checkbox" id="pri_adduser" name="pri_adduser" @if($user->pri_adduser) checked @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>

        </div>
        <!-- Recent Sales End -->
    @endsection
