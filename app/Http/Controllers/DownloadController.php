<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function view_multi_down(){


		$downloads=DB::table('download_info')->get();
        return view('multi_file',compact('downloads'));

    }
}











//        public function view_multi_down(){
// $downloads=DB::table('download_info')->get();
//            $downloads=DB::table('downloadpdf')->get();
//        var_dump($downloads);
//            return view('download.multi_file',compact('downloads'));

//        $pathToFile = public_path('/download/');
//        string(39) "D:\wamp64\www\lara5.8\public\/download/"
//        var_dump($pathToFile);