<!-- 服の画像 -->
<a data-toggle="modal" data-target="#detail_coordinations{{$coordination_cloth->id}}" >
  {{$coordination_cloth->image}}
</a>
<!-- 詳細モーダル画面内容 -->
<div class="modal fade" id="detail_coordinations{{$coordination_cloth->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card">
          <div class="row no-gutters">
            <div class="col-5">
              <img class="card-img" src="{{$coordination_cloth->image}}" alt="服のイメージ画像">
            </div>
            <div class="col-7">
              <div class="card-body text-center">
                <p class="card-text lead">カテゴリー：{{$coordination_cloth->category}}</p>
                <p class="card-text lead">購入日：{{$coordination_cloth->buy_date}}</p>
                <p class="card-text lead">ブランド：{{$coordination_cloth->brand}}</p>
                <p class="card-text lead">購入金額：{{$coordination_cloth->price}}円</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">✕</button>
      </div>
    </div>
  </div>
</div>