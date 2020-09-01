<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 追記

class Todo extends Model
{
  use SoftDeletes;

    protected $fillable = 
    [
      'title',
      'user_id'
    ];// 追記

    protected $softDelete = ['deleted_at'];
    //追記

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }//追記
}

//DBに保存できるカラムを設定している

// php artisan make:model Todoの実行結果
/*
App\Todo {#1099 ▼
  #fillable: array:1 [▼
    0 => "title"
]
*/