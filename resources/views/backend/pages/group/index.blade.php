@extends('backend.layouts.master')

@section('title', 'Permission Lists Pages')

@section('breadcrumbs')
<h4 class="page-title pull-left">Permission Lists</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="{{ route('admin.dashboard') }}">Dashboard Home</a></li>
    <li><a href="{{ route('roles.index') }}">Roles</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a href="{{ route('permission.index') }}">Pemission</a></li>
</ul>
@endsection

@section('admin-content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12">
            @include('backend.layouts.partials.messages')
        </div>
    </div>
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Permission List</h4>
                    <p class="float-right">
                        <a class="btn btn-primary text-white" href="{{ route('group.create') }}">Create</a>
                    </p>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="20%">Group Name</th>
                                    <th width="35%">Action Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permmission_group as $row)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $row->group_name }}</td>
                                    <td>
                                        <a class="btn btn-info text-white" href={{ route('group.edit', $row->id) }}>Edit</a>
                                        <a class="btn btn-danger text-white" href="{{ route('group.destroy', $row->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $row->id }}').submit();">Delete</a>
                                        <form id="delete-form-{{ $row->id }}" action="{{ route('group.destroy', $row->id) }}" method="POST" style="display: none;">
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
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<!-- style css -->
@endsection
@section('custom_script_footer_on_demand_on_page')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script type="text/javascript">
    /*================================
    datatable active
    ==================================*/
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            responsive: true
        });
    }

</script>
@endsection
