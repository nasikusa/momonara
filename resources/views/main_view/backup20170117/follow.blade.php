@extends('layouts.default')

@section('title' , 'フォロー - momonara' )

@section('content' )

@for ($i = 0 ; $i < count( $following_user ) ; $i++)

<p><a href="/user/{{ $following_user[$i]['id'] }}">{{ $following_user[$i]['name'] }}</a></p>

@endfor


@endsection
