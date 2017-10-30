<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class suggestorController extends Controller
{
    private $apiPath = '/service/suggestor';
    public function searchKeyword($keyword)
    {
        $client = new Client([
            'base_uri' => config('app.apiUrl'),
        ]);
        try{
            $res = $client->get("{$this->apiPath}/keyword/{$keyword}",[
                'headers' => config('app.headers')
            ]);
            echo $res->getBody();
        }catch(GuzzleException $e){
            $host = $e->getRequest()->getUri();
            $response = null;
            if ($e->hasResponse()) {
                $response = $e->getResponse()->getBody();
            }
            return view('error',["host"=>$host,"response"=>$response]);
        }
    }

    public function searchLocation($location)
    {
        $client = new Client([
            'base_uri' => config('app.apiUrl'),
        ]);
        try{
            $res = $client->get("{$this->apiPath}/location/{$location}",[
                'headers' => config('app.headers')
            ]);
            echo $res->getBody();
        }catch(GuzzleException $e){
            $host = $e->getRequest()->getUri();
            $response = null;
            if ($e->hasResponse()) {
                $response = $e->getResponse()->getBody();
            }
            return view('error',["host"=>$host,"response"=>$response]);
        }
    }
}
