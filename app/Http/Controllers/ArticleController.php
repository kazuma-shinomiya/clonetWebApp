<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cloth;
use App\Coordination;

use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * みんなのコーディネート一覧を取得
     * 
     * @return view
     */
    public function index()
    {
        $articles = Coordination::where('is_open',1)->get();

        return view('articles.index', compact('articles'));
    }
    /**
     * みんなのコーディネートの検索
     * 
     * @return view
     */

    public function search(Request $request)
    {
        //フォームから受け取る
        $keyword=$request->tag_search;

        if(!empty($keyword))
        {
            $articles=Coordination::whereHas('tags', function($query) use($keyword) {
                $query->where('name','like',"%$keyword%");
            })->get();
        }else{
            return redirect(route('show_article'));
        }
        

        
       return view('articles.index',compact('articles'));
    }

    /**
     * いいねをつける
     * 
     * @return view
     */
    public function like(Request $request, Coordination $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }
    /**
     * いいねを消す
     * 
     * @return view
     */
    public function unlike(Request $request, Coordination $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }
}
