@extends('backend.layouts.master_v2')
@section('title')
Role List
@endsection
@section('active_breadcumbs_title')
Role List
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Roles List</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
    @if (Auth::user()->hasRole('superadmin', 'web'))
        <div>
            <p class="float-right">
                <a class="btn btn-warning waves-effect waves-light text-white fl-r" href="{{ route('roles.create') }}" type="button">Create Roles</a>
            </p>
        </div>
    @endif
    </div>
    <div class="row">
        <!-- new data table start -->
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Permission List</b></h4>
                <div class="p20">
                    <form action="{{ route('admin.roles.multiple.create') }}" method="POST">
                        @csrf
                        <div class="main-dashboard-inner-content" style="width: 100%; float: left;">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach($roles as $role)
                                    <a class="nav-link <?php if($loop->index == 0): ?>active<?php endif; ?>" data-bs-toggle="tab" href="#<?php  echo str_replace(' ','-', $role->name) ?>" role="tab" aria-controls="home" aria-selected="true">{{ $role->name }}</a>
                                @endforeach
                                </div>
                            </nav>
                            <!-- tab content start -->
                            <div class="tab-content" id="nav-tabContent">
                                <!-- now here just get the all role list -->
                                <?php 
                                    $i = 0;
                                    $counter = 0; 
                                ?>
                                @foreach ($roles as $role)
                                <div class="tab-pane show <?php if($loop->index == 0): ?>active<?php endif; ?>" id="<?php  echo str_replace(' ','-', $role->name) ?>" role="tabpane{{ $role->id }}" aria-labelledby="home-tab">
                                    <div class="form-row">
                                        <!-- print the all permission in a group -->
                                        <?php
                                            $i++;
                                        ?>
                                        @foreach($permissionGroup as $group)
                                        <div class="role_group_grid_box ow">
                                            @php
                                            $permissions = App\Models\User::getPermissionsGroupNameById($group->id);
                                            $j = 1;
                                            @endphp
                                            <div class="role_group_header">
                                                <h5><strong>{{ $group->group_name }}</strong></h5>
                                                <div class="form-check ow">
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
                        @role('superadmin')
                        <div class="form-submit-footer">
                            <input type="submit" name="btnSubmitMultipleRole" class="btn btn-primary" />
                        </div>
                        @endrole
                    </form>
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
