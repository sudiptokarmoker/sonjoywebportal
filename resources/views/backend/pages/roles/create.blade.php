@extends('backend.layouts.master')
@section('title', 'Roles Create Page')
@section('breadcrumbs')
<h4 class="page-title pull-left">Create Role</h4>
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
                    <h4 class="header-title">Create Roles</h4>
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="txtRoleName">Enter a role name</label>
                                <input type="text" name="name" class="form-control" id="txtRoleName" placeholder="Enter a role name">
                            </div>
                            <div class="form-group permission-checkbox-raw-wrapper">
                                <label for="name">Permissons</label>
                                <div class="form-check">
                                    <input type="checkbox" name="" class="form-check-input" id="checkPermissionAll" value="" />
                                    <label class="form-check-label" for="checkPermissionAll">All</label>
                                </div>
                                <hr>
                                @php $i = 1; @endphp
                                @foreach($permissionGroup as $group)
                                <div class="row">
                                    @php
                                    // $permissions = App\Models\User::getPermissionsByGroupName($group->name);
                                    $permissions = App\Models\User::getPermissionsGroupNameById($group->id);
                                    $j = 1;
                                    @endphp
                                    <div class="col-4">
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input pr-group-{{ $i }}" id="checkPermissionGroup-{{ $i }}" value="{{ $group->group_name }}" onclick="checkPermissionByGroupName('role-{{ $i }}-management-checkbox', this)" />
                                                <label class="custom-control-label" for="checkPermissionGroup-{{ $i }}">{{ $group->group_name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 role-{{ $i }}-management-checkbox">
                                        @foreach($permissions as $permission)
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input checkbox-permission-checkbox-list permission-child-{{ $permission->id }}" name="permissions[]" id="checkPermission-{{ $permission->id }}" value="{{ $permission->name }}" onclick="permissionGroupCheckUncheck('permission-child-{{ $permission->id }}', 'pr-group-{{ $i }}', 'role-{{ $i }}-management-checkbox')" />
                                                <label class="custom-control-label" for="checkPermission-{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                        @php $j++; @endphp
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                @php $i++; @endphp
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_script_footer_on_demand_on_page')
<script type="text/javascript" src="{{ asset('backend/assets/js/role-functions-list.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/onload-scripts.js') }}"></script>
@endsection
