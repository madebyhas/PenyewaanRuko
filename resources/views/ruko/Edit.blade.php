<!DOCTYPE html>
@extends('admin.partials.head')
@section('css')

<!--  Section Container-->
@section('container')
<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <div class="col-sm-6">
                    <h4><B>RUKO</B></h4>
                </div>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="bg-white rounded-circle"><i class="ti ti-user"> {{
                                    Auth::guard('admin')->user()->username }}!</i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
                            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary d-block w-75 px-2 mx-auto"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--  Header End -->
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center"
                    style="background-color: rgba(0, 0, 255, 0.5); color: white;">
                    <h4><b>Edit Data Ruko</b></h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route("ruko.update",$ruko->id_ruko)}}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="jenis_ruko">Jenis Ruko</label>
                            <input type="text" name="jenis_ruko" id="jenis_ruko"
                                class="form-control @error('jenis_ruko'){{'is-invalid'}}@enderror"
                                value="{{$ruko->jenis_ruko}}">
                            @error('jenis_ruko')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="luas_ruko">Luas Ruko</label>
                            <input type="number" name="luas_ruko" id="luas_ruko"
                                class="form-control @error('luas_ruko'){{'is-invalid'}}@enderror"
                                value="{{$ruko->luas_ruko}}">
                            @error('luas_ruko')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_ruko">Nomor Ruko</label>
                            <input type="number" name="no_ruko" id="no_ruko"
                                class="form-control @error('no_ruko'){{'is-invalid'}}@enderror"
                                value="{{$ruko->no_ruko}}">
                            @error('no_ruko')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga"
                                class="form-control @error('harga'){{'is-invalid'}}@enderror"
                                value="{{$ruko->harga}}">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://datatables.net/legacy/v1/media/js/jquery.dataTables.js"></script>
<script src="https://datatables.net/legacy/v1/media/js/dataTables.bootstrap5.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $('#example').DataTable();
</script>

@endsection

</html>