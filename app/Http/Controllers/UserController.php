<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Paper;
use App\User;
use App\Folfol;
use App\Stock;
use App\Like;
use App\tag;

class UserController extends Controller
{

	/**
	 * マイページを表示する
	 *
	 * @return view
	 *
	 */
	public function user_page( $id )
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
		 * ユーザーページのユーザー情報
		 *
		 * @var object
		 *
		 */
		$this_page_user = User::findOrFail($id);


		$my_articles = DB::select("
		select
			papers.title ,
			papers.created_at ,
			papers.updated_at ,
			papers.user_id ,
			papers.id ,
			users.name,
			users.p_image_name,
			users.selfintro,
			(select count(*)  from likes where paper_id = papers.id group by likes.paper_id  ) as like_count ,
			(select count(*)  from stocks where stock_id = papers.id group by stocks.stock_id  ) as stock_count
		from papers
		inner join users on papers.user_id = users.id
		where users.id = $id
		order by papers.created_at desc
		limit 20
		");




		/**
		 * 認証されたユーザーがストックした記事の一覧を取得
		 *
		 * @var array
		 *
		 */
		 $stock_article_all = Stock::where('user_id' , $id )
								  ->select('stock_id')
								  ->get()
								  ->toArray();

		/**
		* $follow_user_allの配列の値をstringに変換する(sql用)
		*
		* @var string
		*
		*/
		 $stock_article_string = "";

		 foreach( $stock_article_all as $value )
		 {
			 $stock_article_string .= $value['stock_id'] . ",";
		 }
		 $stock_article_string = rtrim($stock_article_string, ',');


		/**
		 * ストックしている記事を取得
		 *
		 * @var array ( array内部はstdClassで構成 )
		 *
		 */
		if( ! empty($stock_article_all) ){
			$my_stocks = DB::select("
			select
				papers.title ,
				papers.created_at ,
				papers.updated_at ,
				papers.user_id ,
				papers.id ,
				users.name,
				users.p_image_name,
				users.selfintro,
				(select count(*)  from likes where paper_id = papers.id group by likes.paper_id  ) as like_count ,
				(select count(*)  from stocks where stock_id = papers.id group by stocks.stock_id  ) as stock_count
			from papers
			inner join users on papers.user_id = users.id
			where papers.id in ( $stock_article_string )
			order by papers.created_at desc
			limit 20
			");


		}else {
			$my_stocks = null;
		}




		/**
		 * 認証されたユーザーのフォロワーを取得（合計数用）
		 *
		 * @var array
		 *
		 */
		$my_follower = Folfol::where('follow_id' , $id )
							 ->get()
							 ->toArray();

		/**
		 * 認証されたユーザーのフォローしている人を取得（合計数用）
		 *
		 * @var array
		 *
		 */
		$my_follow = Folfol::where('user_id' , $id )
						   ->get()
						   ->toArray();


		/**
		 * いいねされた数の総計(トータル期間)
		 *
		 *
		 */
		 $my_articles_like_count = Like::select(DB::raw('count(*) as like_count'))
									   ->where('liked_author_id' , $id )
									   ->get()
									   ->toArray();



	   /**
		 * ストックされた数の総計(トータル期間)
		 *
		 *
		*/
		 $my_articles_stock_count = Stock::select(DB::raw('count(*) as stock_count'))
									   ->where('stocked_author_id' , $id )
									   ->get()
									   ->toArray();


		/**
		 * ユーザーがよく使っているタグ
		 *
		 * @var array
		 */
		$my_article_tags = tag::where( 'page_author_id' , $id )
							  ->select('id' , 'name' , DB::raw( "count(*) as count" ))
							  ->groupBy('name')
							  ->orderBy('count' , 'desc')
							  ->take(10)
							  ->get()
							  ->toArray();

		 /**
		 * 最近フォローしたユーザー
		 *
		 * @var array
		 */
		$my_latest_follow_user = Folfol::where('user_id' , $id)
									   ->join('users' , 'folfols.follow_id' , '=' , 'users.id')
									   ->orderBy('folfols.created_at' , 'desc')
									   ->take(5)
									   ->get()
									   ->toArray();

	   /**
		 * 最近フォローされたユーザー
		 *
		 * @var array
		 */
		$my_latest_followed_user = Folfol::where('follow_id' , $id)
									   ->join('users' , 'folfols.user_id' , '=' , 'users.id')
									   ->orderBy('folfols.created_at' , 'desc')
									   ->take(5)
									   ->get()
									   ->toArray();






		return view('main_view.user')->with([
			 'user' => $this_page_user ,
			 'my_articles' => $my_articles,
			 'my_articles_like_count' => $my_articles_like_count,
			 'my_articles_stock_count' => $my_articles_stock_count,
			 'my_stocks' => $my_stocks,
			 'my_follower' => $my_follower,
			 'my_follow' => $my_follow,
			 'my_article_tags' => $my_article_tags,
			 'my_latest_follow_user' => $my_latest_follow_user,
			 'my_latest_followed_user' => $my_latest_followed_user,
		 ]);
	}
}
