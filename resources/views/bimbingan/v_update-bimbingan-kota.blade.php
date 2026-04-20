@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/bimbingan">Bimbingan</a></li>
    <li class="breadcrumb-item active">Edit Bimbingan</li>
@endsection
@section('content')
<div class="container">
    <!-- @if(!isset($listKota))
    <form action="{{ route('kota.create') }}" method="POST" id="form">
    @else
    <form action="{{ route('kota.update', ['idKota' => $listKota->id]) }}" method="POST" id="form">
    @endif
    {{ csrf_field() }} -->
    <form action="{{ route('bimbingan.update.kota', ['idBimbingan' => $bimbingan->id_bimbingan]) }}" id="form" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col-2">Tanggal bimbingan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="date" name="tanggal_bimbingan" value="{{ isset($bimbingan) ? $bimbingan->tanggal_bimbingan : old('tanggal_bimbingan') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Topik bimbingan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="topik_bimbingan" value="{{ isset($bimbingan) ? $bimbingan->topik_bimbingan : old('topik_bimbingan') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Dosen pembimbing</div>
        <div class="col">
            <div class="search_select_box input-group-sm mb-3">
                <div class="input-group input-group-sm mb-3">
                    <input type="text" name="pembimbing" value="{{ isset($bimbingan) ? $bimbingan->nama_dosen : old('nama_dosen') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Status Bimbingan</div>
        <div class="col">
            <div class="search_select_box input-group-sm mb-3">
                <div class="input-group input-group-sm mb-3">
                    {{ ucwords($bimbingan->status) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Catatan Hasil Bimbingan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="catatan" value="{{ isset($bimbingan) ? $bimbingan->catatan : old('catatan') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Lampiran</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <input type="file" name="file">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Komentar Dosen pembimbing</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3 ">
                <textarea class="form-control" name="komentar" id="exampleFormControlTextarea1" rows="3" disabled>{{ isset($bimbingan) ? $bimbingan->komentar : old('komentar') }}</textarea>
            </div>
        </div>
    </div>
    @if($bimbingan->status == 'disetujui')
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <button class="btn btn-primary mb-4" onclick="this.disabled=true;document.getElementById('form').submit()" role="button" disabled>Simpan</button>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <button class="btn btn-primary mb-4" onclick="this.disabled=true;document.getElementById('form').submit()" role="button">Simpan</button>
            </div>
        </div>
    @endif
   </form>
</div>
@endsection
