@php
//use App\Models\User;
@endphp
@extends('backend.layouts.master')

@section('title', 'Roles Create Page')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }

</style>
@endsection

@section('breadcrumbs')
<h4 class="page-title pull-left">Edit Users</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="{{ route('admin.dashboard') }}">Dashboard Home</a></li>
    <li><a href="{{ route('roles.index') }}">Roles</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a href="{{ route('permission.index') }}">Pemission</a></li>
</ul>
@endsection

@section('admin-content')
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit User : {{ $user->name }}</h4>
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basic_information_tab" data-toggle="tab" href="#basic-information-tab" role="tab" aria-controls="home" aria-selected="true">Basic Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="user_permission_tab" data-toggle="tab" href="#user-permission-tab" role="tab" aria-controls="profile" aria-selected="false">Permissions</a>
                                </li>
                            </ul>
                            <?php 
                                $i = 0; 
                                $permission_group_inner_item_counter = [];
                            ?>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-information-tab" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="name">Firstname</label>
                                            <input type="text" class="form-control" id="name" name="firstname" placeholder="Enter First Name" value="{{ $user->firstname }}" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="txtLastName">Lastname</label>
                                            <input type="text" name="lastname" id="txtLastName" class="form-control" placeholder="type last name" value="{{ $user->lastname }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label for="email">User Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $user->email }}">
                                    </div>
                                    {{-- <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control user_password" id="password" name="password" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                                        </div>
                                    </div> --}}
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
                                <div class="tab-pane fade" id="user-permission-tab" role="tabpanel" aria-labelledby="profile-tab">
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
                                                    
                                                         if(in_array($permission->name, $permission_name_list)){ 
                                                            echo 'disabled';
                                                         }
                                                    
                                                     ?> id="checkPermission-{{ $permission->id }}" value="{{ $permission->name }}" onclick="permissionGroupCheckUncheck('permission-child-{{ $permission->id }}', 'pr-group-{{ $i }}', 'role-{{ $i }}-management-checkbox')" />
                                                    {{-- <label class="custom-control-label" for="checkPermission-{{ $permission->id }}">{{ $permission->name }}</label> --}}
                                                    <label class="custom-control-label permission-name-list-label" for="checkPermission-{{ $permission->id }}">{{ str_replace(".", " ", $permission->name) }}</label>
                                                </div>

                                                {{-- <div class="custom-control custom-checkbox mr-sm-2">
                                                    <input type="checkbox" data-loop-value={{ $loop->index }} class="custom-control-input checkbox-permission-checkbox-list permission-child-{{ $permission->id }}" data-value="{{ $user->hasPermissionTo($permission->name) }}" name="permissions[]" {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission-{{ $permission->id }}" value="{{ $permission->name }}" onclick="permissionGroupCheckUncheck('permission-child-{{ $permission->id }}', 'pr-group-{{ $i }}', 'role-{{ $i }}-management-checkbox')" />
                                                <label class="custom-control-label" for="checkPermission-{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div> --}}

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
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- data table end -->
</div>
</div>
@endsection
@section('custom_script_footer_on_demand_on_page')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript" src="{{ asset('backend/assets/js/role-functions-list.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/onload-scripts.js') }}"></script>

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
