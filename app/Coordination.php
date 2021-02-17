<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordination extends Model
{
    //テーブル名
    protected $table = 'coordinations';


    //userとのリレーション
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //clothとの多対多リレーション
    public function clothes()
    {
        return $this->belongsToMany('App\Cloth');
    }

    //likesテーブルとの多対多リレーション
    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    // ユーザーがいいね済みかどうか判別する
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()//userがいれば1がかえる
            : false;
    }

    // いいね数の取得
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }
}
