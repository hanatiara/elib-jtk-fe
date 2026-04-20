@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-user">Manage Data User</a></li>
    <li class="breadcrumb-item active">Manage KoTA</li>
@endsection
@section('content')
    <!-- <a class="btn btn-primary mb-4 mx-2" href="/register-kota" role="button">Register Data KoTA</a> -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id Kota</th>
                    <th>Nama KoTA</th>
                    <th>Anggota</th>
                    <th>Pembimbing</th>
                    <th>Penguji</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $old_id = 0 ?>
                        @foreach ( $listKota as $kota )
                        @if(!($kota->id == $old_id))
                            <tr>
                                <th>{{ $kota->id  }}</th>
                                <th>{{ $kota->nama_kota }}</th>
                                <th>{{ $kota->nama_mahasiswa1 }}<br>{{ $kota->nama_mahasiswa2 }}<br>{{ $kota->nama_mahasiswa3 }}</th>
                                <th>
                                    @foreach ($listPembimbing as $namaPembimbing)
                                    @if($kota->id == $namaPembimbing->id_kota)
                                        {{ $namaPembimbing->nama_dosen }} <br>
                                    @endif
                                    @endforeach
                                </th>
                                <th>
                                    @foreach ($listPenguji as $namaPenguji)
                                    @if($kota->id == $namaPenguji->id_kota)
                                        {{ $namaPenguji->nama_dosen }} <br>
                                    @endif
                                    @endforeach
                                </th>
                                <th>{{ $kota->status }}</th>
                                <th><a class="btn btn-success my-1" href="{{ route('kota.formUpdate', ['idKota' => $kota->id]) }}" role="button"><i class="fas fa-edit"></i></a></th>
                            </tr>
                        @endif
                        <?php $old_id = $kota->id ?>
                        @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id Kota</th>
                    <th>Nama KoTA</th>
                    <th>Anggota</th>
                    <th>Pembimbing</th>
                    <th>Penguji</th>
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
