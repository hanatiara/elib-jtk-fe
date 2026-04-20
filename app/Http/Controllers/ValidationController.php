<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public static function autofillKota($request) {
        if ((!isset($request->nama_mahasiswa1))) return $request->nama_mahasiswa1 = "-";
        if ((!isset($request->nama_mahasiswa2))) return $request->nama_mahasiswa2 = "-";
        if ((!isset($request->nama_mahasiswa3))) return $request->nama_mahasiswa3 = "-";
        if ((!isset($request->nim1))) return $request->nim1 = "-";
        if ((!isset($request->nim2))) return $request->nim2 = "-";
        if ((!isset($request->nim3))) return $request->nim3 = "-";
        if ((!isset($request->prodi))) return $request->prodi = "-";
        if ((!isset($request->judul_ta))) return $request->judul_ta = "-";
        if ((!isset($request->pembimbing1))) return $request->pembimbing1 = "-";
        if ((!isset($request->pembimbing2))) return $request->pembimbing2 = "-";
        if ((!isset($request->pembimbing3))) return $request->pembimbing3 = "-";
        if ((!isset($request->penguji1))) return $request->penguji1 = "-";
        if ((!isset($request->penguji2))) return $request->penguji2 = "-";
        if ((!isset($request->penguji3))) return $request->penguji3 = "-";
    }




}
