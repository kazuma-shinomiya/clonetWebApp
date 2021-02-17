<!-- 検索フォーム -->
<form method="post" class="form-inline" action="{{route('search_cloth')}}" >
@csrf
  <div class="form-group">
    <select class="form-control"  name="category_search">
      <option value="">--全て--</option>
      @foreach($category as $index => $name)
        <option value="{{ $index }}">{{$name}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-outline-primary">
    <i class="fas fa-search"></i>
  </button>
</form>