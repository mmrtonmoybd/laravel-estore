@extends('layouts.app')
@section('content')
<form action="{{ route('com.edit', ['id' => $comment->id ]) }}" method="POST">
@csrf
@foreach($errors->all() as $error)
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{ $error }}
       </div>
       @endforeach
<div class="form-group">
    <label for="exampleInputName">Content</label>
    <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required">{{ old('comment') ? old('comment') : $comment->comment }}</textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection