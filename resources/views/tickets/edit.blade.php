@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form class="mb-4" action="{{ route('tickets.update',$ticket) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Passenger name</label>
                                <input type="text" class="form-control" name="name" placeholder="passenger name" required="" value="{{ $ticket->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Registration type</label>
                                <select name="type" style="width: 100%;" class="form-control" required>
                                    <option value="">Select registration type</option>
                                    @foreach (\App\Models\Regtype::all() as $item)
                                        <option {{ $ticket->type == $item->name ? 'selected' : '' }} value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Passenger Number</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+88</span>
                                        </div>
                                        <input type="number" stop="0.01" class="form-control" name="number" placeholder="Passenger mobile number 11 digit" value="{{ $ticket->number }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Booking reference number</label>
                                <input type="text" class="form-control" name="purchase_by" placeholder="Booking reference number"  value="{{ $ticket->purchase_by }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Passport number</label>
                                <input type="text" class="form-control" name="passport_number" placeholder="passport number" value="{{ $ticket->passport_number }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Airlines</label>
                                <select class="js-select2 form-control" id="example-select2" name="airline_id" style="width: 100%;" data-placeholder="Choose one airlines">
                                    <option></option>
                                    @foreach (\App\Models\Airline::where('active',1)->get() as $item)
                                        <option {{ $ticket->airline_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Flight Date</label>
                                <input type="text" class="js-flatpickr form-control bg-white  @error('flight_date') is-invalid @enderror" id="example-flatpickr-datetime" name="flight_date" data-enable-time="true" placeholder="Flight Date" value="{{ $ticket->flight_date }}">
                                @error('flight_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control" name="code" placeholder="Code" value="{{ $ticket->code }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Sector</label>
                                <select class="js-select2 form-control" id="select2" name="sector_id" style="width: 100%;" data-placeholder="Choose one Sector">
                                    <option></option>
                                    @foreach (\App\Models\Sector::where('active',1)->get() as $item)
                                        <option {{ $ticket->sector_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Refered by</label>
                                <input type="text" class="form-control" name="refered_by" placeholder="refered by" value="{{ $ticket->refered_by }}">
                            </div>
                        </div>
                    </div>
                    <h2 class="content-heading border-bottom mb-4 pb-2">Document File</h2>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <img src="" id="passport_copyShow" alt="" width="150px">
                                <label>Passport copy</label>
                                <div class="custom-file">
                                    <input id="passport_copy" name="passport_copy" type="file" class="custom-file-input" data-toggle="custom-file-input">
                                    <label class="custom-file-label" for="passport_copy">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <img src="" id="ticket_copyShow" alt="" width="150px">
                                <label>Ticket copy</label>
                                <div class="custom-file">
                                    <input id="ticket_copy" name="ticket_copy" type="file" class="custom-file-input" data-toggle="custom-file-input">
                                    <label class="custom-file-label" for="ticket_copy">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <img src="" id="visa_copyShow" alt="" width="150px">
                                <label>Visa copy upload</label>
                                <div class="custom-file">
                                    <input id="visa_copy" name="visa_copy" type="file" class="custom-file-input" data-toggle="custom-file-input">
                                    <label class="custom-file-label" for="visa_copy">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <img src="" id="others_copyShow" alt="" width="150px">
                                <label>Others copy</label>
                                <div class="custom-file">
                                    <input id="others_copy" name="others_copy" type="file" class="custom-file-input" data-toggle="custom-file-input">
                                    <label class="custom-file-label" for="others_copy">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="content-heading border-bottom mb-4 pb-2">Payment</h2>

                    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'branch_manager')
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Purchase price</label>
                                    <input stop="0.01" type="number" class="form-control" name="purchase" placeholder="purchase price" id="purchase" value="{{ $ticket->purchase }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Select Vendor</label>
                                    <select class="form-control" name="vendor_id" style="width: 100%;" data-placeholder="Choose one Vendor">
                                        <option value="" selected>Select a vendor</option>
                                        @if (auth()->user()->role == 'branch_manager')
                                            @foreach (\App\Models\Vendor::where('branch_id',auth()->user()->branch_id)->where('active',1)->get() as $item)
                                                <option {{ $ticket->vendor_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach (\App\Models\Vendor::where('active',1)->get() as $item)
                                                <option {{ $ticket->vendor_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="states" style="width: 100%;">
                                        <option value="" selected>Select a status</option>
                                        <option {{ $ticket->states == 'On hold' ? 'selected' : '' }} value="On hold">On hold </option>
                                        <option {{ $ticket->states == 'In process' ? 'selected' : '' }} value="In process">In process</option>
                                        <option {{ $ticket->states == 'Confirm' ? 'selected' : '' }} value="Confirm">Confirm</option>
                                        <option {{ $ticket->states == 'Delivery ok' ? 'selected' : '' }} value="Delivery ok">Delivery ok</option>
                                        <option {{ $ticket->states == 'Cancelled' ? 'selected' : '' }} value="Cancelled">Cancelled</option>
                                        <option {{ $ticket->states == 'Refund' ? 'selected' : '' }} value="Refund">Refund</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Ground Total</label>
                                <input onkeyup="givePriceSum()" stop="0.01" type="number" class="form-control bg-dark text-white" name="amount" placeholder="Total" id="amount" value="{{ $ticket->amount }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Discount</label>
                                <input onkeyup="givePriceSum()" stop="0.01" type="number" class="form-control bg-dark text-white" name="discount" placeholder="Discount" id="discount" value="{{ $ticket->discount }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Now Pay</label>
                                <input onkeyup="givePriceSum()" stop="0.01" type="number" class="form-control bg-success text-white" name="pay" placeholder="Now Pay" id="pay" value="{{ $ticket->pay }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Due</label>
                                <input stop="0.01" type="number" class="form-control bg-danger text-white" name="due" placeholder="Due" readonly="" id="dou" value="{{ $ticket->due }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <label>Notes</label>
                            <textarea class="form-control"  name="note" rows="4" placeholder="notes content..">{{ $ticket->note }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Basic -->
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        function givePriceSum(){
            var amount      = document.getElementById('amount').value;
            var discount    = document.getElementById('discount').value;
            var pay         = document.getElementById('pay').value;
            var total       = (Number(amount)-Number(discount))-Number(pay);

            $('#dou').val(total);
        };
    </script>

    <script>
        //passport_copy
        function readpassportURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#passport_copyShow').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }
        $("#passport_copy").change(function() {
          readpassportURL(this);
        });
        //ticket_copy
        function readticketURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#ticket_copyShow').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }
        $("#ticket_copy").change(function() {
          readticketURL(this);
        });
        //visa_copy
        function readvisaURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#visa_copyShow').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }
        $("#visa_copy").change(function() {
          readvisaURL(this);
        });
        //others_copy
        function readothersURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#others_copyShow').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }
        $("#others_copy").change(function() {
          readothersURL(this);
        });
    </script>

@endsection

@section('css')
    <style type="text/css">
        input {
            text-transform: uppercase;
        }
        input:-ms-input-placeholder {
            text-transform: none;
        }
        input::placeholder {
            text-transform: none;
        }
    </style>
@endsection