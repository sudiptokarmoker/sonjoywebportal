@extends('backend.layouts.master_v2')
@section('title')
Create Group
@endsection
@section('active_breadcumbs_title')
Create Group
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Create Group Form</h4>
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
                <h4 class="header-title">Create Group</h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('group.store') }}" method="POST" class="p20">
                            @csrf
                            <div class="form">
                                <div class="form-group">
                                    <label for="txtPermissionRouteName">Enter Group Name</label>
                                    <input type="text" name="group_name" id="txtPermissionGroupName" class="form-control" placeholder="type permission group name" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Group</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- new data table end -->
    </div>
</div> <!-- container -->
@endsection
