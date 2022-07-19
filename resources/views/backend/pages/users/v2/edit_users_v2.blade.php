@extends('backend.layouts.master_v2')
@section('title')
Edit User
@endsection
@section('active_breadcumbs_title')
Edit User
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit User Form</h4>
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
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-link active" data-bs-toggle="tab" id="basic_information_tab" href="#basic-information-tab">Basic Information</a>
                                        <a class="nav-link" data-bs-toggle="tab" id="user_permission_tab" href="#user-permission-tab">Permissions</a>
                                    </div>
                                </nav>
                                <?php
                                    $i = 0;
                                    $permission_group_inner_item_counter = [];
                                ?>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active p10" id="basic-information-tab">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="name">First name</label>
                                                <input type="text" class="form-control" id="name" name="first_name" placeholder="Enter User First Name" value="{{ $user->first_name }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="name">Last name</label>
                                                <input type="text" class="form-control" id="name" name="last_name" placeholder="Enter User Last Name" value="{{ $user->last_name }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label for="email">User Email</label>
                                            <input type="text" readonly class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $user->email }}">
                                        </div>
                                        <!-- password edit options here -->
                                        <div class="form-row">
                                            <button onclick="toggle_password()" class="btn btn-link btn-toggle-password" type="button">Open change password field</button>
                                        </div>
                                        <div class="wrap-password-change">
                                        </div>
                                        <!-- password edit option end here -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="password">Assign Roles</label>
                                                <select name="roles[]" id="roles" class="form-control select2" multiple>
                                                    @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade p10" id="user-permission-tab">
                                        <!-- print all permission here to assign manual permission here -->
                                        <?php 
                                            $i++;
                                        ?>
                                        @foreach($permissionGroup as $group)
                                        <div class="role_group_grid_box">
                                            @php
                                            $permissions = App\Models\User::getPermissionsGroupNameById($group->id);
                                            $j = 1;
                                            @endphp
                                            <div class="role_group_header">
                                                <h5><strong>{{ $group->group_name }}</strong></h5>
                                                <div class="form-check">
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input type="checkbox" class="custom-control-input pr-group-{{ $i }}" id="checkPermissionGroup-{{ $i }}" value="{{ $group->group_name }}" onclick="checkPermissionByGroupNameForDirectPermissionAssign('role-{{ $i }}-management-checkbox', this)" />
                                                        <label class="custom-control-label select-all-label" for="checkPermissionGroup-{{ $i }}">Select All</label>
                                                    </div>
                                                    <hr />
                                                </div>
                                            </div>
                                            <div class="role_group_header_body role-{{ $i }}-management-checkbox">
                                                @foreach($permissions as $permission)
                                                <div class="form-check">
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input type="checkbox" data-loop-value={{ $loop->index }} class="custom-control-input checkbox-permission-checkbox-list permission-child-{{ $permission->id }}" data-value="{{ $user->hasPermissionTo($permission->name) }}" name="permissions[]" {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }} <?php 
                                                    
                                                         if($permission_name_list && in_array($permission->name, $permission_name_list)){ 
                                                            echo 'disabled';
                                                         }
                                                    
                                                     ?> id="checkPermission-{{ $permission->id }}" value="{{ $permission->name }}" onclick="permissionGroupCheckUncheck('permission-child-{{ $permission->id }}', 'pr-group-{{ $i }}', 'role-{{ $i }}-management-checkbox')" />
                                                        <label class="custom-control-label permission-name-list-label" for="checkPermission-{{ $permission->id }}">{{ str_replace(".", " ", $permission->name) }}</label>
                                                    </div>
                                                </div>
                                                @php $j++; @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                        @endforeach
                                        <!-- end of print here -->
                                    </div>
                                </div>
                                <div class="save-button-form-v1">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save User</button>
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
