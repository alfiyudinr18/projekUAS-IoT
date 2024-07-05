<?php

namespace App\Http\Controllers;

use App\Models\DHT11;
use Illuminate\Http\Request;

class DHT11Controller extends Controller
{
    public function getData()
    {
        $data = DHT11::find(1);
        return response()->json(["data" => $data]);
    }

    public function index()
    {
        return view('Dht11');
    }

    public function uploadData($jarak, $status)
    {
        $data = DHT11::where('id', 1)->update([
            'jarak' => $jarak,
            'status' => $status,
        ]);
    }
}
