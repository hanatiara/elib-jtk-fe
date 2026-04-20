@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-bimbingan-pembimbing">Bimbingan</a></li>
    <li class="breadcrumb-item active">Beri Komentar</li>
@endsection
@section('content')
<div class="container">
    <!-- @if(!isset($listKota))
    <form action="{{ route('kota.create') }}" method="POST" id="form">
    @else
    <form action="{{ route('kota.update', ['idKota' => $listKota->id]) }}" method="POST" id="form">
    @endif
    {{ csrf_field() }} -->
    <div class="row">
        <div class="col-2">Tanggal bimbingan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="tanggal_bimbingan" value="{{ isset($bimbingan) ? $bimbingan->tanggal_bimbingan : old('tanggal_bimbingan') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">KoTA</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="nama_kota" value="{{ isset($bimbingan) ? $bimbingan->nama_kota : old('nama_kota') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Topik bimbingan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="topik_bimbingan" value="{{ isset($bimbingan) ? $bimbingan->topik_bimbingan : old('topik_bimbingan') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Dosen pembimbing</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="id_pembimbing" value="{{ isset($bimbingan) ? $bimbingan->nama_dosen : old('nama_dosen') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
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
        <div class="col-2">Catatan hasil bimbingan</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3 ">
                <textarea class="form-control" name="catatan" id="exampleFormControlTextarea1" rows="3" disabled>{{ isset($bimbingan) ? $bimbingan->catatan : old('catatan') }}</textarea>
            </div>
        </div>
    </div>
    @if (!($bimbingan->url == '-'))
    <div class="row">
        <div class="col-2">Lampiran</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <a href="{{ route('bimbingan.download', ['idBimbingan' => $bimbingan->id_bimbingan]) }}"><button class="btn btn-primary mb-4" onclick="" role="button">Download</button></a>
            </div>
        </div>
    </div>
    @endif

    @if(!($bimbingan->status == 'disetujui'))
    <form action="{{ route('bimbingan.update', ['idBimbingan' => $bimbingan->id_bimbingan]) }}" id="form" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" value="{{ $bimbingan->id_bimbingan }}" name="id">
    <div class="row">
        <div class="col-2">Komentar Dosen pembimbing</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3 ">
                <textarea class="form-control" name="komentar" id="exampleFormControlTextarea1" rows="3">{{ isset($bimbingan) ? $bimbingan->komentar : old('komentar') }}</textarea>
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
   @else
   <input type="hidden" value="{{ $bimbingan->id_bimbingan }}" name="id">
    <div class="row">
        <div class="col-2">Komentar Dosen pembimbing</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3 ">
                <textarea class="form-control" name="komentar" id="exampleFormControlTextarea1" rows="3" disabled>{{ isset($bimbingan) ? $bimbingan->komentar : old('komentar') }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <button class="btn btn-primary mb-4" onclick="this.disabled=true;document.getElementById('form').submit()" role="button" disabled>Simpan</button>
        </div>
    </div>
   </form>
   @endif

   <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <div class="row"><p>Klik "simpan" jika hanya untuk menyimpan komentar.</p></div>
        </div>
   </div>

   @if(!($bimbingan->status == 'disetujui'))
   <form action="{{ route('bimbingan.accept', ['idBimbingan' => $bimbingan->id_bimbingan]) }}" id="formAcc" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" value="{{ $bimbingan->id_bimbingan }}" name="id">
    <input type="hidden" value="{{ $bimbingan->komentar }}" name="komentar">
   <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <button class="btn btn-primary mb-4" onclick="this.disabled=true;document.getElementById('formAcc').submit()" role="button">Setujui</button>
        </div>
    </div>
    </form>
    @else
    <input type="hidden" value="{{ $bimbingan->id_bimbingan }}" name="id">
   <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <button class="btn btn-primary mb-4" onclick="this.disabled=true;document.getElementById('formAcc').submit()" role="button" disabled>Setujui</button>
        </div>
    </div>
    </form>
   @endif

    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <div class="row"><p>Klik "setujui" untuk menyetujui bimbingan.</p></div>
        </div>
   </div>
</div>
@endsection
