@component('mail::message')
# Dear {{ $claim->nama_distributor }},
<p>You have submitted a claim with following detail:</p>
<table style="font-size: 16px">
	<tr>
		<td><b>Claim Number</b></td>
		<td>:</td>
		<td>{{ $claim->id_claim }}</td>
	</tr>
	<tr>
		<td><b>Status</b></td>
		<td>:</td>
		<td>{{ $claim->status }}</td>
	</tr>
	<tr>
		<td><b>Registered by</b></td>
		<td>:</td>
		<td>{{ $claim->nama_distributor }}</td>
	</tr>
	<tr>
		<td><b>Registration on</b></td>
		<td>:</td>
		<td>{{ $claim->created_at }}</td>
	</tr>
	<tr>
		<td><b>Description</b></td>
		<td>:</td>
		<td>{{ $claim->nama_program }}</td>
	</tr>
	<tr>
		<td><b>Claim Type</b></td>
		<td>:</td>
		<td>{{ $claim->nama_category }}</td>
	</tr>
	<tr>
		<td><b>Value</b></td>
		<td>:</td>
		<td>Rp <?php echo number_format("$claim->value",0,',','.'); ?></td>
	</tr>
	<tr>
		<td><b>PR Number</b></td>
		<td>:</td>
		<td>@if($claim->pr_number==NULL) - @else {{ $claim->pr_number }} @endif</td>
	</tr>
	<tr>
		<td><b>Invoice Number</b></td>
		<td>:</td>
		<td>@if($claim->invoice_number==NULL) - @else {{ $claim->invoice_number }} @endif</td>
	</tr>
</table>
<p style="font-size: 16px"><br>
	<b>Comment Detail</b> :<br>
	@foreach($comment as $comments)
	<i>{{ $comments->created_at }}</i> | <b>{{ $comments->nama_user }}</b> | {{ $comments->comment }}<br>
	@endforeach
</p>
<p>
	*Please login to http://www.philips-eApproval.com to view the detail<br><br>

	Thanks,<br>
	Philips Lighting Indonesia
</p>
@endcomponent
