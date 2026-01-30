<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()/*Todoモデルの全データを取得してindex.blade.phpに渡す*/
    {
        $todos = Todo::all();
        return view('index', compact('todos'));//データをビューに渡す
    }

    public function store(TodoRequest $request)
    {/*フォームから送信されたデータの中から、contentだけを取得してTodoモデルにstoreする*/
        $todo = $request->only(['content']);/*$request->allではセキュリティ上の問題があるため、onlyで指定する*/
        Todo::create($todo);
 
        return redirect('/')->with('message', 'Todoを作成しました');    
    }

    public function update(TodoRequest $request){
        $todo = $request->only(['content']);
        Todo::find($request->id)->update($todo);/*Todoモデルのidを取得して、contentを更新する*/

        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request){/*destroyにはcontentの」バリデーションは不要のためTodoREquestではなくRequestを使用する*/
        Todo::find($request->id)->delete();

        return redirect('/')->with('message', 'Todoを削除しました');
    }
} 