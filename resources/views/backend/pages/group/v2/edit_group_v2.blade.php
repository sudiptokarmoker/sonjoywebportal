@extends('backend.layouts.master_v2')
@section('title')
    Permission Group Edit
@endsection
@section('active_breadcumbs_title')
    Permission Group Edit
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-box">
                    <h4 class="page-title">Permission Group Edit</h4>
                    <!-- breadcumbs -->
                    @include('backend.layouts.partials.v2.breadcumbs_v2')
                    <!-- end of breadcumbs -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <!-- form start -->
            <div class="col-xs-12 col-lg-12 col-xl-6">
                <div class="card-box">
                    <h4 class="header-title">
                        Edit Group : {{ $groupModel->group_name }}
                    </h4>
                    @include('backend.layouts.partials.messages')
                    <form action="{{ route('group.update', $groupModel->id) }}" method="POST" class="p20">
                        @method('PUT')
                        @csrf
                        <div class="form">
                            <div class="form-floating mb-3">
                                <input type="text" name="group_name" id="txtPermissionGroupName" class="form-control txtPermissionGroupName" value="{{ $groupModel->group_name }}" placeholder="Group Name"/>
                                <label for="txtPermissionGroupName">Group Name</label>
                            </div>
                            <div class="mt10">
                                <button type="submit" class="btn w-100 color-white button-sm bg-dark-blue waves-effect waves-light">Save Permission Group</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- end col-->
            <!-- form end -->
        </div>
    </div> <!-- container -->
@endsection