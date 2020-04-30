@extends('layouts.default')

@section('title' , "設定を変更しました - mononara")

@section('content')
<div class="con_wrapper">
    <div class="con_left_column">
		@include('main_view.config_side_menu')
	</div>
    <div class="con_right_column">
		<p class="con_finish_text">設定を変更しました</p>
	</div>{{-- config_right_column --}}
</div>{{-- con_wrapper --}}



@endsection


@section('script')

<script>

var side_menu = document.getElementsByClassName('con_nav_button');
var profile = side_menu[0];
var mail = side_menu[1];
var password = side_menu[2];


</script>

@endsection
