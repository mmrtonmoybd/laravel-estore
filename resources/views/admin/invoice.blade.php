<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name') . 'Payment Invoice' }}</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Invoice #: {{ $payment->id }}<br>
                                @php
$date = \Carbon\Carbon::parse($payment->created_at);
@endphp
                                Created: {{ $date->isoFormat('MMM Do YY') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
							{{ config('app.name') }}<br>
                                12345 Sunny Road<br>
                                Sunnyville, CA 12345
                            </td>
                            
                            <td>
							{{ $payment->user->name }}<br>
                                {{ $payment->user->email }}<br>
									{{ $payment->address }}<br>
										{{ $payment->mobile }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Payment Info
                </td>
                
                <td>
                    Check #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Checkout
                </td>
                
                <td>
				{{ \App\Models\Setting::getValue('currency_icon') }}{{ $payment->amount }}
                </td>
            </tr>
			<tr class="details">
                <td>
                    Payment Transaction
                </td>
                
                <td>
				{{ \App\Models\Setting::getValue('currency_icon') }}{{ $payment->transaction }}
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Item
                </td>
				
				<td>
				Qty
				</td>
				
				<td>
				Color
				</td>
				
				<td>
				Size
				</td>
				
				<td>
				Discounds
				</td>
                
                <td>
                    Price
                </td>
            </tr>
            @php
$i = -1;
@endphp
@foreach ($orders as $order)
            <tr class="item">
			@php
$i++;
$price = $products[$i]->price;
$didiscounds = $products[$i]->discounds;
$calculation = $price * $didiscounds / 100;
$total = $price - $calculation;
@endphp
<td>{{ $products[$i]->title }}</td>
<td>{{ $order->quantity }}</td>
<td>{{ $order->color }}</td>
<td>{{ $order->size }}</td>
<td>{{ \App\Models\Setting::getValue('currency_icon') }}{{ $calculation }}</td>
<td>{{ \App\Models\Setting::getValue('currency_icon') }}{{ $total }}</td>
            </tr>
			@endforeach
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: {{ \App\Models\Setting::getValue('currency_icon') }}{{ $payment->amount }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>