<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TrashDataController extends Controller
{
    public function index()
    {
        $url = "https://api.thingspeak.com/channels/2811012/feeds.json?results=2";

        $response = Http::get($url);

        if($response->successful()){
            $data = $response->json();
            return $data;
        }else{
            return ['error' => 'gagal ambil data'];
        }
    }

    public function show()
    {
        $url = "https://api.thingspeak.com/channels/2811012/feeds.json?results=2";
        $response = Http::get($url);

        
    }
}
