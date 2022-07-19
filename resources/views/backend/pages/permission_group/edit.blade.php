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
<h4 class="page-title pull-left">Permission Group List</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="{{ route('admin.dashboard') }}">Dashboard Home</a></li>
    <li><a href="{{ route('roles.index') }}">Roles</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a href="{{ route('permission.index') }}">Pemission</a></li>
</ul>
@endsection
@section('admin-content')
<!-- header area start -->
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
                    <h4 class="header-title">Edit User : {{ $permission->name }}</h4>
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <label for="name">Group Name</label>
                                <select class="form-control" name="lstGroupNameOnStore">
                                    <option>select group</option>
                                    @foreach ($permissionGroup as $row)
                                    <option value="{{ $row->id }}" {{ ( $row->id == $permission->group_id) ? 'selected' : '' }}>
                                        {{ $row->group_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row">
                                <label for="name">Permission Name</label>
                                <input type="text" class="form-control" id="name" name="txtPermissionRouteName" placeholder="Enter Route Name" value="{{ $permission->name }}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Route</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection