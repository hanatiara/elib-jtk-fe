@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Cari Dokumen Tugas Akhir</li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="display table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Judul</th>
                                    <th>Kelompok</th>
                                    <th>Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listRepo as $repo)
                                    <tr>
                                        <td>{{ $repo->tahun_ajaran }}</td>
                                        <td>{{ $repo->judul_ta }}</td>
                                        <td>{{ $repo->nama_kota }}</td>
                                        <td>{{ $repo->nama_mahasiswa1 }}<br>{{ $repo->nama_mahasiswa2 }}<br>{{ $repo->nama_mahasiswa3 }}</td>
                                        <td><a class="btn btn-success my-1" href="{{ route('view.repo', ['idBerkas' => $repo->id]) }}" role="button"><i class="fa-solid fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Judul</th>
                                    <th>Kelompok</th>
                                    <th>Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection
