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
                    <h4><B>DASHBOARD</B></h4>
                </div>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="bg-white rounded-circle"><i class="ti ti-user"> {{ Auth::guard('admin')->user()->username }}!</i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
                                <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary d-block w-75 px-2 mx-auto" onclick="event.preventDefault(); this.closest('form').submit();">
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
        <!--  Row 1 -->
        <div class="row my-3">
            <div class="col-sm-12 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-header d-block d-md-flex bg-primary">
                    </div>
                    <div class="card-body pt-3 p-4">
                        <h2 class="text-center"><span><i class="ti ti-user"></i></span></h2>
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="fw-semibold fs-4 mb-0">Admin</h6>
                            <h6 class="ms-2 fw-normal fs-4 mb-0">{{ $admin }}</h6>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-header d-block d-md-flex bg-primary">
                    </div>
                    <div class="card-body pt-3 p-4">
                        <h2 class="text-center"><span><i class="ti ti-users"></i></span></h2>
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="fw-semibold fs-4 mb-0">Penyewa</h6>
                            <h6 class="ms-2 fw-normal fs-4 mb-0">{{ $penyewa }}</h6>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-header d-block d-md-flex bg-primary">
                    </div>
                    <div class="card-body pt-3 p-4">
                        <h2 class="text-center"><span>
                            <i class="ti ti-home"></i>
                        </span></h2>
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="fw-semibold fs-4 mb-0">Ruko</h6>
                            <h6 class="ms-2 fw-normal fs-4 mb-0">{{ $ruko }}</h6>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-header d-block d-md-flex bg-primary">
                    </div>
                    <div class="card-body pt-3 p-4">
                        <h2 class="text-center"><span> <i class="ti ti-list-details"></i></h2>
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="fw-semibold fs-4 mb-0">Sewa Ruko</h6>
                            <h6 class="ms-2 fw-normal fs-4 mb-0">{{ $sewaruko }}</h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>
               
           

            <div class="row">
                <div class="col-md-12 col-xl-12 my-4">
                  <div class="card">
                    <div class="card-header d-block d-md-flex bg-primary">
                      <h5 class="text-white mb-0">Akses Cepat </h5>
            
                    </div>
                    <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="buttons">
                      <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <button type="button" class="btn bg-white text-success px-0">
                          <h5>
                            <a href="{{ route('tampil.admin') }}">
                                <i class="ti ti-user"></i> Add Admin </a>
                          </h5>
                        </button>
                      </div>
                      <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <button type="button" class="btn bg-white text-success px-0">
                          <h5>
                            <a href="{{ route('ruko.index') }}">
                                <i class="ti ti-home"></i>Add Ruko </a>
                          </h5>
                        </button>
                      </div>
                      <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <button type="button" class="btn bg-white text-success px-0">
                          <h5>
                            <a href="{{ route('tampil.penyewa') }}">
                                <i class="ti ti-users"></i> Add Penyewa </a>
                            <h5>
                        </button>
                      </div>
                      <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <button type="button" class="btn bg-white text-success px-0">
                          <h5>
                            <a href="{{ route('laporan.index') }}">
                                <i class="ti ti-file-analytics"></i> Laporan </a>
                          </h5>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 

        </div>
       
    </div>
    
</div>
@endsection
</html>