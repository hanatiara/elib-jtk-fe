@extends('layout.v_template')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/manage-data-user">Manage Data User</a></li>
    <li class="breadcrumb-item active">Manage Akun</li>
@endsection
@section('content')
    <a class="btn btn-primary mb-4 mx-2" href="/form-akun-dosen" role="button">Import Akun Dosen</a>
    <a class="btn btn-primary mb-4 mx-2" href="/form-akun-kota" role="button">Import Akun Kota</a>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="multi-table" class="display table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id User</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php $old_id = 0 ?>
                    @foreach ($listUser as $user)
                        @if(!($user->id_user == $old_id))
                            <tr>
                                <td>{{ $user->id_user }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    @foreach ($listUser as $listDosen)
                                    @if($user->id_user == $listDosen->id_user)
                                        {{ ucwords($listDosen->nama_role) }} <br>
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-success my-1" href="{{ route('user.formUpdate', ['idUser' => $user->id_user]) }}" role="button"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endif
                        <?php $old_id = $user->id_user ?>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id User</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
                <div class="card-body">
                  <table id="multi-table" class="display table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Id User</th>
                      <th>Username</th>
                      <th>Prodi</th>
                      <th>Tahun Ajaran</th>
                      <th>Role</th>
                    </tr>
                    </thead>
                    <tbody>
                  @foreach ($listKota as $kota)
                    <tr>
                        <td>{{ $kota->id_user }}</td>
                        <td>{{ $kota->username }}</td>
                        <td>{{ $kota->prodi }}</td>
                        <td>{{ $kota->tahun_ajaran }}</td>
                        <td>{{ $kota->role }}</td>
                    </tr>
                  @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Id User</th>
                      <th>Username</th>
                      <th>Prodi</th>
                      <th>Tahun Ajaran</th>
                      <th>Role</th>
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
