@extends('layouts.app')
@section('content')
<table class="table table-striped">
<thead>
<tr>
<th>Vauchar Title</th>
<th>Vauchar Code</th>
<th>Vauchar limits</th>
</tr>
</thead>
<tbody>
@foreach ($vauchars as $vauchar)
<tr>
<td>{{ $vauchar->title }}</td>
<td>{{ $vauchar->code }}</td>
<td>{{ $vauchar->quantity - $vauchar->used }}</td>
</tr>
@endforeach
</tbody>
</table>
{{ $vauchars->links() }}
@endsection