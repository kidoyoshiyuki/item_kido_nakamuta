@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-search">
                        <div class="input-group input-group-sm">
                            <form class="d-flex" action="{{ url('/items') }}" method="GET">
                                <input class="btn-search" type="submit" value="古い順">
                            </form>
                            <form class="d-flex" action="{{ url('/items/reverse') }}" method="GET">
                                <input class="btn-search" type="submit" value="新しい順">
                            </form>
                        </div>
                        <div class="input-group input-group-sm">
                            <form class="d-flex" action="{{ url('/items') }}" method="GET">
                                <input class="word" type="text" name="keyword" value="{{ $keyword }}"  autofocus>
                                <input class="btn-search" type="submit" value="キーワード検索">
                            </form>
                        </div>
                    </div>
                    @can('admin-higher')
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>　　</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type_name }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td>@can('admin-higher')<a href=" {{ url('items/edit', ['id'=>$item->id]) }} ">{{ ('>>編集') }}</a>@endcan</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
