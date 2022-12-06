@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block">
            <div class="block-header">
            	<div class="row">
            		<div class="col-lg-6">
            			<h3 class="block-title">Tickets <small>list</small></h3>
            		</div>
            		<div class="col-lg-6">
            			<a href="{{ route('tickets.create') }}" class="btn btn-success float-right">Add New</a>
            		</div>
            	</div>
            </div>
            <div class="block-content block-content-full ">
                <table id="datatable" class="table table-bordered table-striped table-vcenter table-responsive table-sm">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Issue Date</th>
                            <th>Reg Type</th>
                            <th>Name</th>
                            <th>Airline</th>
                            <th>Mobile</th>
                            <th>Passport Number</th>
                            <th>Refered By</th>
                            <th>Flight Date</th>
                            <th>Sector</th>
                            <th>Pay</th>
                            <th>Due</th>
                            <th>States</th>
                            <th>Access</th>
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
                                <td onclick="showTicketModal({{ $ticket->id }})" class="d-none d-sm-table-cell font-size-sm">
                                    <em class="text-muted font-size-sm">{{ $ticket->refered_by }}</em>
                                </td>
                                <td onclick="showTicketModal({{ $ticket->id }})">
                                    @if ($ticket->flight_date)
                                        <span class="badge badge-primary">{{ date('d M y, g:i a', strtotime($ticket->flight_date)) }}</span>
                                    @endif
                                </td>
                                <td onclick="showTicketModal({{ $ticket->id }})" class="d-none d-sm-table-cell font-size-sm">
                                    {{ $ticket->sector ? $ticket->sector->name : 'N/A'  }}
                                </td>
	                            <td>
	                                <em class="text-muted font-size-sm">{{ $ticket->pay }}</em>
	                            </td>
                                <td>
                                    <em class="text-danger font-size-sm">{{ $ticket->due }}</em>
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
                                        @if (auth()->user()->role == 'admin')
                                            @if (!$ticket->sale_vendor_id)
                                                @if ($ticket->due > 0)
                                                    <a  href="javascript:void(0)" onclick="douPaid({{ $ticket->id }});" class="btn btn-sm btn-success" data-toggle="tooltip" title="Due amount paid">
                                                    <i class="fas fa-money-bill fa-fw"></i>
                                                @else
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Due amount paid">
                                                    <i class="fas fa-money-bill fa-fw"></i>
                                                @endif
                                            @else
                                                <a href="javascript:void(0)" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Sale Vendor Item">
                                                <i class="fas fa-money-bill fa-fw"></i>
                                            @endif
                                            </a>
                                            <button onclick="showTicketModal({{ $ticket->id }})" class="btn btn-sm btn-info" data-toggle="tooltip" title="View Ditetels">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </button>
                                            <a href="{{ route('tickets.edit',$ticket) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" title="Edit Data">
                                                <i class="fas fa-fw fa-edit"></i>
                                            </a>
                                        @endif
                                        <a target="_blank" href="{{ route('tickets.show',$ticket) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Print Invoice">
                                            <i class="fa fa-fw fa-print"></i>
                                        </a>
                                        @if (auth()->user()->role == 'admin')
                                            <a href="javascript:void(0)" onclick="confirm_modal('{{route('tickets.delete', $ticket->id)}}');" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Item">
                                                <i class="fa fa-fw fa-trash-alt"></i>
                                            </a>
                                        @endif
                                        @if ($ticket->purchase > 0)
                                            <button class="btn btn-sm btn-light text-success" type="button"><i class="far fa-check-circle" ></i></button>
                                        @else
                                            <button class="btn btn-sm btn-light text-danger" type="button"> <i class="far fa-times-circle"></i></button>
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

    <div class="modal fade" id="ticket" tabindex="-1" role="dialog" aria-labelledby="ticket" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Ticket details</h3>
                    </div>
                    <div class="block-content" id="ticket-modal-body">

                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>

                        <button onclick="sendMail()" type="button" class="btn btn-sm btn-success"><i class="fa fa-envelope mr-1"></i>Mail Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mailModel" tabindex="-1" role="dialog" aria-labelledby="ticket" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('mail.send') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="ticketId" value="">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Send mail</h3>
                        </div>
                        <div class="block-content">
                            <div class="row justify-content-center py-sm-3 py-md-5">
                                <div class="col-sm-10 col-md-8">
                                    <div class="form-group">
                                        <label for="block-form1-username">Email</label>
                                        <input type="mail" class="form-control form-control-alt" id="block-form1-username" name="email" placeholder="Enter to mail.." required>
                                    </div>
                                </div>
                                <div class="col-sm-10 col-md-8">
                                    <div class="form-group">
                                        <label for="block-form1-username">Subject</label>
                                        <input type="text" class="form-control form-control-alt" id="block-form1-username" name="subject" placeholder="Enter mail subject.." required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-paper-plane mr-1"></i>Send</button>
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

    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script>
        function showTicketModal(id){
            $('#ticket-modal-body').html(null);
            $('#ticket').modal('show');
            $("#ticketId").val(id);
            $.post('{{ route('ticket.details') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#ticket-modal-body').html(data);
            });
        }
        function sendMail(){
            $('#mailModel').modal('show');
            $('#ticket').modal('hide');
        }
        function douPaid(id){
            $('#duePaid-modal-body').html(null);
            $('#duePaid').modal('show');
            $.post('{{ route('douPaid.model.show') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#duePaid-modal-body').html(data);
            });
        }
    </script>
        <script type="text/javascript">
            $(document).ready( function () {
                $('#datatable').DataTable({
                    ordering: false,
                    "pageLength": 25
                });
            } );
        </script>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <style type="text/css">
        .table-responsive::-webkit-scrollbar {
            -webkit-appearance: none;
        }

        .table-responsive::-webkit-scrollbar:vertical {
            width: 12px;
        }

        .table-responsive::-webkit-scrollbar:horizontal {
            height: 12px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, .5);
            border-radius: 10px;
            border: 2px solid #ffffff;
        }

        .table-responsive::-webkit-scrollbar-track {
            border-radius: 10px;
            background-color: #ffffff;
        }
        div#datatable_filter{
            float: left;
            width: 100%;
        }
        div#datatable_filter label{
            width: 100%;
        }
        div#datatable_filter input{
            width: 100%;
            border:2px solid #28a745;
        }
    </style>
@endsection
