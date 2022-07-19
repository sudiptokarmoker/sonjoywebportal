@extends('backend.layouts.master_v2')
@section('title')
Create Verses Category
@endsection
@section('active_breadcumbs_title')
Create Verses Catgory
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Create Verses Catgory</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        @include('backend.layouts.partials.messages')
        <form action="{{ route('verses_category.store') }}" method="POST" class="p20" autocomplete="off">
            <h4 class="header-title"><b>Create Verses Catgory</b></h4>
            @csrf
            <!-- new data table start -->
            <div class="col-6">
                <div class="card-box table-responsive">
                    <div class="p20">
                        <div>
                            <div class="form">
                               <div class="form-floating mb-3">
                                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="category name" required/>
                                    <label for="category_name">Category Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="category_name_bangla" id="category_name_bangla" class="form-control" placeholder="category name bangla" required/>
                                    <label for="category_name_bangla">Category Name bangla</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Create Category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> <!-- container -->
@endsection