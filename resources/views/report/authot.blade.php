@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
            	<div class="row">
            		<div class="col-lg-6">
            			<h3 class="block-title">Authot <small>reports</small></h3>
            		</div>
            	</div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">#NO</th>
                            <th class="text-center" style="width: 20%;">
                                <i class="far fa-user"></i>
                            </th>
                            <th class="d-none d-sm-table-cell">Total Sales Dou</th>
                            <th class="d-none d-sm-table-cell">Total Sales Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach ($datas as $key=>$data)
                    		<tr>
	                            <td class="text-center font-size-sm">{{ $key+1 }}</td>
	                            <td class="font-w600 font-size-sm">
                                    @if ($data->image)
	                                   <img src="{{ asset($data->image) }}" class="img-avatar img-avatar48">
                                    @else
                                        <img src="{{ asset('assets/media/avatars/avatar2.jpg') }}" class="img-avatar img-avatar48">
                                    @endif
                                    <br>
                                    {{ $data->name }}
	                            </td>
	                            <td class="d-none d-sm-table-cell">
	                                <em class="text-danger"><b>{{ number_format($data->tickets->sum('due') ,2) }} .Tk</b></em>
	                            </td>
                                <td class="d-none d-sm-table-cell">
                                    <em class="text-success"><b>{{ number_format($data->tickets->sum('pay') ,2) }} .Tk</b></em>
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