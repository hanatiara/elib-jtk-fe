<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class JadwalController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Upload Jadwal',
        ];

        return view('/manage-jadwal/v_kelola-jadwal',$data);
    }

    public function uploadJadwal(Request $request) {
        $this->validate($request, [
            'file' => 'required|mimes:pdf'
        ]);
        $file = $request->file('file');
        $ext = $file->extension();
        $name = 'jadwal'.$ext;
        $name = str_replace(' ', '_', $name);

        $file->move('pdf',$name);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/jadwal/get/");

        if(json_decode($response->getBody())->data == []) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->post(env('BACKEND_URL')."/api/jadwal/create",[
                'nama_file' => $name,
                'keterangan' => "keterangan",
                'url' => '/'.$name
            ]);
            // dd(json_decode($response->getbody()));
        }
        else {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->put(env('BACKEND_URL')."/api/jadwal/update/1",[
                'id' => 1,
                'nama_file' => $name,
                'keterangan' => "Keterangan",
                'url' => '/'.$name
            ]);

        }

        $result = json_decode($response->getBody());

        return redirect('/')->with([
            'success' => $result->success,
            'message' => $result->message,
        ]);

    }

    public function viewInfo() {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->GET(env('BACKEND_URL')."/api/jadwal/get/1");
        $result = json_decode($response->getBody());

        $id_user = session('user')['user']->id;

        $responsePembimbing = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->GET(env('BACKEND_URL')."/api/user/getDataPembimbing/".$id_user);
        $resultPembimbing = json_decode($responsePembimbing->body());

        $responsePenguji = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->GET(env('BACKEND_URL')."/api/user/getDataPenguji/".$id_user);
        $resultPenguji = json_decode($responsePenguji->body());

        $responseDosen = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->GET(env('BACKEND_URL')."/api/user/get-pembimbing-penguji/".$id_user);
        $resultDosen = json_decode($responseDosen->body());

        if(isset($result->data)){
            $data = [
                'listJadwal' => $result->data,
            ];
        }

        // dd($resultPembimbing->data);

        $data = [
            'title' => 'Information Board',
            'listJadwal' => $result->data,
            'listPembimbing' => $resultPembimbing->data,
            'listPenguji' => $resultPenguji->data,
            'listKotaPembimbing' => $resultDosen->data->pembimbing,
            'listKotaPenguji' => $resultDosen->data->penguji
        ];

        return view('v_info-board',$data);
    }

}
