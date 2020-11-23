@component('mail::message')
Thank You  {{ $payment->name }}, for buying from our site. 
We recived ${{ $payment->amount }} from your card. 
Your payment is successful. 
Your payment id is : {{ $payment->payment_id }}.

please kept secure. We will send your odering product to {{ $payment->address }}.

Check your order status in order page. If you see it successful, then we send your product to {{ $payment->address }}.
@component('mail::button', ['url' => {{ route('users.order', ['id' => $payment->id]) }}])
Order Info
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent