@extends('backend.layouts.master_v2')
@section('title')
Dashboard Page - Admin Panel
@endsection
@section('active_breadcumbs_title')
Dashboard Page
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        @can('roles.list')
        {{-- <div class="col-md-6 mt-5 mb-3">
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
</div> --}}
<div class="col-lg-3 col-md-6 mb30">
    <div class="card bg-warning">
        <div class="desh-card card-body">
            <a href="{{ route('roles.index') }}">
                <div class="row mb30 align-items-center">
                    <div class="col">
                        <h3 class="color-white">{{ $total_roles }}</h3>
                    </div>
                    <div class="col-auto">
                        <p class="color-white">Roles</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div><!-- end col-->
@endcan
@can('permission.list')
{{-- <div class="col-md-6 mt-md-5 mb-3">
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
</div> --}}

<div class="col-lg-3 col-md-6 mb30">
    <div class="card bg-warning">
        <div class="desh-card card-body">
            <a href="{{ route('permission.index') }}">
                <div class="row mb30 align-items-center">
                    <div class="col">
                        <h3 class="color-white">{{ $total_permissions }}</h3>
                    </div>
                    <div class="col-auto">
                        <p class="color-white">Permission</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div><!-- end col-->
@endcan
@can('users.list')
    <x-user-type-role-user-count-card/>
    {{-- <x-counsellor-type-role-user-count-card/> --}}
@endcan
</div><!-- end row -->
</div> <!-- container -->
@endsection
