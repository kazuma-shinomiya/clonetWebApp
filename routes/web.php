<?php


//みんなのコーディネートを表示
Route::get('/', 'ArticleController@index')->name('show_article');
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});
//みんなのコーディネートの検索
Route::post('/article/search','ArticleController@search')->name('search_article');

//タグ別に表示させる
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');




Route::group(['middleware' => 'auth'], function() {
    //服一覧を表示
    Route::get('/cloth/index','ClothController@index')->name('show_cloth');
    //服のカテゴリで絞り込み
    Route::post('/cloth/search','ClothController@search')->name('search_cloth');
    //服を追加
    Route::post('/cloth/add','ClothController@store')->name('add_cloth');
    //服の編集
    Route::post('/cloth/edit','ClothController@update')->name('edit_cloth');
    //服の削除
    Route::post('/cloth/delete/{id}','ClothController@destroy')->name('delete_cloth');

    //コーディネート一覧の表示
    Route::get('/coordination/index','CoordinationController@index')->name('show_coordination');
    //コーディネートをタグで絞り込み
    Route::get('/coordination/tag/{name}','CoordinationController@searchTag')->name('tag_coordination');
    //コーディネートの検索
    Route::post('/coordination/search','CoordinationController@search')->name('search_coordination');
    //コーディネートの追加
    Route::post('/coordination/add','CoordinationController@store')->name('add_coordination');
    //コーディネートの編集
    Route::post('/coordination/edit','CoordinationController@update')->name('edit_coordination');
    //コーディネートの削除
    Route::post('/coordination/delete/{id}','CoordinationController@destroy')->name('delete_coordination');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
