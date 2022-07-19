@extends('backend.layouts.master_v2')
@section('title')
Category
@endsection
@section('active_breadcumbs_title')
Category
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Category Lists</h4>
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
        <div class="col-lg-6">
            <h4 class="header-title"><b>Add a new cateogry</b></h4>
            <form>
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="category_name" placeholder="category name" />
                </div>
                <div class="mb-3">
                    <label for="category_name_bangla" class="form-label">Category Name Bangla</label>
                    <input type="text" class="form-control" id="category_name_bangla" placeholder="category name bangla" />
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="parent_id">
                        <option selected>Parent Category</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Category List</b></h4>
                <div class="p20">
                    <table class="table table-bordered data-table" id="datatable">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Category Name</th>
                                <th>Category Bangla</th>
                                <th>Category Slug</th>
                                <th>Category Slug Bangla</th>
                                <th>Created At</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->
@endsection
@section('after_domready_script')
<script type="text/javascript">
    //var table;
    $(function() {
        $.fn.dataTable.ext.errMode = 'throw';
        var table = $('.data-table').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('posts_category.lists.all') }}"
            , order: []
            , columns: [{
                    data: 'id'
                    , name: 'id'
                }
                , {
                    data: 'category_name'
                    , name: 'category_name'
                }
                , {
                    data: 'category_name_bangla'
                    , name: 'category_name_bangla'
                }
                , {
                    data: 'category_slug'
                    , name: 'category_slug'
                }
                , {
                    data: 'category_slug_bangla'
                    , name: 'category_slug_bangla'
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
            ]
        });
    });

    function delete_form_processing(category_id) {
        event.preventDefault();
        let text = "Are you confirm to delete this category!! If you delete site may down";
        if (confirm(text) == true) {
            document.getElementById('delete-form-' + category_id).submit();
        }
        return;
    }

</script>
@endsection
