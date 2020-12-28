@extends('layouts.app')
@section('content')
<table class="table table-striped">
<thead>
<tr>
<th>Payment Transaction</th>
<th>Shiping Address</th>
<th>Shiping Mobile</th>
<th>Payment Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($payments as $payment)
<tr>
<td>{{ $payment->transaction }}</td>
<td>{{ $payment->address }}</td>
<td>{{ $payment->mobile }}</td>
@php
$date = \Carbon\Carbon::parse($payment->created_at);
@endphp
<td>{{ $date->isoFormat('MMM Do YY') }}</td>
<td><a href='{{ url("users/orders/{$payment->id}") }}'><button type="button" class="btn btn-info">View</button></a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $payments->links() }}
@endsection