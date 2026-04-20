<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BimbinganController extends Controller
{

    public function viewBimbinganKota() {
        $id_kota = session('user')['user']->id;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/bimbingan/get-user-kota/".$id_kota);
        $result = json_decode($response->body());
        // dd($result);
        $data = [
            'title' => 'Manage Bimbingan',
            'listBimbingan' => $result->data
        ];
        return view('/bimbingan/v_manage-bimbingan-kota', $data);
    }

    public function viewBimbinganPembimbing() {
        $id_pembimbing = session('user')['user']->id;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/bimbingan/get-pembimbing/".$id_pembimbing);
        $result = json_decode($response->body());

        $data = [
            'title' => 'Manage Bimbingan',
            'listBimbingan' => $result->data
        ];
        return view('/bimbingan/v_manage-bimbingan-pembimbing', $data);
    }

    public function viewBimbinganPerKota($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/bimbingan/get-kota/".$id);
        $result = json_decode($response->body());

        $data = [
            'title' => 'Manage Bimbingan',
            'listBimbingan' => $result->data
        ];
        return view('/bimbingan/v_manage-bimbingan-pembimbing', $data);
    }

    public function viewBimbinganKoor() {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/bimbingan/get-all/");
        $result = json_decode($response->body());

        $data = [
            'title' => 'Lihat Bimbingan',
            'listBimbingan' => $result->data
        ];
        return view('/bimbingan/v_manage-bimbingan-koor', $data);
    }

    public function acceptBimbingan(Request $request) {
        // dd($request->komentar);
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->put(env('BACKEND_URL')."/api/bimbingan/updateKomentar/".$request->id,[
            'id' => $request->id,
            'komentar' => $request->komentar,
            'status' => 'disetujui',
        ]);

        $result = json_decode($response->body());

        // dd($result);

        return redirect('/manage-bimbingan')->with([
            'success' => $result->success,
            'message' => $result->message
        ]);
    }

    public function downloadAttachment($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/bimbingan/get-bimbingan/".$id);
        $result = json_decode($response->body())->data;

        $path = public_path($result->url);
    	$ext = ['Content-Type: application/pdf'];
    	$fileName = $result->nama_file;

        // dd($path);

    	return response()->download($path, $fileName, $ext);
    }

    public function viewKomentarBimbingan($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/bimbingan/get-bimbingan/".$id);
        $result = json_decode($response->body());
        // dd($result);

        $data = [
            'title' => 'Manage Bimbingan',
            'bimbingan' => $result->data
        ];

        return view('/bimbingan/v_komentar-bimbingan', $data);
    }

    public function komentarBimbingan(Request $request) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->put(env('BACKEND_URL')."/api/bimbingan/updateKomentar/".$request->id,[
            'id' => $request->id,
            'komentar' => $request->komentar,
            'status' => 'dikomentari',
        ]);

        $result = json_decode($response->body());

        // dd($result);

        return redirect('/manage-bimbingan')->with([
            'success' => $result->success,
            'message' => $result->message
        ]);
    }

    public function viewExistingBimbingan($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/bimbingan/get-bimbingan/".$id);
        $result = json_decode($response->body());

        $id_kota = session('user')['user']->id;
        // dd($id_kota);

        $responsePembimbing = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/pembimbing/get-pembimbing/".$id_kota);
        $resultPembimbing = json_decode($responsePembimbing->body());

        $data = [
            'title' => 'Lihat Bimbingan',
            'listPembimbing' => $resultPembimbing->data,
            'bimbingan' => $result->data
        ];

        return view('/bimbingan/v_update-bimbingan-kota', $data);
    }

    public function updateExistingBimbingan($id ,Request $request) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/kota/get-logged-id/");

        $result = json_decode($response->body());

        // dd($result);

        if ($request->has('file')) {

            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $name = str_replace(' ', '_', $name);
            $name = $result->data->nama_kota.'_'.$request->tanggal_bimbingan.'_'.$name ;

            $file->move('dokumen/bimbingan',$name);

            // dd($name);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->put(env('BACKEND_URL')."/api/bimbingan/updateBimbingan/".$id,[
                'id' => $id,
                'topik_bimbingan' => $request->topik_bimbingan,
                'catatan' => $request->catatan,
                'url' => 'dokumen/bimbingan/'.$name,
                'nama_file' => $name
            ]);
            // dd(json_decode($response->getbody()));
        }

        else {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->put(env('BACKEND_URL')."/api/bimbingan/updateBimbingan/".$id,[
                'id' => $id,
                'topik_bimbingan' => $request->topik_bimbingan,
                'catatan' => $request->catatan,
            ]);
            // dd($id);
            // dd(json_decode($response->getbody()));
        }


        $result = json_decode($response->body());

        // dd($result);

        return redirect('/bimbingan')->with([
            'success' => $result->success,
            'message' => $result->message
        ]);
    }

    public function viewAjukanBimbingan(){
        $id_kota = session('user')['user']->id;
        // dd($id_kota);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/pembimbing/get-pembimbing/".$id_kota);
        $result = json_decode($response->body());

        // dd($result->data);

        $data = [
            'title' => 'Ajukan Bimbingan',
            'listPembimbing' => $result->data
        ];

        return view('/bimbingan/v_ajukan-bimbingan-kota', $data);
    }

    public function ajukanBimbingan(Request $request) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/kota/get-logged-id/");

        $result = json_decode($response->body());

        // dd($result);

        if ($request->has('file')) {

            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $name = str_replace(' ', '_', $name);
            $name = $result->data->nama_kota.'_'.$request->tanggal_bimbingan.'_'.$name ;

            $file->move('dokumen/bimbingan',$name);

            // dd($name);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->post(env('BACKEND_URL')."/api/bimbingan/create",[
                'tanggal_bimbingan' => $request->tanggal_bimbingan,
                'topik_bimbingan' => $request->topik_bimbingan,
                'catatan' => $request->catatan,
                'id_kota' => $result->data->id,
                'status' => 'diproses',
                'komentar' => '-',
                'id_pembimbing' => $request->pembimbing,
                'url' => 'dokumen/bimbingan/'.$name,
                'nama_file' => $name
            ]);
            // dd(json_decode($response->getbody()));
        }

        else {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->post(env('BACKEND_URL')."/api/bimbingan/create",[
                'tanggal_bimbingan' => $request->tanggal_bimbingan,
                'topik_bimbingan' => $request->topik_bimbingan,
                'catatan' => $request->catatan,
                'id_kota' => $result->data->id,
                'status' => 'diproses',
                'komentar' => '-',
                'id_pembimbing' => $request->pembimbing,
                'url' => '-',
                'nama_file' => '-'
            ]);

        }
        $result = json_decode($response->getbody());
        return redirect('/bimbingan')->with([
            'success' => $result->success,
            'message' => $result->message
        ]);
    }

    public function viewLaporanBimbingan() {
        $data = [
            'title' => 'Laporan Bimbingan',
        ];
        return view('/bimbingan/v_laporan-bimbingan', $data);
    }


}
