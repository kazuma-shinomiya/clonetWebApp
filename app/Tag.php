<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    //タグに#をつける
    public function getHashtagAttribute(): string
    {
        return '#' . $this->name;
    }

    public function coordinations()
    {
        return $this->belongsToMany('App\Coordination')->withTimestamps();
    }
}
