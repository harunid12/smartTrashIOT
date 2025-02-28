<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('l, d F Y');
        $client = new Client();
        $url = "https://api.thingspeak.com/channels/2811012/feeds.json";

        $promise = $client->getAsync($url);

        $response = $promise->wait();
        $allData = json_decode($response->getBody(), true);

        $lastData = end($allData['feeds']);

        if (empty($allData['feeds'])) {
            return [
                'message' => 'Belum ada data terbaru dari sensor.',
                'channel' => $allData['channel']
            ];
        }

        $feeds = $allData['feeds'];
        $weeklyData = [];

        foreach ($feeds as $feed) {
            if (isset($feed['field2'])) {
                $date = Carbon::parse($feed['created_at']); // Konversi tanggal
                $monthName = $date->translatedFormat('F'); // Nama bulan (Februari, Maret, dll.)
                $weekOfMonth = ceil($date->day / 7); // Hitung minggu ke berapa dalam bulan itu
                $weekLabel = "$monthName Minggu $weekOfMonth"; // Format label

                // Simpan field2 dalam array berdasarkan bulan-minggu
                $weeklyData[$weekLabel][] = floatval($feed['field2']);
            }
        }

        // Hitung rata-rata per minggu
        $weeklyAverages = [];
        foreach ($weeklyData as $weekLabel => $values) {
            $weeklyAverages[$weekLabel] = number_format(array_sum($values) / count($values), 2);
        }

        $lastData = end($allData['feeds']);

        $field2Value = isset($lastData['field2']) ? floatval($lastData['field2']) : 0;
        $percentage = ($field2Value / 80) * 100;

        $deskripsi = "Sistem Informasi Tong Sampah Pintar berbasis IoT (Internet of Things) adalah solusi berbasis teknologi yang dirancang untuk mengelola sampah secara efisien dengan memanfaatkan sensor. Sistem ini memungkinkan pemantauan kapasitas tong sampah secara real-time";

        return view('dashboard.view', [
            'data' => $allData,
            'today' => $today,
            'lastData' => $lastData,
            'percentage' => $percentage,
            'weeklyAverages' => $weeklyAverages,
            'deskripsi' => $deskripsi
        ]);
    }

}
