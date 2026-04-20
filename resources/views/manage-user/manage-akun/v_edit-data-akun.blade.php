@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-user">Manage Data User</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-akun">Manage Data Akun</a></li>
    <li class="breadcrumb-item active">Edit Data Akun</li>
@endsection
@section('content')
<div class="container">
    <form action="{{ route('user.update', ['idUser' => $listUser->id]) }}" method="POST" id="form">
        <input type="hidden" value="" name="id_user">
        @csrf
        <div class="row">
            <div class="col-2">Username</div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <input type="text" name="username" value="{{ $listUser->username }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">Koordinator</div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="form-check mr-3">
                    <input class="form-check-input" type="radio" name="status" value="ya" id="status_yes">
                    <label class="form-check-label" for="">Ya</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="tidak" id="status_no">
                    <label class="form-check-label" for="">Tidak</label>
                  </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">Prodi</div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                    <select data-live-search="true" name="prodi" class="border rounded" aria-valuenow="" id="prodi_koordinator" disabled>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <button class="btn btn-primary mb-4" onclick="" role="button">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
