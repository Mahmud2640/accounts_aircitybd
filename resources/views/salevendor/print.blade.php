<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Air City BD</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
    <style type="text/css">
    	.borderless thead td, .borderless thead th {
		    border: none;
		}
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row" style="width: 100%; display: block;overflow: hidden;">
            <div class="col-md-8" style="width: 60%;float:left">
                <img src="{{ asset('logo.jpeg') }}" class="mb-2" style="padding: 10px;border-radius: 5px;width:150px" /><br>
                <p class="text-uppercase text-monospace" style="font-size: 14px;margin:0;">Air City BD</p>
                <p style="font-size:13px; margin:0;">New market 2nd floor,Raipur lakshmipur, Bangladesh</p>
                <p style="font-size:13px; margin:0;"><b>Email :</b> info@aircitybd.com <br> <b>Phone :</b> +8801644299822</p>
                <p style="font-size:13px; margin:0;"><b>Website :</b> www.aircitybd.com</p>
            </div>
            <div class="col-md-4" style="width: 40%;float:right">
				<table class="table table-borderless table-sm">
				  <thead>
				    <tr>
				      <th colspan="3" class="text-center table-dark">INVOICE</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr class="table-primary">
				      <td class="text-left">Total Amount</td>
				      <td class="text-center">:</td>
				      <td class="text-center">Tk {{ $saleVendor->amount+$saleVendor->total }}</td>
				    </tr>
				    <tr class="table-success">
				      <td class="text-left">Total Paid</td>
				      <td class="text-center">:</td>
				      <td class="text-center">Tk {{ $saleVendor->total }}</td>
				    </tr>
				    <tr class="table-danger">
				      <td class="text-left">Total Due</td>
				      <td class="text-center">:</td>
				      <td class="text-center">Tk {{ $saleVendor->amount }}</td>
				    </tr>
				  </tbody>
				</table>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-md-12">
                <hr style="padding: 0;margin: 0;background: #ddd;">
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<p style="font-size:13px; margin:0;">To</p>
        		<div class="ml-5">
        			<h4 style="font-size:16px;font-weight: bold">{{ $saleVendor->name }}</h4>
        			<p style="font-size:13px; margin:0;"><b>Contact :</b> {{ $saleVendor->number ?? 'N/A' }}</p>
        		</div>
        	</div>
        	<div class="col-lg-12 mt-4">
				<table class="table table-sm borderless table-bordered">
				  <thead>
				    <tr class="table-active">
                        <th>Code</th>
                        <th>Issue Date</th>
                        <th>Reg Type</th>
                        <th>Airline</th>
                        <th>Flight Date</th>
                        <th>Sector</th>
                        <th>Pay</th>
                        <th>Due</th>
                        <th>Ground Total</th>
				    </tr>
				  </thead>
				  <tbody>
                    @foreach ($tickets as $key=>$ticket)
                        <tr>
                            <td class="text-center  font-size-sm"> {{ $ticket->code }}</td>
                            <td>
                                {{ date('d M y, g:i a', strtotime($ticket->created_at)) }}
                            </td>
                            <td class="text-center font-size-sm">{{ $ticket->type }}</td>
                            <td class="d-sm-table-cell font-size-sm">
                                {{ $ticket->airline ? $ticket->airline->name : 'N/A'  }}
                            </td>
                            <td>
                                {{ date('d M y, g:i a', strtotime($ticket->flight_date)) }}

                            </td>
                            <td class="d-sm-table-cell font-size-sm">
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
                        </tr>
                    @endforeach
				  </tbody>
				</table>
        	</div>
        </div>
    </div>
    <script type="text/javascript">
		window.print();
	</script>
</body>
</html>
