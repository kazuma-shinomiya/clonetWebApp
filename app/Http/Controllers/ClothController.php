<?php

namespace App\Http\Controllers;
use App\Http\Requests\ClothRequest;
use Illuminate\Http\Request;

//モデルの利用
use App\Cloth;

//Authの使用
use Illuminate\Support\Facades\Auth;

class ClothController extends Controller
{
    /**
     * 服一覧を表示
     * 
     * @return view
     */
    public function index(Request $request)
    {
        // Clothモデルのデータを取得
        $clothes = $request->user()->clothes;
        return view('clothes.index',compact('clothes'));
    }

    /**
     * 服の絞り込み
     * 
     * @return view
     */

    public function search(Request $request)
    {
       // Clothモデルのデータを取得
        $clothes = $request->user()->clothes;
       //フォームから受け取る
        $keyword=$request->category_search;
        if(!empty($keyword)){
            $clothes=$clothes->where('category_number',$keyword);
        }

        return view('clothes.index',compact('clothes'));
    }

    /**
     * 服を追加
     * 
     * @return view
     */
    public function store(ClothRequest $request, Cloth $cloth)
    {
        // dd($request->all());
        $cloth->fill($request->all()); 
        $cloth->user_id = $request->user()->id;
        $cloth->save();
        return redirect()->route('show_cloth');
    }

    /**
     * 服を編集
     * 
     * @return view
     */
    public function update(ClothRequest $request)
    {
        $cloth=Cloth::find($request->id);
        $cloth->fill($request->all())->save();
        return redirect()->route('show_cloth');
    }

    /**
     * 服の削除
     * 
     * @param int $id
     * @return view
     */
    public function destroy($id)
    {
        try{
            Cloth::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }
        return redirect(route('show_cloth'));
    }
}
