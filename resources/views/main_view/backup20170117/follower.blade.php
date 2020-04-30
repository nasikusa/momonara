@extends('layouts.default')

@section('title' , 'フォロワー - momonara' )

@section('content' )

@for ($i = 0 ; $i < count( $followed_user ) ; $i++)

<p><a href="/user/{{ $followed_user[$i]['id'] }}">{{ $followed_user[$i]['name'] }}</a></p>

@endfor

@endsection
