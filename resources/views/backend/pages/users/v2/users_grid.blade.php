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
                    <table class="table table-bordered data-table" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>created_at</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
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
    //var table;
    $(function() {
        $.fn.dataTable.ext.errMode = 'throw';
        var table = $('.data-table').DataTable({
            processing: true, 
            serverSide: true,
            ajax: "{{ route('users.lists.all') }}",
            order: [], 
            columns: [
                {data: 'id', name: 'id'}, 
                {data: 'first_name', name: 'first_name'}, 
                {data: 'email', name: 'email'}, 
                {data: 'roles', name: 'roles'}, 
                {data: 'created_at', name: 'created_at'}, 
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    });

    function delete_form_processing(user_id) {
        event.preventDefault();
        document.getElementById('delete-form-' + user_id).submit();
    }

    function hard_delete_form_processing(user_id) {
        event.preventDefault();
        document.getElementById('hard-delete-form-' + user_id).submit();
    }

</script>
@endsection
