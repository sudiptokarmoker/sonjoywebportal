@extends('backend.layouts.master_v2')
@section('title')
Video Question
@endsection
@section('active_breadcumbs_title')
Video Question
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Video Question List</h4>
                <!-- breadcumbs -->
                @include('backend.layouts.partials.v2.breadcumbs_v2')
                <!-- end of breadcumbs -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        @if (Auth::user()->hasPermissionTo('videoQuestion.create.form.view'))
        <div>
            <p class="float-right">
                <a class="btn btn-warning waves-effect waves-light text-white fl-r" href="{{ route('video_question.create') }}" type="button">Create Video Question</a>
            </p>
        </div>
        @endif
    </div>
    <div class="row">
        <!-- new data table start -->
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Video Question List</b></h4>
                <div class="p20">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="60%">Question Title</th>
                                <th width="5%">Order</th>
                                <th width="30%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach ($video_question_collection as $row)
                            <tr data-item-id={{ $row->id }} data-sort-order-number={{ $row->question_display_order }}>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $row->question }}</td>
                                <td class="sort-td-column">{{ $row->question_display_order }}</td>
                                <td>
                                    <a class="btn btn-info text-white" href={{ route('video_question.edit', $row->id) }}>Edit</a>
                                    <a class="btn btn-danger text-white" href="{{ route('video_question.destroy', $row->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $row->id }}').submit();">Delete</a>
                                    <form id="delete-form-{{ $row->id }}" action="{{ route('video_question.destroy', $row->id) }}" method="POST" style="display: none;">
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
        $("#sortable").sortable();

        $("#sortable").on("sortstop", function(event, ui) {
            let sort_data = [];
            $("tbody#sortable tr").each(function(index, item) {
                // prepareing data array with sort id and item id //
                sort_data[index] = {
                    'item_id': $(item).data('item-id')
                    , 'sort_id': $(item).data('sort-order-number')
                    , 'new_sort_id': index + 1
                };
            });
            $.ajax({
                url: '{{ route('admin.video_question.question_sort_processing') }}', 
                dataType: 'json'
                , type: 'POST'
                , data: {
                    '_token': '{{ csrf_token() }}'
                    , 'sort_data': sort_data
                }
                , success: function(data) {
                    $("tbody#sortable tr").each(function(index, item) {                        
                        $("tbody#sortable tr").eq(index).find('.sort-td-column').text(index + 1);
                    });
                }, 
                error: function() {
                }
            })
        });
    });

</script>
@endsection
