@extends('layouts.default')

@section('title' , 'エディター (editor) - momonara' )

@section('content' )

<div id="editor_all_wrapper">

<div id="editor_wrapper">

    @if ( $article_id === null )
    <form action="/submit_article" method="post">
    @else
    <form action="/update_article/{{ $article_id }}" method="post">
    @endif

	{{ csrf_field() }}



        @if(url()->current() !== "/editor/new")
        <input type="text" name="title" value="{{ $article_title }}" class="ed_article_edit_title" placeholder="タイトル ( 50文字まで )( 例 : Mayaで作業を効率化する方法 )" autocomplete="off" autofocus required>
        @else
        <input type="text" name="title" value="" class="ed_article_edit_title" placeholder="タイトル ( 50文字まで )( 例 : Mayaで作業を効率化する方法 )" autocomplete="off" autofocus required>
        @endif

		<input type="text" name="tag" placeholder="タグ ( タグごとの区切りは , でできます。 ) ( 例 : 3DCG , ローポリ , Unity , ゲームエンジン ) ( 10個まで )" value="{{ implode(',' , $page_tags) }}" class="ed_article_edit_tag_list" autocomplete="off">

		<div class="editor_other_info_wrapper">
			<div class="ed_image_upload_button ed_other_info_button" onClick="$('#editor_form_image_uploader').click();">画像のアップロード</div>
			<div class="ed_submit_button_wrapper ed_other_info_button">
				<input type="submit" value="記事を投稿する" class="ed_submit_button ">
			</div>
		</div>

		<div class="editor_main_content_wrapper">
			<div class="edit_textarea_wrapper">
				<textarea id="editor" name="article_text" placeholder="ここに記事本文を書いてください。記事はマークダウン記法で書くことが出来ます。" spellcheck="false" autocomplete="off" required>@if ( url()->current() !== "/editor/new" ){!! e( $article_content ) !!}@endif</textarea>
			</div>
			<div class="res_editor_wrapper">
				<div id="edit_val" class="markdown-body">

				</div>
			</div>
		</div>
    </form>

	<form id="ed_ajax_form" style="display:none">
		<label for="editor_form_image_uploader" class="ed_file_upload_label">
			<img src="/storage/app_images/ed_upload_image_icon.png">
			<input type="file" accept=".jpg,.png" id="editor_form_image_uploader" name="ajax_image_data" >
		</label>
		<!-- <button type="button" onclick="file_upload()">アップロード</button> -->
	</input>

</div><!-- editor_wrapper -->


</div><!-- edit_all_wrapper -->




@endsection



@section('script')

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/marked.min.js"></script>


@if ($errors->has('title'))
<script>alert("{{ $errors->first('title') }}")</script>
@endif
@if ($errors->has('article_text'))
<script>alert("{{ $errors->first('article_text') }}")</script>
@endif
@if ($errors->has('tag'))
<script>alert("{{ $errors->first('tag') }}")</script>
@endif

<script>
// nl2br用の変数
var str;

// 入力しているエディター
var edit_textarea = document.getElementById('editor');
// 入力したデータを反映している箇所
var result_textarea = document.getElementById('edit_val');





//===================================
// Ajax 画像アップロードの処理
//===================================
$(function(){

	$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	});

	function file_upload()
{
    var formdata = new FormData($('#ed_ajax_form').get(0));
    $.ajax({
        url  : "/image_upload_ajax",
        type : "POST",
        data : formdata,
        cache       : false,
        contentType : false,
        processData : false,
        dataType    : "html"
    })
    .done(function(data){
		var sentence = edit_textarea.value;
		var len = sentence.length;
		var pos = edit_textarea.selectionStart;
		console.log(len);
		console.log(pos);
		var before   = sentence.substr(0, pos);
		var word     = '![article_image](/storage/images/' + data + ')';
		var after    = sentence.substr(pos, len);

		sentence = before + word + after;

		edit_textarea.value = sentence;

		result_textarea.innerHTML =marked(document.getElementById('editor').value );

    })
    .fail(function(){
        alert('画像のアップロードに失敗しました。');
    });
}

$("#editor_form_image_uploader").on('change' , function(){
	file_upload();
});

})


//===================================
// エディターのメイン処理
//===================================

edit_textarea.addEventListener('keyup' , function(){
	var now_edit_data = this.value;
	console.log(now_edit_data);
	var now_result_data = marked( now_edit_data );
	console.log(now_result_data);

	result_textarea.innerHTML = now_result_data;
});



 marked.setOptions({
   sanitize: true,
   breaks: true,
   // smartLists : true,
 });

 function nl2br(str) {
    // str = str.replace(/(\r\n)/g, "<br />");
    str = str.replace(/(\n|\r)/g, "<br />");
    return str;
}



// 初期処理でリザルトにエディターの初期データを入れる
 result_textarea.innerHTML =marked(document.getElementById('editor').value );






</script>

@endsection
