@extends('backend.layouts.master_v2')
@section('title')
Video Question Edit
@endsection
@section('active_breadcumbs_title')
Video Question Edit
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Video Question Edit Form</h4>
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
                <h4 class="header-title"><b>Edit Video Question</b></h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <!-- main form start -->
                        <form action="{{ route('video_question.update', $video_question->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form">
                                <div class="form-group">
                                    <label for="txtQuestion">Question</label>
                                    <input type="text" name="question" id="txtQuestion" class="form-control"
                                        placeholder="type question" value="{{ $video_question->question }}" />
                                </div>
                                <div class="form-group">
                                    <label for="txtQuestionDisplayOrder">Order</label>
                                    <input type="text" name="question_display_order" id="txtQuestionDisplayOrder"
                                        class="form-control" placeholder="type sort order"
                                        value="{{ $video_question->question_display_order }}" />
                                    <input type="hidden" name="existingSortOrderValue" value="{{ $video_question->question_display_order }}"/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Edit Question</button>
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