@extends('backend.layouts.master')
@section('title', 'Video Question Create Page')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection
@section('breadcrumbs')
    <h4 class="page-title pull-left">Create User</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="{{ route('admin.dashboard') }}">Dashboard Home</a></li>
        <li><a href="{{ route('roles.index') }}">Roles</a></li>
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li><a href="{{ route('permission.index') }}">Pemission</a></li>
        <li><a href="{{ route('video_question.index') }}">Video Question</a></li>
    </ul>
@endsection
@section('admin-content')
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit Video Question</h4>
                        <div>
                            @include('backend.layouts.partials.messages')
                            <form action="{{ route('video_question.update', $video_question->id) }}" method="POST">
                                @method('PUT')
                                @csrf
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection