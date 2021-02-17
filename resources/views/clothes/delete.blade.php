<!-- 削除ボタン -->
<a data-toggle="modal" data-target="#delete_clothes{{$cloth->id}}" class="ml-2">
  <i class="far fa-trash-alt fa-lg"></i>
</a>

<!-- 削除確認モーダル画面 -->
<div class="modal fade" id="delete_clothes{{$cloth->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>このアイテムを削除してよろしいですか？</h4>
        <form method="post" action="{{route('delete_cloth',$cloth->id)}}">
          @csrf
          <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt fa-1x"></i>　削除</button>
        </form>
        <button type="button" class="btn btn-black" data-dismiss="modal">キャンセル</button>
      </div>
    </div>
  </div>
</div>