@extends('layouts.app')
@section('content')
<table class="table table-striped">
@if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
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
<th>Buyer Home Address:</th>
@php
$info = Auth::guard()->user()->userInfo()->first();
@endphp
<td>{{ $info->address }}</td>
</tr>
<tr>
<th>Buyer Mobile:</th>
<td>{{ $info->mobile }}</td>
</tr>
<tr>
<th>Buyer IP Address:</th>
<td>{{ $info->ip }}</td>
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
<th>Size</th>
<th>Color</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@php
$i = -1;
@endphp
@foreach ($orders as $order)
<tr>
@php
$i++;
$price = $products[$i]->price;
$didiscounds = $products[$i]->didiscounds;
$calculation = $price * $didiscounds / 100;
$total = $price - $calculation;
@endphp
<td>{{ $products[$i]->title }}</td>
<td>{{ $order->quantity }}</td>
<td>${{ $total }}</td>
<td>{{ $order->size }}</td>
<td>{{ $order->color }}</td>
<td>{{ $order->status }}</td>
<td><a href='{{ url("product/{$order->product_id}") }}'><button type="button" class="btn btn-info">View product</button></a></td>
</tr>
@endforeach
</tbody>
</table>

@endsection