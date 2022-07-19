@extends('backend.layouts.master')
@section('title', 'Create Permission Group')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .form-check-label {
        text-transform: capitalize;
    }

</style>
@endsection
@section('breadcrumbs')
<h4 class="page-title pull-left">Create Permission Group</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="{{ route('admin.dashboard') }}">Dashboard Home</a></li>
    <li><a href="{{ route('roles.index') }}">Roles</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a href="{{ route('permission.index') }}">Pemission</a></li>
</ul>
@endsection
@section('admin-content')
<!-- header area start -->
{{-- @include('backend.pages.roles.partial.header') --}}
<!-- header area end -->
<!-- page title area start -->
{{-- @include('backend.pages.roles.partial.page_title') --}}
<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Create Permission</h4>
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="lstGroupNameOnStore">
                                    <option value="">Select Group</option>
                                    @foreach ($permissionGroupName as $row_permission_group_name)
                                    <option value="{{ $row_permission_group_name->id }}">{{ $row_permission_group_name->group_name }}</option>
                                    @endforeach
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtPermissionRouteName">Enter Permission Route Name</label>
                                <input type="text" name="txtPermissionRouteName" id="txtPermissionRouteName" class="form-control" placeholder="type permission route name" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Group</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
