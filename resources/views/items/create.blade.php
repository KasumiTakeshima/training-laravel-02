@extends('layouts.app')
@section('title', '商品登録')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::open(['route' => 'items.store', 'files' => true]) }}
    <div class="form-group">
        {{ Form::label('name', '商品名：') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('category_id', 'カテゴリー名：') }}
        {{ Form::select('category_id', $categories, null,['class' => 'form-control', 'id' => 'category_id'])}}
    </div>
    <div class="form-image_url">
        <input type="file" name="image_url">
    </div>
    <div class="form-group">
        {{ Form::submit('登録', ['class' => 'btn btn-primary form-control']) }}
    </div>
    {{ Form::close() }}
@endsection
