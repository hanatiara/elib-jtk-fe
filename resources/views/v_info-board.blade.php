@extends('layout.v_template')
@section('content')
    @if((session('user')['user']->role == 'kota') && isset($listKotaPembimbing[0]->pembimbing))
    <p>Ini dosen yang menjadi pembimbing</p>
    <div class="d-flex flex-row mb-2">
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title mb-2">Pembimbing</h3>
                    <p class="card-text">
                        @foreach ($listKotaPembimbing as $pembimbing)
                            {{ $pembimbing->pembimbing }}<br>
                        @endforeach
                    </p>
                    <a href="/bimbingan" class="btn btn-primary">Detail Bimbingan</a>
                </div>
            </div>
        <br>
    </div>
    @endif
    @if((session('user')['user']->role == 'kota') && isset($listKotaPenguji[0]->penguji))
    <p>Ini dosen yang menjadi penguji</p>
    <div class="d-flex flex-row mb-2">
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title mb-2">Penguji</h3>
                    <p class="card-text">
                        @foreach ($listKotaPenguji as $penguji)
                            {{ $penguji->penguji }}<br>
                        @endforeach
                    </p>
                </div>
            </div>
        <br>
    </div>
    @endif
    @if(in_array('pembimbing', session('user')['user']->role_dosen)&& isset($listPembimbing[0]->id_kota))
    <p>Ini kelompok yang anda bimbing</p>
    <div class="d-flex flex-row">
            @foreach($listPembimbing as $pembimbing)
                @if($pembimbing->status == 'ML' || $pembimbing->status == 'BL')
                <div class="card m-2" style="width: 18rem;">
                    <div class="card-body">
                        <h3 class="card-title">KoTA {{ $pembimbing->nama_kota }}</h3>
                        <p class="card-text">
                            {{ $pembimbing->nama_mahasiswa1 }}<br>
                            {{ $pembimbing->nama_mahasiswa2 }}<br>
                            {{ $pembimbing->nama_mahasiswa3 }}
                        </p>
                        <p>Prodi {{ $pembimbing->prodi }}</p>
                        <a href="/manage-bimbingan-kota/{{ $pembimbing->id_kota }}" class="btn btn-primary">Detail Bimbingan</a>
                    </div>
                </div>
                @endif
            @endforeach
        <br>
    </div>
    @endif
    @if(in_array('penguji', session('user')['user']->role_dosen) && isset($listPenguji[0]->id_kota))
    <p>Ini kelompok yang anda uji</p>
    <div class="d-flex flex-row">
        @foreach($listPenguji as $penguji)
            @if($penguji->status == 'ML' || $penguji->status == 'BL')
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title">KoTA {{ $penguji->nama_kota }}</h3>
                    <p class="card-text">
                    {{ $penguji->nama_mahasiswa1 }}<br>
                        {{ $penguji->nama_mahasiswa2 }}<br>
                        {{ $penguji->nama_mahasiswa3 }}
                    </p>
                    <p>Prodi {{ $penguji->prodi }}</p>
                    <a href="/detail-berkas-kota/{{ $penguji->id_kota }}" class="btn btn-primary">Detail Berkas</a>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    <br><br>
    @endif
    @if(in_array('koordinator', session('user')['user']->role_dosen))
        <a class="btn btn-primary mb-4 mx-1" href="/kelola-jadwal" name="submit" role="button">Kelola Jadwal</a>
    @endif
    @if(isset($listJadwal))
        <object data="{{asset('pdf').$listJadwal->url}}" type="application/pdf" title="PDF" width="100%" height="500px"></object>
    @endif
@endsection
