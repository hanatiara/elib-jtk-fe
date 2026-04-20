@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-user">Manage Data User</a></li>
    <li class="breadcrumb-item active">Manage Data Dosen</li>
@endsection
@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id Dosen</th>
                    <th>Id User</th>
                    <th>Inisial Dosen</th>
                    <th>Nama Dosen</th>
                    <th>NIP</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($listDosen as $dosen)
                    <tr>
                        <td>{{ $dosen->id }}</td>
                        <td>{{ $dosen->id_user }}</td>
                        <td>{{ $dosen->inisial_dosen }}</td>
                        <td>{{ $dosen->nama_dosen }}</td>
                        <td>{{ $dosen->nip }}</td>
                        <td>
                            <a class="btn btn-success my-1" href="{{ route('dosen.formUpdate', ['idDosen' => $dosen->id]) }}" role="button"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id Dosen</th>
                    <th>Id User</th>
                    <th>Inisial Dosen</th>
                    <th>Nama Dosen</th>
                    <th>NIP</th>
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
