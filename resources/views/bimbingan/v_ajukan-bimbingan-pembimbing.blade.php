@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-bimbingan-pembimbing">Bimbingan</a></li>
    <li class="breadcrumb-item active">Ajukan Bimbingan</li>
@endsection
@section('content')
<div class="container">
    <!-- @if(!isset($listKota))
    <form action="{{ route('kota.create') }}" method="POST" id="form">
    @else
    <form action="{{ route('kota.update', ['idKota' => $listKota->id]) }}" method="POST" id="form">
    @endif
    {{ csrf_field() }} -->
    <form action="ajukan-bimbingan" id="form" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col-2">Tanggal bimbingan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="" value="" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Topik bimbingan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="" value="" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Dosen pembimbing</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="" value="" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Status</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <select data-live-search="true" name="prodi" class="border rounded" aria-valuenow="{{ isset($listKota) ? $listKota->prodi : old('prodi') }}">
                <option value="disetujui">Disetujui</option>
                <option value="belum-disetujui">Belum disetujui</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <button class="btn btn-primary mb-4" onclick="this.disabled=true;document.getElementById('form').submit()" role="button">Simpan</button>
        </div>
    </div>
   </form>
</div>
@endsection
