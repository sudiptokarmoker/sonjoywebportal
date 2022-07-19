@extends('backend.layouts.master_v2_editor')
@section('title')
Edit verses
@endsection
@section('active_breadcumbs_title')
Edit verses
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit verses</h4>
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
        <form action="{{ route('verses.update', $verses_edit_obj['id']) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- new data table start -->
            <div class="col-8">
                <div class="card-box table-responsive">
                    <div class="p20">
                        <div>
                            <div class="form-floating mb-3">
                                <select class="form-select" multiple aria-label="multiple select category" name="category_id[]" id="category_id">
                                    <option>Select Cateogory</option>
                                    @foreach($verses_edit_obj['category_lists'] as $category_list_item)
                                        <option value="{{ $category_list_item['id'] }}" @if(in_array($category_list_item['id'], $verses_edit_obj['category_id'])) selected @endif>{{ $category_list_item['category_name_bangla'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" multiple aria-label="multiple select artists_lists" name="artists_lists[]" id="category_id">
                                    <option>Select Artists Lists</option>
                                    @foreach($verses_edit_obj['artists_lists'] as $artists_lists_item)
                                        <option value="{{ $artists_lists_item['id'] }}" @if(in_array($artists_lists_item['id'], $verses_edit_obj['artists_id'])) selected @endif>{{ $artists_lists_item['name_in_bangla'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="select composer_id" name="composer_id" id="composer_id">
                                    <option>Select Composer</option>
                                    @foreach($verses_edit_obj['composer_lists'] as $composer_list_item)
                                        <option value="{{ $composer_list_item['id'] }}" @if($composer_list_item['id'] == $verses_edit_obj['posts_details']['composer_id']) selected @endif>{{ $composer_list_item['name_in_bangla'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Song title in bengali" required value="{{$verses_edit_obj['title']}}"/>
                                <label for="title">Song Title In Bengali</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="title_in_english" id="title_in_english" class="form-control" placeholder="Song title in english" required value="{{$verses_edit_obj['title_in_english']}}"/>
                                <label for="title_in_english">Song Title In English</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="summernote description form-control" name="content" id="description">
                                    {{$verses_edit_obj['content']}}
                                </textarea>
                                <label for="description">Description</label>
                            </div>
                            <div class="form-floating mb-3" for="rag">
                                <input type="text" class="rag form-control" id="rag" name="rag" placeholder="rag" value="{{$verses_edit_obj['posts_details']['rag']}}"/>
                                <label for="rag">Rag</label>
                            </div>
                            <div class="form-floating mb-3" for="tal">
                                <input type="text" class="tal form-control" id="tal" name="tal" placeholder="tal" value="{{$verses_edit_obj['posts_details']['tal']}}"/>
                                <label for="tal">Tal</label>
                            </div>
                            <div class="form-floating mb-3" for="composition_time_bangla">
                                <input type="text" class="composition_time_bangla form-control" id="composition_time_bangla" name="composition_time_bangla" placeholder="Composition Time" value="{{$verses_edit_obj['posts_details']['composition_time_bangla']}}"/>
                                <label for="composition_time_bangla">Composition Time Bangla (year)</label>
                            </div>
                            <div class="form-floating mb-3" for="composition_time_english">
                                <input type="text" class="composition_time_english form-control" id="composition_time_english" name="composition_time_english" placeholder="Composition Time in English" value="{{$verses_edit_obj['posts_details']['composition_time_english']}}"/>
                                <label for="composition_time_english">Composition Time English (year)</label>
                            </div>
                            <div class="form-floating mb-3" for="composition_place">
                                <input type="text" class="rag form-control" id="composition_place" name="composition_place" placeholder="composition_place" value="{{$verses_edit_obj['posts_details']['composition_place']}}"/>
                                <label for="composition_place">Composition Place</label>
                            </div>
                            <div class="form-floating mb-3" for="notation">
                                <input type="text" class="notation form-control" id="notation" name="notation" placeholder="Notation" value="{{$verses_edit_obj['posts_details']['notation']}}"/>
                                <label for="notation">notation</label>
                            </div>
                             {{-- <div class="form-row">
                                    <label for="profile_image">Upload Notation Image</label>
                                    <input type="file" class="form-control-file" id="posts_notation_images" name="posts_notation_images">
                            </div> --}}
                            <div class="form-row">
                                @if($verses_edit_obj['posts_media'] && $verses_edit_obj['posts_media']['posts_notation_images'] && file_exists('storage/images/notation/'.$verses_edit_obj['posts_media']['posts_notation_images']))
                                    <img src="{{ asset('storage/images/notation/'.$verses_edit_obj['posts_media']['posts_notation_images']) }}" alt="" title="" width="60"/>
                                    <label for="posts_notation_images">Upload New Notation Image</label>
                                    <input type="file" class="form-control-file" id="posts_notation_images" name="posts_notation_images"/>
                                @else
                                <label for="posts_notation_images">Upload Notation Image</label>
                                <input type="file" class="form-control-file" id="posts_notation_images" name="posts_notation_images"/>
                                @endif
                            </div>
                            <div class="form-floating mb-3" for="posts_youtube_video_url">
                                <input type="text" class="notation form-control" id="posts_youtube_video_url" name="posts_youtube_video_url" placeholder="youtube video url" value="{{$verses_edit_obj['posts_media']['posts_youtube_video_url']}}"/>
                                <label for="posts_youtube_video_url">youtube video url</label>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="song_id" value="{{ $verses_edit_obj['id'] }}" />
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Edit Song</button>
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
