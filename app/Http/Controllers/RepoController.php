<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RepoController extends Controller
{
    public function viewRepo() {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/repo/get-repo");
        $result = json_decode($response->body());

        $data = [
            'title' => 'Cari Dokumen',
            'listRepo' => $result->data
        ];
        return view('/repositori/v_cari-dokumen', $data);
    }

    public function viewDetailTA($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/repo/get-repo/".$id);
        $result = json_decode($response->body());

        $data = [
            'title' => 'Detail Dokumen',
            'listBerkas' => $result->data
        ];
        return view('/repositori/v_detail-dokumen_ta', $data);
    }

    public function downloadRepo($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/repo/get-repo/".$id);
        $result = json_decode($response->body());

        // dd($result->data->url_berkas);

        $path = public_path($result->data->url_berkas);

    	$ext = ['Content-Type: application/pdf,application/x-rar',];

    	$fileName = $result->data->nama_berkas;

        // dd($fileName);

    	return response()->download($path, $fileName, $ext);
    }
}
