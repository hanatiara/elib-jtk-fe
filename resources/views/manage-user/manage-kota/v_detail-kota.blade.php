@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-user">Manage Data User</a></li>
    <li class="breadcrumb-item"><a href="/manage-kota">Manage KoTA</a></li>
    <li class="breadcrumb-item active">View Detail KoTA {{ $listKota->nama_kota }}</li>
@endsection
@section('content')
<div class="flex">
<div class="text-xl mb-3">Detail KoTA {{ $listKota->nama_kota }}</div>
<div class="flex w-1/2 bg-white">
    <table class="table border-collapse border border-slate-500 w-full">
        <tr>
          <th class="w-1/3 px-2 py-1 border border-slate-700 bg-blue-200">Prodi</th>
          <td class="w-2/3 px-2 py-1 border border-slate-700">{{ $listKota->prodi }}</td>
        </tr>
        <tr>
          <th class="px-2 py-1 border border-slate-700 bg-blue-200">Tahun Ajaran</th>
          <td class="px-2 py-1 border border-slate-700 ">{{ $listKota->tahun_ajaran }}</td>
        </tr>
        <tr>
          <th class="px-2 py-1 border border-slate-700 bg-blue-200">Anggota</th>
          <td class="px-2 py-1 border border-slate-700 ">{{ $listKota->nama_mahasiswa1 }}<br>{{ $listKota->nama_mahasiswa2 }}<br>{{ $listKota->nama_mahasiswa3 }}</td>
        </tr>
        <tr>
          <th class="px-2 py-1 border border-slate-700 bg-blue-200">Pembimbing 1</th>
         @if(isset($listPembimbing))
            @foreach ($listPembimbing as $pembimbing)
            <td class="px-2 py-1 border border-slate-700">{{ $pembimbing->nama_dosen }}</td>
            @endforeach
         @endif
        </tr>
        {{-- <tr>
          <th class="px-2 py-1 border border-slate-700 bg-blue-200">Pembimbing 2</th>
          <td class="px-2 py-1 border border-slate-700"></td>
        </tr>
        <tr>
          <th class="px-2 py-1 border border-slate-700 bg-blue-200">Pembimbing 3</th>
          <td class="px-2 py-1 border border-slate-700"></td>
        </tr> --}}
        <tr>
          <th class="px-2 py-1 border border-slate-700 bg-blue-200">Penguji</td>
          <td class="px-2 py-1 border border-slate-700"></td>
        </tr>
    </table>
</div>
</div>
@endsection
