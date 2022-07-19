@extends('backend.layouts.master_v2')
@section('title')
Permission Group
@endsection
@section('active_breadcumbs_title')
Permission Group
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Permission Group</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        @if (Auth::user()->hasPermissionTo('group.create.form.view'))
        <div>
            <p class="float-right">
                <a class="btn btn-warning waves-effect waves-light text-white fl-r" href="{{ route('group.create') }}" type="button">Create Permission Group</a>
            </p>
        </div>
        @endif
    </div>
    <div class="row">
        <!-- new data table start -->
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Permission Group List</b></h4>
                <div class="p20">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="20%">Group Name</th>
                                <th width="35%">Action Name</th>
                            </tr>
                        </thead>
                        @foreach ($permmission_group as $row)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $row->group_name }}</td>
                            <td>
                                <a class="btn btn-info text-white" href={{ route('group.edit', $row->id) }}>Edit</a>
                                <a class="btn btn-danger text-white" href="{{ route('group.destroy', $row->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $row->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $row->id }}" action="{{ route('group.destroy', $row->id) }}" method="POST" style="display: none;">
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
