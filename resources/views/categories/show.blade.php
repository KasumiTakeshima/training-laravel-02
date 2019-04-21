@extends('layouts.app')
@section('title', 'カテゴリー詳細')
@section('content')
    <p>ID：{{ $category->id }}</p>
    <p>カテゴリー名：{{ $category->name }}</p>
    <p>登録日：{{ $category->created_at }}</p>
    <p>更新日：{{ $category->updated_at }}</p>
@endsection
