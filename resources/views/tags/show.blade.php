@extends('layouts.app')

@section('content')
@include('layouts.nav')

<div class="container mt-4">
  <h2 class="text-center">{{ $tag->hashtag }}</h2>
  <div class="text-right">
    検索結果：{{ $tag->coordinations->count() }}件
  </div>
</div>

<div class="container">
  <div class="row">
    @foreach($tag->coordinations as $article)
      <div class="col-lg-6">
        @include('articles.card')
      </div>
    @endforeach
  </div>
</div>

@endsection