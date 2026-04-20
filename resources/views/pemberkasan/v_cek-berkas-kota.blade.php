@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $jenis_seminar)) }}</li>
@endsection
@section('content')
    <a class="btn btn-primary mb-4 mx-2" href="/update-berkas/{{ $jenis_seminar }}" role="button">Update berkas</a>
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
                                    <th>Berkas</th>
                                    <th>Status pengumpulan file</th>
                                    <th>Nama file</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listBerkas as $berkas)
                                <tr>
                                    <td>{{ $berkas->id }}</td>
                                    <td>{{ $berkas->jenis_berkas }}</td>
                                    <td><button class="btn btn-block btn-success btn-xs"><i class="fa-solid fa-check mr-2"></i>Terkumpul</button></td>
                                    <td>{{ $berkas->nama_berkas }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Berkas</th>
                                    <th>Status pengumpulan file</th>
                                    <th>Nama file</th>
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
