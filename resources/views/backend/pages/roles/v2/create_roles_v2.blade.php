@extends('backend.layouts.master_v2')
@section('title')
Create Role
@endsection
@section('active_breadcumbs_title')
Role List
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Create Roles</h4>
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
                <h4 class="header-title"><b>Create Roles</b></h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('roles.store') }}" method="POST" class="p20">
                            @csrf
                            <div class="form">
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
