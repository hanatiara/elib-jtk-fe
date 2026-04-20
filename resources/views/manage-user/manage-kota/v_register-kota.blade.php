@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-user">Manage Data User</a></li>
    <li class="breadcrumb-item"><a href="/manage-kota">Manage KoTA</a></li>
    <li class="breadcrumb-item active">Register Data KoTA</li>
@endsection
@section('content')
<div class="container">
    @if(!isset($listKota))
    <form action="{{ route('kota.create') }}" method="POST" id="form">
    @else
    <form action="{{ route('kota.update', ['idKota' => $listKota->id]) }}" method="POST" id="form">
    @endif
    {{ csrf_field() }}
    <div class="row">
        <div class="col-2">Nama Kota</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <input type="text" name="nama_kota" value="{{ isset($listKota) ? $listKota->nama_kota : old('nama_kota') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Prodi</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <select data-live-search="true" name="prodi" class="border rounded" aria-valuenow="{{ isset($listKota) ? $listKota->prodi : old('prodi') }}">
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Tahun Ajaran</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
                <input type="text" name="tahun_ajaran" value="{{ isset($listKota) ? $listKota->tahun_ajaran : old('tahun_ajaran') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Judul TA</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="judul_ta" value="{{ isset($listKota) ? $listKota->judul_ta : old('judul_ta') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Status</div>
        <div class="col">
            <div class="search_select_box input-group-sm mb-3">
                    <select data-live-search="true" name="status" class="border rounded">
                    <option value="BL">Belum Lulus</option>
                    <option value="LL">Lulus</option>
                    <option value="MG">Mengulang</option>
                    <option value="DO">DO</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Nama Mahasiswa 1</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="nama_mahasiswa1" value="{{ isset($listKota) ? $listKota->nama_mahasiswa1 : old('nama_mahasiswa1') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">NIM Mahasiswa 1</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="nim1" value="{{ isset($listKota) ? $listKota->nim1 : old('nim1') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Nama Mahasiswa 2</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="nama_mahasiswa2" value="{{ isset($listKota) ? $listKota->nama_mahasiswa2 : old('nama_mahasiswa2') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">NIM Mahasiswa 2</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="nim2" value="{{ isset($listKota) ? $listKota->nim2 : old('nim2') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Nama Mahasiswa 3</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="nama_mahasiswa3" value="{{ isset($listKota) ? $listKota->nama_mahasiswa3 : old('nama_mahasiswa3') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">NIM Mahasiswa 3</div>
        <div class="col">
            <div class="input-group input-group-sm mb-3">
              <input type="text" name="nim3" value="{{ isset($listKota) ? $listKota->nim3 : old('nim3') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-2">Dosen Pembimbing 1</div>
        <div class="col">
            <div class="search_select_box input-group-sm mb-3">
                    <select data-live-search="true" name="pembimbing1" class="border rounded">
                    <option value="-">-</option>
                    @foreach ($listDosen as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Dosen Pembimbing 2</div>
        <div class="col">
            <div class="search_select_box input-group-sm mb-3">
                <select data-live-search="true" name="pembimbing2" class="border rounded">
                    <option value="-">-</option>
                    @foreach ($listDosen as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Dosen Pembimbing 3</div>
        <div class="col">
            <div class="search_select_box input-group-sm mb-3">
                <select data-live-search="true" name="pembimbing3" class="border rounded">
                    <option value="-">-</option>
                    @foreach ($listDosen as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Dosen Penguji 1</div>
        <div class="col">
            <div class="search_select_box input-group-sm mb-3">
                <select data-live-search="true" name="penguji1" class="border rounded">
                    <option value="-">-</option>
                    @foreach ($listDosen as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Dosen Penguji 2</div>
        <div class="col">
            <div class="search_select_box input-group-sm mb-3">
                <select data-live-search="true" name="penguji2" class="border rounded">
                    <option value="-">-</option>
                    @foreach ($listDosen as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">Dosen Penguji 3</div>
        <div class="col">
            <div class="search_select_box input-group-sm mb-3">
                <select data-live-search="true" name="penguji3" class="border rounded">
                    <option value="-">-</option>
                    @foreach ($listDosen as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                    @endforeach
                </select>
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
