@extends('layouts.app')
@section('content')
<table class="table table-striped">
<thead>
<tr>
<th>Buyer Name:</th>
<td>{{ Auth::guard()->user()->name }}</td>
</tr>
<tr>
<th>Buyer Email Address:</th>
<td>{{ Auth::guard()->user()->email }}</td>
</tr>
<tr>
<th>Payment Id:</th>
<td>{{ $payment->payment_id }}</td>
</tr>
<tr>
<th>Payment Amount:</th>
<td>${{ $payment->amount }}</td>
</tr>
<tr>
<th>Payment Date:</th>
<td>{{ $payment->created_at }}</td>
</tr>
<tr>
<th>Order Shiping:</th>
<td>{{ $payment->address }}</td>
</tr>
<tr>
<th>Order Shiping Mobile:</th>
<td>{{ $payment->mobile }}</td>
</tr>
</thead>
</table>
<table class="table table-striped">
<thead>
<tr>
<th>Item Name</th>
<th>Item Qty</th>
<th>Price</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($orders as $order)
@foreach ($products as $product)
<tr>
@php
$price = $product->price;
$didiscounds = $product->didiscounds;
$calculation = $price * $didiscounds / 100;
$total = $price - $calculation;
@endphp
<td>{{ $product->title }}</td>
<td>{{ $order->quantity }}</td>
<td>${{ $total }}</td>
<td>{{ $order->status }}</td>
<td><a href='{{ url("product/{$order->product_id}") }}'><button type="button" class="btn btn-info">View product</button></a></td>
</tr>
@endforeach
@endforeach
</tbody>
</table>

@endsection