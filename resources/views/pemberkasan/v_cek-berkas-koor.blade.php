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
                                    <th>No.</th>
                                    <th>KoTA</th>
                                    <th>Berkas</th>
                                    <th>Status</th>
                                    <th>Nama file</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listBerkas as $berkas)
                                <tr>
                                    <td>{{ $berkas->id }}</td>
                                    <td>{{ $berkas->nama_kota }}</td>
                                    <td>{{ $berkas->jenis_berkas }}</td>
                                    <td><button class="btn btn-block btn-success btn-xs"><i class="fa-solid fa-check mr-2"></i>Terkumpul</button></td>
                                    <td>{{ $berkas->nama_berkas }}</td>
                                    <td><a class="btn btn-success my-1" href="{{ route('berkas.download.koor', ['idBerkas' => $berkas->id]) }}" role="button"><i class="fa-solid fa-download"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>KoTA</th>
                                    <th>Berkas</th>
                                    <th>Status pengumpulan</th>
                                    <th>Nama file</th>
                                    <th>Download</th>
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
