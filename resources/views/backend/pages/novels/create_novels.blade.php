@extends('backend.layouts.master_v2_editor')
@section('title')
Novels Verses
@endsection
@section('active_breadcumbs_title')
Novels Verses
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Novels Verses</h4>
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
        <form action="{{ route('novels.store') }}" method="POST" class="p20" autocomplete="off" enctype="multipart/form-data">
            <h4 class="header-title"><b>Create Novels</b></h4>
            @csrf
            <!-- new data table start -->
            <div class="col-8">
                <div class="card-box table-responsive">
                    <div class="p20">
                        <div>
                            <div class="form-floating mb-3">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Song title in bengali" required />
                                <label for="title">Novels Title In Bengali</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="title_in_english" id="title_in_english" class="form-control" placeholder="Verses title in english" required />
                                <label for="title_in_english">Novels Title In English</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="summernote description form-control" name="content" id="description"></textarea>
                                <label for="description">Content</label>
                            </div>
                             <div class="form-row">
                                    <label for="posts_image">Upload Novels Image</label>
                                    <input type="file" class="form-control-file" id="posts_image" name="posts_image">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="root_category_id" value="{{ $novelsRootCategoryId }}" />
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Create Novels</button>
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

@section('after_domready_script')
<script type="text/javascript">
    $(document).ready(function() {
        //$('.summernote').summernote();
        $('.summernote').summernote({
            height: 250, //set editable area's height
        });
    });

</script>
@endsection
