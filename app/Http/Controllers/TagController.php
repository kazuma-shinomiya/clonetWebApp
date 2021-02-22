<?php

namespace App\Http\Controllers;

use App\Tag;

use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * タグ別コーディネート一覧を取得
     * 
     * @return view
     */
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        return view('tags.show', compact('tag'));
    }
}
