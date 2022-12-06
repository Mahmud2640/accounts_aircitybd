@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
            	<div class="row">
            		<div class="col-lg-6">
            			<h3 class="block-title">Salary <small>list</small></h3>
            		</div>
            		<div class="col-lg-6">
            			<a href="{{ route('banks.create') }}" class="btn btn-success float-right">Add New</a>
            		</div>
            	</div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">#NO</th>
                            <th width="20%">Bank name</th>
                            <th>Amount</th>
                            <th width="20%">Deposit/Withdrawal</th>
                            <th width="10%">Transfer</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach ($items as $key=>$item)
                            <tr style="font-size: 18px;">
                                <td class="text-center font-size-sm">{{ $key+1 }}</td>
                                <td style="font-size:19px;font-weight: bold;">{{ $item->name }}</td>
                                <td style="font-size:19px;font-weight: bold;">Tk.{{ $item->amount }}</td>
                                <td style="font-size:19px;font-weight: bold;">
                                    <button onclick="depositForm({{ $item->id }})" class="btn btn-success btn-sm" type="button">Deposit</button>
                                    <button onclick="withdrawalForm({{ $item->id }})" class="btn btn-danger btn-sm" type="button">Withdrawal</button>
                                </td>
                                <td style="font-size:19px;font-weight: bold;">
                                    <button onclick="transferForm({{ $item->id }})" class="btn btn-dark btn-sm" type="button">Transfer</button>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('banks.show',$item) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Statement">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        <a href="{{ route('banks.edit',$item) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="confirm_modal('{{route('banks.delete', $item->id)}}');" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Item">
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

<div class="modal fade" id="transferModel" tabindex="-1" role="dialog" aria-labelledby="ticket" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="transferForm-modal-body">

        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
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
    function transferForm(id) {
        $('#transferForm-modal-body').html(null);
        $('#transferModel').modal('show');
        $.post('{{ route('bank_transfor.model.show') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
            $('#transferForm-modal-body').html(data);
        });
    }
</script>
@endsection
