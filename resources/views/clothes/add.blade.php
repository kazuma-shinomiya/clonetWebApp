<!-- 追加ボタン -->
<div class="text-right">
  <a data-toggle="modal" data-target="#add_clothes">
    <i class="fas fa-plus fa-lg"></i>
  </a>
</div>

<!-- モーダル画面 -->
<div class="modal fade" id="add_clothes" tabindex="-1" role="dialog" aria-labelledby="basicModal"
  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>新しく服を追加する</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="{{route('add_cloth')}}" enctype="multipart/form-data" name="addCloth">
            @csrf
            <div class="form-group">
              <label for="category_number">カテゴリー：</label>
              <select class="form-control" id="category_number" name="category_number">
                @foreach($category as $index => $name)
                  <option value="{{ $index }}">{{$name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="brand">ブランド：</label>
              <input type="text" class="form-control" id="brand" name="brand">
            </div>
            <div class="form-group">
              <label for="brand">購入日：</label>
              <input type="date" class="form-control" id="buy_date" name="buy_date">
            </div>
            <div class="form-group">
              <label for="price">価格：</label>
              <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="form-group">
              <label for="image">画像：</label>
              <!-- <input type="file" class="form-control" id="image" name="image"> -->
              <input type="text" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
              <label for="comment">自由欄：</label>
              <textarea id="comment" class="form-control" name="comment"></textarea>
            </div>
            <div class="d-flex my-box-light">
              <div class="my-box mr-auto">
                <a data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </a>
              </div>
              <div class="my-box">
                <a href="javascript:addCloth.submit()">
                  <i class="fas fa-check"></i>
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>