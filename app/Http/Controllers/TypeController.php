<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 種別一覧
     */
    public function index()
    {
        //種別一覧取得
        $types = Type
            ::where('types.status', 'active')
            ->select()
            ->get();

        return view('type.index', compact('types'));
    }


    /**
     * 降順表示
     */
    public function reverse()
    {
        //種別一覧取得
        $types = Type
            ::where('types.status', 'active')
            ->orderBy('id','desc')
            ->select()
            ->get();

        return view('type.index', compact('types'));
    }








    /**
     * 種別登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'type_name' => 'required|max:100',
            ]);

            // 種別登録
            Type::create([
                'type_name' => $request->type_name,
            ]);

            return redirect('/types');
        }

        return view('type.add');
    }

    /**
     * 種別編集
     */
    public function edit(Request $request,$id)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'type_name' => 'required|max:100',
            ]);

            //value="edit"でボタンから送信された場合
            if(isset($request->edit)) {

            //編集処理の実行
            $type = Type::find($id);
            $type->update([
                'type_name'=>$request->type_name,
            ]);
            return redirect('/types')
            ->with('result', '種別の編集を完了しました');
            }

            //value="delete"でボタンから送信された場合
            if(isset($request->delete)) {

            //削除処理の実行
            $type = Type::find($id);
            $type->delete();
            return redirect('/types')
            ->with('result', '種別の削除を完了しました');


            }

            }

        //取得したidでの編集画面の表示
        $type = Type::find($id);
        return view('type.edit', [
            'type' => $type,
        ]);


    }

    

}
