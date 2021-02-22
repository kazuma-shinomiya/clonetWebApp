<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cloth;
use App\Coordination;
use App\Tag;

use App\Http\Requests\CoordinationRequest;

use Illuminate\Support\Facades\Auth;

class CoordinationController extends Controller
{
    /**
     * コーディネート一覧を取得
     * 
     * @return view
     */
    public function index(CoordinationRequest $request,Coordination $coordination)
    {
        // Clothモデルのデータを取得
        $clothes = $request->user()->clothes;
        
        //Coordinationモデルのデータを取得
        $coordinations=$request->user()->coordinations;
        

        //編集画面用のtag
        $tagNames = [];
        foreach($coordinations as $coordination){
            $tagName = $coordination->tags->map(function ($tag) {
                return ['text' => $tag->name];
            });
            array_push($tagNames,$tagName);
        }

        //タグの自動補完
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
        
        return view('coordinations.index',compact('clothes','coordinations','tagNames','allTagNames'));
    }

    /**
     * コーディネートの検索
     * 
     * @return view
     */

    public function search(Request $request)
    {
        //ログイン者のユーザーidを取得
        $id=Auth::id();
        //フォームから受け取る
        $keyword=$request->tag_search;

        if(!empty($keyword))
        {
            $coordinations=Coordination::where('user_id',$id)->whereHas('tags', function($query) use($keyword) {
                $query->where('name','like',"%$keyword%");
            })->get();
        }else{
            return redirect(route('show_coordination'));
        }
        

        // Clothモデルのデータを取得
        $clothes = $request->user()->clothes;
        
       return view('coordinations.index',compact('clothes','coordinations'));
    }

    /**
     * コーディネートのタグごとのページを表示
     * 
     * @return view
     */

    public function searchTag(CoordinationRequest $request,string $name)
    {
        //ログイン者のユーザーidを取得
        $id=Auth::id();
        //タグで絞り込み
        $coordinations = Coordination::where('user_id',$id)->whereHas('tags', function($query) use($name) {
            $query->where('name', $name);
        })->get();
        // Clothモデルのデータを取得
        $clothes = $request->user()->clothes;
        
    
        
        return view('coordinations.index',compact('clothes','coordinations'));
    }

    /**
     * コーディネートを追加
     * 
     * @return view
     */
    public function store(CoordinationRequest $request,Coordination $coordination)
    {
    
        // \DB::beginTransaction();
        // try{
            //コーディネートの基本情報を保存
            $coordination->is_open=$request->is_open;
            $coordination->user_id=$request->user()->id;
            $coordination->save();
    
            //追加されたコーディネートのidを取得
            $coordination_id=$coordination->id;
            //選択された服のidを取得
            $cloth_id=$request->cloth_id;
            //coordinationとclothの紐付け
            $coordination->clothes()->attach($cloth_id);

            //タグを追加
            $request->tags->each(function ($tagName) use ($coordination) {
                $tag=Tag::firstOrCreate(['name' => $tagName]);
                $coordination->tags()->attach($tag);
            });


        //     \DB::commit();
        // }catch(\Throwable $e)
        // {
            // \DB::rollback();
            // abort(500);
        // }

        return redirect(route('show_coordination'));
    }

    /**
     * コーディネートの編集
     * 
     *
     * @return view 
     */
    public function update(CoordinationRequest $request)
    {
        

        // \DB::beginTransaction();
        // try{
            $coordination=Coordination::find($request->id);
            $coordination->save();
    
            //選択された服のidを取得
            $cloth_id=$request->cloth_id;
        
            $coordination->clothes()->sync($cloth_id);

            //タグを編集
            $coordination->tags()->detach();
            $request->tags->each(function ($tagName) use ($coordination) {
                $tag=Tag::firstOrCreate(['name' => $tagName]);
                $coordination->tags()->attach($tag);
            });
    
        //     \DB::commit();
        // }catch(\Throwable $e)
        // {
        //     \DB::rollback();
        //     abort(500);
        // }

        return redirect(route('show_coordination'));
    }

    /**
     * コーディネートの削除
     * 
     * @return view
     */
    public function destroy($id)
    {
        //
        $coordination=Coordination::find($id);
        $coordination->clothes()->detach();
        // $coordination->tags()->detach();
        
        try{
            Coordination::destroy($id);
        }catch(\Throwable $e)
        {
            abort(500);
        }
        return redirect(route('show_coordination'));
    }
}
