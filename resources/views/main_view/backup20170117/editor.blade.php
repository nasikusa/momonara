@extends('layouts.default')

@section('title' , 'エディター (editor) - momonara' )

@section('content' )

<style>

#editor_all_wrapper img {
    display: block;
}

</style>

<div id="editor_all_wrapper">

<div id="editor_wrapper">

	{{-- ここはフォームを新規か更新かでactionの変更を行っている --}}
	{{-- $article_idがnullの場合は新規作成と判断 --}}
    @if ( $article_id === null )
        <form action="/submit_article" method="post">
    @else
        <form action="/update_article/{{ $article_id }}" method="post">
    @endif


		<input type="text" name="tags" placeholder="タグを入力してください。タグの区切りはカンマ( , )で行うことができます。" size=100 value="{{ implode(',' , $page_tags) }}">

        {{ csrf_field() }}
        @if(url()->current() !== "/editor/new")
        <input type="text" name="article_title" value="{{ $article_title }}" class="article_edit_title" size=155 placeholder="タイトル欄です。191字までで入力してください。">
        @else
        <input type="text" name="article_title" value="" class="article_edit_title" size=155 placeholder="タイトル欄です。191字までで入力してください。">
        @endif

        <textarea id="editor" name="article_content" rows="8" cols="40">

        @if ( url()->current() !== "/editor/new" )
        {!! e( $article_content ) !!}
        @endif

        </textarea>
        <input type="submit" value="送信">
    </form>
</div>

<div id="res_editor_wrapper">
    <div id="edit_val"></div>
</div>

</div>

<script src="/js/simplemde.min.js"></script>
<script src="/js/marked.min.js"></script>
<script>

var str;
var before_edit_data = document.getElementById('editor');
var result_edit_data = document.getElementById('edit_val');

var simplemde = new SimpleMDE({
     element: document.getElementById("editor"),
     forceSync: true,
     spellChecker : false,
     toolbar: [ "bold" , "italic" , "strikethrough" , "|" ,  "heading-1", "heading-2" , "heading-3" , "|" , "link" , "image" , "quote" , "|" , "unordered-list" , "ordered-list"],
 });

 marked.setOptions({
   sanitize: true,
 });

 function nl2br(str) {
    str = str.replace(/(\r\n)/g, "<br />");
    // str = str.replace(/(\n|\r)/g, "<br />");
    return str;
}

 result_edit_data.innerHTML = nl2br( marked( document.getElementById('editor').value ));

simplemde.codemirror.on("change", function(){
    result_edit_data.innerHTML = nl2br( marked(  document.getElementById('editor').value ));
});



 // result_edit_data.addEventListener('keyup' , function(){
 //     console.log('hogehoge');
      // result_edit_data.innerHTML = marked( document.getElementById("editor").value );
      // result_edit_data.innerHTML = marked(  );
 // });



</script>

@endsection
