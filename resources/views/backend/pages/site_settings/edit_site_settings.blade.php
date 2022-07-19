@extends('backend.layouts.master_v2')
@section('title')
Edit Site Settings
@endsection
@section('active_breadcumbs_title')
Edit Site Settings
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Site Settings</h4>
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
                <h4 class="header-title"><b>Edit Site Settings</b></h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <!-- main form start -->
                        <form action="{{ route('site-settings.update', $site_settings_edit_data->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form">
                                <div class="form-group">
                                    <label for="txtModuleIdentifier">Module Identifier</label>
                                    <input type="text" name="module_identifier" id="txtModuleIdentifier" class="form-control" placeholder="type Module Identifier" value="{{ $site_settings_edit_data->module_identifier }}" />
                                </div>
                                <div class="form-group">
                                    <label for="txtParam">Param</label>
                                    <input type="text" name="param" id="txtParam" class="form-control" placeholder="Param" value="{{ $site_settings_edit_data->param }}" />
                                </div>
                                <div class="form-group">
                                    <label for="txtParamValue">Param Value</label>
                                    <input type="text" name="param_value" id="txtParamValue" class="form-control" placeholder="Param Value" value="{{ $site_settings_edit_data->param_value }}" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Edit Site Settings Data</button>
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
