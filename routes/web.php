<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Auth page
 *
 * @see php artisan route:list
 * @see https://qiita.com/zaburo/items/9fcf0f4c771e011a4d35
 *
 */
// 認証用
Auth::routes();

/*
 * HomeController
 */
// インデックスページ用
Route::get('/' , 'HomeController@root' );
// Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');

/*
 * PaperController
 */
// 新しい記事用
Route::get('/editor/new' , 'PaperController@edit_new')->middleware('auth');
// すでにある記事の編集用
Route::get('/editor/{id}' , 'PaperController@edit_update')->middleware('auth')->where('id' , '[0-9]+');
// 記事を見る用
Route::get('/articles/{id}' , 'PaperController@articles')->where('id' , '[0-9]+');
// 記事の投稿用 ( dbに登録 )
Route::post('/submit_article' , 'PaperController@submit_article')->middleware('auth');
// 記事の更新用 ( dbに登録 )
Route::post('/update_article/{id}' , 'PaperController@update_article')->middleware('auth')->where('id' , '[0-9]+');
// 検索する
Route::get('/search' , 'PaperController@search');
// タグ検索する
Route::get('/tag' , 'PaperController@tag');

/*
 * MypageController
 */
// マイページ
Route::get('/mypage' , 'MypageController@mypage')->middleware('auth');
// フォローしてる人の表示用
Route::get('/follow' , 'MypageController@follow')->middleware('auth');
// フォローされてる人の表示用
Route::get('/follower' , 'MypageController@follower')->middleware('auth');
// 設定画面
Route::get('/mypage/config/main' , 'MypageController@config')->middleware('auth');
// 設定を反映する処理
Route::post('/mypage/config/change' , 'MypageController@config_change')->middleware('auth');
// メールアドレスの設定を変更するページ
Route::get('/mypage/config/email' ,
'MypageController@config_email')->middleware('auth');
// メールアドレスの設定を反映する処理
Route::post('/mypage/config/change_email' , 'MypageController@config_change_email')->middleware('auth');
// パスワードの設定を変更するページ
Route::get('/mypage/config/password' , 'MypageController@config_password')->middleware('auth');
// パスワードの設定を反映する処理
Route::post('/mypage/config/change_password' , 'MypageController@config_change_password')->middleware('auth');
// 設定を変更した後に表示されるページ
Route::get('/mypage/config/finish' , 'MypageController@config_finish')->middleware('auth');

/*
 * UserController
 */
// ユーザーページ用
Route::get('/user/{id}' , 'UserController@user_page')->where('id' , '[0-9]+');

/*
 * AjaxController
 */
// フォロー処理 ( ajax , db )
Route::post('/follow_ajax' , 'AjaxController@follow_ajax')->middleware('auth');
// like処理 ( ajax , db )
Route::post('/like_ajax' , 'AjaxController@like_ajax')->middleware('auth');
// stock処理 ( ajax , db )
Route::post('/stock_ajax' , 'AjaxController@stock_ajax')->middleware('auth');
// ajaxでの画像アップロード処理
Route::post('/image_upload_ajax' , 'AjaxController@image_upload_ajax')->middleware('auth');


/*
 * その他のページ
 */
 // aboutページ
 Route::get('/about' , 'OtherController@about');
 // eventページ
 Route::get('/event' , 'OtherController@event');
