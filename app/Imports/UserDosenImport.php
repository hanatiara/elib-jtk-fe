<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserDosenImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collections)
    {

        foreach ($collections as $collection) {
            // create user dosen

            // dd($collection);
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('user.token')
            ])->POST(env('BACKEND_URL')."/api/user/import-user-dosen", [
                'username' => $collection['username'],
                'password' => $collection['password'],
                'role' => 'dosen',
                'nama_dosen' => $collection['nama_dosen'],
                'nip'        => $collection['nip'],
            ]);


            // dd(json_decode($response->getBody()));

        }


    }
}
