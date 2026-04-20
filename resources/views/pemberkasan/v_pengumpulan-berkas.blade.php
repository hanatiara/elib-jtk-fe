@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/pemberkasan-kota/{{ $jenis_seminar }}">{{ ucwords(str_replace('-', ' ', $jenis_seminar)) }}</a></li>
    <li class="breadcrumb-item active">Pengumpulan berkas</li>
@endsection
@section('content')
<div class="container">
    <!-- @if(!isset($listKota))
    <form action="{{ route('kota.create') }}" method="POST" id="form">
    @else
    <form action="{{ route('kota.update', ['idKota' => $listKota->id]) }}" method="POST" id="form">
    @endif
    {{ csrf_field() }} -->
    <form action="/update-berkas/{{ $jenis_seminar }}" id="form" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col-2">Proposal/Laporan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="file" name="proposal-laporan" value="" aria-describedby="inputGroup-sizing-sm" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Artefak</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="file" name="artefak" value="" aria-describedby="inputGroup-sizing-sm" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Form TA</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="file" name="fta" value="" aria-describedby="inputGroup-sizing-sm" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <button class="btn btn-primary mb-4" onclick="this.disabled=true;document.getElementById('form').submit()" role="button">Simpan</button>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                File yang diupload harus berformat .pdf, .docx, .doc, .zip, .rar
            </div>
        </div>
    </div>
   </form>
</div>
@endsection
