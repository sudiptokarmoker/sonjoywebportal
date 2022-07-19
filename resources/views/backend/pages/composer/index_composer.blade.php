@extends('backend.layouts.master_v2')
@section('title')
Composer
@endsection
@section('active_breadcumbs_title')
Composer
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Composer Lists</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        @if (Auth::user()->hasPermissionTo('composer.create.form.view'))
        <div>
            <p class="float-right">
                <a class="btn btn-warning waves-effect waves-light text-white fl-r" href="{{ route('composer.create') }}" type="button">Create Composer</a>
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
                <h4 class="header-title"><b>Composer List</b></h4>
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
            ajax: "{{ route('composer.lists.all') }}",
            order: [], 
            columns: [
                {data: 'id', name: 'id'}, 
                {data: 'name', name: 'name'},
                {data: 'name_in_bangla', name: 'name_in_bangla'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    
    function delete_form_processing(category_id) {
        event.preventDefault();
        let text = "Are you confirm to delete this composer!!";
        if (confirm(text) == true) {
            document.getElementById('delete-form-' + category_id).submit();
        } 
        return;
    }
</script>
@endsection
