<!-- 検索フォーム -->
<form method="post" class="form-inline" action="{{ route('search_article')}}" >
  @csrf
  <div class="form-group">
    <input type="text" class="form-control" name="tag_search" placeholder="--タグで検索--">
  </div>
  <button type="submit" class="btn btn-outline-primary">
    <i class="fas fa-search"></i>
  </button>
</form>