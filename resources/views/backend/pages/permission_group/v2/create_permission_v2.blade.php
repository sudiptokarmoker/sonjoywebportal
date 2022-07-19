@extends('backend.layouts.master_v2')
@section('title')
Create Permission Group
@endsection
@section('active_breadcumbs_title')
Create Permission Group
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Create Permission Group</h4>
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
                <h4 class="header-title"><b>Create Permission Group</b></h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('permission.store') }}" method="POST" class="p20">
                            @csrf
                            <div class="form">
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
@section('on_demand_footer_script_if_exist')
<script type="text/javascript" src="{{ asset('backend/assets/js/role-functions-list.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/onload-scripts.js') }}"></script>
@endsection
@section('after_domready_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
    });

</script>
@endsection
