<!-- カードの内容 -->
<div class="card m-3">
  <div class="card-header">
    <h4>{{$article->user->name}}</h3>
    <div>
      {{$article->created_at->format('Y/m/d H:i')}}
    </div>
    <div class="card-text text-right">
      <article-like
        :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))' 
        :initial-count-likes='@json($article->count_likes)' 
        :authorized='@json(Auth::check())'
        endpoint="{{ route('articles.like', ['article' => $article]) }}"
      >
      </article-like>
    </div>
  </div>  
  <div class="card-body">
    <div>
      @foreach($article->clothes as $article_cloth)
        <!-- 服の画像 -->
        <a data-toggle="modal" data-target="#detail_articles{{$article_cloth->id}}" >
          {{$article_cloth->image}}
        </a>
        @include('articles.detail')
      @endforeach
    </div>
    <div>
      @foreach($article->tags as $tag)
        @if($loop->first)
          <div class="card-text line-height">
        @endif
          <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
            {{$tag->hashtag}}
          </a>
        @if($loop->last)
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>


