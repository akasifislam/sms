<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #68d846;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #13ece1;
}
</style>
</head>
<body>

<h2>Student Registration Card</h2>
    @php
     $registrationfee=
     App\Model\FeeCategoryAmount::where('fee_category_id','1')->where('class_id',$details->class_id)->first();
     $originalfee = $registrationfee->amount;
     $discount = $details['discount']['discount'];
     $discountablefee = $discount/100*$originalfee;
     $finalfee = (float)$originalfee-(float)$discountablefee;
    @endphp
		<table>
			<tr>
			<th>Name</th>
			<td>{{ $details['student']['name'] }}</td>
			</tr>
			<tr>
			<th>Father Name</th>
			<td>{{ $details['student']['fname'] }}</td>
			</tr>
			<tr>
			<th>Mother Name</th>
			<td>{{ $details['student']['mname'] }}</td>
			</tr>
		
		
		</table>

</body>
</html>
