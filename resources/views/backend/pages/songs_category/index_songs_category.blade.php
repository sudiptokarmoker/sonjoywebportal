@extends('backend.layouts.master_v2')
@section('title')
Songs Category
@endsection
@section('active_breadcumbs_title')
Songs Category
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Songs Category Lists</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        @if (Auth::user()->hasPermissionTo('songs_category.create.form.view'))
        <div>
            <p class="float-right">
                <a class="btn btn-warning waves-effect waves-light text-white fl-r" href="{{ route('songs_category.create') }}" type="button">Create Songs Category</a>
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
                <h4 class="header-title"><b>Songs Category List</b></h4>
                <div class="p20">
                    <table class="table table-bordered data-table" id="datatable">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Name in Bangla</th>
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
            ajax: "{{ route('songs_category.lists.all') }}",
            order: [], 
            columns: [
                {data: 'id', name: 'id'}, 
                {data: 'category_name', name: 'category_name'},
                {data: 'category_name_bangla', name: 'category_name_bangla'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    
    function delete_form_processing(category_id) {
        event.preventDefault();
        let text = "Are you confirm to delete this category ";
        if (confirm(text) == true) {
            document.getElementById('delete-form-' + category_id).submit();
        } 
        return;
    }
</script>
@endsection
