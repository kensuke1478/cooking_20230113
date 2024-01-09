<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lang;

class LangsController extends Controller
{
    public function langs()
    {
        $collection = lang::all(); // 全件取得
        // 第2引数に配列値としてテンプレートへ渡す
        return view('langs', ['langs' => $collection]);
    }
}
