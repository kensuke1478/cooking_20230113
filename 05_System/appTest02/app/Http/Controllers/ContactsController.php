<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class ContactsController extends Controller
{
    // 汎用的な値をプロパティとして定義
    private $contactItems = ['name', 'email', 'title', 'body'];

    // 簡易的な文字数制限のみの判定処理
    private $validator = [
        'name'  => 'required|string|max:10',
        'email' => 'required|string|max:50',
        'title' => 'required|string|max:100',
        'body'  => 'required|string|max:255'
    ];

    /**
     * 問い合わせフォームを表示
     *
     * @return object
     **/
    function show()
    {
        return view('contact.form');
    }

    /**
     * 確認画面へ移動
     *
     * @param  object $request
     * @return object
     **/
    function post(Request $request)
    {
        // onlyで入力値のキーと値を取得
        $input = $request->only($this->contactItems);

        $validator = Validator::make($input, $this->validator);

        if ($validator->fails()) {
            // actionでクラス名とアクションで可読性を高める
            return redirect()->action([ContactsController::class, 'show'])
                ->withInput()
                ->withErrors($validator);
        }

        // 第一引数をキーとしてセッション変数にフォームの入力値を保存
        $request->session()->put('form_input', $input);

        // 判定に問題が無ければ確認画面にリダリレクト
        return redirect()->action([ContactsController::class, 'confirm']);
    }

    /**
     * 確認処理
     *
     * @param  object $request
     * @return object
     **/
    function confirm(Request $request)
    {
        // セッションから値を取り出す
        $input = $request->session()->get('form_input');

        // セッションに値が無ければフォームに戻す
        if (!$input) {
            return redirect()->action([ContactsController::class, 'show']);
        }

        return view('contact.confirm', ['input' => $input]);
    }

    /**
     * 送信処理
     *
     * @param  object $request
     * @return object
     **/
    function send(Request $request)
    {
        // セッションから値を取り出す
        $input = $request->session()->get('form_input');

        // 戻るボタンが押されたら値を返す
        if($request->has('back')){
            return redirect()->action([ContactsController::class, 'show'])->withInput($input);
        }

        // // セッションに値が無い時はフォームに戻る
        if (!$input) {
            return redirect()->action([ContactsController::class, 'show']);
        }

        // メール送信処理

        // forgetでセッション変数を空にする
        $request->session()->forget('form_input');

        // 完了画面に移動
        return redirect()->action([ContactsController::class, 'done']);
    }

    /**
     * 完了画面に移動
     *
     * @return object
     **/
    function done()
    {
        return view('contact.done');
    }
}
