@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Cari Dokumen Tugas Akhir</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-2">Tahun</div>:
        <div class="col">{{ $listBerkas->tahun_ajaran }}</div>
    </div>
    <div class="row">
        <div class="col-2">Judul</div>:
        <div class="col">{{ $listBerkas->judul_ta }}</div>
    </div>
    <div class="row">
        <div class="col-2">Kelompok</div>:
        <div class="col">{{ $listBerkas->nama_kota }}</div>
    </div>
    <div class="row">
        <div class="col-2">Penulis</div>:
        <div class="col">
            {{ $listBerkas->nama_mahasiswa1 }}<br>
            {{ $listBerkas->nama_mahasiswa2 }}<br>
            {{ $listBerkas->nama_mahasiswa3 }}
        </div>
    </div>
    <div class="row">
        <div class="col-2">File</div>:
            <div class="col">
                <a href="{{ route('download.repo', ['idBerkas' => $listBerkas->id]) }}" class="link-info"> Laporan TA</a>
            </div>
        </div>
    </div><br><br><br>
    {{-- <div class="row">
        <div class="col-2">Abstraksi</div>:
        <div class="col">Aplikasi berbasis web ini merupakan aplikasi untuk membantu mahasiswa sekaligus dosen untuk memanajemen berkas-berkas yang dibutuhkan selama pengerjaan proyek tugas akhir sebagai syarat kelengkapan  untuk kelulusan</div>
    </div> --}}
@endsection
