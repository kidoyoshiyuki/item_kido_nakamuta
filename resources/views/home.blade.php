@extends('adminlte::page')

@section('title', 'ホーム画面')

@section('content_header')
    <h1>ホーム画面</h1>
@stop

@section('content')

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <?php
    Illuminate\Support\Facades\Log::info( "--------------home blade------------" . url()->current() );
    ?>
@stop

