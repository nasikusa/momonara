<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Paper;
use App\Folfol;
use App\Stock;
use App\Like;
use App\tag;

class MypageController extends Controller
{

	/**
	 * マイページを表示する
	 *
	 * @return view
	 *
	 */
    public function mypage()
    {
		/**
		 * 認証されたユーザーの情報
		 *
		 * @var object
		 *
		 */
        $user = \Auth::user();

		/**
		 * 認証されたユーザーが投稿した記事一覧
		 *
		 * @var array
		 *
		 */
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
		where users.id = $user->id
		order by papers.created_at desc
		limit 20
		");




		/**
		 * 認証されたユーザーがストックした記事の一覧を取得
		 *
		 * @var array
		 *
		 */
		 $stock_article_all = Stock::where('user_id' , $user->id )
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
        $my_follower = Folfol::where('follow_id' , $user->id )
							 ->get()
							 ->toArray();

		/**
		 * 認証されたユーザーのフォローしている人を取得（合計数用）
		 *
		 * @var array
		 *
		 */
        $my_follow = Folfol::where('user_id' , $user->id )
		                   ->get()
						   ->toArray();


		/**
		 * いいねされた数の総計(トータル期間)
		 *
		 * @var array
		 *
		 */
		 $my_articles_like_count = Like::select(DB::raw('count(*) as like_count'))
		                               ->where('liked_author_id' , $user->id )
									   ->get()
									   ->toArray();



	   /**
		 * ストックされた数の総計(トータル期間)
		 *
		 * @var array
		 *
		*/
		 $my_articles_stock_count = Stock::select(DB::raw('count(*) as stock_count'))
		                               ->where('stocked_author_id' , $user->id )
									   ->get()
									   ->toArray();


		/**
		 * ユーザーがよく使っているタグ
		 *
		 * @var array
		 */
		$my_article_tags = tag::where( 'page_author_id' , $user->id )
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
		$my_latest_follow_user = Folfol::where('user_id' , $user->id)
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
		$my_latest_followed_user = Folfol::where('follow_id' , $user->id)
		                               ->join('users' , 'folfols.user_id' , '=' , 'users.id')
		                               ->orderBy('folfols.created_at' , 'desc')
									   ->take(5)
									   ->get()
									   ->toArray();






        return view('main_view.mypage')->with([
             'user' => $user ,
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


	/**
	 * ユーザーの設定画面を表示する
	 *
	 *　
	 *
	 */
	public function config()
	{

		/**
		 * 認証されたユーザーの情報
		 *
		 * @var object
		 *
		 */
		$user = \Auth::user();



		return view('main_view.config')->with([
			'config_name' => $user->name ,
			'config_selfintro' => $user->selfintro,
			'config_p_image_name' => $user->p_image_name,
		]);
	}


	 /**
	  * ユーザーのemail設定画面を表示する
	  *
	  *　
	  *
	  */
	 public function config_email()
	 {
		 /**
		  * 認証されたユーザーの情報
		  *
		  * @var object
		  *
		  */
		 $user = \Auth::user();

		 return view('main_view.config_email')->with([
			 'config_email' => $user->email
		 ]);
	 }

	 /**
	  * ユーザーのpassword設定画面を表示する
	  *
	  *　
	  *
	  */
	 public function config_password()
	 {
		 /**
		  * 認証されたユーザーの情報
		  *
		  * @var object
		  *
		  */
		 $user = \Auth::user();

		 return view('main_view.config_password');
	 }

	 /**
	 * ユーザーの設定変更を反映させるための処理を行う
	 *
	 * @return void
	 *
	 */
	 public function config_change( Request $request)
	 {

		 $this->validate($request, [
			 'my_profileimage' => 'mimes:jpeg,png|file|image|max:1500',
	 		'my_name' => 'required|string|max:191|cntrl',
	 		'my_introduction' => 'string|max:1000|cntrlnrt'
		]);

		 /**
		  * 認証されたユーザーの情報
		  *
		  * @var object
		  *
		  */
		 $user = \Auth::user();

		 /**
		  * フォームで入力されたユーザー名
		  *
		  * @var string
		  *
		  */
		 $config_name = $request->input('my_name');

		 /**
		  * フォームで入力された自己紹介文
		  *
		  * @var string
		  *
		  */
		 $config_intro = $request->input('my_introduction');

		 /**
		  * フォームで入力されたアイコン
		  *
		  * @var ?
		  *
		  */
		 $config_icon = $request->file('my_profileimage');

		if(! empty($config_icon) )
		{

			/**
			 * アップロードされた画像のMIMEタイプを取得
			 *
			 * @var int
			 *
			 */
			$upload_file_mimetype = $config_icon->getMimeType();

			// dd($upload_file_mimetype);

			/**
			 * リサイズしたい画像の横幅を指定
			 *
			 * @var int
			 *
			 */
			$resize_image_w = 200;

			/**
			 * リサイズしたい画像の縦幅を指定
			 *
			 * @var int
			 *
			 */
			$resize_image_h = 200;

			/**
			 * フォームからアップロードされた画像の縦幅と横幅を取得（変数２つ）
			 *
			 * @var int
			 *
			 */
			list( $image_w , $image_h ) = getimagesize( $config_icon );

			/**
			 * フォームからアップロードされた画像の縦横比を取得
			 *
			 * @var int
			 *
			 */
			$upload_image_proportion = $image_w / $image_h;

			/**
			 * 画像のもととなるものを作成（横縦幅を決定）
			 *
			 * @var
			 *
			 */
			$resized_thumb_image = imagecreatetruecolor($resize_image_w, $resize_image_h);
			imagefill($resized_thumb_image , 0 , 0 , 0xFFFFFF);



			/**
			 * 画像のインスタンスを作成
			 *
			 * @var
			 *
			 */
			if( $upload_file_mimetype === 'image/jpeg' )
			{
				$icon_image = imagecreatefromjpeg( $config_icon );
			}elseif( $upload_file_mimetype === 'image/png' ){
			    $icon_image = imagecreatefrompng( $config_icon );
			}

			// トリミング用の処理（実際の処理は 下のimagecopyresampledで行う）
			if ( $image_w >= $image_h )
			{
				$side = $image_h;
				$x_position = floor( ($image_w - $image_h) / 2 );
				$y_position = 0;
				$image_w = $side;
			} else {
				$side = $image_w;
				$y_position = floor (( $height - $width ) / 2 );
				$x_position = 0;
				$image_h = $side;
			}

			imagecopyresampled(
				 $resized_thumb_image,
				 $icon_image,
				 0,
				 0,
				 $x_position,
				 $y_position,
				 $resize_image_w,
				 $resize_image_h,
				 $image_w,
				 $image_h
			);


			/**
			 * ランダムな文字列を作成する関数
			 *
			 * @see https://qiita.com/TetsuTaka/items/bb020642e75458217b8a
			 * @var int $length
			 * @return string
			 *
			 */
			function makeRandStr($length = 40) {
			    static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
			    $str = '';
			    for ($i = 0; $i < $length; ++$i) {
			        $str .= $chars[mt_rand(0, 61)];
			    }
			    return $str;
			}

			/**
			 * makeRandStrでランダムな文字列を作成する（ファイル名用）
			 *
			 * @var string
			 *
			 */
			$random_str_image_name = makeRandStr();

			/**
			 * アイコン画像を入れるフォルダ（ユーザーID / ランダム文字列.拡張子 )で入る
			 *
			 * @var string
			 *
			 */
			$user_icon_image_folder = storage_path('app/public/icon_images/' . $user->id );

			// フォルダがなければ作る
			if( ! file_exists( $user_icon_image_folder  ) )
			{
				mkdir($user_icon_image_folder, 0777);
			}

			// MIMEタイプごとに画像を出力する
			if( $upload_file_mimetype === 'image/jpeg' )
			{
				$random_str_image_name .= '.jpg';
				imagejpeg($resized_thumb_image,           // 背景画像
					storage_path('app/public/icon_images/' . $user->id . '/' . $random_str_image_name),
					100
				);
			}elseif( $upload_file_mimetype === 'image/png' ){
				$random_str_image_name .= '.png';
				imagepng($resized_thumb_image,           // 背景画像
					storage_path('app/public/icon_images/' . $user->id . '/' .  $random_str_image_name)
				);
			}
		}

		if(! empty( $config_icon) )
		{
			/**
			* アイコン画像のアップロード終了後の画像ファイル名
			*
			* @var string
			*
			*/
			$uploaded_filename = $request->file('my_profileimage')->store('public/icon_images');
		}



		 if(! empty($config_name) )
		 {


			DB::table('users')
			->where( 'id' , $user->id )
			->update([ 'name' => $config_name ]);

		 }
		 if(! empty($config_intro) )
		 {
			DB::table('users')
			->where( 'id' , $user->id )
			->update([ 'selfintro' => $config_intro ]);

		 }
		 if(! empty($uploaded_filename))
		 {
			 DB::table('users')
			 ->where( 'id' , $user->id )
			 ->update([ 'p_image_name' => $random_str_image_name ]);

		 }

		 return redirect('/mypage/config/finish');
	 }

	/**
	 * メールアドレスの設定を反映する処理
	 *
	 *　
	 */
	 public function config_change_email( Request $request ){
		 /**
		  * 認証されたユーザーの情報
		  *
		  * @var object
		  *
		  */
		  $user = \Auth::user();

		 /**
		  * 入力されたメールアドレスのデータ
		  *
		  * @var string
		  */
		 $request_email = $request->my_email;

		 if(! empty($request_email))
		 {
			 DB::table('users')
			 ->where( 'id' , $user->id )
			 ->update([ 'email' => $request_email ]);
		 }

		 return redirect('/mypage/config/finish');
	 }

	 /**
	  * パスワードの設定を反映する処理
	  *
	  *　
	  */
	  public function config_change_password( Request $request ){


		/**
		 * 認証されたユーザーの情報
		 *
		 * @var object
		 *
		 */
		$user = \Auth::user();

		/**
		 * 入力された現在のパスワードのデータ
		 *
		 * @var string
		 */
		$request_password_current = $request->my_current_password;

		/**
		 * 入力されたパスワードのデータ
		 *
		 * @var string
		 */
		$request_password_new = $request->my_password;

		/**
		 * 入力されたパスワードのデータ（確認)
		 *
		 * @var string
		 */
		$request_password_new_confirm = $request->my_password_confirm;

		if($request_password_new_confirm !== $request_password_new){
			exit('同じパスワードを入力してください');
		}

		if(empty($request_password_new) || empty($request_password_current) || empty($request_password_new_confirm))
		{
			exit("入力されてないデータがあります");
		}


		  if(Hash::check($request_password_current , $user->password))
		  {
			  $new_hashed_password = Hash::make( $request_password_new );
			  DB::table('users')
			  ->where( 'id' , $user->id )
			  ->update([ 'password' => $new_hashed_password ]);
		  }else{
			  exit('パスワードの認証に失敗しました');
		  }

		  return redirect('/mypage/config/finish');
	  }


	/**
	 * 設定を変更した後に表示するページをだす
	 *
	 *
	 *
	 */
	 public function config_finish()
	 {
		 return view('main_view.config_finish');
	 }


	/**
	 * フォローしている人の一覧ページを表示する
	 *
	 * @return view
	 *
	 */
    public function follow()
    {
		/**
		 * 認証されたユーザーの情報
		 *
		 * @var object
		 *
		 */
        $user = \Auth::user();

		/**
		 * フォローしている人の情報を取得する
		 *
		 * @var object
		 *
		 */
        $following_user = Folfol::join('users' , 'users.id' , '=' , 'folfols.follow_id')
                                ->where('user_id' , $user->id )
                                ->orderBy('folfols.updated_at' , 'desc')
                                ->get()
                                ->toArray();

        return view('main_view.follow')->with('following_user' , $following_user);
    }

	/**
	 * フォローされている人の一覧ページを表示する
	 *
	 * @return view
	 *
	 */
    public function follower()
    {
		/**
		 * 認証されたユーザーの情報
		 *
		 * @var object
		 *
		 */
        $user = \Auth::user();

		/**
		 * フォローされているユーザーの情報を取得する
		 *
		 * @var object
		 *
		 */
        $followed_user = Folfol::join('users' , 'users.id' , '=' , 'folfols.user_id')
                                ->where('follow_id' , $user->id )
                                ->orderBy('folfols.updated_at' , 'desc')
                                ->get()
                                ->toArray();

        return view('main_view.follower')->with('followed_user' , $followed_user );
    }
}
