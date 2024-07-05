<?php

namespace App\Http\Controllers;

use App\Models\Webiot;
use Carbon\Carbon;

class WebiotController extends Controller
{
    public function index()
    {
        $rfid = Webiot::all();
        return view('rfid');
    }

    public function update($rfid_tag)
    {
        // $rfid = Webiot::find(1);
        // $rfid->rfid_tag = $rfid_tag;
        // $rfid->save;
        $data = Webiot::where('id', 1)->update([
            "rfid_tag" => $rfid_tag,
        ]);
    }

    public function updateTag($rfid_tag, $nama, $status)
    {
        $date = Carbon::now('Asia/Jakarta');
        $data = Webiot::where('id', 1)->update([
            "rfid_tag" => $rfid_tag,
            "nama" => $nama,
            "status" => $status,
            "updated_at" => $date->toDateTimeString()
        ]);
    }

    public function tambahTag($rfid_tag, $nama, $status)
    {
        $date = Carbon::now('Asia/Jakarta');
        $data = new Webiot();
        $data->rfid_tag = $rfid_tag;
        $data->nama = $nama;
        $data->status = $status;
        $data->created_at = $date->toDateTimeString();
        $data->updated_at = $date->toDateTimeString();
        $data->save();
    }

    public function checkUser()
    {
        $data = Webiot::find(1);
        // $user = User::where('rfid', $lastTag->rfid_tag)->first();
        return response()->json(["data" => $data]);
    }

    public function checkRfid()
    {
        $data = Webiot::orderBy('created_at', 'desc')->first();
        return response()->json(["data" => $data]);
    }

    public function checkTable()
    {
        $rfid = Webiot::all();
        return response()->json(["rfid" => $rfid]);
    }
}
