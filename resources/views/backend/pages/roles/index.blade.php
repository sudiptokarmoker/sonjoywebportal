@extends('backend.layouts.master')
@section('title', 'Roles Pages')
@section('breadcrumbs')
<h4 class="page-title pull-left">Role List</h4>
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
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Roles List</h4>
                    @if (Auth::user()->hasRole('superadmin'))
                    <p class="float-right">
                        <a class="btn btn-primary text-white" href="{{ route('roles.create') }}">Create</a>
                    </p>
                    @endif
                    <!-- new format display here -->
                    @include('backend.layouts.partials.messages')
                    <form action="{{ route('admin.roles.multiple.create') }}" method="POST">
                        @csrf
                        <div class="main-dashboard-inner-content" style="width: 100%; float: left;">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach($roles as $role)
                                <li class="nav-item">
                                    <a class="nav-link <?php if($loop->index == 0): ?>active<?php endif; ?>" id="tab_<?php  echo str_replace(' ','-', $role->name) ?>" data-toggle="tab" href="#<?php  echo str_replace(' ','-', $role->name) ?>" role="tab" aria-controls="home" aria-selected="true">{{ $role->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            <!-- tab content start -->
                            <div class="tab-content" id="roleListsTabContent">
                                <!-- now here just get the all role list -->
                                <?php 
                                $i = 0;
                                $counter = 0; 
                            ?>
                                @foreach ($roles as $role)
                                <div class="tab-pane fade show <?php if($loop->index == 0): ?>active<?php endif; ?>" id="<?php  echo str_replace(' ','-', $role->name) ?>" role="tabpane{{ $role->id }}" aria-labelledby="home-tab">
                                    <div class="form-row">
                                        <!-- print the all permission in a group -->
                                        <?php 
                                        $i++; 
                                    ?>
                                        @foreach($permissionGroup as $group)
                                        <div class="role_group_grid_box">
                                            @php
                                            $permissions = App\Models\User::getPermissionsGroupNameById($group->id);
                                            $j = 1;
                                            @endphp
                                            <div class="role_group_header">
                                                <h5><strong>{{ $group->group_name }}</strong></h5>
                                                <div class="form-check">
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input type="checkbox" class="custom-control-input pr-group-{{ $i }}" id="checkPermissionGroup-{{ $i }}" value="{{ $group->group_name }}" onclick="checkPermissionByGroupName('role-{{ $i }}-management-checkbox', this)" {{ count($permissions) > 0 && App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }} @php echo ($role->name == 'superadmin' ? 'disabled' : '')
                                                        @endphp/>
                                                        <label class="custom-control-label select-all-label" for="checkPermissionGroup-{{ $i }}">Select All</label>
                                                    </div>
                                                    <hr />
                                                </div>
                                            </div>
                                            <div class="role_group_header_body role-{{ $i }}-management-checkbox">
                                                @foreach($permissions as $permission)
                                                <?php 
                                                $counter++;
                                                //$permission_id_modified_value = $permission->id + $counter; 
                                            ?>
                                                <div class="form-check">
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input type="checkbox" data-loop-value={{ $loop->index }} class="custom-control-input checkbox-permission-checkbox-list permission-child-{{ $counter.'-rid-'.$role->id.'-'.$permission->id }}" data-value="{{ $role->hasPermissionTo($permission->name) }}" name="permissions[{{ $role->id }}][]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission-{{ $counter.'-rid-'.$role->id.'-'.$permission->id }}" value="{{ $permission->name }}" onclick="permissionGroupCheckUncheck('permission-child-{{ $counter.'-rid-'.$role->id.'-'.$permission->id }}', 'pr-group-{{ $i }}', 'role-{{ $i }}-management-checkbox')" @php echo ($role->name == 'superadmin' ? 'disabled' : '')
                                                        @endphp/>
                                                        <label class="custom-control-label permission-name-list-label" for="checkPermission-{{ $counter.'-rid-'.$role->id.'-'.$permission->id }}">{{ str_replace(".", " ", $permission->name) }}</label>
                                                        {{-- <label class="custom-control-label" for="checkPermission-{{ $counter.'-rid-'.$role->id.'-'.$permission->id }}">{{ $permission->name }}</label> --}}
                                                    </div>
                                                </div>
                                                @php $j++; @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                        @endforeach
                                        <!--end of print all role and permission here-->
                                    </div>
                                </div>
                                @endforeach
                                <!-- end of role list loop here -->
                            </div>
                            <!-- tab content end -->
                        </div>
                        <div class="form-submit-footer">
                            <input type="submit" name="btnSubmitMultipleRole" class="btn btn-primary" />
                        </div>
                    </form>
                    <!-- end of card display here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<!-- style css -->
@endsection
@section('custom_script_footer_on_demand_on_page')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script type="text/javascript" src="{{ asset('backend/assets/js/role-functions-list.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/onload-scripts.js') }}"></script>

<script type="text/javascript">
    /*================================
    datatable active
    ==================================*/
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            responsive: true
        });
    }

</script>
@endsection
