<!-- 削除ボタン -->
<a class="float-right ml-2" data-toggle="modal" data-target="#delete_coordinations{{$coordination->id}}">
  <i class="far fa-trash-alt fa-lg"></i>
</a>

<!-- 削除確認モーダル画面 -->
<div class="modal fade" id="delete_coordinations{{$coordination->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center">このコーデを削除してよろしいですか？</h4>
        <form class="text-center" method="post" action="{{route('delete_coordination',$coordination->id)}}">
        @csrf
          <button type="submit" class="btn btn-outline-danger mt-4 btn-lg"><i class="fas fa-trash-alt fa-1x"></i>　削除</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">✕</button>
      </div>
    </div>
  </div>
</div>