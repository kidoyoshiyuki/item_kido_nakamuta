<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Type;
use App\Models\User;

class ItemController extends Controller
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
     * 商品一覧
     */
    public function index(Request $request)
    {

        //viewの$requestから検索ワードを受け取る
        $keyword = $request->input('keyword');

        //テーブル結合
        $query = Item::select([
            'i.id as id',
            'i.user_id as user_id',
            'i.name as name',
            'i.type as type',
            'i.detail as detail',
            't.type_name as type_name',
        ])

        ->from('items as i')
        ->leftJoin('types as t', function ($join) {
            $join->on('i.type', '=', 't.id');
        });

        // 商品一覧取得
            //検索ワードが空でなければ
            if (!empty($keyword)) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('type', 'LIKE', "%{$keyword}%");
                    
            } else {
                $items = Item
                ::where('items.status', 'active')
                ->orderBy('id');

            }

            $items = $query->get();
    

        return view('item.index', compact('items','keyword'));
    }

    //降順表示
    public function reverse(Request $request)
    {
        //viewの$requestから検索ワードを受け取る
        $keyword = $request->input('keyword');

        //テーブル結合
        $query = Item::select([
            'i.id as id',
            'i.user_id as user_id',
            'i.name as name',
            'i.type as type',
            'i.detail as detail',
            't.type_name as type_name',
        ])

        ->from('items as i')
        ->leftJoin('types as t', function ($join) {
            $join->on('i.type', '=', 't.id');
        });

        // 商品一覧取得
            //検索ワードが空でなければ、検索ワードを含むものを取得
            if(!empty($keyword)) {
                $items = Item::
                where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('type', 'LIKE', "%{$keyword}%");
                

            //検索ワードが空の場合、activeなレコードすべてを取得
            } else {
                $items = Item
                ::where('items.status', 'active');

                
            }
            //idを降順に取得
            $items = $query->orderBy('id','desc')->get();

    

        return view('item.index', compact('items','keyword'));
    }











    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        // // 商品一覧を取得する
        $items = Item::orderBy('id', 'asc')->get();

        // 種別一覧を取得する
        $types = Type::orderBy('id', 'asc')->get();

        return view('item.add', ['types' => $types, 'items' => $items,]);

    }

    /**
     * 商品編集
     */
    public function edit(Request $request, $id)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            //value="edit"でボタンから送信された場合
            if(isset($request->edit)) {

            //編集処理の実行
            $item = Item::find($id);
            $item->update([
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);
            return redirect('/items');
        }

        //value="delete"でボタンから送信された場合
        if(isset($request->delete)) {

            //削除処理の実行
            $item = Item::find($id);
            $item->delete();
            return redirect('/items');
        }

        }

        //編集画面の表示

        // // 商品一覧を取得する
        $items = Item::orderBy('id', 'asc')->get();

        // 種別一覧を取得する
        $types = Type::orderBy('id', 'asc')->get();


        //クリックしたときに取得したIDと同じIDのレコードをデータベースから取得する
        $item = Item::find($id);
        return view('item.edit',['types' => $types,
            'item' => $item,'items' => $items,
        ]);


    }
    
}
