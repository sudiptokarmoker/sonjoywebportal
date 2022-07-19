@extends('backend.layouts.master_v2')
@section('title')
Withdraw request processing
@endsection
@section('active_breadcumbs_title')
Withdraw request processing
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Withdraw request processing</h4>
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
                <h4 class="header-title"><b>Update withdraw processing status</b></h4>
                <div class="p20">
                    <div>
                        @include('backend.layouts.partials.messages')
                        <!-- main form start -->
                        <form action="{{ route('withdraw-details.update', $withdrawDetailsModel->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form">
                                <div class="form-row">
                                    <label for="amount">Amount</label>
                                    <input type="text" readonly class="form-control" id="amount" value="{{ $withdrawDetailsModel->amount }}">
                                </div>
                                <div class="form-row">
                                    <label for="currency">Currency</label>
                                    <input type="text" readonly class="form-control" id="currency" value="{{ $withdrawDetailsModel->currency }}">
                                </div>
                                <div class="form-row">
                                    <label for="withdraw_status">Status</label>
                                    <select class="form-control" name="status" id="withdraw_status">
                                        <option>Select Status</option>
                                        @foreach ($withdrawStatusLists as $value)
                                        <option value="{{ $value }}" {{ ( $value == $withdrawDetailsModel->status) ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($withdrawDetailsModel->transaction_details != null)
                                    <div class="form-row">
                                        <label for="transaction_payment_gateway_type">Transaction Payment Gateway Type</label>
                                        <select class="form-control" name="transaction_payment_gateway_type" id="transaction_payment_gateway_type">
                                            <option value="">Transaction Payment Gateway Type</option>
                                            @foreach ($getTransactionPaymentGatewayType as $value)
                                            <option value="{{ $value }}" {{ ( $value == $withdrawDetailsModel->transaction_details->transaction_payment_gateway_type) ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <label for="transaction_payment_gateway_track_id">Transaction Payment Gateway Track Id</label>
                                        <input type="text" class="form-control" id="transaction_payment_gateway_track_id" name="transaction_payment_gateway_track_id" value="{{ $withdrawDetailsModel->transaction_details->transaction_payment_gateway_track_id }}" />
                                    </div>
                                @else
                                    <div class="form-row">
                                        <label for="transaction_payment_gateway_type">Transaction Payment Gateway Type</label>
                                        <select class="form-control" name="transaction_payment_gateway_type" id="transaction_payment_gateway_type">
                                            <option value="">Transaction Payment Gateway Type</option>
                                            @foreach ($getTransactionPaymentGatewayType as $value)
                                            <option value="{{ $value }}">
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <label for="transaction_payment_gateway_track_id">Transaction Payment Gateway Track Id</label>
                                        <input type="text" class="form-control" name="transaction_payment_gateway_track_id" id="transaction_payment_gateway_track_id"/>
                                    </div>
                                @endif
                                <div>
                                    <div class="save-button-form-v1">
                                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Withdraw Request</button>
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
@section('after_domready_script')
<script type="text/javascript">
    //var table;

</script>
@endsection
