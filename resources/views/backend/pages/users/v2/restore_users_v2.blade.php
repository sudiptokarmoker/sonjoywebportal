@extends('backend.layouts.master_v2')
@section('title')
Disabled Users List
@endsection
@section('active_breadcumbs_title')
Disabled Users List
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Disabled User List</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        @if (Auth::user()->hasPermissionTo('users.create.form'))
        <div>
            <p class="float-right">
                <a class="btn btn-warning waves-effect waves-light text-white fl-r" href="{{ route('users.create') }}" type="button">Create User</a>
            </p>
        </div>
        @endif
    </div>
    <div class="row">
        <!-- new data table start -->
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>User List</b></h4>
                <div class="p20">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="20%">Name</th>
                                <th width="20%">Email</th>
                                <th width="35%">Roles</th>
                                @if (Auth::user()->hasRole('superadmin'))
                                <th width="20%">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @foreach($users as $user)
                        <?php $user_role_array = array(); ?>
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ( $user->roles as $role )
                                <?php 
                                    $user_role_array[] = $role->name;
                                ?>
                                <span class="badge badge-info mr-1">
                                    {{ $role->name }}
                                </span>
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-link" href="{{ route('users.restore_user_process', $user->id) }}" onclick="event.preventDefault(); document.getElementById('activate-user-form-{{ $user->id }}').submit();">
                                    Activate User
                                </a>
                                <form id="activate-user-form-{{ $user->id }}" action="{{ route('users.restore_user_process', $user->id) }}" method="POST" style="display: none;">
                                    @method('GET')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- new data table end -->
    </div>
</div> <!-- container -->
@endsection
@section('after_domready_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
    });

</script>
@endsection
