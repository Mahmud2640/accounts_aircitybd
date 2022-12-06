<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Invoice</title>
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
			rel="stylesheet"
		/>
		<style>
			@media print {
				@page {
					size: A3;
				}
			}
			ul {
				padding: 0;
				margin: 0 0 1rem 0;
				list-style: none;
			}
			body {
				font-family: "Inter", sans-serif;
				margin: 0;
			}
			table {
				width: 100%;
				border-collapse: collapse;
			}
			table,
			table th,
			table td {
				border: 1px solid silver;
			}
			table th,
			table td {
				text-align: right;
				padding: 8px;
			}
			h1,
			h4,
			p {
				margin: 0;
			}

			.container {
				padding: 20px 0;
				width: 1000px;
				max-width: 90%;
				margin: 0 auto;
			}

			.inv-title {
				padding: 10px;
				border: 1px solid silver;
				text-align: center;
				margin-bottom: 30px;
			}

			.inv-logo {
				width: 150px;
				display: block;
				margin: 0 auto;
				margin-bottom: 40px;
			}

			/* header */
			.inv-header {
				display: flex;
				margin-bottom: 20px;
			}
			.inv-header > :nth-child(1) {
				flex: 2;
			}
			.inv-header > :nth-child(2) {
				flex: 1;
			}
			.inv-header h2 {
				font-size: 20px;
				margin: 0 0 0.3rem 0;
			}
			.inv-header ul li {
				font-size: 15px;
				padding: 3px 0;
			}

			/* body */
			.inv-body table th,
			.inv-body table td {
				text-align: left;
			}
			.inv-body {
				margin-bottom: 30px;
			}

			/* footer */
			.inv-footer {
				display: flex;
				flex-direction: row;
			}
			.inv-footer > :nth-child(1) {
				flex: 2;
			}
			.inv-footer > :nth-child(2) {
				flex: 1;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="inv-title">
				<h1>Invoice # {{ sprintf('%05d',$ticket->id) }}</h1>
			</div>
			<img src="{{ asset('logo.jpeg') }}" class="inv-logo" style="padding: 10px;border-radius: 5px;" />
			<div class="inv-header">
				<div>
					<h2>Air City BD</h2>
					<ul>
						<li>{{ $ticket->user->branch->location }}</li>
						<li>{{ $ticket->user->branch->email }}</li>
						<li>{{ $ticket->user->branch->mobile }}</li>
					</ul>
				</div>
				<div>
					<table>
						<tr>
							<th width="35%">Issue Date</th>
							<td>{{ $ticket->created_at->format('jS \of F Y h:i:s A') }}</td>
						</tr>
						<tr>
							<th>Flight Date</th>
							<td>{{ date('jS \of F Y h:i:s A', strtotime($ticket->flight_date)) }}</td>
						</tr>
						<tr>
							<th>Total</th>
							<td>Tk. {{ number_format($ticket->amount,2) }}</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="inv-body">
				<table>
					<thead>
						<th>Code</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>Passport</th>
						<th>airline</th>
					</thead>
					<tbody>
						<tr>
							<td>{{ $ticket->code }}</td>
							<td>{{ $ticket->name }}</td>
							<td>{{ $ticket->number }}</td>
							<td>{{ $ticket->passport_number }}</td>
							<td>{{ $ticket->airline->name }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="inv-footer">
				<div><!-- required --></div>
				<div>
					<table>
						<tr>
							<th>Ticket Price</th>
							<td>Tk. {{ number_format($ticket->amount,2) }}</td>
						</tr>
						<tr>
							<th>Discount</th>
							<td>Tk. {{ number_format($ticket->discount,2) }}</td>
						</tr>
			            <tr>
			              <th>Pue</th>
			              <td>Tk. {{ number_format($ticket->pay,2) }}</td>
			            </tr>
			            <tr>
			              <th>Due</th>
			              <td>Tk. {{ number_format($ticket->due,2) }}</td>
			            </tr>
						<tr>
							<th>Grand total</th>
							<td>Tk. {{ number_format($ticket->amount-$ticket->discount,2) }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		window.print();
	</script>
</html>
