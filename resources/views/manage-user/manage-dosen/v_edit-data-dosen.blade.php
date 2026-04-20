@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-user">Manage Data User</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-dosen">Manage Data Dosen</a></li>
    <li class="breadcrumb-item active">Edit Data Dosen</li>
@endsection
@section('content')
<div class="container">
    <form action="{{ route('dosen.update', ['idDosen' => $listDosen->id]) }}" method="POST" id="form">
        <input type="hidden" value="{{ $listDosen->id_user }}" name="id_user">
        @csrf
        <div class="row">
            <div class="col-2">Inisial Dosen</div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <input type="text" name="inisial_dosen" value="{{ $listDosen->inisial_dosen }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">Nama Dosen</div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <input type="text" name="nama_dosen" value="{{ $listDosen->nama_dosen }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">NIP</div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <input type="text" name="nip" value="{{ $listDosen->nip }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
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
