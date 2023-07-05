@extends('adminlte::page')

@section('title', '種別編集')

@section('content_header')
    <h1>種別編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="type_name">種別</label>
                            <input type="text" class="form-control" id="type_name" name="type_name" value="{{$type->type_name}}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="edit" id="edit" value="edit" class="btn btn-primary">編集</button>
                        <button type="submit" name="delete" id="delete" value="delete" class="btn btn-primary">削除</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
