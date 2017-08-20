@component('mail::message')
# Dear {{ $claim->nama_distributor }},
<p>We have one new E-Approval with following detail:</p>
@component('mail::table')
| | | |
| ------------------: | - | ---------------------------------------------------------- |
| **Claim Number**    | : | {{ $claim->id_claim }}                                     |
| **Status**          | : | {{ $claim->status }}                                       |
| **Registered by**   | : | {{ $claim->nama_distributor }}                             |
| **Registration on** | : | {{ $claim->created_at }}                                   |
| **Description**     | : | {{ $claim->nama_program }}                                 |
| **Claim Type**      | : | {{ $claim->nama_category }}                                |
| **Value**           | : | Rp <?php echo number_format("$claim->value",0,',','.'); ?> |
| **PR Number**       | : | @if($claim->pr_number==NULL) - @else {{ $claim->pr_number }} @endif |
| **Invoice Number**  | : | @if($claim->invoice_number==NULL) - @else {{ $claim->invoice_number }} @endif |
@endcomponent
**Comment Detail**:<br>
@foreach($comment as $comments)
*{{ $comments->created_at }}* | **{{ $comments->nama_user }}** | {{ $comments->comment }}<br>
@endforeach
<p>
	*Please print and attach this email within document submitted to Philips Lighting Indonesia<br>
	*Please fill in the Airwaybill number then this ticket will be able to go further<br>
	*Please login to http://www.philips-eApproval.com to approve the E-Approval<br><br>

	Thanks,<br>
	Philips Lighting Indonesia
</p>
@endcomponent
