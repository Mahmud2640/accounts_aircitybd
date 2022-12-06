<div class="row">
  <div class="col-lg-12 mb-2" >
    <table class="table table-borderless table-sm" style="border: 1px solid #e2e4e3;">
      <thead style="background: #e5f1fa;color: #627482;">
        <tr class="text-center">
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Name</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Number</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Passport Number</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Code</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Sector</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Refered By</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Register Type</th>
        </tr>
      </thead>
      <tbody style="color: #868686;">
        <tr class="text-center">
          <td style="font-size:13px;font-weight:bold;">{{ $ticket->name }}</td>
          <td style="font-size:13px;font-weight:bold;">{{ $ticket->number }}</td>
          <td style="font-size:13px;font-weight:bold;">{{ $ticket->passport_number }}</td>
          <td style="font-size:13px;font-weight:bold;">{{ $ticket->code }}</td>
          <td style="font-size:13px;font-weight:bold;">{{ $ticket->sector->name ?? 'N/A' }}</td>
          <td style="font-size:13px;font-weight:bold;">{{ $ticket->refered_by }}</td>
          <td style="font-size:13px;font-weight:bold;">{{ $ticket->type }}</td>
        </tr>
    </table>
  </div>
  <br>
  <div class="col-lg-5 mb-2">
    <table class="table table-borderless table-sm" style="border: 1px solid #e2e4e3;">
      <thead style="background: #e5f1fa;color: #627482;">
        <tr class="text-center">
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Airline</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Status</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Flight Date</th>
        </tr>
      </thead>
      <tbody style="color: #868686;">
        <tr class="text-center">
          <td style="font-size:13px;font-weight:bold;">{{ $ticket->airline->name ?? 'Na' }}</td>
          <td style="font-size:13px;font-weight:bold;">{{ $ticket->states }}</td>
          <td style="font-size:13px;font-weight:bold;">{{ date('Y-m-d H:i:s', strtotime($ticket->flight_date)) }}</td>
        </tr>
    </table>
  </div>
  <div class="col-lg-7 mb-2">
    <table class="table table-borderless table-sm" style="border: 1px solid #e2e4e3;">
      <thead style="background: #e5f1fa;color: #627482;">
        <tr class="text-center">
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Ticket Price</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Discount</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Pue</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Due</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Grand total</th>
        </tr>
      </thead>
      <tbody style="color: #868686;">
        <tr class="text-center">
          <td style="font-size:13px;font-weight:bold;">Tk. {{ number_format($ticket->amount) }}</td>
          <td style="font-size:13px;font-weight:bold;">Tk. {{ number_format($ticket->discount) }}</td>
          <td style="font-size:13px;font-weight:bold;">Tk. {{ number_format($ticket->pay) }}</td>
          <td style="font-size:13px;font-weight:bold;">Tk. {{ number_format($ticket->due) }}</td>
          <td style="font-size:13px;font-weight:bold;">Tk. {{ number_format($ticket->amount-$ticket->discount) }}</td>
        </tr>
    </table>
  </div>
  <div class="col-lg-12">
    <table class="table table-borderless table-sm" style="border: 1px solid #e2e4e3;">
      <thead style="background: #e5f1fa;color: #627482;">
        <tr class="text-left">
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Note</th>
        </tr>
      </thead>
      <tbody style="color: #868686;">
        <tr class="text-left">
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">{{ $ticket->note }}</th>
        </tr>
    </table>
  </div>
  <div class="col-lg-12">
    <table class="table table-borderless table-sm" style="border: 1px solid #e2e4e3;">
      <thead style="background: #e5f1fa;color: #627482;">
        <tr class="text-center">
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Passport copy</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Ticket copy</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Visa copy</th>
          <th style="font-size: 13px;font-weight: bold;text-transform: capitalize;">Others copy</th>
        </tr>
      </thead>
      <tbody style="color: #868686;">
        <tr class="text-center">
          {{-- <td><img style="width:100%;height: 160px" src="{{ asset($ticket->passport_copy) }}" class="img-thumbnail rounded"></td> --}}
          <td>
            <div class="block">
                <div class="options-container">
                    <img class="img-thumbnail rounded options-item" src="{{ asset($ticket->passport_copy) }}" style="width:100%;height: 160px">
                    <div class="options-overlay bg-black-75">
                        <div class="options-overlay-content">
                            <a target="_blank" class="btn btn-sm btn-light" href="{{ asset($ticket->passport_copy) }}">
                                View
                            </a>
                            <a download class="btn btn-sm btn-success" href="{{ asset($ticket->passport_copy) }}">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
          </td>
          <td>
            <div class="block">
                <div class="options-container">
                    <img class="img-thumbnail rounded options-item" src="{{ asset($ticket->ticket_copy) }}" style="width:100%;height: 160px">
                    <div class="options-overlay bg-black-75">
                        <div class="options-overlay-content">
                            <a target="_blank" class="btn btn-sm btn-light" href="{{ asset($ticket->ticket_copy) }}">
                                View
                            </a>
                            <a download class="btn btn-sm btn-success" href="{{ asset($ticket->ticket_copy) }}">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
          </td>
          <td>
              <div class="block">
                  <div class="options-container">
                      <img class="img-thumbnail rounded options-item" src="{{ asset($ticket->visa_copy) }}" style="width:100%;height: 160px">
                      <div class="options-overlay bg-black-75">
                          <div class="options-overlay-content">
                              <a target="_blank" class="btn btn-sm btn-light" href="{{ asset($ticket->visa_copy) }}">
                                  View
                              </a>
                              <a download class="btn btn-sm btn-success" href="{{ asset($ticket->visa_copy) }}">
                                  Download
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
            </td>
          <td>
            <div class="block">
                <div class="options-container">
                    <img class="img-thumbnail rounded options-item" src="{{ asset($ticket->others_copy) }}" style="width:100%;height: 160px">
                    <div class="options-overlay bg-black-75">
                        <div class="options-overlay-content">
                            <a target="_blank" class="btn btn-sm btn-light" href="{{ asset($ticket->others_copy) }}">
                                View
                            </a>
                            <a download class="btn btn-sm btn-success" href="{{ asset($ticket->others_copy) }}">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </td>
        </tr>
    </table>
  </div>
</div>