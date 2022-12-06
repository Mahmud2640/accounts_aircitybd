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
        <div class="row">
            <div class="col-md-8">
                <img src="{{ asset('logo.jpeg') }}" class="mb-2" style="padding: 10px;border-radius: 5px;width:150px" /><br>
                <p class="text-uppercase text-monospace" style="font-size: 14px;margin:0;">Air City BD</p>
                <p style="font-size:13px; margin:0;">New market 2nd floor,Raipur lakshmipur, Bangladesh</p>
                <p style="font-size:13px; margin:0;"><b>Email :</b> info@aircitybd.com <b>Phone :</b> +8801644299822</p>
                <p style="font-size:13px; margin:0;"><b>Website :</b> www.aircitybd.com</p>
            </div>
            <div class="col-md-4">
				<table class="table table-borderless table-sm">
				  <thead>
				    <tr>
				      <th colspan="3" class="text-center table-dark">INVOICE</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td class="text-left">Code</td>
				      <td class="text-center">:</td>
				      <td class="text-right">{{ $ticket->code }}</td>
				    </tr>
				    <tr class="table-active">
				      <td class="text-left">Flight Date</td>
				      <td class="text-center">:</td>
				      @if ($ticket->flight_date)
				      	<td class="text-right">{{ date('d M y, g:i a', strtotime($ticket->flight_date)) }}</td>
				      @else
				      	<td class="text-right">N/A</td>
				      @endif

				    </tr>
				    <tr>
				      <td class="text-left">Issue Date</td>
				      <td class="text-center">:</td>
				      <td class="text-right">{{ date('d M y, g:i a', strtotime($ticket->created_at)) }}</td>
				    </tr>
				    <tr class="table-active">
				      <td class="text-left">Passport Number</td>
				      <td class="text-center">:</td>
				      <td class="text-right">{{ $ticket->passport_number }}</td>
				    </tr>
				  </tbody>
				</table>
            </div>
            <div class="col-md-12">
            	<hr style="padding: 0;margin: 0;background: #ddd;">
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6">
        		<p style="font-size:13px; margin:0;">To</p>
        		<div class="ml-5">
        			<h4 style="font-size:16px;font-weight: bold">{{ $ticket->name }}</h4>
        			<p style="font-size:13px; margin:0;"><b>Contact :</b> {{ $ticket->number }}</p>
        		</div>
        	</div>
        	<div class="col-md-6">
        		<h4 style="font-size:16px;font-weight: bold;margin-top: 20px;">Invoice For.</h4>
        		<h4 style="font-weight: bold;margin-top:5px">{{ $ticket->name }}</h4>
        	</div>
        	<div class="col-lg-12 mt-4">
				<table class="table table-sm borderless table-bordered">
				  <thead>
				    <tr class="table-active">
				      	<th scope="col">Sale Description</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>airline</th>
				      	<th>Base Fare</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      	<td>{{ $ticket->type }}</td>
						<td>{{ $ticket->name }}</td>
						<td>{{ $ticket->number }}</td>
						<td>{{ $ticket->airline->name ?? 'N/A' }}</td>
						<td>{{ number_format($ticket->amount,2) }}</td>
				    </tr>
				  </tbody>
				</table>
        	</div>
        </div>
        <div class="row">
        	<div class="col-lg-7">
        		<p style="font-size: 15px">
        			Note: <br>
					All payment should be made in favor of "Air City BD."
					This Invoice will not be recognized as paid unless supported by Company Official Receipt.
					3% Bank Charge will be add on total bill amount, if the bill Paid/settled by Debit/Credit Card
        		</p>
        	</div>
        	<div class="col-lg-5">
				<table class="table table-bordered table-sm">
					<tbody>
						<tr>
						  <td class="text-left">Ticket Price</td>
						  <td class="text-center">:</td>
						  <td class="text-right">Tk. {{ number_format($ticket->amount,2) }}</td>
						</tr>
						<tr class="table-active">
						  <td class="text-left">Discount</td>
						  <td class="text-center">:</td>
						  <td class="text-right">Tk. {{ number_format($ticket->discount,2) }}</td>
						</tr>
						<tr>
						  <td class="text-left">Pue</td>
						  <td class="text-center">:</td>
						  <td class="text-right">Tk. {{ number_format($ticket->pay,2) }}</td>
						</tr>
						<tr class="table-active">
						  <td class="text-left">Due</td>
						  <td class="text-center">:</td>
						  <td class="text-right">Tk. {{ number_format($ticket->due,2) }}</td>
						</tr>
						<tr>
						  <td class="text-left">Grand total</td>
						  <td class="text-center">:</td>
						  <td class="text-right">Tk. {{ number_format($ticket->amount-$ticket->discount,2) }}</td>
						</tr>
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
