<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;
use App\User;
use App\Folfol;
use App\Like;
use App\Stock;

class AjaxController extends Controller
{

	/**
	*  記事ページの フォローボタン or リムーブボタン からのajaxが飛んでくるので、それ関連の処理を行う（挿入 or 削除 )
	*
	* @var    array request
	* @return string 0 | 1 | 2
	*
	*/
    public function follow_ajax( Request $request )
    {

	$this->validate($request, [
	'user_id' => 'required|numeric|cntrl',
	'follow_id' => 'required|numeric|cntrl',
	'is_follow' => 'required|numeric|cntrl',
	]);


		// 同一ユーザーの場合は処理しない
        if( $request->user_id === $request->follow_id ){
            return 0;
        }

        if( $request->is_follow ){
            Folfol::where('user_id' , $request->user_id )
                    ->where('follow_id' , $request->follow_id )
                    ->delete();
            return 2;
        }else{
            $insert_new_fol = new \App\Folfol();
            $insert_new_fol->user_id = $request->user_id;
            $insert_new_fol->follow_id = $request->follow_id;
            $insert_new_fol->save();
            return 1;
        }

    }

	/**
	*  記事ページの いいねボタン からのajaxが飛んでくるので、それ関連の処理を行う（挿入 or 削除 )
	*
	* @var    array request
	* @return string 0 | 1 | 2
	*
	*/
    public function like_ajax( Request $request )
    {

		$this->validate($request, [
		'like_user_id' => 'required|numeric|cntrl',
		'watch_user_id' => 'required|numeric|cntrl',
		'is_like' => 'required|numeric|cntrl',
		]);

		// 同一ユーザーの場合は処理しない
        if( $request->like_user_id === $request->watch_user_id ){
            return 0;
        }

        if( $request->is_like == 1 ){
            Like::where( 'user_id' , $request->watch_user_id )
                ->where( 'paper_id' , $request->article_id )
                ->delete();
                return 2;
        }else{
            $insert_new_like = new \App\Like();
            $insert_new_like->liked_author_id = $request->like_user_id;
            $insert_new_like->user_id = $request->watch_user_id;
            $insert_new_like->paper_id = $request->article_id;
            $insert_new_like->save();
            return 1;
        }
    }

	/**
	*  記事ページの ストックボタン からのajaxが飛んでくるので、それ関連の処理を行う（挿入 or 削除 )
	*
	* @var    array request
	* @return string 0 | 1 | 2
	*
	*/
    public function stock_ajax( Request $request )
    {

		$this->validate($request, [
		'stock_user_id' => 'required|numeric|cntrl',
		'watch_user_id' => 'required|numeric|cntrl',
		'is_stock' => 'required|numeric|cntrl',
		]);

		// 同一ユーザーの場合は処理しない
        if( $request->stock_user_id === $request->watch_user_id ){
            return 0;
        }

		if( $request->is_stock == 1 )
		{
			Stock::where( 'user_id' , $request->watch_user_id )
				->where( 'stock_id' , $request->article_id )
				->delete();
				return 2;
		}else{
	        $insert_new_like = new \App\Stock();
	        $insert_new_like->stocked_author_id = $request->stock_user_id;
	        $insert_new_like->user_id = $request->watch_user_id;
	        $insert_new_like->stock_id = $request->article_id;
	        $insert_new_like->save();
	        return 1;
	    }
	}

	/**
	 * editorページでのajax画像アップロード処理を担当
	 *
	 *
	 *
	 */
	public function image_upload_ajax( Request $request )
	{

	// バリデーション
	$request->validate([
		'ajax_image_data' => 'mimes:jpeg,png,gif|file|image|max:1500',
	]);

	/**
	 * 認証されたユーザーの情報
	 *
	 * @var object
	 *
	 */
	$user = \Auth::user();

	/**
	 * アップロードされた画像を取得
	 *
	 * @var ? ( file )
	 *
	 */
	$ajax_image_data = $request->file('ajax_image_data');

	/**
	 * 画像のMIMEタイプを取得
	 *
	 * @var string
	 *
	 */
	$upload_file_mimetype = $ajax_image_data->getMimeType();
	// return $upload_file_mimetype;
	// exit;

	/**
	 * フォームからアップロードされた画像の縦幅と横幅を取得（変数２つ）
	 *
	 * @var int
	 *
	 */
	list( $image_w , $image_h ) = getimagesize( $ajax_image_data );

	/**
	 * フォームからアップロードされた画像の縦横比を取得
	 *
	 * @var int
	 *
	 */
	$upload_image_proportion = $image_w / $image_h;

	// return $upload_image_proportion;
	// exit;

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
	  * ランダムな文字列の変数
	  *
	  * @var string
	  *
	  */
	 $random_str_image_name = makeRandStr();

	 function upload_image( $mode , $image_w , $image_h , $random_str_image_name , $upload_image_proportion , $upload_file_mimetype , $ajax_image_data , $user )
	 {
		// global $image_w , $image_h , $random_str_image_name , $upload_image_proportion , $upload_file_mimetype , $ajax_image_data , $user;

		/**
		* モードに応じた画像の幅
		*
		* @var int
		*
		*/
		$width = 100;

		/**
		* ファイルの幅に応じて画像名を変えるための変数
		*
		* @var string
		*
		*/
		$file_size_name = "a";
		if($mode == 1)
		{
			$width = 640;
			$file_size_name = "s";
		}else if($mode == 2)
		{
			$width = 1280;
			$file_size_name = "m";
		}else if($mode == 3)
		{
			$width = 1920;
			$file_size_name = "l";
		}else if($mode == 0)
		{
			$width = $image_w;
			$file_size_name = "d";
		}

		/**
		* 元画像比率からの画像の高さ
		*
		* @var int
		*
		*/
		$height = floor( $width / $upload_image_proportion );



		/**
		* 幅と高さを持つ画像を生成
		*
		* @var ?
		*
		*/
		$resized_thumb_image = imagecreatetruecolor( $width,$height );
		imagefill($resized_thumb_image , 0 , 0 , 0xFFFFFF);

		// return $upload_file_mimetype;
		// exit;

		if( $upload_file_mimetype == 'image/jpeg' )
		{
			$upload_image_data = imagecreatefromjpeg( $ajax_image_data );
		}elseif( $upload_file_mimetype == 'image/png' ){
			$upload_image_data = imagecreatefrompng( $ajax_image_data );
		}else{
			exit;
		}


		imagecopyresampled(
			 $resized_thumb_image,
			 $upload_image_data,
			 0,
			 0,
			 0,
			 0,
			 $width,
			 $height,
			 $image_w,
			 $image_h
		);

		$random_str_image_name .= '_' . $file_size_name;
		$random_str_image_name .= '.jpg';
		imagejpeg($resized_thumb_image,           // 背景画像
			storage_path('app/public/images/' . $random_str_image_name),
			70
		);

		return $random_str_image_name;

		// MIMEタイプごとに画像を出力する
		// if( $upload_file_mimetype === 'image/jpeg' )
		// {
		// 	$random_str_image_name .= '_' . $file_size_name;
		// 	$random_str_image_name .= '.jpg';
		// 	imagejpeg($resized_thumb_image,           // 背景画像
		// 		storage_path('app/public/images/' . $random_str_image_name),
		// 		70
		// 	);
		// }elseif( $upload_file_mimetype === 'image/png' ){
		// 	$random_str_image_name .= '_' . $file_size_name;
		// 	$random_str_image_name .= '.png';
		// 	imagepng($resized_thumb_image,           // 背景画像
		// 		storage_path('app/public/images/' .  $random_str_image_name)
		// 	);
		// }


	}// end of function

	if($image_w >= 640)
	{
		upload_image(1 , $image_w , $image_h ,$random_str_image_name , $upload_image_proportion , $upload_file_mimetype , $ajax_image_data , $user );
	}

	if($image_w >= 1280)
	{
		upload_image(2 , $image_w , $image_h ,$random_str_image_name , $upload_image_proportion , $upload_file_mimetype , $ajax_image_data , $user );
	}

	if($image_w >= 1920)
	{
		upload_image(3 , $image_w , $image_h ,$random_str_image_name , $upload_image_proportion , $upload_file_mimetype , $ajax_image_data , $user );
	}


	$random_str_image_name = upload_image(0 , $image_w , $image_h ,$random_str_image_name , $upload_image_proportion , $upload_file_mimetype , $ajax_image_data , $user );


	 return $random_str_image_name;


	}

}
