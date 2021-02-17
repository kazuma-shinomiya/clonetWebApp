@extends('layouts.app')

@section('content')

@php
$category = config('category');
@endphp

  @include('layouts.nav')

  <!-- 検索フォーム -->
  <div class="container mt-4">
    @include('clothes.search')
  </div>

  <!-- 追加ボタン -->
  <div class="container">
    @include('clothes.add')
  </div>
  

<!-- 一覧表示 -->
  <div class="container">
    <div class="row">
      @foreach($clothes as $cloth)
        <div class="col-lg-4">
          <div class="card mt-4">
            <img src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" class="card-img-top" alt="..."/>
            <div class="card-body">
              @php
              $category_number = $cloth->category_number;
              @endphp
              <p class="card-text">{{$category[$category_number]}}</p>
              <p class="card-text">{{$cloth->brand}}</p>
              <p class="card-text">{{$cloth->price}}円</p>
              <p class="card-text">購入日：{{$cloth->buy_date}}</p>
              <div class="container">
                <div class="text-right">
                  <!-- 編集ボタン -->
                  @include('clothes.edit')
                  <!-- 削除ボタン -->
                  @include('clothes.delete')
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection