@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
                <form action="{{ url()->full() }}" method="GET" id="searchForm">
                    <input type="hidden" name="s" value="on">
                    <input type="hidden" name="status" id="status" value="">
                    <div class="row">
                        <div class="col-4">
                            <h3 class="block-title">{{ $bank->name }} <small>Statement</small></h3>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class='input-group'>
                                    <input class="form-control" type="date" name="start_date" placeholder="from" @if(request()->get('start_date')) value="{{ date('Y-m-d', strtotime(request()->get('start_date'))) }}" @else value="{{ date('Y-m-d') }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class='input-group'>
                                    <input class="form-control" type="date" name="end_date" placeholder="from" @if(request()->get('end_date')) value="{{ date('Y-m-d', strtotime(request()->get('end_date'))) }}" @else value="{{ date('Y-m-d') }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="offset-3 col-6 offset-3 text-right">
                        {{-- <button onclick="searchSubmit('Withdrawal')" class="btn btn-danger float-right ">Withdrawal</button>
                        <button onclick="searchSubmit('deposit')" class="btn btn-success float-right mr-2">Deposit</button>
                        <a href="{{ route('banks.show',$bank) }}" class="btn btn-primary float-right mr-2">All Data</a> --}}
                        <button type="button" class="btn btn-outline-success" disabled>Deposit Tk. {{ $bankdetails->where('status','deposit')->sum('amount') }}</button>
                        <button type="button" class="btn btn-outline-danger" disabled>Withdrawal Tk. {{ $bankdetails->where('status','Withdrawal')->sum('amount') }}</button>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">#NO</th>
                            <th width="20%">Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach ($bankdetails as $key=>$item)
                            <tr class="{{ $item->status == 'deposit' ? 'table-success' : 'table-danger' }}">
                                <td class="text-center font-size-sm">{{ $key+1 }}</td>
                                <td class="font-w600 font-size-sm">{{ $item->created_at->format('d F, Y') }}</td>
                                <td class="font-w600 font-size-sm">{{ $item->status }}</td>
                                <td class="font-w600 font-size-sm">Tk.{{ $item->amount }}</td>
                                <td class="font-w600 font-size-sm">{{ $item->note }}</td>
                            </tr>
                    	@endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<div class="modal fade" id="balanchModel" tabindex="-1" role="dialog" aria-labelledby="ticket" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('bank.balach') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="bankId" value="">
                <input type="hidden" name="update" id="bankUpdate" value="">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Bank Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center py-sm-3 py-md-5">
                            <div class="col-sm-10 col-md-8">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" stop="0.01" class="form-control form-control-alt" name="amount" placeholder="5000" min="0" required>
                                </div>
                            </div>
                            <div class="col-sm-10 col-md-8">
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea name="note" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>

                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save mr-1"></i>Summit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    function searchSubmit(type){
        console.log(type);
        document.getElementById("status").value = type;
        $('#searchForm').submit();
    }
    function depositForm(id) {
        $('#balanchModel').modal('show');
        $("#bankId").val(id);
        $("#bankUpdate").val('deposit');
    }
    function withdrawalForm(id) {
        $('#balanchModel').modal('show');
        $("#bankId").val(id);
        $("#bankUpdate").val('withdrawal');
    }
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datepicker();
        $('#datetimepicker1').datepicker();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css">
@endsection
