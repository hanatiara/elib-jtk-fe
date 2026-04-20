@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-user">Manage Data User</a></li>
    <li class="breadcrumb-item"><a href="/manage-akun">Manage Akun</a></li>
    <li class="breadcrumb-item active">Import Akun KoTA</li>
@endsection
@section('content')
<div class="container">
    <form action="/import-akun-kota" id="form" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-2">File Template</div>
            <div class="mx-2">
                <div class="form-group">
                    <a href="{{ route('user.download', ['namaBerkas' => 'data-kota']) }}" class="link-info">Download</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">Upload File</div>
            <div class="mx-2">
                <div class="form-group">
                    <input type="file" name="file">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
@endsection
