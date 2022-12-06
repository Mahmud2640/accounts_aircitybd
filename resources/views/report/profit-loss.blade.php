@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
            	<div class="row">
            		<div class="col-lg-6">
            			<h3 class="block-title">Profit / Loss <small>reports</small></h3>
            		</div>
            	</div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%">Months</th>
                            <th class="d-none d-sm-table-cell">Total Sale Amount</th>
                            <th class="d-none d-sm-table-cell">Total Purchase Amount</th>
                            <th class="d-none d-sm-table-cell">Profit / Loss</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach ($datas as $key=>$data)
                    		<tr>
	                            <td class="text-center font-size-sm">{{ $data->month }},{{ $data->year }}</td>
	                            <td class="d-none d-sm-table-cell">
	                                <em class="text-danger"><b>{{ number_format($data->amount) }} .Tk</b></em>
	                            </td>
                                <td class="d-none d-sm-table-cell">
                                    <em class="text-success"><b>{{ number_format($data->purchase) }} .Tk</b></em>
                                </td>
                                <td class="d-none d-sm-table-cell ">
                                    @php
                                        $sale = $data->amount;
                                        $purchase = $data->purchase;
                                        $total = $sale-$purchase;
                                    @endphp
                                    @if ($total > 0)
                                        Gross Profit <b class="font-size-sm text-success">{{ number_format($total) }} .Tk</b>
                                    @else
                                        Net Loss <b class="font-size-sm text-danger">{{ number_format(abs($total)) }} .Tk</b>
                                    @endif
                                    
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