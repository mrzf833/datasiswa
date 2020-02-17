@extends('layout')
@section('datasiswa')
    active
@endsection
@section('style')
<style>
            #form-daftar{
                    width: 100%;
                    max-width: 500px;
                    margin-top: -120px;
                    z-index: 2;
            }
            .form-daftar{
                background-color: #f1c40f;
            }
            .z-index-mines{
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
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../siswa">DETAIL SISWA</a>
      <!-- Form -->
      <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
        <div class="form-group mb-0">
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" placeholder="Search" type="text">
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
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button href="" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7 z-index-mines">
    <h1 class="text-white text-center">Silahkan masukan data dibawah ini</h1>
  </div>
  <div class="container" id="form-daftar">
    <div class="text-center pb-2">
        <a href="http://127.0.0.1:8000/siswa" class="btn btn-danger">Kembali</a>
    </div>
    <div class="form-daftar pt-4 pl-2 pr-2 rounded min-margin">
        <form action="{{ route('siswa.store') }}" enctype="multipart/form-data" method="POST">
          @csrf
          <div class="form-group row mx-auto">
            <label for="nis" class="col-3 col-form-label text-white">Nis  </label>
            <input type="text" class="col-9 form-control" name="nis" id="nis" placeholder="Masukan Nis" value="" required>
          </div>
          <div class="form-group row mx-auto">
            <label for="nama" class="col-3 col-form-label text-white">Nama  </label>
            <input type="text" class="col-9 form-control" name="nama" id="nama" placeholder="Masukan Nama lengkap" value="" required>
          </div>
          <div class="form-group row mx-auto">
            <label for="kelas" class="col-3 col-form-label text-white">Kelas  </label>
            <select class="col-9 form-control" name="kelas" id="kelas" >
              @foreach ($kelass as $kl)
                <option value="{{ $kl->kelas }}">{{ $kl->kelas }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group row mx-auto">
            <label for="alamat" class="col-3 col-form-label text-white">Alamat  </label>
            <textarea name="alamat" class="col-9 form-control" id="alamat" cols="30" rows="2" placeholder="masukan alamat"></textarea>
          </div>
          <div class="form-group row mx-auto">
            <label for="status" class="col-3 col-form-label text-white">Status  </label>
            <select class="col-9 form-control" name="status" id="status">
                <option value="0">Di Sembunyikan</option>
                <option value="1">Tidak Di Sembunyikan</option>
            </select>
          </div>
          <div class="form-group row mx-auto">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="">Change image</span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="image">Masukan Foto</label>
              </div>
            </div>
          </div>
          <div class="form-group row mx-auto pb-4">
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary w-100">Tambah Data Siswa</button>
            </div>
          </div>
        </form>
    </div>
  </div>
@endsection
@section('script')
    <script>
      $('input[type="file"]').change(function(e){
          var fileName = e.target.files[0].name;
          $('.custom-file-label').html(fileName);
      });
      $('.clear_alert').click(function(){
        var div_alert = $(this).closest('.alert_erorr');
        $(div_alert).hide(2000,function(){$(div_alert).remove()});
      })
    </script>
@endsection