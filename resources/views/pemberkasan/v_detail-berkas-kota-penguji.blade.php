@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Cari Dokumen Tugas Akhir</li>
@endsection
@section('content')
    @if(isset($listSeminar3))
        <div class="row">
            <div class="col-2">Seminar 3</div>
        </div>
        <div class="row">
            <div class="col-2">Laporan</div>:
            <div class="col">
                <a href="{{ route('berkas.download', ['idBerkas' => $listSeminar3->id_kota, 'document' => 'proposal-laporan', 'seminar_type' => 'seminar-3']) }}" class="link-info">Laporan</a><br>
            </div>
        </div>
        <div class="row">
            <div class="col-2">Artefak</div>:
            <div class="col">
                <a href="{{ route('berkas.download', ['idBerkas' => $listSeminar3->id_kota, 'document' => 'artefak', 'seminar_type' => 'seminar-3']) }}" class="link-info">Artefak</a><br>
            </div>
        </div>
    @endif

    @if(isset($listSidang))
    <br><br>
        <div class="row">
            <div class="col-2">Sidang</div>
        </div>
        <div class="row">
            <div class="col-2">Laporan</div>:
            <div class="col">
                <a href="{{ route('berkas.download', ['idBerkas' => $listSidang->id_kota, 'document' => 'proposal-laporan', 'seminar_type' => 'sidang']) }}" class="link-info">Laporan</a><br>
            </div>
        </div>
        <div class="row">
            <div class="col-2">Artefak</div>:
            <div class="col">
                <a href="{{ route('berkas.download', ['idBerkas' => $listSidang->id_kota, 'document' => 'artefak', 'seminar_type' => 'sidang']) }}" class="link-info">Artefak</a><br>
            </div>
        </div>
    @endif
@endsection
