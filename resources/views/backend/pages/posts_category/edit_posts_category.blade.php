@extends('backend.layouts.master_v2')
@section('title')
Edit Cateogory
@endsection
@section('active_breadcumbs_title')
Edit Cateogory
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Cateogory</h4>
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
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Edit Cateogory : {{ $posts_category['category_name'] }}</b></h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <!-- main form start -->
                        <form action="{{ route('posts_category.update', $posts_category['id']) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form">
                                <div class="form-floating mb-3">
                                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="category name" required value="{{ $posts_category['category_name'] }}"/>
                                    <label for="category_name">Category Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="category_name_bangla" id="category_name_bangla" class="form-control" placeholder="category name bangla" required value="{{ $posts_category['category_name_bangla'] }}"/>
                                    <label for="category_name_bangla">Category Name bangla</label>
                                </div>
                                <div class="save-button-form-v1">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Posts Category</button>
                                </div>
                            </div>
                        </form>
                        <!-- main form end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- new data table end -->
    </div>
</div> <!-- container -->
@endsection
@section('on_demand_footer_script_if_exist')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/role-functions-list.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/onload-scripts.js') }}"></script>
@endsection
@section('after_domready_script')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
    /*
        Group header select task (select all check box seletor task auto by this script) (very important)
    */
    $(".role_group_grid_box").each(function(index, element) {
        let index_increment = index + 1;
        let current_group_inner_item_length = $(element).find('div.role_group_header_body div.form-check').length;
        if ($(element).find('.role_group_header_body .checkbox-permission-checkbox-list:checked').length === current_group_inner_item_length) {
            $('.pr-group-' + index_increment).prop('checked', true);
        } else {
            $('.pr-group-' + index_increment).prop('checked', false);
        }
    });

</script>
@endsection
