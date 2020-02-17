@extends('layout')
@section('detailnilai')
    active
@endsection
@section('style')
    <style>
        .mid-auto{
            margin: auto;
        }
        .mid{
            margin-top: -21px !important;
        }
        @media only screen and (min-width: 768px) {
        .mid-auto{
                margin: 0px;
            }
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
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('nilai_siswa.index') }}">DETAIL nilai SISWA</a>
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
  <!-- End Navbar -->
  <!-- Header -->
  <div class="header bg-gradient-primary pb-6 pt-5 pt-md-7">
    <h1 class="text-white text-center text-capitalize">Detail Data Nilai Semua Siswa 
      @if (isset($find))
        @if ($find !== "tersembunyi")
            Kelas
        @endif
        {{$find}}
      @endif</h1>
  </div>
  <div class="row mx-auto mid">
    @if (count($kelass)>0)
    <div class="col-6 col-md-4 col-lg-3 pb-2 text-center m-auto"><a href="{{ route('nilai_siswa.index') }}" class="btn btn-success pl-5 pr-5">Semua</a></div>
    @endif
    @if (count($jml_sembunyi)>0)
    <div class="col-6 col-md-4 col-lg-3 pb-2 text-center m-auto"><a href="http://127.0.0.1:8000/nilai_siswa/tersembunyi" class="btn btn-success pl-5 pr-5">DiSembunyikan</a></div>
    @endif
    @foreach ($kelass as $kelas)
      <div class="col-6 col-md-4 col-lg-3 pb-2 text-center m-auto"><a href="{{ route('nilai_siswa.show',$kelas)}}" class="btn btn-success pl-5 pr-5">Kelas {{ $kelas->kelas }}</a></div>
    @endforeach
  </div>
  <hr>
  @if (!isset($find)) {{-- jika find undefined maka jalankan dibawah ini --}}
  <div class="row mx-auto" id="row">
    @foreach ($siswas as $siswa)
      @if ($siswa->status == 1)
      <div class="col-md-6 col-lg-4 mid-auto mb-2 data">
          <div class="card m-auto" style="width: 14rem;">
              <img src="../storage/images/{{ $siswa->foto }}" class="card-img-top" alt="...">
              <div class="card-body">
              <h3 class="card-title text-uppercase">{{ $siswa->nama_siswa }}</h3>
              <p class="card-text">nis: {{$siswa->nis}} <br>kelas : {{$siswa->id_kelas}}</p>
                  <div class="text-center pb-1">
                    <button class="btn btn-primary edit_detail" data-toggle="modal" data-target="#modal{{ $siswa->id}}">DETAIL OR EDIT</button>
                  </div>
              </div>
          </div> 
      </div>
      @endif
    @endforeach
  </div>
  @endif
  @if (isset($find)) {{-- jika find TIDAK undefined maka jalankan dibawah ini --}}
  <div class="row mx-auto" id="row">
    @if ($find === "tersembunyi")
      @foreach ($siswas as $siswa)
        @if ($siswa->status == 0)
        <div class="col-md-6 col-lg-4 mid-auto mb-2 data">
            <div class="card m-auto" style="width: 14rem;">
                <img src="../storage/images/{{ $siswa->foto }}" class="card-img-top" alt="...">
                <div class="card-body">
                <h3 class="card-title text-uppercase">{{ $siswa->nama_siswa }}</h3>
                <p class="card-text">nis: {{$siswa->nis}} <br>kelas : {{$siswa->id_kelas}}</p>
                    <div class="text-center pb-1">
                      <button class="btn btn-primary edit_detail" data-toggle="modal" data-target="#modal{{ $siswa->id}}">DETAIL OR EDIT</button>
                    </div>
                </div>
            </div> 
        </div>
        @endif
      @endforeach
    @else
      @foreach ($siswas as $siswa)
        @if ($siswa->status == 1)
        <div class="col-md-6 col-lg-4 mid-auto mb-2 data">
            <div class="card m-auto" style="width: 14rem;">
                <img src="../storage/images/{{ $siswa->foto }}" class="card-img-top" alt="...">
                <div class="card-body">
                <h3 class="card-title text-uppercase">{{ $siswa->nama_siswa }}</h3>
                <p class="card-text">nis: {{$siswa->nis}} <br>kelas : {{$siswa->id_kelas}}</p>
                    <div class="text-center pb-1">
                      <button class="btn btn-primary edit_detail" data-toggle="modal" data-target="#modal{{ $siswa->id}}">DETAIL OR EDIT</button>
                    </div>
                </div>
            </div> 
        </div>
        @endif
      @endforeach
    @endif
  </div>
  @endif
  <!-- Modal -->
  @if (!isset($find)) {{-- jika find undefined maka jalankan dibawah ini --}}
  <div id="semua_modal">
    @foreach ($siswas as $siswa)
        @if ($siswa->status == 1)
        <form action="{{ route('nilai_siswa.update',$siswa->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="modal fade" id="modal{{$siswa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-uppercase" id="">nilai siswa</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @foreach ($mapels as $mapel)
                            <div class="form-group row">
                                <label for="{{ $mapel->mata_pelajaran }}" class="col-3 col-form-label text-capitalize">{{ $mapel->mata_pelajaran }}  </label>
                                <input type="text" class="col-9 form-control" name="{{ $mapel->mata_pelajaran }}" id="{{ $mapel->mata_pelajaran }}" isi="{{ $siswa->nilai_siswas()->where('id_matepelajaran',$mapel->id)->first()->nilai }}" placeholder="Nilai Belum di input" value="{{ $siswa->nilai_siswas()->where('id_matepelajaran',$mapel->id)->first()->nilai }}">
                            </div>
                            @endforeach
                            <div>Jika ingin dikosongkan/menghapus nilai tinggal di kosongkan saja input di atas</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endif
        @endforeach
      </div>
  @endif
  @if (isset($find)) {{-- jika find TIDAK undefined maka jalankan dibawah ini --}}
  <div id="semua_modal">
    @if ($find === "tersembunyi")
      @foreach ($siswas as $siswa)
        @if ($siswa->status == 0)
        <form action="{{ route('nilai_siswa.update',$siswa->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
            @csrf
            <div class="modal fade" id="modal{{$siswa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title text-uppercase" id="">siswa</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @foreach ($mapels as $mapel)
                            <div class="form-group row">
                                <label for="{{ $mapel->mata_pelajaran }}" class="col-3 col-form-label text-capitalize">{{ $mapel->mata_pelajaran }}  </label>
                                <input type="text" class="col-9 form-control" name="{{ $mapel->mata_pelajaran }}" id="{{ $mapel->mata_pelajaran }}" isi="{{ $siswa->nilai_siswas()->where('id_matepelajaran',$mapel->id)->first()->nilai }}" placeholder="Nilai Belum di input" value="{{ $siswa->nilai_siswas()->where('id_matepelajaran',$mapel->id)->first()->nilai }}">
                            </div>
                    @endforeach
                    <div>Jika ingin dikosongkan/menghapus nilai tinggal di kosongkan saja input di atas</div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
        @endif
      @endforeach
    @else
    @foreach ($siswas as $siswa)
    @if ($siswa->status == 1)
    <form action="{{ route('nilai_siswa.update',$siswa->id) }}" method="POST" enctype="multipart/form-data">
      @method('PUT')
        @csrf
        <div class="modal fade" id="modal{{$siswa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-uppercase" id="">siswa</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @foreach ($mapels as $mapel)
                            <div class="form-group row">
                                <label for="{{ $mapel->mata_pelajaran }}" class="col-3 col-form-label text-capitalize">{{ $mapel->mata_pelajaran }}  </label>
                                <input type="text" class="col-9 form-control" name="{{ $mapel->mata_pelajaran }}" id="{{ $mapel->mata_pelajaran }}" isi="{{ $siswa->nilai_siswas()->where('id_matepelajaran',$mapel->id)->first()->nilai }}" placeholder="Nilai Belum di input" value="{{ $siswa->nilai_siswas()->where('id_matepelajaran',$mapel->id)->first()->nilai }}">
                            </div>
                @endforeach
                <div>Jika ingin dikosongkan/menghapus nilai tinggal di kosongkan saja input di atas</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    </form>
    @endif
  @endforeach
    @endif
      </div>
  @endif
@endsection
@section('script')
    {{-- <script>
        $(document).ready(function(){
            $(window).resize(function(){
                if($(window).width() => 768){
                    $("#row .card").removeAttr('class')
                }
            }); 
        })
    </script> --}}
    <script type="application/javascript">
      $("button.edit_detail").click(function(){
        var attrBtn = $(this).attr('data-target');
        @foreach($mapels as $mapel)
        var {{ $mapel->mata_pelajaran }} = $(attrBtn + ' #{{ $mapel->mata_pelajaran }}').attr('isi');
        @endforeach
        
        @foreach($mapels as $mapel)
          $(attrBtn + ' #{{$mapel->mata_pelajaran}}').val({{$mapel->mata_pelajaran}});
        @endforeach
      })
      $('.clear_alert').click(function(){
        var div_alert = $(this).closest('.alert_erorr');
        $(div_alert).hide(2000,function(){$(div_alert).remove()});
      })
  </script>
@endsection