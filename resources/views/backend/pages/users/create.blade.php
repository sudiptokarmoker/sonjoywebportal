@php
//use App\Models\User;
@endphp
@extends('backend.layouts.master')

@section('title', 'User Create Page')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }

</style>
@endsection

@section('breadcrumbs')
<h4 class="page-title pull-left">Create User</h4>
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
                    <h4 class="header-title">Create User</h4>
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="txtFirstName">Firstname</label>
                                <input type="text" name="firstname" id="txtFirstName" class="form-control" placeholder="type first name" />
                            </div>
                            <div class="form-group">
                                <label for="txtLastName">Lastname</label>
                                <input type="text" name="lastname" id="txtLastName" class="form-control" placeholder="type last name" />
                            </div>
                            <div class="form-group">
                                <label for="txtUserPassword">Password</label>
                                <input type="password" name="password" id="txtUserPassword" class="form-control" placeholder="type password" />
                            </div>
                            <div class="form-group">
                                <label for="txtUserConfirmPassword">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="txtUserConfirmPassword" class="form-control" placeholder="type password" />
                            </div>
                            <div class="form-group">
                                <label for="txtUserEmail">Type Email</label>
                                <input type="email" name="email" id="txtUserEmail" class="form-control" placeholder="type email address" />
                            </div>
                            <div class="form-group">
                                <label for="lstRolesList">select multiple roles</label>
                                <select name="roles[]" multiple class="form-control select2" id="lstRolesList" name="lstRolesList">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_script_footer_on_demand_on_page')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
@endsection
