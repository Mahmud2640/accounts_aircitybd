@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
            	<div class="row">
            		<div class="col-lg-6">
            			<h3 class="block-title">Website <small>list</small></h3>
            		</div>
            		<div class="col-lg-6">
            			<a href="{{ route('links.create') }}" class="btn btn-success float-right">Add New</a>
            		</div>
            	</div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">#NO</th>
                            <th width="20%">Image</th>
                            <th width="20%">Name</th>
                            <th width="70%">URL</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach ($links as $key=>$item)
                    		<tr>
	                            <td class="text-center font-size-sm">{{ $key+1 }}</td>
	                            <td class="font-w600 font-size-sm">
	                                <a target="_blank" href="{{ $item->link }}"><img src="{{ asset($item->image) }}" style="width:60px;height: 60px;"></a>
	                            </td>
                                <td class="font-w600 font-size-sm">
                                    <a target="_blank" href="{{ $item->link }}">{{ $item->name }}</a>
                                </td>
                                <td class="font-w600 font-size-sm">
                                    <a target="_blank" href="{{ $item->link }}">{{ $item->link }}</a>
                                </td>

	                            <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('links.edit',$item) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="confirm_modal('{{route('links.delete', $item->id)}}');" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Item">
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