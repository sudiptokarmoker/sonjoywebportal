@extends('backend.layouts.master_v2_editor')
@section('title')
Edit novels
@endsection
@section('active_breadcumbs_title')
Edit novels
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit novels</h4>
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
        <form action="{{ route('novels.update', $novels_edit_obj['id']) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- new data table start -->
            <div class="col-8">
                <div class="card-box table-responsive">
                    <div class="p20">
                        <div>
                            <div class="form-floating mb-3">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Novels title in bengali" required value="{{$novels_edit_obj['title']}}"/>
                                <label for="title">Novels Title In Bengali</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="title_in_english" id="title_in_english" class="form-control" placeholder="Novels title in english" required value="{{$novels_edit_obj['title_in_english']}}"/>
                                <label for="title_in_english">Novels Title In English</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="summernote description form-control" name="content" id="description">
                                    {{$novels_edit_obj['content']}}
                                </textarea>
                                <label for="description">Content</label>
                            </div>
                            <div class="form-row">
                                @if($novels_edit_obj['posts_media'] && $novels_edit_obj['posts_media']['posts_image'] && file_exists('storage/images/posts_image/'.$novels_edit_obj['posts_media']['posts_image']))
                                    <img src="{{ asset('storage/images/posts_image/'.$novels_edit_obj['posts_media']['posts_image']) }}" alt="" title="" width="60"/>
                                    <label for="posts_image">Upload New Posts Image</label>
                                    <input type="file" class="form-control-file" id="posts_image" name="posts_image"/>
                                @else
                                <label for="posts_image">Upload Posts Image</label>
                                <input type="file" class="form-control-file" id="posts_image" name="posts_image"/>
                                @endif
                            </div>

                            <div class="form-row">
                                @if($novels_edit_obj['posts_media'] && $novels_edit_obj['posts_media']['posts_file'] && file_exists('storage/novels/'.$novels_edit_obj['posts_media']['posts_file']))
                                    <label for="posts_image">Upload New Novels Doc Files (PDF)</label>
                                    <input type="file" class="form-control-file" id="posts_image" name="posts_file"/>
                                @else
                                <label for="posts_file">Upload Novels Doc Files (PDF)</label>
                                <input type="file" class="form-control-file" id="posts_image" name="posts_file"/>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <input type="hidden" name="song_id" value="{{ $novels_edit_obj['id'] }}" />
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Edit Novels</button>
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
            height: 200, //set editable area's height
        });
    });

</script>
@endsection
