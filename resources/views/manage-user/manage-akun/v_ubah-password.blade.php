@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Ubah Password</li>
@endsection
@section('content')
<div class="container">
    <form action="{{ route('password.update', ['idUser' => $user]) }}" method="POST" id="form">
        @csrf
        <div class="row">
            <div class="col-2">Password Lama</div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <input type="password" name="old_password" id="old_password" value="" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">Password Baru</div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <input type="password" name="new_password" id="new_password" value="" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">Konfirmasi Password</div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <div class="input-group input-group-sm mb-3">
                    <span id='message'></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <button class="btn btn-primary mb-4" id="submit" role="button" disabled>Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
