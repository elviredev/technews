@extends('back.app')

@section('title', 'Dashboard - Ajouter/Modifier un auteur ')

@section('dashboard-header')
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title mt-5">Ajouter un auteur</h3>
    </div>
  </div>
@endsection

@section('dashboard-content')
  <div class="row">
    <div class="col-lg-12">
      <form action="{{ route('author.store') }}" method="POST">
        @csrf

        <div class="row formtype">
          <div class="col-md-4">
            <div class="form-group">
              <label>Nom</label>
              <input
                class="form-control @error('name') is-invalid @enderror"
                type="text"
                name="name"
                value="{{ old('name') }}"
              />
              @error('name')
                <p class="text-danger fs-md">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Email</label>
              <input
                class="form-control @error('email') is-invalid @enderror"
                type="email"
                name="email"
                value="{{ old('email') }}"
              />
              @error('email')
                <p class="text-danger fs-md">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <!-- Bouton à gauche en bas -->
        <div class="mt-3 ml-2 text-start">
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
@endsection
