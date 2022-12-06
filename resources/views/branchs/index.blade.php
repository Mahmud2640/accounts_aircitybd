@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
            	<div class="row">
            		<div class="col-lg-6">
            			<h3 class="block-title">Your conpany branch <small>list</small></h3>
            		</div>
            		<div class="col-lg-6">
            			<a href="{{ route('branchs.create') }}" class="btn btn-success float-right">Add New</a>
            		</div>
            	</div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">#NO</th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Email</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">mobile</th>
                            <th class="d-none d-sm-table-cell">Address</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Access</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach ($branchs as $key=>$branch)
                    		<tr>
	                            <td class="text-center font-size-sm">{{ $key+1 }}</td>
	                            <td class="font-w600 font-size-sm">
	                                {{ $branch->name }}
	                            </td>
	                            <td class="d-none d-sm-table-cell font-size-sm">
	                                <em class="text-muted">{{ $branch->email }}</em>
	                            </td>
	                            <td class="d-none d-sm-table-cell">
	                                <span class="badge badge-success">{{ $branch->mobile }}</span>
	                            </td>
	                            <td>
	                                <em class="text-muted font-size-sm">{{ $branch->location }}</em>
	                            </td>
	                            <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('branchs.edit',$branch) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="confirm_modal('{{route('branchs.delete', $branch->id)}}');" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Item">
                                                <i class="fa fa-fw fa-trash-alt"></i></a>
                                        
                                    </div>
                                </td>
	                        </tr>
                    	@endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>

@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection