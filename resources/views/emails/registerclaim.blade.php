@component('mail::message')
# Dear {{ $mail->nama_distributor }},
<p>We have one new E-Approval with following detail :</p>
@component('mail::table')
| | | |
| --------------: | - | --------------- |
| Claim Number    | : | Right-Aligned   |
| Status          | : | Right-Aligned   |
| Registered by   | : | Right-Aligned   |
| Department      | : | Right-Aligned   |
| Registration on | : | Right-Aligned   |
| Description     | : | Right-Aligned   |
| Claim Type      | : | Right-Aligned   |
| Value           | : | Right-Aligned   |
| PR Number       | : | Right-Aligned   |
| Invoice Number  | : | Right-Aligned   |
| Comment Detail  | : | Right-Aligned   |
@endcomponent
<p>
	*Please print and attach this email within document submitted to Philips Lighting Indonesia<br>
	*Please fill in the Airwaybill number then this ticket will be able to go further<br>
	*Please login to http://www.philips-eApproval.com to approve the E-Approval<br><br>

	Thanks,<br>
	Philips Lighting Indonesia
</p>
@endcomponent
