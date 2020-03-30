<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Technicians;
use App\Models\Reports;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->permission_id == 1) {

            return view('pages.dashboard-admin');
        }

        $items = $this->load_xml();

        return view('pages.dashboard', ['items' => $items]);
    }

    public function load_xml()
    {
        $items = [];
        $url = "http://alertux.com/blog/?feed=rss2";
        $xml = simplexml_load_file($url);
        $channel = $xml->channel->children();
        foreach ($channel as $item){
            $tag = $item->getName();
            if ($tag == "item") {
                $item_data = [];
                foreach ($item->children() as $k){
                    $tag = $k->getName();
                    $tag_value = $item->$tag;
                    if ($tag == "title") {
                        $item_data['title'] = $tag_value[0];
                    }
                    if ($tag == "link") {
                        $item_data['link'] = $tag_value[0];
                    }
                    if ($tag == "pubDate") {
                        $item_data['pubDate'] = $tag_value[0];
                    }
                    if ($tag == "description") {
                        $item_data['description'] = $tag_value[0];
                    }
                }
                $content = $item->children('content', true)->encoded;
                preg_match('/<*img[^>]*src *= *["\']?([^"\']*)/i', $content, $matches);
                if (count($matches) > 0) {
                    $item_data['img'] = $matches;
                }

                $items[] = $item_data;
            }
        }

        return $items;
    }

    public function get_content($content){
        $data = [];
        foreach ($content as $k){
            $tag = $k->getName();
            $tag_value = $content->$tag;
            if ($tag == "title") {
                $data['title'] = $tag_value[0];
            }
            if ($tag == "link") {
                $data['link'] = $tag_value[0];
            }
            if ($tag == "pubDate") {
                echo $tag .' '.$tag_value[0].'<br />';
                $data['pubDate'] = $tag_value[0];
            }
            if ($tag == "description") {
                $data['description'] = $tag_value[0];
            }
            if ($tag == "content: encoded") {
                echo $tag .' '.$tag_value[0].'<br />';
                $data['content'] = $tag_value[0];
            }
        }
        return $data;
    }

    public function all_tag($xml){
        $i=0; $name = "";
        foreach ($xml as $k){
            $tag = $k->getName();
            $tag_value = $xml->$tag;
            if ($name == $tag){ $i++;    }
            $name = $tag;
            echo $tag .' '.$tag_value[$i].'<br />';
            // recursive
            $this->all_tag($xml->$tag->children());
        }
    }

}
