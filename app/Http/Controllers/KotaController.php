<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ValidationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KotaController extends Controller
{
    public function index() {

        $responseKota = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/kota/get");
        $resultKota = json_decode($responseKota->body());

        $responsePembimbing = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/pembimbing/get-data");
        $resultPembimbing = json_decode($responsePembimbing->body());

        $responsePenguji = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/penguji/get-data");
        $resultPenguji = json_decode($responsePenguji->body());

        $data = [
            'title' => 'Manage Kota',
            'listKota' => $resultKota->data,
            'listPembimbing' => $resultPembimbing->data,
            'listPenguji' => $resultPenguji->data,
        ];

        return view('/manage-user/manage-kota/v_manage-kota',$data);
    }

    public function createKota(Request $request) {

        $validation = ValidationController::autofillKota($request);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->post(env('BACKEND_URL')."/api/kota/create", [
            'nama_kota' => $request->nama_kota,
            'prodi' => $request->prodi,
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => $request->status,
            'nama_mahasiswa1' => $request->nama_mahasiswa1,
            'nama_mahasiswa2' => $request->nama_mahasiswa2,
            'nama_mahasiswa3' => $request->nama_mahasiswa3,
            'nim1' => $request->nim1,
            'nim2' => $request->nim2,
            'nim3' => $request->nim3,
            'judul_ta' => $request->judul_ta,
        ]);

        $result = json_decode($response->getBody());

        return redirect('/manage-kota')->with([
            'success' => $result->success,
            'message' => $result->message
        ]);

    }

    public function formUpdateKota($id) {
        $responseKota = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/kota/get/".$id);
        $resultKota = json_decode($responseKota->body());

        $responseDosen = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/dosen/get");
        $resultDosen = json_decode($responseDosen->body());


        $data = [
            'title' => 'Manage Kota',
            'listKota' => $resultKota->data,
            'listDosen' => $resultDosen->data,
        ];

        return view('/manage-user/manage-kota/v_register-kota',$data);
    }

    public function updateKota($id, Request $request) {

        $validation = ValidationController::autofillKota($request);

        $responseKota = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->PUT(env('BACKEND_URL')."/api/kota/update/".$id, [
            'id' => $id,
            'nama_kota' => $request->nama_kota,
            'prodi' => $request->prodi,
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => $request->status,
            'nama_mahasiswa1' => $request->nama_mahasiswa1,
            'nama_mahasiswa2' => $request->nama_mahasiswa2,
            'nama_mahasiswa3' => $request->nama_mahasiswa3,
            'nim1' => $request->nim1,
            'nim2' => $request->nim2,
            'nim3' => $request->nim3,
            'judul_ta' => $request->judul_ta,
        ]);

        $resultKota = json_decode($responseKota->getBody());

        // dd($request->penguji1);

        // delete all existing pembimbing
        Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->delete(env('BACKEND_URL')."/api/pembimbing/delete-data/".$id);

        if(!($request->pembimbing1 == '-')){
            // Register to data_pembimbing
            $p = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->POST(env('BACKEND_URL')."/api/pembimbing/create", [
                'id_pembimbing' => $request->pembimbing1,
                'id_kota' => $id,
            ]);

            // dd(json_decode($p->body()));

        }

        if(!($request->pembimbing2 == '-')){
            // Register to data_pembimbing
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->POST(env('BACKEND_URL')."/api/pembimbing/create", [
                'id_pembimbing' => $request->pembimbing2,
                'id_kota' => $id,
            ]);

        }

        if(!($request->pembimbing3 == '-')){
            // Register to data_pembimbing
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->POST(env('BACKEND_URL')."/api/pembimbing/create", [
                'id_pembimbing' => $request->pembimbing3,
                'id_kota' => $id,
            ]);

        }

        // Delete all existing penguji
        Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->delete(env('BACKEND_URL')."/api/penguji/delete-data/".$id);

        if(!($request->penguji1 == '-')){
            // Register to data_pembimbing
            $test = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->POST(env('BACKEND_URL')."/api/penguji/create", [
                'id_penguji' => $request->penguji1,
                'id_kota' => $id,
            ]);
        }

        if(!($request->penguji2 == '-')){

            // Register to data_pembimbing
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->POST(env('BACKEND_URL')."/api/penguji/create", [
                'id_penguji' => $request->penguji2,
                'id_kota' => $id,
            ]);

        }

        if(!($request->penguji3 == '-')){

            // Register to data_pembimbing
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->POST(env('BACKEND_URL')."/api/penguji/create", [
                'id_penguji' => $request->penguji3,
                'id_kota' => $id,
            ]);

        }


        return redirect('/manage-kota')->with([
            'success' => $resultKota->success,
            'message' => $resultKota->message
        ]);

    }


    public function deleteKota($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->delete(env('BACKEND_URL')."/api/kota/".$id);
        $result = json_decode($response->body());

        return back()->with([
            'success' => $result->success,
            'message' => $result->message
        ]);

    }


}
