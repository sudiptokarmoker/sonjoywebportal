@extends('backend.layouts.master_v2')
@section('title')
Create User
@endsection
@section('active_breadcumbs_title')
Create User
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Create User Form</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <!-- new data table start -->
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Create User</b></h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('users.store') }}" method="POST" class="p20" autocomplete="off">
                            @csrf
                            <div class="form">
                                <div class="form-floating mb-3">
                                    <input type="text" name="full_name" id="txtFullName" class="form-control" placeholder="type user full name" />
                                    <label for="txtFullName">Full Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" id="txtUserPassword" class="form-control" placeholder="type password" />
                                    <label for="txtUserPassword">Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password_confirmation" id="txtUserConfirmPassword" class="form-control" placeholder="type password" />
                                    <label for="txtUserConfirmPassword">Confirm Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" id="txtUserEmail" class="form-control" placeholder="type email address" />
                                    <label for="txtUserEmail">Type Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="mobile_number" id="txtMobileNumber" class="form-control" placeholder="type mobile number" />
                                    <label for="txtMobileNumber">Type Mobile Number</label>
                                </div>
                                <div class="form-group">
                                    <label for="lstRolesList">select multiple roles</label>
                                    {{-- <select name="roles[]" multiple class="form-control select2" id="lstRolesList" name="lstRolesList"> --}}
                                    <select name="roles[]" class="form-select select2" id="lstRolesList" multiple aria-label="multiple select example">
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- new data table end -->
    </div>
</div> <!-- container -->
@endsection
@section('on_demand_footer_script_if_exist')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection
@section('after_domready_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });

</script>
@endsection
