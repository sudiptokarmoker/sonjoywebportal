@extends('backend.layouts.master_v2')
@section('title')
Create Site Settings
@endsection
@section('active_breadcumbs_title')
Create Site Settings
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Create Site Settings</h4>
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
                <h4 class="header-title">Create Site Settings</h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('site-settings.store') }}" method="POST" class="p20" enctype="multipart/form-data">
                            @csrf
                            <div class="form">
                                <div class="form-group">
                                    <label for="txtModuleIdentifier">Module Identifier</label>
                                    <input type="text" name="module_identifier" id="txtModuleIdentifier" class="form-control" placeholder="type Module Identifier" />
                                </div>
                                <div class="form-group">
                                    <label for="txtParam">Param</label>
                                    <input type="text" name="param" id="txtParam" class="form-control" placeholder="Param" />
                                </div>
                                <div class="form-group">
                                    <label for="txtParamValue">Param Value</label>
                                    <input type="text" name="param_value" id="txtParamValue" class="form-control" placeholder="Param Value" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Site Settings Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- new data table end -->
    </div>
</div> <!-- container -->
@endsection
