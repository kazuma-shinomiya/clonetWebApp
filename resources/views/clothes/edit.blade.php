<!-- 編集ボタン -->
<a data-toggle="modal" data-target="#edit_clothes{{$cloth->id}}">
  <i class="far fa-edit fa-lg"></i>
</a>

<!-- 編集モーダル画面 -->
<div class="modal fade" id="edit_clothes{{$cloth->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>服を編集する</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('edit_cloth')}}" enctype="multipart/form-data" name="editCloth{{$cloth->id}}">
          @csrf
          <input type="hidden" name="id" value="{{$cloth->id}}">
          <div class="form-group">
            <label for="category_number">カテゴリー：</label>
            <select class="form-control" id="category_number" name="category_number">
              @foreach(config('category') as $index => $name)
                @if($cloth->category_number == $index)
                  <option value="{{ $index }}" selected>{{$name}}</option>
                @else
                  <option value="{{ $index }}">{{$name}}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="brand">ブランド：</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{$cloth->brand}}">
          </div>
          <div class="form-group">
            <label for="brand">購入日：</label>
            <input type="date" class="form-control" id="buy_date" name="buy_date" value="{{$cloth->date}}">
          </div>
          <div class="form-group">
            <label for="price">価格：</label>
            <input type="number" class="form-control" id="price" name="price" value="{{$cloth->price}}">
          </div>
          <div class="form-group">
            <label for="image">画像：</label>
            <!-- <input type="file" class="form-control" id="image" name="image"> -->
            <input type="text" class="form-control" id="image" name="image" value="{{$cloth->image}}">
          </div>
          <div class="form-group">
            <label for="comment">自由欄：</label>
            <textarea id="comment" class="form-control" name="comment">{{$cloth->comment}}</textarea>
          </div>
          <div class="d-flex my-box-light">
            <div class="my-box mr-auto">
              <a data-dismiss="modal">
                <i class="fas fa-times"></i>
              </a>
            </div>
            <div class="my-box">
              <a href="javascript:editCloth.submit()">
                <i class="fas fa-check"></i>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>