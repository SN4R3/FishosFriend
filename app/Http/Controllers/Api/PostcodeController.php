<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class PostcodeController extends Controller {
  
  public function searchPostcode(Request $request) {
    if(strlen($request->postcode) === 4 && ctype_digit($request->postcode)) {
      $client = new Client();

      $promise = $client->getAsync('http://v0.postcodeapi.com.au/suburbs/'.$request->postcode.'.json');

      $response = $promise->wait();
      return json_decode($response->getBody()->getContents());
    }
    return [];
  }
}
