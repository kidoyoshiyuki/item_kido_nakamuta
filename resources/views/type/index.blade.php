@extends('adminlte::page')

@section('title', '種別一覧')

@section('content_header')
    <h1>種別一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">種別一覧</h3>
                    <div class="card-search">
                        <div class="input-group input-group-sm">
                            <form class="d-flex" action="{{ url('/types') }}" method="GET">
                                <input class="btn-search" type="submit" value="古い順">
                            </form>
                            <form class="d-flex" action="{{ url('/types/reverse') }}" method="GET">
                                <input class="btn-search" type="submit" value="新しい順">
                            </form>
                        </div>
                    </div>
                    @can('admin-higher')
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('types/add') }}" class="btn btn-default">種別登録</a>
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
                                <th>種別</th>
                                <th>　　</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->type_name }}</td>
                                    <td>@can('admin-higher')<a href=" {{ url('/types/edit', ['id'=>$type->id]) }} ">{{ ('>>編集') }}</a>@endcan</td>
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
