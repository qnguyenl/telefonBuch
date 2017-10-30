<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    private $apiPath = "/suche";
    public function search(Request $request){
        $request->validate([
            'keyword' => 'required'
        ]);
        $keyword = $request->input('keyword');
        $location = $request->input('location');
        $client = new Client([
            'base_uri' => config('app.apiUrl'),
        ]);
        $res = $client->get("{$this->apiPath}/{$keyword}/{$location}/{$request->input('page')}",[
            'headers' => config('app.headers')
        ]);
        $hitlist = json_decode($res->getBody())->hitlist;
        $hits = $hitlist->hits;
        $paginator = new LengthAwarePaginator([],$hitlist->totalHitCount,20);
        $paginator->setPath("/search?keyword={$keyword}&location={$location}");
        return view('welcome',['hits'=>$hits,'paginator'=>$paginator,'keyword'=>$keyword,'location'=>$location,'startToken'=>$request->fullUrl()]);
    }
}
