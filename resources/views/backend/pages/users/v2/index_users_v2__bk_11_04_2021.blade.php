@extends('backend.layouts.master_v2')
@section('title')
User List
@endsection
@section('active_breadcumbs_title')
User List
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">User List</h4>
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
            <div>
                @include('backend.layouts.partials.messages')
            </div>
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
                            <td>{{ $user->full_name }}</td>
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
                            {{-- @if (Auth::user()->hasRole('superadmin')) --}}
                            <td>
                                <?php 
                                        //print_r($user_role_array);
                                    ?>
                                <a class="btn btn-info text-white" href={{ route('users.edit', $user->id) }}>Edit</a>
                                <?php if(!in_array('superadmin', $user_role_array)): ?>
                                <a class="btn btn-danger text-white" href="{{ route('users.destroy', $user->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                    Disable User
                                </a>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <a class="btn btn-link" href="{{ route('users.destroy_by_hard_delete', $user->id) }}" onclick="event.preventDefault(); document.getElementById('hard-delete-form-{{ $user->id }}').submit();">
                                    Permanently Delete User
                                </a>
                                <form id="hard-delete-form-{{ $user->id }}" action="{{ route('users.destroy_by_hard_delete', $user->id) }}" method="POST" style="display: none;">
                                    @method('GET')
                                    @csrf
                                </form>
                                <?php endif; ?>
                            </td>
                            {{-- @endif --}}
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
