@extends('backend.layouts.master_v2')
@section('title')
Transaction Details
@endsection
@section('active_breadcumbs_title')
Transaction Details
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Transaction Details</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- new data table start -->
        <div class="col-sm-12">
            <div>
                @include('backend.layouts.partials.messages')
            </div>
            <div>
                <!-- body -->
                <div class="card-box">
                    <div class="p20">
                        <table class="table table-bordered table-custom-report">
                            <tbody>
                                <tr>
                                    <td>Id</td>
                                    <td>{{ $transactionDetails->id }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction Id</td>
                                    <td>{{ $transactionDetails->transaction_id }}</td>
                                </tr>
                                <tr>
                                    <td>Base Trsaction Amount</td>
                                    <td>{{ $transactionDetails->base_transaction_amount }} {{ strtoupper($transactionDetails->transaction_currency) }}</td>
                                </tr>
                                <tr class="alert alert-info">
                                    <td>Profit</td>
                                    <td>{{ $transactionDetails->transaction_amount }} {{ strtoupper($transactionDetails->transaction_currency) }}</td>
                                </tr>
                                <tr>
                                    <td>Trsaction Type</td>
                                    <td>{{ $transactionDetails->transaction_type }}</td>
                                </tr>
                                <tr>
                                    <td>Datetime of Transaction</td>
                                    <td>{{ $transactionDetails->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Date of Counselling</td>
                                    <td>{{ $transactionDetails->date_of_counselling }}</td>
                                </tr>
                                <tr>
                                    <td>Start Time</td>
                                    <td>{{ $transactionDetails->start_time }}</td>
                                </tr>
                                <tr>
                                    <td>End Time</td>
                                    <td>{{ $transactionDetails->end_time }}</td>
                                </tr>
                                <tr>
                                    <td>Booked By User Id</td>
                                    <td>{{ $transactionDetails->booked_user_id }}</td>
                                </tr>
                                <tr>
                                    <td>Booked By User Full Name</td>
                                    <td>{{ $transactionDetails->booked_user_full_name }}</td>
                                </tr>
                                <tr>
                                    <td>Booked By User Email</td>
                                    <td>{{ $transactionDetails->booked_user_email }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction By User Mobile Number</td>
                                    <td>{{ $transactionDetails->transaction_by_user_mobile_number }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction To User Mobile Number</td>
                                    <td>{{ $transactionDetails->transaction_to_user_mobile_number }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction To User Id</td>
                                    <td>{{ $transactionDetails->transaction_to_user_id }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction To User Full Name</td>
                                    <td>{{ $transactionDetails->transaction_to_user_full_name }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction To User Email</td>
                                    <td>{{ $transactionDetails->transaction_to_user_email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end body -->
            </div>
        </div>
        <!-- new data table end -->
    </div>
</div> <!-- container -->
@endsection
