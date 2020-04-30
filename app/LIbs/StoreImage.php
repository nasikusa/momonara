<?php

namespace App\Libs;

class StoreImage
{
	public function echoTest()
	{
		echo "hello!";
	}

	public function uploaded_image_store()
	{
		// if(! empty($config_icon) )
		// {
        //
		// 	/**
		// 	 * アップロードされた画像のMIMEタイプを取得
		// 	 *
		// 	 * @var int
		// 	 *
		// 	 */
		// 	$upload_file_mimetype = $config_icon->getMimeType();
        //
		// 	// dd($upload_file_mimetype);
        //
		// 	/**
		// 	 * リサイズしたい画像の横幅を指定
		// 	 *
		// 	 * @var int
		// 	 *
		// 	 */
		// 	$resize_image_w = 200;
        //
		// 	/**
		// 	 * リサイズしたい画像の縦幅を指定
		// 	 *
		// 	 * @var int
		// 	 *
		// 	 */
		// 	$resize_image_h = 200;
        //
		// 	/**
		// 	 * フォームからアップロードされた画像の縦幅と横幅を取得（変数２つ）
		// 	 *
		// 	 * @var int
		// 	 *
		// 	 */
		// 	list( $image_w , $image_h ) = getimagesize( $config_icon );
        //
		// 	/**
		// 	 * フォームからアップロードされた画像の縦横比を取得
		// 	 *
		// 	 * @var int
		// 	 *
		// 	 */
		// 	$upload_image_proportion = $image_w / $image_h;
        //
		// 	/**
		// 	 * 画像のもととなるものを作成（横縦幅を決定）
		// 	 *
		// 	 * @var
		// 	 *
		// 	 */
		// 	$resized_thumb_image = imagecreatetruecolor($resize_image_w, $resize_image_h);
		// 	imagefill($resized_thumb_image , 0 , 0 , 0xFFFFFF);
        //
        //
        //
		// 	/**
		// 	 * 画像のインスタンスを作成
		// 	 *
		// 	 * @var
		// 	 *
		// 	 */
		// 	if( $upload_file_mimetype === 'image/jpeg' )
		// 	{
		// 		$icon_image = imagecreatefromjpeg( $config_icon );
		// 	}elseif( $upload_file_mimetype === 'image/png' ){
		// 		$icon_image = imagecreatefrompng( $config_icon );
		// 	}
        //
		// 	// トリミング用の処理（実際の処理は 下のimagecopyresampledで行う）
		// 	if ( $image_w >= $image_h )
		// 	{
		// 		$side = $image_h;
		// 		$x_position = floor( ($image_w - $image_h) / 2 );
		// 		$y_position = 0;
		// 		$image_w = $side;
		// 	} else {
		// 		$side = $image_w;
		// 		$y_position = floor (( $height - $width ) / 2 );
		// 		$x_position = 0;
		// 		$image_h = $side;
		// 	}
        //
		// 	imagecopyresampled(
		// 		 $resized_thumb_image,
		// 		 $icon_image,
		// 		 0,
		// 		 0,
		// 		 $x_position,
		// 		 $y_position,
		// 		 $resize_image_w,
		// 		 $resize_image_h,
		// 		 $image_w,
		// 		 $image_h
		// 	);
        //
        //
		// 	/**
		// 	 * ランダムな文字列を作成する関数
		// 	 *
		// 	 * @see https://qiita.com/TetsuTaka/items/bb020642e75458217b8a
		// 	 * @var int $length
		// 	 * @return string
		// 	 *
		// 	 */
		// 	function makeRandStr($length = 40) {
		// 		static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
		// 		$str = '';
		// 		for ($i = 0; $i < $length; ++$i) {
		// 			$str .= $chars[mt_rand(0, 61)];
		// 		}
		// 		return $str;
		// 	}
        //
		// 	/**
		// 	 * makeRandStrでランダムな文字列を作成する（ファイル名用）
		// 	 *
		// 	 * @var string
		// 	 *
		// 	 */
		// 	$random_str_image_name = makeRandStr();
        //
		// 	/**
		// 	 * アイコン画像を入れるフォルダ（ユーザーID / ランダム文字列.拡張子 )で入る
		// 	 *
		// 	 * @var string
		// 	 *
		// 	 */
		// 	$user_icon_image_folder = storage_path('app/public/icon_images/' . $user->id );
        //
		// 	// フォルダがなければ作る
		// 	if( ! file_exists( $user_icon_image_folder  ) )
		// 	{
		// 		mkdir($user_icon_image_folder, 0777);
		// 	}
        //
		// 	// MIMEタイプごとに画像を出力する
		// 	if( $upload_file_mimetype === 'image/jpeg' )
		// 	{
		// 		$random_str_image_name .= '.jpg';
		// 		imagejpeg($resized_thumb_image,           // 背景画像
		// 			storage_path('app/public/icon_images/' . $user->id . '/' . $random_str_image_name),
		// 			100
		// 		);
		// 	}elseif( $upload_file_mimetype === 'image/png' ){
		// 		$random_str_image_name .= '.png';
		// 		imagepng($resized_thumb_image,           // 背景画像
		// 			storage_path('app/public/icon_images/' . $user->id . '/' .  $random_str_image_name)
		// 		);
		// 	}
		// }
        //
		//  /**
		//   * アイコン画像のアップロード終了後の画像ファイル名
		//   *
		//   * @var string
		//   *
		//   */
		//  $uploaded_filename = $request->file('my_profileimage')->store('public/icon_images');
        //
		//  if(! empty($config_name) )
		//  {
		// 	DB::table('users')
		// 	->where( 'id' , $user->id )
		// 	->update([ 'name' => $config_name ]);
        //
		//  }
		//  if(! empty($config_intro) )
		//  {
		// 	DB::table('users')
		// 	->where( 'id' , $user->id )
		// 	->update([ 'selfintro' => $config_intro ]);
        //
		//  }
		//  if(! empty($uploaded_filename))
		//  {
		// 	 DB::table('users')
		// 	 ->where( 'id' , $user->id )
		// 	 ->update([ 'p_image_name' => $random_str_image_name ]);
        //
		//  }
	}
}
