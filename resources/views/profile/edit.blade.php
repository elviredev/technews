@extends('back.app')

@section('title', 'Dashboard - Profil')

@section('dashboard-header')
  <div class="row">
    <div class="col">
      <h3 class="page-title">Profil</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de Bord</a></li>
        <li class="breadcrumb-item active">Profil</li>
      </ul>
    </div>
  </div>
@endsection

@section('dashboard-content')
  <div class="row">
    <div class="col-md-12">
      <div class="profile-header ">
        <div class="row align-items-center">
          <div class="col-auto profile-image">
            <a href="#">
              <img class="rounded-circle" alt="User Image" src="{{ isset(Auth::user()->image) ? asset('storage/' . Auth::user()->image) : asset('back_auth/assets/img/no_image.jpg') }}">
            </a>
          </div>
          <div class="col ml-md-n2 profile-user-info">
            <h4 class="user-name mb-3">{{ Auth::user()->name }}</h4>
            <h6 class="text-muted mt-1">Admin</h6>
          </div>

        </div>
      </div>
      <div class="profile-menu">

        @php
            $active_tab = session('active_tab', 'about'); // "about" par défaut
        @endphp

        <ul class="nav nav-tabs nav-tabs-solid">
          <li class="nav-item">
            <a class="nav-link {{ $active_tab == 'about' ? 'active' : '' }} " data-toggle="tab" href="#per_details_tab">A propos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $active_tab == 'password' ? 'active' : '' }}" data-toggle="tab" href="#password_tab">Mot de passe</a>
          </li>
        </ul>
      </div>

      <div class="tab-content profile-tab-cont">
        {{-- A Propos --}}
        <div class="tab-pane fade {{ $active_tab == 'about' ? 'show active' : '' }}" id="per_details_tab">

          @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
          @endif

          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title d-flex justify-content-between">
                    <span>Informations Personnelles</span>
                    <a class="edit-link" data-toggle="modal" href="#edit_personal_details">
                      <i class="fa fa-edit mr-1"></i>Modifier
                    </a>
                  </h5>
                  <div class="row">
                    <p class="col-sm-3 font-weight-bold text-brown text-sm-right mb-0 mb-sm-3">Nom :</p>
                    <p class="col-sm-9">{{ Auth::user()->name }}</p>
                  </div>
                  <div class="row">
                    <p class="col-sm-3 font-weight-bold text-brown text-sm-right mb-0 mb-sm-3">Email :</p>
                    <p class="col-sm-9">
                      <a href="">{{ Auth::user()->email }}</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Modifier vos informations</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row form-row">
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>Nom</label>
                              <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                            </div>
                          </div>

                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                            </div>
                          </div>

                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>Photo de profil</label>
                              <input type="file" name="image" class="form-control" >
                            </div>
                          </div>


                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Enregistrer les modifications</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Mot de Passe --}}
        <div class="tab-pane fade {{ $active_tab == 'password' ? 'show active' : '' }}" id="password_tab">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Modifier le mot de passe</h5>
              <div class="row">
                <div class="col-md-10 col-lg-6">
                  <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                      <label>Ancien mot de passe</label>
                      <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                      @error('current_password')
                        <p class="fs-md text-danger mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Nouveau mot de passe</label>
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                      @error('password')
                        <p class="fs-md text-danger mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Confirmer mot de passe</label>
                      <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                      @error('password_confirmation')
                        <p class="fs-md text-danger mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Enregistrer les modifications</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

