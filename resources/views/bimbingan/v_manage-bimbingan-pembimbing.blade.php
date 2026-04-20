@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Bimbingan</li>
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
                                    <th>Tanggal</th>
                                    <th>Topik Bimbingan</th>
                                    <th>Kelompok TA</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listBimbingan as $bimbingan)
                                <tr>
                                    <td>{{ $bimbingan->tanggal_bimbingan }}</td>
                                    <td>{{ $bimbingan->topik_bimbingan }}</td>
                                    <td>{{ $bimbingan->nama_kota }}</td>
                                    <td>@include('layout.v_status-bimbingan')</td>
                                    <th>
                                        <a class="btn btn-success my-1" href="{{ route('bimbingan.komentar', ['idBimbingan' => $bimbingan->id_bimbingan]) }}" role="button"><i class="fa-solid fa-comment-dots"></i></i></a>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Topik Bimbingan</th>
                                    <th>Kelompok TA</th>
                                    <th>Status</th>
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
