@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
            	<div class="row">
            		<div class="col-lg-6">
            			<h3 class="block-title">Payment History <small>list</small></h3>
            		</div>
            	</div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">#NO</th>
                            <th width="25%">Date</th>
                            <th width="10%">Amount</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dates as $key=>$item)
                            <tr>
                                <td class="text-center font-size-sm">{{ $key+1 }}</td>
                                <td class="font-w600 font-size-sm">{{ $item->created_at->format('F j, Y, g:i a') }}</td>
                                <td class="font-w600 font-size-sm">Tk.{{ $item->amount }}</td>
                                <td class="font-w600 font-size-sm">{!! $item->note !!}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection