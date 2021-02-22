@extends('layouts.app')

@section('content')

@php
$category = config('category');
@endphp

@include('layouts.nav')

<div class="container mt-4">
  @include('coordinations.search')
</div>

<!-- 追加ボタン -->
<div class="container">
  <div class="text-right">
    <a data-toggle="modal" data-target="#add_coordinations">
      <i class="fas fa-plus fa-lg"></i>
    </a>
  </div>
</div>

<!-- 追加モーダル画面 -->
<div class="modal fade" id="add_coordinations" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4>コーディネートを追加する</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('add_coordination')}}" enctype="multipart/form-data" name="addCoordination">
          @csrf
          <!-- 衣服選択画面 -->
          <div class="accordion" id="accordionExample">
            @foreach($clothes as $cloth)
              @include('coordinations.collaps')
            @endforeach
          </div>
          <!-- タグ入力 -->
          <div class="form-group mt-3">
            <coordination-tags-input
            :autocomplete-items='@json($allTagNames ?? [])'
            >
            </coordination-tags-input> 
          </div>
          <!-- 公開するかどうか選択 -->
          @include('coordinations.isOpenForm')
          <div class="d-flex my-box-light">
            <div class="my-box mr-auto">
              <a data-dismiss="modal">
                <i class="fas fa-times"></i>
              </a>
            </div>
            <div class="my-box">
              <a href="javascript:addCoordination.submit()">
                <i class="fas fa-check"></i>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





<!-- コーディネーションの表示 -->
<div class="container">
  <div class="row">
    @foreach($coordinations as $coordination)
      <div class="col-lg-6">
        <div class="card m-3">
          <div class="card-header">
            <!-- いいねの数 -->
            <i class="fas fa-heart mr-1 red-text"></i>
            {{ $coordination->count_likes}}

            <!-- 削除ボタン -->
            @include('coordinations.delete')
            <!-- 編集ボタン -->
            <a class="float-right" data-toggle="modal" data-target="#edit_coordinations{{$coordination->id}}">
              <i class="far fa-edit fa-lg"></i>
            </a>

            <!-- 編集モーダル画面内容 -->
            <div class="modal fade" id="edit_coordinations{{$coordination->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                      <h4>コーデを編集する</h4>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="{{route('edit_coordination')}}" enctype="multipart/form-data" name="editCoordination{{$coordination->id}}" >
                    @csrf
                      <input type="hidden" name="id" value="{{$coordination->id}}">
                      <!-- 衣服選択画面 -->
                      <div class="accordion" id="accordionExample">
                        @foreach($clothes as $cloth)
                          @include('coordinations.collaps')
                        @endforeach
                      </div>
                      <!-- タグ入力 -->
                      <div class="form-group mt-3">
                        <coordination-tags-input
                        :initial-tags='@json($tagNames[$loop->iteration - 1] ?? [])'
                        :autocomplete-items='@json($allTagNames ?? [])'
                        >
                        </coordination-tags-input>
                      </div>
                      <!-- 公開するかどうか選択 -->
                      @include('coordinations.isOpenForm')
                      <div class="d-flex my-box-light">
                        <div class="my-box mr-auto">
                          <a data-dismiss="modal">
                            <i class="fas fa-times"></i>
                          </a>
                        </div>
                        <div class="my-box">
                          <a href="javascript:editCoordination{{$coordination->id}}.submit()">
                            <i class="fas fa-check"></i>
                          </a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div>
              @foreach($coordination->clothes as $coordination_cloth)
                @include('coordinations.cardDetail')
              @endforeach
            </div>
            <div>
              @foreach($coordination->tags as $tag)
                @if($loop->first)
                  <div class="card-text line-height">
                @endif
                  <a href="{{ route('tag_coordination', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                    {{$tag->hashtag}}
                  </a>
                @if($loop->last)
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection