@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-bimbingan-kota">Bimbingan</a></li>
    <li class="breadcrumb-item active">Laporan Bimbingan</li>
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
        <div class="col-2">Catatan hasil bimbingan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3 ">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Attachment</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="file" name="" value="" aria-describedby="inputGroup-sizing-sm">
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
