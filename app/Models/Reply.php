<?php

namespace App\Models;

class Reply extends Model
{
  //只允许更改content字段
    protected $fillable = ['content'];

    /*一个回复属于一个话题，一条回复属于一个作者*/

    public function topic()
    {
      return $this->belongsTo(Topic::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
