<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Paper;
use App\User;
use App\Image;
use App\Folfol;
use App\Like;
use App\Stock;
use Carbon\Carbon;
use App\tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('home');
    // }


	/**
	 * インデックスページを表示するための処理
	 *
	 * @return
	 *
	 */
    public function root()
    {

		// 認証されていない場合は new_visitor.blade.php のviewを返す
		if( \Auth::check() )
        {

			/**
			* 認証されたユーザー
			*
			* @var object
			*
			*/
			$auth_user = \Auth::user();

			/**
			* 認証されたユーザーのID
			*
			* @var int
			*
			*/
			$auth_user_id = $auth_user->id;


			/**
			 * 最新の記事を最大20件取得 ( like , stock のカウント数も取得)
			 *
			 * @var array ( array内部はstdClassで構成 )
			 *
			 */
			$latest_articles = DB::select('
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
			order by papers.created_at desc
			limit 20
			');

			/**
			 * フォローしているユーザーのIDを取得する
			 *
			 * @var array
			 *
			 */
			 $follow_user_all = Folfol::where('user_id' , $auth_user_id )
			                          ->select('follow_id')
			                          ->get()
									  ->toArray();

			/**
			* $follow_user_allの配列の値をstringに変換する(sql用)
			*
			* @var string
			*
			*/
			 $follow_user_string = "";

			 foreach( $follow_user_all as $value )
			 {
				 $follow_user_string .= $value['follow_id'] . ",";
			 }
			 $follow_user_string = rtrim($follow_user_string, ',');


			/**
			 * フォローしているユーザーの最新記事を最大20件取得する ( like , stock の数も取得 )
			 *
			 * @var array ( array内部はstdClassで構成 )
			 *
			 */
			if( ! empty($follow_user_all) ){
				$follow_user_articles = DB::select("
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
				where papers.user_id in ( $follow_user_string )
				order by papers.created_at desc
				limit 20
				");
			}else {
				$follow_user_articles = null;
			}

			 /**
			 * ユーザーのいいね数のトータルでのランキング（期間：すべて）
			 *
			 * @var array
			 *
			 */
			$index_user_rank_total = Like::select('likes.liked_author_id' , 'users.name' , 'users.p_image_name' , DB::raw("count(likes.liked_author_id) as like_count"))
			                             ->join('users' , 'users.id' , '=' , 'likes.liked_author_id')
			                             ->groupBy('likes.liked_author_id')
										 ->orderBy('like_count' , 'desc')
										 ->take(5)
										 // ->toSql();
										 ->get()
										 ->toArray();


			/**
			 * 今日の日付
			 *
			 * @var string
			 *
			 */
			$index_now_date = Carbon::now();

			/**
			 * 今日の日付(計算用)
			 *
			 * @var string
			 *
			 */
			$index_date = Carbon::now();

			/**
			 * 1週間前の日付
			 *
			 * @var string
			 *
			 */
			$index_sub_week_date = $index_date->subDay(7);



			/**
			 * ユーザーのいいね数のトータルでのランキング（期間：最近１週間）
			 *
			 * @var array
			 *
			 */
			$index_user_rank_week = Like::select('likes.liked_author_id' , 'users.name' , 'users.p_image_name' , DB::raw("count(likes.liked_author_id) as like_count"))
			                             ->join('users' , 'likes.liked_author_id' , '=' , 'users.id')
			                             ->where('likes.created_at' , '>=' , $index_sub_week_date )
										 ->groupBy('likes.liked_author_id')
										 ->orderBy('like_count' , 'desc')
										 // ->toSql();
										 ->take(5)
										 ->get()
										 ->toArray();



			/**
			 * タグの多い順に20件取り出す
			 *
			 * @var array
			 *
			 */
			$index_tag_ranking = tag::select( DB::raw( 'count(name) as tag_count , tags.name , tags.id' ) )
			                        ->groupBy('tags.name')
									->orderBy('tag_count' , 'desc')
									->take(20)
									->get()
									->toArray();

									// dd($index_tag_ranking);




			// 認証されている場合はこのページへ飛ぶ
			return view('main_view.index')->with([
				'latest_articles' => $latest_articles,
				'follow_user_articles' => $follow_user_articles,
				'user_rank_total' => $index_user_rank_total,
				'user_rank_week' => $index_user_rank_week,
				'tag_ranking' => $index_tag_ranking,
			]);
		}else{
			// 認証されていない場合はこのページに飛ぶ

			$random_num = rand(0 , 3);
			return view('main_view.new_visitor')->with([
				'random_num' => $random_num,
			]);
		}
    }
}
