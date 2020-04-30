<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Paper;
use App\Folfol;
use App\Like;
use App\Stock;
use App\Image;
use App\tag;


/**
 *
 * @method articles( int $id )
 * @method edit_new()
 * @method edit_update( int $id )
 * @method submit_article( Request $request )
 * @method update_article( int $id ,  Request $request )
 * @method search( Request $request )
 * @method tag( Request $request )
 *
 */
class PaperController extends Controller
{

	/**
	 * 記事ページを表示する
	 *
	 * @return view
	 *
	 */
    public function articles($id)
    {

		/** 数字のみであるかの検証( 厳密 : -や.やeを含まない )
		 *
		 * @param  integer $id
		 * @return void
		 *
		 */
		function num_revalidate($id){
		    if (preg_match('/\A[0-9]{1,10}\z/u' , $id) == 0){
		        exit('urlが間違っています');
		    }
		}

		/** 制御文字の検証
		 *
		 * @param  integer $id
		 * @return void
		 *
		 */
		function cntrl_revalidate($id){
		    if (preg_match('/\A[[:^cntrl:]]+\z/u' , $id) == 0){
		        exit('制御文字を使用しないでください');
		    }
		}

		num_revalidate($id);
		cntrl_revalidate($id);

        /**
		 * 記事本体のデータ
		 *
		 * @var object
		 *
		 */
        $article = Paper::findOrFail($id);

        /** 投稿ユーザー ( id , name )
		 *
		 * @var object
		 *
		 */
        $post_user = User::select('id','name' , 'p_image_name')->findOrFail( $article->user_id );

		/** 記事主のフォロワー数
		 *
		 * @var string
		 *
		 */
		$article_author_fol_num = Folfol::where( 'follow_id' , $post_user->id )
								  ->count();

		/** 記事のいいね数
		 *
		 * @var string
		 *
		 */
		$article_like_num = Like::where( 'paper_id' , $article->id )
		                         ->count();

		/** 記事のストック数
		 *
		 * @var string
		 *
		 */
		 $article_stock_num = Stock::where( 'stock_id' , $article->id )
 		                         ->count();



		/**
		 * 記事のタグを取得する
		 *
		 * @var array
		 *
		 */
		 $article_tag_list = tag::where('article_id' , $id)
		                        ->select('name')
		                        ->get()
								->toArray();
								// dd($article_tag_list);
		 $article_tag_array = array_flatten( $article_tag_list );

		// 認証されたユーザーと認証されてないユーザーごとに処理を分ける
        if( \Auth::check() )
        {

			/**
			* 認証されたユーザー
			*
			* @var object
			*
			*/
            $auth_user = \Auth::user();

			/** 記事を見ているユーザーID
			 *
			 * @var int
			 *
			 */
            $watch_user_id = $auth_user->id;

			/**
			 * このページを見ているユーザーがページ作者をフォローしているか
			 *
			 * @var bool
			 *
			 */
            $is_follow = Folfol::where('user_id' , $auth_user->id )
                                ->where('follow_id' , $post_user->id)
                                ->exists();
            if($is_follow){
                $is_follow = 1;
            }else{
                $is_follow = 0;
            }

			/**
			 * このページを見ているユーザーがページをいいねしているか
			 *
			 * @var bool
			 *
			 */
            $is_like = Like::where('user_id' , $auth_user->id )
                           ->where('paper_id' , $id )
                           ->exists();
            if($is_like){
               $is_like = 1;
            }else{
               $is_like = 0;
            }

			/**
			 * このページを見ているユーザーがページをストックしているかどうか
			 *
			 * @var bool
			 *
			 */
            $is_stock = Stock::where('user_id' , $auth_user->id)
                             ->where('stock_id' , $id )
                             ->exists();
            if($is_stock){
             $is_stock = 1;
            }else{
             $is_stock = 0;
            }

        }else{
			// 認証されていないユーザーの場合はこの値に固定
            $watch_user_id = -1;
            $is_follow = 0;
            $is_like = 0;
            $is_stock = 0;
        }



        return view('main_view.articles')
                ->with([
                    'article' => $article,
                    'post_user' => $post_user,
					'article_like_num' => $article_like_num,
					'article_stock_num' => $article_stock_num,
					'article_author_fol_num' => $article_author_fol_num,
                    'watch_user_id' => $watch_user_id,
                    'article_id' => $id,
                    'is_follow' => $is_follow,
                    'is_like' => $is_like,
                    'is_stock' => $is_stock,
					'article_tag_array' => $article_tag_array,
                ]);
    }

	/**
	 * 新しく記事作成するための処理
	 *
	 *　@return view
	 *
	 */
    public function edit_new()
    {
        return view('main_view.editor')->with([
            'article_content' => null,
            'article_title' => null,
            'user_name' => null,
            'article_id' => null,
			'page_tags' => [],
        ]);
    }

	/**
	 * 記事を更新するための処理
	 *
	 *　@return view
	 *
	 */
    public function edit_update( $id )
    {

		/**
		 * 編集する記事のデータを取得する
		 *
		 * @var object
		 *
		 */
        $article = Paper::findOrFail( $id );

		/**
		 * 認証されたユーザーの情報
		 *
		 * @var object
		 *
		 */
        $user = \Auth::user();

		// 記事主と編集ユーザーが同一なら実行
        if( $article->user_id === $user->id ){

			/**
			 * 編集する記事のデータを取得する
			 *
			 * @var object
			 *
			 */
            $article = Paper::findOrFail($id);

			/**
			 * 記事主の情報を取得する
			 *
			 * @var object
			 *
			 */
            $post_user = User::findOrFail( $article->user_id );

			/**
			 * 記事のタグを取得する
			 *
			 * @var array
			 *
			 */
			 $page_tags = tag::where('article_id' , $id )
			                 ->select('name')
			                 ->get()
							 ->toArray();

			 $page_tags = array_flatten( $page_tags );

            return view('main_view.editor')->with([
                'article_content' => $article->content,
                'article_title' => $article->title,
                'user_name' => $post_user->name,
                'article_id' => $id,
				'page_tags' => $page_tags,
            ]);

        }else{
			exit;
            return false;
        }
    }

	/**
	 * 新しい記事をデータベースに入れるための処理
	 *
	 * @param  Request $request
	 * @return redirect
	 *
	 */
    public function submit_article( Request $request )
    {
		if(! empty($request->input('tag'))){
			$this->validate( $request , [
				'title' => 'required|max:50|string|min:1|cntrl',
				'article_text' => 'required|max:10000|string|min:1|cntrlnrt',
				'tag' => 'cntrlnrt|string',
				] );
		}else{
			$this->validate( $request , [
				'title' => 'required|max:50|string|min:1|cntrl',
				'article_text' => 'required|max:10000|string|min:1|cntrlnrt',
				] );
		}

		/**
		 * 記事をデータベースに入れるためにインスタンスを作る
		 *
		 * @var object
		 *
		 */
        $article_submit = new \App\Paper();

		/**
		 * 認証されたユーザーの情報を取得
		 *
		 * @var object
		 *
		 */
        $user = \Auth::user();
        $article_submit->title = $request->input('title');
        $article_submit->content = $request->input('article_text');
        $article_submit->user_id = $user->id;
		/**
		 * 記事データを保存できかたを確認するためのブール値を取得
		 *
		 * @var bool
		 *
		 */
        $article_submit_bool = $article_submit->save();


        /*
		 * タグテーブルへの挿入
		 */
		 if(! empty($request->input('tag'))){

		$input_tags = $request->input('tag');
		$input_tags_explode = explode(',' , $input_tags );
		$submit_tags_array = [];
		foreach($input_tags_explode as $val)
		{
			$submit_tags_array[] = trim( mb_convert_kana( $val , "s", 'UTF-8'));
		}

		for($i = 0 ; $i < count( $submit_tags_array ) ; $i++ )
		{
			$tag_submit = new \App\tag();
			$tag_submit->name = $submit_tags_array[$i];
			$tag_submit->article_id = $article_submit->id;
			$tag_submit->page_author_id = $user->id;
			$tag_submit_bool = $tag_submit->save();
		}

		}

		/*
		 * 成否判定（papersテーブルへの処理で行う）
		 */
		// エラー時はマイページへ戻る（正常なら記事ページへ移動)
		if( $article_submit_bool )
		{
			return redirect( '/articles/' . $article_submit->id );
		}else{
			return redirect( action('MypageController@mypage') );
		}


    }

	/**
	 * 記事を更新してデータベースに入れるための処理
	 *
	 * @return redirect
	 *
	 */
    public function update_article($id , Request $request )
    {

		if(! empty($request->input('tag'))){
			$this->validate( $request , [
				'title' => 'required|max:50|string|min:1|cntrl',
				'article_text' => 'required|max:10000|string|min:1|cntrlnrt',
				'tag' => 'cntrlnrt|string',
				] );
		}else{
			$this->validate( $request , [
				'title' => 'required|max:50|string|min:1|cntrl',
				'article_text' => 'required|max:10000|string|min:1|cntrlnrt',
				] );
		}

		/**
		 * 編集する記事の情報を取得する
		 *
		 * @var object
		 *
		 */
        $article_submit = Paper::find($id);

		/**
		 * 認証されたユーザーの情報を取得
		 *
		 * @var object
		 *
		 */
        $user = \Auth::user();

        $article_submit->title = $request->input('title');
        $article_submit->content = $request->input('article_text');
        $article_submit->user_id = $user->id;
		/**
		 * 記事データを更新できかたを確認するためのブール値を取得
		 *
		 * @var bool
		 *
		 */
        $article_submit_bool = $article_submit->save();



		/*
		 * タグテーブルへの挿入
		 */
		 // いったん既存のものを削除する
		 	tag::where('article_id' , $id )
			   ->delete();

		 // 新しく挿入する
		if(! empty($request->input('tag'))){
		$input_tags = $request->input('tag');
		$input_tags_explode = explode(',' , $input_tags );
		$submit_tags_array = [];
		foreach($input_tags_explode as $val)
		{
			$submit_tags_array[] = trim( mb_convert_kana( $val , "s", 'UTF-8'));
		}

		for($i = 0 ; $i < count( $submit_tags_array ) ; $i++ )
		{
			$tag_submit = new \App\tag();
			$tag_submit->name = $submit_tags_array[$i];
			$tag_submit->article_id = $article_submit->id;
			$tag_submit->page_author_id = $user->id;
			$tag_submit_bool = $tag_submit->save();
		}

		}

		/**
		 *
		 * @todo 記事の確認画面が必要
		 *
		 */

		// エラー時はマイページへ戻る（正常なら記事ページへ移動)
		if( $article_submit_bool )
		{
			return redirect( '/articles/' . $id );
		}else{
			return redirect( action('MypageController@mypage') );
		}
    }

	/**
	 * 検索した際の処理
	 *
	 * @param Request $request
	 *
	 */
	 public function search( Request $request )
	 {
		 $this->validate( $request , [
			 'search' => 'required|string|cntrl',
			 ] );

		/**
		 * フォームで入力された検索ワード
		 *
		 * @var string
		 *
		 */
		$search_word = $request->input('search');

		/**
		 * 入力された検索ワードを半角スペースをデリミタにして分ける
		 *
		 * @var array
		 *
		 */
		$search_word_explode = explode( ' ' , $search_word);

		/**
		 * 入力されたワードを分割したものの配列数
		 *
		 * @var int
		 * @see $search_word_explode
		 *
		 */
		$search_word_array_count = count( $search_word_explode );

		$search_result_final = [];

		// タイトルから検索文字を探す(for文で複数に対応)
		for($i = 0 ; $i < $search_word_array_count ; $i++ )
		{
			$search_result_title = Paper::where('title' , 'like' , '%' . $search_word_explode[$i] . '%' )
			                            // ->toSql();
										->select('id')
										->get()
										->toArray();

			$search_result_final[] = $search_result_title;
		}

		// 記事中から検索文字を探す(for文で複数に対応)
		for($i = 0 ; $i < $search_word_array_count ; $i++ )
		{
			$search_result_content = Paper::where('content' , 'like' , '%' . $search_word_explode[$i] . '%' )
			                            // ->toSql();
										->select('id')
										->get()
										->toArray();

			$search_result_final[] = $search_result_content;
		}

		/**
		 * 検索ワードの処理から返ってきたデータをまとめて、扱いやすいようにする
		 *
		 * @var array
		 *
		 */
		$f_search_result_final = array_values(
			                     array_unique(
							     array_sort(
							     array_flatten( $search_result_final )) , SORT_NUMERIC ));
		/**
		 * 最終的な検索結果をORMから取得する
		 *
		 * @var array
		 *
		 */
		$search_result_article_data = Paper::whereIn('papers.id' , $f_search_result_final)
		                                   ->join('users' , 'users.id' , '=' , 'papers.user_id')
		                                   ->orderBy('papers.created_at' , 'desc')
										   ->select(
											   'papers.user_id',
											   'papers.title',
											   'papers.id',
											   'papers.created_at',
											   'papers.updated_at',
											   'users.p_image_name',
											   'users.name'
											   )
										   ->take(20)
		                                   ->get()
										   ->toArray();

        $search_like_count_array = [];
		$search_stock_count_array = [];
		foreach( $search_result_article_data as $key => $value )
		{
			$search_temp_like_count = Like::select( DB::raw('count(*) as like_count') )
			                              ->where('paper_id' , $value['id'])
										  ->get()
										  ->toArray();

			$search_result_article_data[$key]['like_count'] = $search_temp_like_count[0]['like_count'];
			$search_temp_stock_count = Stock::select( DB::raw('count(*) as stock_count') )
			                              ->where('stock_id' , $value['id'])
										  ->get()
										  ->toArray();
			$search_result_article_data[$key]['stock_count'] = $search_temp_stock_count[0]['stock_count'];
		}

		return view('main_view.search')->with([
		'search_word' => $search_word,
		'f_search_result_final' => $f_search_result_final,
		'search_result_article_data' => $search_result_article_data,
		]);
	 }


	 /**
	  * タグ検索の処理をする
	  *
	  * @param Request $request
	  *
	  */
	  public function tag( Request $request )
	  {

		$this->validate( $request , [
		  'tag' => 'required|string|cntrl',
		 ] );

		  $input_tag = $request->input('tag');

		  $search_result_article_data = tag::join('papers' , 'papers.id' , '=' , 'tags.article_id')
		                         ->join('users' , 'users.id' , '=' , 'tags.page_author_id')
								 ->select(
									 'papers.user_id',
									 'papers.title',
									 'papers.id',
									 'papers.created_at',
									 'papers.updated_at',
									 'users.p_image_name',
									 'users.name'
									 )
		                         ->where('tags.name' , $input_tag)
		                         ->orderBy('tags.created_at' , 'desc')
								 ->take(20)
								 ->get()
								 ->toArray();



		$search_like_count_array = [];
		$search_stock_count_array = [];
		foreach( $search_result_article_data as $key => $value )
		{
			$search_temp_like_count = Like::select( DB::raw('count(*) as like_count') )
			                              ->where('paper_id' , $value['id'])
										  ->get()
										  ->toArray();

			$search_result_article_data[$key]['like_count'] = $search_temp_like_count[0]['like_count'];
			$search_temp_stock_count = Stock::select( DB::raw('count(*) as stock_count') )
			                              ->where('stock_id' , $value['id'])
										  ->get()
										  ->toArray();

			$search_result_article_data[$key]['stock_count'] = $search_temp_stock_count[0]['stock_count'];
		}

		return view('main_view.tag')->with([
			'search_word' => $input_tag,
			'search_result_article_data' => $search_result_article_data,
		]);
	  }

}
