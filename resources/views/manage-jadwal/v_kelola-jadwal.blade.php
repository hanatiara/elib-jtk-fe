@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Kelola Jadwal</li>
@endsection
@section('content')
<div>
    <div class="row">
        <div class="col-2">Dokumen jadwal</div>
        <form class="mx-2" action="/upload-jadwal" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" name="file" required>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <input type="submit" value="Simpan" name="submit" class="btn btn-primary">
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="form-group  mt-4 ml-2">
            <p>*File harus dengan format .pdf</p>
        </div>
    </div>
</form>
</div>
@endsection
