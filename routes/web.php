<?php

use Illuminate\Http\Request;


Route::get('multi_down','DownloadController@view_multi_down');

Route::get('/postDownload',function (Request $request){

    $url=$request->urlpath;
    $pathToFile = public_path('\download\\'.$url);
    return response()->download($pathToFile);

});


















