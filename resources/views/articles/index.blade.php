@extends('layouts.app')

@section('title', '記事一覧')

@section('content')
@include('layouts.nav')
<div class="container mt-4">
  @include('articles.search')
</div>
<!-- コーディネーションの表示 -->
<div class="container">
  <div class="row">
    @foreach($articles as $article)
      <div class="col-lg-6">
        @include('articles.card')
      </div>
    @endforeach
  </div>
</div>
@endsection