@extends('backend.layouts.master_v2')
@section('title')
Edit Verses Category
@endsection
@section('active_breadcumbs_title')
Edit Verses Category
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Verses Category</h4>
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
        <form action="{{ route('verses_category.update', $verses_category['id']) }}" method="POST">
            @method('PUT')
            @csrf
            <h4 class="header-title"><b>Create Artists</b></h4>
            <!-- new data table start -->
            <div class="col-6">
                <div class="card-box table-responsive">
                    <div class="p20">
                        <div>
                           <div class="form">
                                <div class="form-floating mb-3">
                                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="category name" required value="{{ $verses_category['category_name'] }}"/>
                                    <label for="category_name">Category Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="category_name_bangla" id="category_name_bangla" class="form-control" placeholder="category name bangla" required value="{{ $verses_category['category_name_bangla'] }}"/>
                                    <label for="category_name_bangla">Category Name bangla</label>
                                </div>
                                <div class="save-button-form-v1">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Posts Category</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> <!-- container -->
@endsection