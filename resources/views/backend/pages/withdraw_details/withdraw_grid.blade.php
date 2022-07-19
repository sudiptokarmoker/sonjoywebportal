@extends('backend.layouts.master_v2')
@section('title')
Withdraw List
@endsection
@section('active_breadcumbs_title')
Withdraw List
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Withdraw List</h4>
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
            <div>
                @include('backend.layouts.partials.messages')
            </div>
            <div class="card-box table-responsive">
                {{-- <a href="{{ route('withdraw-details.edit', 10) }}">Edit</a> --}}
                {{-- <a class="btn btn-info text-white" href={{ route('users.edit', $user->id) }}>Edit</a> --}}
                <h4 class="header-title"><b>Withdraw List</b></h4>
                <div class="p20">
                    <table class="table table-bordered data-table" id="datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Full Name</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Transaction ID</th>
                                <th>Withdraw Method</th>
                                <th>Roles</th>
                                <th>Status</th>
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
            ajax: "{{ route('withdraw.details.all.lists') }}",
            order: [], 
            columns: [
                {data: 'id', name: 'id'}, 
                {data: 'user_id', name: 'user_id'}, 
                {data: 'full_name', name: 'full_name'}, 
                {data: 'currency', name: 'currency'},
                {data: 'amount', name: 'amount'},
                {data: 'transaction_id', name: 'transaction_id'},
                {data: 'withdraw_method', name: 'withdraw_method'},
                {data: 'roles', name: 'roles'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection
