@extends('backend.layouts.master_v2')
@section('title')
Vendor Transaction Lists
@endsection
@section('active_breadcumbs_title')
Vendor Transaction Lists
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Vendor Transaction Lists</h4>
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
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Vendor Transaction Lists</b></h4>
                <div class="p20">
                    <table class="table table-bordered data-table" id="datatable">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Transaction ID</th>
                                <th>Base Transaction Amount</th>
                                <th>Transaction Amount</th>
                                <th>Transaction Currency</th>
                                <th>Transaction Type</th>
                                <th>Created Date</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- new data table end -->
    </div>
</div> <!-- container -->
@endsection
@section('after_domready_script')
<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.vendor.accounts.transaction.list') }}"
            , order: [], // this is very important. If now use this then default order will not work on renderred
            columns: [{
                    data: 'id'
                    , name: 'id'
                }
                , {
                    data: 'transaction_id'
                    , name: 'transaction_id'
                }
                , {
                    data: 'base_transaction_amount'
                    , name: 'base_transaction_amount'
                }
                , {
                    data: 'transaction_amount'
                    , name: 'transaction_amount'
                }
                , {
                    data: 'transaction_currency'
                    , name: 'transaction_currency'
                    , title: 'Payment Gateway Type'
                }
                , {
                    data: 'transaction_type'
                    , name: 'transaction_type'
                }
                , {
                    data: 'created_at'
                    , name: 'created_at'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });
    });

</script>
@endsection
