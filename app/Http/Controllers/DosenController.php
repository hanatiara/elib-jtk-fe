<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DosenController extends Controller
{
    public function index() {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/dosen/get");
        $result = json_decode($response->body());

        $data = [
            'title' => 'Manage Dosen',
            'listDosen' => $result->data,
        ];

        return view('/manage-user/manage-dosen/v_manage-data-dosen', $data);
    }

    public function formUpdateDosen($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/dosen/get/".$id);
        $result = json_decode($response->body());

        $data = [
            'title' => 'Update Data Dosen',
            'listDosen' => $result->data[0],
        ];

        return view('/manage-user/manage-dosen/v_edit-data-dosen', $data);
    }

    public function updateDosen($id, Request $request) {
        $responseDosen = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->PUT(env('BACKEND_URL')."/api/dosen/update/".$id, [
            'id' => $id,
            'id_user' => $request->id_user,
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'inisial_dosen' => $request->inisial_dosen,
        ]);
        $resultDosen = json_decode($responseDosen->body());

        return redirect('/manage-data-dosen')->with([
            'success' => $resultDosen->success,
            'message' => $resultDosen->message
        ]);
    }
}
