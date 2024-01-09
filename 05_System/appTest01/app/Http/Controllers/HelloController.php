<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // 自作したモデルクラスを取り込む

class HelloController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // 全件取得
        // 第2引数に配列値としてテンプレートへ渡す
        return view('hello.index', ['posts' => $posts]);
    }
}
