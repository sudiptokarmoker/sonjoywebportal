@extends('backend.layouts.master_v2')
@section('title')
Site Settings
@endsection
@section('active_breadcumbs_title')
Site Settings
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Site Settings</h4>
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
    </div>
    <div class="row">
        <!-- currency lists -->
        <div class="col">
            <div>
                @if(Auth::user()->hasPermissionTo('currency.create'))
                <p class="float-left">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#currencyCreateModel">
                        Add Currency
                    </button>
                </p>
                <!-- Modal -->
                <div class="modal fade" id="currencyCreateModel" tabindex="-1" aria-labelledby="currencyCreateModelLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="form currency_form">
                            @method('post')
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Currency</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body currency-lists-data">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Save Currency</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            <div>
                @if (Auth::user()->hasPermissionTo('currency.lists'))
                @if(isset($currencyLists) && count($currencyLists) > 0)
                <table id="datatable_currency" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th width="5%">ID</th>
                            <th width="30%">Currency Code</th>
                            <th width="20%">Currency Code details</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currencyLists as $row)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->currency_code }}</td>
                            <td>{{ $row->currency_code_details }}</td>
                            <td>
                                <a class="btn btn-danger text-white" href="{{ route('admin.delete.currency', $row->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $row->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $row->id }}" action="{{ route('admin.delete.currency', $row->id) }}" method="POST" style="display: none;">
                                    @method('GET')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                @endif
            </div>
        </div>
        <!-- end of view currency lists -->
        <div class="col">
            @if (Auth::user()->hasPermissionTo('site.settings.create'))
            <div>
                <p class="float-right">
                    <a class="btn btn-warning waves-effect waves-light text-white fl-r" href="{{ route('site-settings.create') }}" type="button">Create Site Settings</a>
                </p>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <!-- new data table start -->
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Counselling Interest Category Settings</b></h4>
                <div class="p20">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="5%">Original ID</th>
                                <th width="30%">Settings Module Identifier Name</th>
                                <th width="20%">Param</th>
                                <th width="10%">Value</th>
                                <th width="30%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-settings-row">
                            @foreach ($site_settings_data as $row)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->module_identifier }}</td>
                                <td>{{ $row->param }}</td>
                                <td>{{ $row->param_value }}</td>
                                <td>
                                    <a class="btn btn-info text-white" href={{ route('site-settings.edit', $row->id) }}>Edit</a>
                                    <a class="btn btn-danger text-white" href="{{ route('site-settings.destroy', $row->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $row->id }}').submit();">Delete</a>
                                    <form id="delete-form-{{ $row->id }}" action="{{ route('site-settings.destroy', $row->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
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
    $(document).ready(function() {
        $('#datatable').DataTable();
        // load data for currency
        @if(Auth::user()->hasPermissionTo('currency.create'))
        $.get('https://openexchangerates.org/api/currencies.json', function(data) {
            let currencyDataObject = []
                , selectHtmlPrepared = '<select name="currency_lists_dropdown" class="form-select" aria-label="multiple select example" id="currency_lists_dropdown">';
            $.each(data, function(i, v) {
                selectHtmlPrepared += '<option value="' + i + '">' + v + '</option>';
            });
            selectHtmlPrepared += '</select>';
            $('.currency-lists-data').html(selectHtmlPrepared);
        });
        @endif
        // end of currency
    });

    function update_interest_settings() {
        var selectedActiveStatus = $("input[name='active_status']:checked").val();
        if (selectedActiveStatus !== undefined) {
            $.ajax({
                url: "{{ route('admin.counsellor.interest.category.settings') }}"
                , dataType: "json"
                , data: {
                    'settings_id': selectedActiveStatus
                }
            }).done(function() {
                console.log("END");
            });
        }
    }
    @if(Auth::user()->hasPermissionTo('currency.create'))
        $(".currency_form").submit(function(event) {
            let selectedCurrencyCodeActiveStatus = $("#currency_lists_dropdown option:selected").val();
            $.ajax({
                url: "{{ route('admin.create.currency.ajax') }}",
                type: "POST",
                data: {currency_code: selectedCurrencyCodeActiveStatus, currency_code_details: $("#currency_lists_dropdown option:selected").text(), _token: "{{csrf_token()}}"},
                dataType: "json",
            }).done(function(dataObj) {
                window.location.href = "{{ route('site-settings.index') }}";
            }).fail(function(jqXHR, textStatus) {
                //alert( "Request failed: " + textStatus );
               /* 
                const responseText = JSON.parse(jqXHR.responseText);
                console.log(responseText);
                console.log(jqXHR.responseText);
                console.log(textStatus);
                console.log(errorThrown);
                */
                $('#currencyCreateModel').modal('hide');
                $('.dialog-body').html('<span style="color:red">'+textStatus+'</span>');
                $('#statusDisplayModal').modal('show');
            });
            event.preventDefault();
        });
    @endif
</script>
@endsection
