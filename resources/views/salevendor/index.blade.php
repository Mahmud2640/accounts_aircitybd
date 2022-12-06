@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
            	<div class="row">
            		<div class="col-lg-6">
            			<h3 class="block-title">Sale Vendore <small>list</small></h3>
            		</div>
            		<div class="col-lg-6">
            			<a href="{{ route('salevendor.create') }}" class="btn btn-success float-right">Add New</a>
            		</div>
            	</div>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">#NO</th>
                            <th width="20%">Sale Vendor name</th>
                            <th width="20%">Mobile</th>
                            <th>Due Amount</th>
                            <th>Total Paid</th>
                            {{-- <th width="10%">Pay Now</th> --}}
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key=>$item)
                            <tr>
                                <td class="text-center font-size-sm">{{ $key+1 }}</td>
                                <td class="font-w600 font-size-sm">
                                    <a href="{{ route('salevendor.show',$item->id) }}">{{ $item->name }}</a>
                                </td>
                                <td class="font-w600 font-size-sm">
                                    <a href="{{ route('salevendor.show',$item->id) }}">{{ $item->mobile }}</a>
                                </td>
                                <td class="font-w600 font-size-sm">Tk.{{ $item->amount }}</td>
                                <td class="font-w600 font-size-sm">Tk.{{ $item->total }}</td>
                                {{-- <td class="font-w600 font-size-sm">
                                    <button onclick="vendordepositForm({{ $item->id }})" class="btn btn-success btn-sm" type="button">New Sale</button>
                                    <button onclick="vendorwithdrawalForm({{ $item->id }})" class="btn btn-success btn-sm" type="button">Due Paid</button>
                                </td> --}}

                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('salevendor.paymetn-history',$item->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Payment History">
                                            <i class="fas fa-file-invoice fa-fw"></i>
                                        </a>
                                        <a href="{{ route('salevendor.edit',$item->id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="confirm_modal('{{route('salevendor.delete', $item->id)}}');" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Item">
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

<div class="modal fade" id="saleVendorModel" tabindex="-1" role="dialog" aria-labelledby="ticket" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('salevendor.balach') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="saleId" value="">
                <input type="hidden" name="update" id="saleUpdate" value="">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Sale Vender Balanc update form</h3>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center py-sm-3 py-md-5">
                            <div class="col-sm-10 col-md-8">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" stop="0.01" class="form-control form-control-alt" name="amount" placeholder="Amount" min="0" required>
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
    function vendordepositForm(id) {
        $('#saleVendorModel').modal('show');
        $("#saleId").val(id);
        $("#saleUpdate").val('deposit');
    }
    function vendorwithdrawalForm(id) {
        $('#saleVendorModel').modal('show');
        $("#saleId").val(id);
        $("#saleUpdate").val('due');
    }
</script>
@endsection
