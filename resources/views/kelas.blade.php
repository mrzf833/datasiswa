@extends('layout')
@section('kelas')
    active
@endsection
@section('style')
    <style>
        #row{
            margin-top: -50px;
        }
        #header{
            z-index: -1;
        }
        #semua_alert{
          width: 325px;
          position: fixed;
          top: 5px;
          left: 100%;
          transform: translateX(-100%);
          z-index: 2;
        }
    </style>
@endsection
@section('content')
<div id="semua_alert">
  @if (count($errors) > 0)
    @foreach ($errors->all() as $error)
    <div class="alert_erorr" id="error{{ $loop->iteration }}">
      <div class="alert alert-danger lert row" role="alert">
      <div class="d-inline-block col-10">{{ $error }} !</div>
        <div class="ml-2 d-inline-block col-1">
          <button type="button" class="btn btn-danger clear_alert d-inline-block" style="padding: 0px 10px;"><i class="fas fa-times"></i></button>
        </div>
      </div>
    </div>
    @endforeach
  @endif
  @if (Session::has('sukses'))
    <div class="alert_erorr">
      <div class="alert alert-warning lert row" role="alert">
      <div class="d-inline-block col-10">{{ Session::get('sukses') }} !</div>
        <div class="ml-2 d-inline-block col-1">
          <button type="button" class="btn btn-warning clear_alert d-inline-block" style="padding: 0px 10px;"><i class="fas fa-times"></i></button>
        </div>
      </div>
    </div>
  @endif
</div>
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('nilai_siswa.index') }}">info mataPelajaran</a>
      <!-- Form -->
      <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
        <div class="form-group mb-0">
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control cari" placeholder="Search" type="text">
          </div>
        </div>
      </form>
      <!-- User -->
      <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg">
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button href="" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </button>
            </form>
        </li>
      </ul>
    </div>
  </nav>
  <div class="header bg-gradient-primary pb-6 pt-5 pt-md-7" id="header">
    <h1 class="text-white text-center text-capitalize">Info Semua Kelas</h1>
  </div>    
  <div class=" w-25 mr-auto ml-auto" id="row">
    <table class="table table-striped table-success rounded">
        <thead>
          <tr>
            <th scope="col" class="text-center">Kelas</th>
            <th scope="col" style="width:85px" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
            @if (count($kelass)>0)
                @foreach ($kelass as $kelas)
                    <tr class="data">
                        <td class="text-center">{{ $kelas->kelas }}</td>
                        <td class="text-center">
                            <form action="{{ route('kelas.destroy',$kelas->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width:85px">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <td colspan="2">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_kelas">Tambah Kelas</button>
                    </div>
                </td>
            </tr>
        </tbody>
      </table>
      <!-- Modal -->
    <form action="{{ route('kelas.store') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah_kelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="form-group row">
                    <label for="kelas" class="col-3 col-form-label text-capitalize">Kelas</label>
                    <input type="number" name="kelas" id="kelas" class="col-9 form-control" placeholder="silahkan masukan kelas">
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>
</form>
  </div>
@endsection
@section('script')
    <script>
      $('.clear_alert').click(function(){
        var div_alert = $(this).closest('.alert_erorr');
        $(div_alert).hide(2000,function(){$(div_alert).remove()});
      })
    </script>
@endsection