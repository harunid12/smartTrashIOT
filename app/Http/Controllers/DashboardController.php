<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $url = "https://api.thingspeak.com/channels/2811012/feeds.json";
        $response = Http::get($url);
        $data = $response->json(); 

        if (empty($data['feeds'])) {
            return [
                'message' => 'Belum ada data terbaru dari sensor.',
                'channel' => $data['channel']
            ];
        }

        return view('dashboard.view', ['data' => $data]);
    }

}
