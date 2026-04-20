<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Imports\UserDosenImport;
use App\Imports\UserKotaImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index() {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/user/get-role/dosen");
        $result = json_decode($response->body());

        // dd($result);

        $responseKota = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/user/get-role/kota");
        $resultKota = json_decode($responseKota->body());

        $data = [
            'title' => 'Manage Akun',
            'listUser' => $result->data,
            'listKota' => $resultKota->data,
        ];

        return view('/manage-user/manage-akun/v_manage-akun',$data);
    }

    public function viewImportDosen() {
        $data = [
            'title' => 'Import Akun Dosen',
        ];
        return view('/manage-user/manage-akun/v_import-akun-dosen',$data);
    }

    public function importAkunDosen(Request $request) {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

        $file = $request->file('file');
        // dd($file->getMimeType());
        $name = $file->getClientOriginalName();
        $file->move('excel',$name);
        $data = Excel::import(new UserDosenImport, public_path('/excel/'.$name));


        return redirect('/manage-akun');
    }

    public function viewImportKota() {
        $data = [
            'title' => 'Import Akun KoTA',
        ];
        return view('/manage-user/manage-akun/v_import-akun-kota',$data);
    }

    public function importAkunKota(Request $request) {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move('excel',$name);
        $data = Excel::import(new UserKotaImport, public_path('/excel/'.$name));


        return redirect('/manage-akun');
    }

    public function downloadTemplate($id) {
        $path = public_path('excel/'.$id.'.xlsx');
    	$ext = ['Content-Type: application/vnd.ms-excel'];
    	$fileName = $id.'.xlsx';

        // dd($ext);

    	return response()->download($path, $fileName, $ext);
    }

    public function menuDataUser() {
        $data = [
            'title' => 'Manage Data User',
        ];
        return view('/manage-user/v_manage-data-user',$data);
    }

    public function viewUbahPassword() {
        $username = session('user')['user']->username;

        $data = [
            'title' => 'Ubah Password',
            'user' => $username
        ];
        return view('/manage-user/manage-akun/v_ubah-password',$data);
    }

    public function ubahPassword(Request $request) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->PUT(env('BACKEND_URL')."/api/user/update-user/".session('user')['user']->username, [
            'id' => session('user')['user']->id,
            'username' => session('user')['user']->username,
            'password' => $request->old_password,
            'new_password' => $request->new_password
        ]);
        $result = json_decode($response->body());

        // dd($result);

        return redirect('/ubah-password')->with([
            'success' => $result->success,
            'message' => $result->message
        ]);
    }

    public function formUpdateUserDosen($id) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->get(env('BACKEND_URL')."/api/user/get/".$id);
        $result = json_decode($response->body());

        $data = [
            'title' => 'Edit Akun',
            'listUser' => $result->data
        ];
        return view('/manage-user/manage-akun/v_edit-data-akun',$data);
    }

    public function updateUserDosen($id, Request $request) {
        // dd($request);

        if(isset($request->status)){
            // Delete koord
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => config('Constants.token') . session('user.token')
            ])->delete(env('BACKEND_URL')."/api/user/delete-koor/".$id);

            if($request->status == 'ya'){
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Authorization' => config('Constants.token') . session('user.token')
                ])->PUT(env('BACKEND_URL')."/api/user/update-koor/".$id, [
                    'id' => $id,
                    'prodi' => $request->prodi,
                ]);
            }
        }


        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => config('Constants.token') . session('user.token')
        ])->PUT(env('BACKEND_URL')."/api/user/update/".$id, [
            'id' => $id,
            'username' => $request->username,
        ]);
        $result = json_decode($response->body());

        // dd($result);

        return redirect('/manage-akun')->with([
            'success' => $result->success,
            'message' => $result->message
        ]);
    }

}
