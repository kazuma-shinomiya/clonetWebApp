<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cloth extends Model
{
    //テーブル名
    protected $table = 'clothes';

    protected $fillable = [
        'category_number',
        'brand',
        'buy_date',
        'price',
        'image',
        'comment'
    ];

    //usersテーブルとのリレーション
    public function user(): BelongsTo{
        return $this->belongsTo('App\User');
    }

    //coordinationsテーブルとのリレーション
    public function coordinations()
    {
        return $this->belongsToMany('App\Coordination');
    }
    

    
}
