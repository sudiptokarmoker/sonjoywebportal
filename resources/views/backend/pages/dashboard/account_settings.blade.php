@extends('backend.layouts.master_v2')
@section('title')
Edit Account Settings
@endsection
@section('active_breadcumbs_title')
Edit Account Settings
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Account Settings</h4>
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
                <h4 class="header-title"><b>Edit User : {{ $user->full_name }}</b></h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <!-- main form start -->
                        <form autocomplete="off" action="{{ route('admin.home.account.settings.submit', $user->id) }}" method="POST" id="form-edit-user" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form">
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="name">Full name</label>
                                        <input type="text" class="form-control" id="name" name="full_name" placeholder="Enter Full Name" value="{{ $user->full_name }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label for="email">User Email</label>
                                    <input readonly type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $user->email }}">
                                </div>
                                <div class="form-row">
                                    @if($userMediaInfoModel != null && file_exists('storage/images/profile_image/'.$userMediaInfoModel->profile_image))
                                        <img src="{{ asset('storage/images/profile_image/'.$userMediaInfoModel->profile_image) }}" alt="" title="{{ $user->firstname }}" width="60"/>
                                    @endif
                                    <label for="profile_image">Upload Profile Image</label>
                                    <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                                </div>
                                <div class="form-row">
                                    <button onclick="toggle_password()" class="btn btn-link btn-toggle-password" type="button">Open change password field</button>
                                </div>
                                <div class="wrap-password-change"></div>
                                <div class="save-button-form-v1">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Account Information</button>
                                </div>
                            </div>
                        </form>
                        <!-- main form end -->
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
<script type="text/javascript" src="{{ asset('backend/assets/js/role-functions-list.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/onload-scripts.js') }}"></script>
@endsection
@section('after_domready_script')
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $("#form-edit-user").attr('autocomplete', 'off');
        $("#txtUserConfirmPassword").val('');
    })
    /*
        Group header select task (select all check box seletor task auto by this script) (very important)
    */
    $(".role_group_grid_box").each(function(index, element) {
        let index_increment = index + 1;
        let current_group_inner_item_length = $(element).find('div.role_group_header_body div.form-check').length;
        if ($(element).find('.role_group_header_body .checkbox-permission-checkbox-list:checked').length === current_group_inner_item_length) {
            $('.pr-group-' + index_increment).prop('checked', true);
        } else {
            $('.pr-group-' + index_increment).prop('checked', false);
        }
    });

</script>
@endsection
