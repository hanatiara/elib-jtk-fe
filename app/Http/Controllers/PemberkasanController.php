<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PemberkasanController extends Controller
{
    public function viewPemberkasanKota($seminar_type) {
        $id = session('user')['user']->id;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/berkas/get-kota/".$id."/".$seminar_type);
        $result = json_decode($response->body());

        // dd($result);

        $data = [
            'title' => 'Lihat Berkas',
            'listBerkas' => $result->data,
            'jenis_seminar' => $seminar_type
        ];
        return view('/pemberkasan/v_cek-berkas-kota', $data);
    }

    public function viewPemberkasanKoor($seminar_type) {
        $id = session('user')['user']->id;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/koordinator/get-prodi/".$id);
        $result = json_decode($response->body());

        $prodi = $result->data->prodi;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/berkas/get-prodi/".$prodi."/".$seminar_type);
        $result = json_decode($response->body());

        // dd($result);

        $data = [
            'title' => 'Lihat Berkas',
            'listBerkas' => $result->data
        ];
        return view('/pemberkasan/v_cek-berkas-koor', $data);
    }

    public function viewPengumpulan($seminar_type) {
        $data = [
            'title' => 'Lihat Berkas',
            'jenis_seminar' => $seminar_type
        ];
        return view('/pemberkasan/v_pengumpulan-berkas', $data);
    }

    public function uploadPengumpulan($seminar_type, Request $request) {
        $this->validate($request, [
            'proposal-laporan' => 'required|file|mimes:pdf,docx,doc,zip,rar',
            'artefak' => 'required|file|mimes:pdf,docx,doc,zip,rar',
            'fta' => 'required|file|mimes:pdf,docx,doc,zip,rar'
		]);

        $id_user = session('user')['user']->id;
        $date = date("Y-m-d");

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/kota/get-logged-id");
        $data_kota = json_decode($response->body());

        //Proposal

        $responseProposal = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/berkas/check-berkas/".$id_user."/".$seminar_type."/proposal-laporan");
        $resultProposal = json_decode($responseProposal->body());

        $file = $request->file('proposal-laporan');
        $name = 'proposal_laporan';
        $ext = $file->extension();
        $name = $seminar_type.'_'.$data_kota->data->nama_kota.'_'.$date.'_'.$name.'.'.$ext;

        $file->move('dokumen/pemberkasan/'.$seminar_type, $name);


        if(!($resultProposal->success)) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->post(env('BACKEND_URL')."/api/berkas/create",[
                'id_kota' => $data_kota->data->id,
                'tgl_pengumpulan' => $date,
                'jenis_berkas' => 'proposal-laporan',
                'jenis_seminar'=> $seminar_type,
                'status' => 'terkumpul',
                'url_berkas' => 'dokumen/pemberkasan/'.$seminar_type.'/'.$name,
                'nama_berkas' => $name
            ]);
            // dd(json_decode($response->body()));
        }
        else {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->put(env('BACKEND_URL')."/api/berkas/update/".$resultProposal->id,[
                'id' => $resultProposal->id,
                'tgl_pengumpulan' => $date,
                'url_berkas' => 'dokumen/pemberkasan/'.$seminar_type.'/'.$name,
                'nama_berkas' => $name
            ]);
            // dd(json_decode($response->body()));
        }

        // Artefak

        $responseArtefak = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/berkas/check-berkas/".$id_user."/".$seminar_type."/artefak");
        $resultArtefak = json_decode($responseArtefak->body());

        $file = $request->file('artefak');
        $name = 'artefak';
        $ext = $file->extension();
        $name = $seminar_type.'_'.$data_kota->data->nama_kota.'_'.$date.'_'.$name.'.'.$ext;

        $file->move('dokumen/pemberkasan/'.$seminar_type, $name);


        if(!($resultProposal->success)) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->post(env('BACKEND_URL')."/api/berkas/create",[
                'id_kota' => $data_kota->data->id,
                'tgl_pengumpulan' => $date,
                'jenis_berkas' => 'artefak',
                'jenis_seminar'=> $seminar_type,
                'status' => 'terkumpul',
                'url_berkas' => 'dokumen/pemberkasan/'.$seminar_type.'/'.$name,
                'nama_berkas' => $name
            ]);
            // dd(json_decode($response->body()));
        }
        else {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->put(env('BACKEND_URL')."/api/berkas/update/".$resultProposal->id,[
                'id' => $resultProposal->id,
                'tgl_pengumpulan' => $date,
                'url_berkas' => 'dokumen/pemberkasan/'.$seminar_type.'/'.$name,
                'nama_berkas' => $name
            ]);
            // dd(json_decode($response->body()));
        }

        // FTA

        $responseFTA = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/berkas/check-berkas/".$id_user."/".$seminar_type."/fta");
        $resultFTA = json_decode($responseFTA->body());

        $file = $request->file('fta');
        $name = 'fta';
        $ext = $file->extension();
        $name = $seminar_type.'_'.$data_kota->data->nama_kota.'_'.$date.'_'.$name.'.'.$ext;

        $file->move('dokumen/pemberkasan/'.$seminar_type, $name);


        if(!($resultProposal->success)) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->post(env('BACKEND_URL')."/api/berkas/create",[
                'id_kota' => $data_kota->data->id,
                'tgl_pengumpulan' => $date,
                'jenis_berkas' => 'fta',
                'jenis_seminar'=> $seminar_type,
                'status' => 'terkumpul',
                'url_berkas' => 'dokumen/pemberkasan/'.$seminar_type.'/'.$name,
                'nama_berkas' => $name
            ]);
            // dd(json_decode($response->body()));
        }
        else {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->put(env('BACKEND_URL')."/api/berkas/update/".$resultProposal->id,[
                'id' => $resultProposal->id,
                'tgl_pengumpulan' => $date,
                'url_berkas' => 'dokumen/pemberkasan/'.$seminar_type.'/'.$name,
                'nama_berkas' => $name
            ]);
            // dd(json_decode($response->body()));
        }
        $result = json_decode($response->body());
        // dd($result);

        return redirect('/pemberkasan-kota/'.$seminar_type)->with([
            'success' => $result->success,
            'message' => $result->message
        ]);

    }

    public function viewDetailBerkas($id) {
        $responseSeminar3 = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/berkas/get-id/".$id."/seminar-3");
        $resultSeminar3 = json_decode($responseSeminar3->body());

        // dd($resultSeminar3->data->id_kota);

        $responseSidang = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/berkas/get-id/".$id."/sidang");
        $resultSidang = json_decode($responseSidang->body());

        // dd(isset($resultSidang->data));
        // dd(isset($resultSidang->data[0]));

        $data = [
            'title' => 'Detail Berkas',
            'listSeminar3' => $resultSeminar3->data,
            'listSidang' => $resultSidang->data
        ];
        return view('/pemberkasan/v_detail-berkas-kota-penguji', $data);
    }

    public function downloadBerkasKoordinator($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/berkas/get/".$id);
        $result = json_decode($response->body());

        // dd($result);

        $path = public_path($result->data->url_berkas);

    	$ext = ['Content-Type: application/pdf,application/x-rar',];
    	$fileName = $result->data->nama_berkas;

        // dd($fileName);

    	return response()->download($path, $fileName, $ext);
    }

    public function downloadBerkas($id, $document, $seminar_type) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/berkas/get/".$id."/".$document."/".$seminar_type);
        $result = json_decode($response->body());

        // dd($document);
        // dd($result->data->nama_berkas);

        $path = public_path($result->data->url_berkas);

    	$ext = ['Content-Type: application/pdf,application/x-rar',];
    	$fileName = $result->data->nama_berkas;

        // dd($path);

    	return response()->download($path, $fileName, $ext);
    }
}
