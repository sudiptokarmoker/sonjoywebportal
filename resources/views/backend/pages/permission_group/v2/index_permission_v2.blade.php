@extends('backend.layouts.master_v2')
@section('title')
    Permission Lists Pages
@endsection
@section('active_breadcumbs_title')
    Permission Lists
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-box">
                    <h4 class="page-title">Permission Lists</h4>
                    <!-- breadcumbs -->
                    @include('backend.layouts.partials.v2.breadcumbs_v2')
                    <!-- end of breadcumbs -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <!-- end row -->
    <div class="row">
    @if (Auth::user()->hasPermissionTo('permission.create.form.view'))
        <div>
            <p class="float-right">
                <a class="btn btn-warning waves-effect waves-light text-white fl-r" href="{{ route('permission.create') }}" type="button">Create Permission</a>
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
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="20%">Name</th>
                                    <th width="20%">Guard Name</th>
                                    <th width="20%">Group Name</th>
                                    <th width="35%">Action Name</th>
                                </tr>
                            </thead>
                            @foreach($permissionModel as $row)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->guard_name }}</td>
                                    <td>{{ $row->group_name }}</td>
                                    <td>
                                        <a class="btn btn-info text-white" href={{ route('permission.edit', $row->permission_main_id) }}>Edit</a>
                                        <a class="btn btn-danger text-white" href="{{ route('permission.destroy', $row->permission_main_id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $row->permission_main_id }}').submit();">Delete</a>
                                        <form id="delete-form-{{ $row->permission_main_id }}" action="{{ route('permission.destroy', $row->permission_main_id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
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