@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Manage Data User</li>
@endsection
@section('content')
<div class="container">
  <div class="row">
        <!-- <button type="button" class="btn btn-primary btn-lg btn-block my-1">Add Prodi & Tahun Ajaran</button> -->
        <a class="btn btn-primary btn-lg btn-block my-1" href="/manage-akun" role="button">Manage Akun</a>
        <a class="btn btn-primary btn-lg btn-block my-1" href="{{ route('kota.index') }}" role="button">Manage KoTA</a>
        <a class="btn btn-primary btn-lg btn-block my-1" href="/manage-data-dosen" role="button">Manage Data Dosen</a>
        <!-- <button type="button" class="btn btn-primary btn-lg btn-block my-1">Manage Pembimbing</button>
        <button type="button" class="btn btn-primary btn-lg btn-block my-1">Manage Penguji</button> -->
  </div>
</div>
@endsection
