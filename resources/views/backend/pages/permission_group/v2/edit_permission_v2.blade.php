@extends('backend.layouts.master_v2')
@section('title')
Edit Pemmission
@endsection
@section('active_breadcumbs_title')
Edit Permission
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Permission</h4>
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
                <h4 class="header-title"><b>Edit Permission : {{ $permission->name }}</b></h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form">
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