<div class="col-lg-3">
        <h1 class="my-4">{{ config('app.name', 'Laravel') }}</h1>
        <div class="list-group">
        @foreach ($categories as $category)
          <a href='{{ url("category/{$category->id}") }}' class="list-group-item">{{ $category->name }}</a>
@endforeach
        </div>
      </div>