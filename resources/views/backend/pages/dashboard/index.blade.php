@extends('backend.layouts.master')
@section('title')
Dashboard Page - Admin Panel
@endsection
@section('breadcrumbs')
<h4 class="page-title pull-left">Dashboard</h4>
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
        <div class="col-12">
            @include('backend.layouts.partials.messages')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                @can('roles.list')
                <div class="col-md-6 mt-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg1">
                            <a href="{{ route('roles.index') }}">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="fa fa-users"></i> Roles</div>
                                    <h2>{{ $total_roles }}</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endcan
                @can('permission.list')
                <div class="col-md-6 mt-md-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg2">
                            <a href="{{ route('permission.index') }}">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="fa fa-user"></i> Permission</div>
                                    <h2>{{ $total_permissions }}</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
