<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;

class DetailController extends Controller
{
	private $base_uri = "https://adresse.preview.tb.it2media.de";
	private $apiPath = "/Details";
    public function show(Request $request,$id){
        $startToken = $request->input('st'); 
        try{
        	$client = new Client([
	            'base_uri' => $this->base_uri,
	        ]);
	        $res = $client->get("{$this->apiPath}/{$id}",[
	            'headers' => config('app.headers')
	        ]);
	        $resultHits = json_decode($res->getBody())->hit;
	        $displayName = $resultHits->displayName;
	        $address = "{$resultHits->address->street} {$resultHits->address->houseNo}, {$resultHits->address->postalCode} {$resultHits->address->locationName}";
	        $tel = null;
	        foreach ($resultHits->tel as $tmp) {
	        	if($tmp->type === "fon"){
	        		$tel = $tmp->value;
	        	}
	        }
        	return view('details',['startToken'=>$startToken,"displayName"=>$displayName,"address"=>$address,'tel'=>$tel]);
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
