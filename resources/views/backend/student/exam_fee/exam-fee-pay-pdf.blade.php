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
  border: 1px solid #000000;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #d0dbdb;
}
</style>
</head>
<body>

<h2>Student Exam fee </h2>
    @php
     $registrationfee=
     App\Model\FeeCategoryAmount::where('fee_category_id','3')->where('class_id',$details->class_id)->first();
     $originalfee = $registrationfee->amount;
     $discount = $details['discount']['discount'];
     $discountablefee = $discount/100*$originalfee;
     $finalfee = (float)$originalfee-(float)$discountablefee;
    @endphp
<table>
  <tr>
    <th>ID</th>
    <td>{{ $details['student']['id_no'] }}</td>
  </tr>
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
  <tr>
    <th>Discount</th>
    <td>{{ $discount }}%</td>
  </tr>
  <tr>
    <th>Monthly Fee</th>
    <td>{{ $originalfee }}</td>
  </tr>
  <tr>
    <th>Final Fee of <span style="color: rgb(252, 6, 88)">{{ $exam_name }}</span> </th>
    <td>{{ $finalfee }}</td>
  </tr>

</table>
<p>...............................................................................................................................................................</p>
<h2>Student Exam fee</h2>
<table>
  <tr>
    <th>ID</th>
    <td>{{ $details['student']['id_no'] }}</td>
  </tr>
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
  <tr>
    <th>Discount</th>
    <td>{{ $discount }}%</td>
  </tr>
  <tr>
    <th>Monthly Fee</th>
    <td>{{ $originalfee }}</td>
  </tr>
  <tr>
    <th>Final Fee of <span style="color: rgb(252, 6, 88)">{{ $exam_name }}</span></th>
    <td>{{ $finalfee }}</td>
  </tr>

</table>

</body>
</html>
