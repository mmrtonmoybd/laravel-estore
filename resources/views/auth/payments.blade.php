@extends('layouts.app')
@section('content')
<table class="table table-striped">
<thead>
<tr>
<th>Payment Id</th>
<th>Shiping Address</th>
<th>Shiping Mobile</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($payments as $payment)
<tr>
<td>{{ $payment->payment_id }}</td>
<td>{{ $payment->address }}</td>
<td>{{ $payment->mobile }}</td>
<td><a href='{{ url("users/orders/{$payment->id}") }}'><button type="button" class="btn btn-info">View</button></a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $payments->links() }}
@endsection