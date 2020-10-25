@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Payments</h1>
          <p>Display All Payments</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Payments</li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-title-w-btn">
              <h3 class="title">All Payments</h3>
              </div>
            <div class="tile-body">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
		
              <div class="table-responsive">
                <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_length" id="sampleTable_length">
                <label>Order By: 
                  <select name="sampleTable_length" aria-controls="sampleTable" class="form-control form-control-sm">
                    <option onClick="window.location = '{{ route("admin.payment.list") }}'">Latest(Default)</option>
                    <option onClick="window.location = '{{ route("admin.payment.list") }}?order=older'">Oldest</option>
                    <option onClick="window.location = '{{ route("admin.payment.list") }}?order=low'">Amount Low => High</option>
                    <option onClick="window.location = '{{ route("admin.payment.list") }}?order=high'">Amount High => Low</option>
                  </select></label>
                  </div>
                </div>
                </div>
                  <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Payment ID</th>
                      <th>Buyer Name</th>
                      <th>Shipping Address</th>
                      <th>Shipping Mobile</th>
                      <th>Shipping Email</th>
                      <th>Amount</th>
                      <th>User ID</th>
                      <th>Updated</th>
                      <th>Created</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($payments as $payment)
                  <tr>
                      <td>{{ $payment->id }}</td>
                      <td>{{ $payment->payment_id }}</td> 
                      <td>{{ $payment->user->name }}</td>  
                      <td>{{ $payment->address }}</td>
                      <td>{{ $payment->mobile }}</td>
                      <td>{{ $payment->user->email }}</td>
                      <td>{{ \App\Setting::getValue('currency_icon') }}{{ $payment->amount }}</td>
                      <td>{{ $payment->user_id }}</td>
                      <td>{{ $payment->updated_at }}</td>
                      <td>{{ $payment->created_at }}</td>
					  <td><div class="btn-group"><a class="btn btn-primary" href="{{ route('admin.invoice.view', ['id' => $payment->id])}}"><i class="fa fa-lg fa-eye"></i></a><a class="btn btn-primary" href="{{ route('admin.invoice.download', ['id' => $payment->id])}}"><i class="fa fa-lg fa-download"></i></a><a class="btn btn-primary" href="{{ route('admin.payment.update', ['id' => $payment->id])}}"><i class="fa fa-lg fa-edit"></i></a><a class="btn btn-primary" href="{{ route('admin.payment.delete', ['id' => $payment->id])}}"><i class="fa fa-lg fa-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $payments->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection