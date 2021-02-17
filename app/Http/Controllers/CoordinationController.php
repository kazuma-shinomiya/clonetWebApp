<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cloth;
use App\Coordination;

use Illuminate\Support\Facades\Auth;

class CoordinationController extends Controller
{
    /**
     * コーディネート一覧を取得
     * 
     * @return view
     */
    public function index(Request $request)
    {
        // Clothモデルのデータを取得
        $clothes = $request->user()->clothes;
        
        //Coordinationモデルのデータを取得
        $coordinations=$request->user()->coordinations;
        
        //いいねの件数取得
        // foreach($outfits as $outfit)
        // {
        //     $like_count=0;
        //     $like_count=Like::where('outfit_id',$outfit['id'])->count();
        //     $outfit['like']=$like_count;
        // }

        return view('coordinations.index',compact('clothes','coordinations'));
    }

    /**
     * コーディネートを追加
     * 
     * @return view
     */
    public function store(Request $request,Coordination $coordination)
    {
    
        // \DB::beginTransaction();
        // try{
            //コーディネートの基本情報を保存
            $coordination->is_open=$request->is_open;
            $coordination->user_id=$request->user()->id;
            // $coordination->tag_comment=$request->tag_name;
            $coordination->save();
    
            //追加されたコーディネートのidを取得
            $coordination_id=$coordination->id;
            //選択された服のidを取得
            $cloth_id=$request->cloth_id;
            //coordinationとclothの紐付け
            // $coordination=coordination::find($coordination_id);
            $coordination->clothes()->attach($cloth_id);

            //タグを追加
            //正規表現で＃以降を判別
            // preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tag_name, $match);
            // //Tagテーブルに無いtagをデータで追加
            // foreach($match[1] as $input)
            // {
            //     $tag=Tag::firstOrCreate(['name'=>$input]);
            //     $tag=null;
            //     //入力されたタグのidを取得
            //     $tag_id=Tag::where('name',$input)->get(['id']);
            //     //タグとoutfitの紐付け
            //     $outfit=Outfit::find($outfit_id);
            //     $outfit->tags()->attach($tag_id);
            // }

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
    public function update(Request $request)
    {
        

        // \DB::beginTransaction();
        // try{
            $coordination=Coordination::find($request->id);
            // $coordination->tag_comment=$request->tag_name;
            $coordination->save();
    
            //編集されたコーディネートのidを取得
            // $coordination_id=$coordination->id;
    
            //選択された服のidを取得
            $cloth_id=$request->cloth_id;
        
            // $coordination=Coordination::find($coordination_id);
            $coordination->clothes()->sync($cloth_id);

            //タグを編集
            //現在の紐付けを解除
            // $coordination->tags()->detach();
            //正規表現で＃以降を判別
            // preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u',$request->tag_name, $match);
            //Tagテーブルに無いtagをデータで追加
            // foreach($match[1] as $input)
            // {
            //     $tag=Tag::firstOrCreate(['name'=>$input]);
            //     $tag=null;
            //     //入力されたタグのidを取得
            //     $tag_id=Tag::where('name',$input)->get(['id']);
            //     //タグとoutfitの紐付け
            //     $outfit=Outfit::find($outfit_id);
            //     $outfit->tags()->attach($tag_id);
            // }
    
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