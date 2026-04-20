<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserKotaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collections)
    {

        foreach ($collections as $collection) {
            // create user koTA

            // dd($collection);
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('user.token')
            ])->POST(env('BACKEND_URL')."/api/user/import-user-kota", [
                'username' => $collection['username'],
                'password' => $collection['password'],
                'role' => 'kota',
                'prodi' => $collection['prodi'],
                'tahun_ajaran' => $collection['tahun_ajaran'],
            ]);


            // dd(json_decode($response->getBody()));

        }


    }
}
