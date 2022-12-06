@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>{{ $saleVendor->name }}</h4>
            </div>
            <div class="col-md-6 col-xl-3">
                <!-- Default Position Primary -->
                <div class="block">
                    <div class="block-content block-content-full ribbon ribbon-primary">
                        <div class="ribbon-box">
                            {{ number_format($saleVendor->total) }}
                        </div>
                        <div class="text-center py-4">
                            <p>
                                <i class="fas fa-3x fa-money-bill-wave text-success"></i>
                            </p>
                            <h4 class="mb-0 text-success">Total Paid</h4>
                        </div>
                    </div>
                </div>
                <!-- END Default Position Primary -->
            </div>
            <div class="col-md-6 col-xl-3">
                <!-- Default Position Primary -->
                <div class="block">
                    <div class="block-content block-content-full ribbon ribbon-primary">
                        <div class="ribbon-box ">
                            {{ number_format($saleVendor->amount) }}
                        </div>
                        <div class="text-center py-4">
                            <p>
                                <i class="fas fa-money-bill-wave fa-3x text-danger"></i>
                            </p>
                            <h4 class="mb-0 text-danger">Total Due</h4>
                        </div>
                    </div>
                </div>
                <!-- END Default Position Primary -->
            </div>
            <div class="col-md-6 col-xl-3">
                <!-- Default Position Primary -->
                <div class="block">
                    <div class="block-content block-content-full ribbon ribbon-primary">
                        <div class="text-center py-4">
                            <p>
                                <i class="fas fa-3x fa-money-check-alt text-primary"></i>
                            </p>
                            <h4 class="mb-0">
                                <a href="javascript:void(0)" onclick="vendorwithdrawalForm({{ $saleVendor->id }})" class="btn btn-primary"> Due Paid</a>
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- END Default Position Primary -->
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block">
                    <div class="block-content block-content-full ribbon ribbon-success">
                        <div class="text-center py-4">
                            <p>
                                <i class="fas fa-3x fa-plane-departure text-success"></i>
                            </p>
                            <h4 class="mb-0">
                                <a href="{{ route('salevendor.register',$saleVendor->id) }}" class="btn btn-success">Add New</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full ">
                <div class="row">
                    <div class="col-md-12">
                        <a target="_blank" href="{{ route('salevendor.due.print',$saleVendor->id) }}" class="btn btn-info" style="margin-left: 19%">Invoice</a>
                    </div>
                </div>
                <table id="printTable" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination table-responsive table-sm">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Issue Date</th>
                            <th>Reg Type</th>
                            <th>Name</th>
                            <th>Airline</th>
                            <th>Mobile</th>
                            <th>Passport Number</th>
                            <th>Flight Date</th>
                            <th>Sector</th>
                            <th>Pay</th>
                            <th>Due</th>
                            <th>Ground Total</th>
                            <th>States</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $key=>$ticket)
                            <tr>
                                <td  onclick="showTicketModal({{ $ticket->id }})" class="text-center  font-size-sm"> <span class="badge badge-info">{{ $ticket->code }}</span></td>
                                <td onclick="showTicketModal({{ $ticket->id }})">
                                    <span class="badge badge-dark">{{ date('d M y, g:i a', strtotime($ticket->created_at)) }}</span>
                                </td>
                                <td onclick="showTicketModal({{ $ticket->id }})"  class="text-center font-size-sm">{{ $ticket->type }}</td>
                                <td onclick="showTicketModal({{ $ticket->id }})"  class="font-w600 font-size-sm">
                                    {{ $ticket->name }}
                                </td>
                                <td onclick="showTicketModal({{ $ticket->id }})" class="d-none d-sm-table-cell font-size-sm">
                                    {{ $ticket->airline ? $ticket->airline->name : 'N/A'  }}
                                </td>
                                <td onclick="showTicketModal({{ $ticket->id }})" class="d-none d-sm-table-cell">
                                    <span class="badge badge-success">{{ $ticket->number }}</span>
                                </td>
                                <td onclick="showTicketModal({{ $ticket->id }})" class="d-none d-sm-table-cell font-size-sm">
                                    <em class="text-muted font-size-sm">{{ $ticket->passport_number }}</em>
                                </td>
                                <td onclick="showTicketModal({{ $ticket->id }})">
                                    <span class="badge badge-primary">{{ date('d M y, g:i a', strtotime($ticket->flight_date)) }}</span>
                                </td>
                                <td onclick="showTicketModal({{ $ticket->id }})" class="d-none d-sm-table-cell font-size-sm">
                                    {{ $ticket->sector ? $ticket->sector->name : 'N/A'  }}
                                </td>
                                <td>
                                    <em class="text-muted font-size-sm">{{ $ticket->pay }}</em>
                                </td>
                                </td>
                                <td>
                                    <em class="text-muted font-size-sm">{{ $ticket->due }}</em>
                                </td>
                                </td>
                                <td>
                                    <em class="text-muted font-size-sm">{{ $ticket->amount }}</em>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    @if($ticket->states == 'On hold')
                                        <span class="badge badge-warning">{{ $ticket->states }}</span>
                                    @elseif($ticket->states == 'In process')
                                        <span class="badge badge-primary">{{ $ticket->states }}</span>
                                    @elseif($ticket->states == 'Confirm')
                                        <span class="badge badge-success">{{ $ticket->states }}</span>
                                    @elseif($ticket->states == 'Delivery ok')
                                        <span class="badge badge-success">{{ $ticket->states }}</span>
                                    @elseif($ticket->states == 'Cancelled')
                                        <span class="badge badge-danger">{{ $ticket->states }}</span>
                                    @elseif($ticket->states == 'Refund')
                                        <span class="badge badge-dark">{{ $ticket->states }}</span>
                                    @else
                                        <span class="badge badge-secondary">Panding</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if ($ticket->due > 0)
                                            <button onclick="douPaid({{ $ticket->id }});" class="btn btn-sm btn-success" data-toggle="tooltip" title="Due amount paid">
                                            <i class="fas fa-money-bill fa-fw"></i> </button>
                                        @else
                                            <button class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Due amount paid">
                                            <i class="fas fa-money-bill fa-fw"></i> </button>
                                        @endif
                                        <button onclick="showTicketModal({{ $ticket->id }})" class="btn btn-sm btn-info" data-toggle="tooltip" title="View Ditetels">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </button>
                                        <a href="{{ route('tickets.edit',$ticket) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" title="Edit Data">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </a>
                                        @if (auth()->user()->role == 'admin')
                                            <a href="javascript:void(0)" onclick="confirm_modal('{{route('tickets.delete', $ticket->id)}}');" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Item">
                                                <i class="fa fa-fw fa-trash-alt"></i>
                                            </a>
                                        @endif
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
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" name="note" rows="4" placeholder="Textarea content.."></textarea>
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

<div class="modal fade" id="duePaid" tabindex="-1" role="dialog" aria-labelledby="duePaid" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="duePaid-modal-body">
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
    function douPaid(id){
        $('#duePaid-modal-body').html(null);
        $('#duePaid').modal('show');
        $.post('{{ route('douPaid.model.show') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
            $('#duePaid-modal-body').html(data);
        });
    }
</script>


    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script>

        $(document).ready(function() {
            $('#printTable').DataTable( {
                dom: 'Bfrtip',
                ordering: false,
                pageLength: 25,
                buttons: [
                    'csv', 'excel', 'pdf'
                ]
            } );
        } );

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <style>
        #printTable_wrapper{
            margin-top: -38px;
        }
    </style>
@endsection
