@extends('layouts.default')

@section('title' , 'example_image_form' )

@section('content' )

<form action="/put_image" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    user_id : <input type="text" name="user_id">
    article_id : <input type="text" name="article_id">
    <input type="file" name="image_data">
    <input type="submit">
</form>

@endsection
