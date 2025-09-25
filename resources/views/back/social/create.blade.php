@extends('back.app')

@section('title', 'Dashboard - Ajouter/Modifier un média')

@section('dashboard-header')
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title mt-5">
        {{ isset($social) ? 'Modifier' : 'Ajouter' }} un réseau social
      </h3>
    </div>
  </div>
@endsection

@section('dashboard-content')
  <div class="row">
    <div class="col-lg-12">
      <form action="{{ isset($social) ? route('social.update', $social) : route('social.store') }}" method="POST">
        @csrf
        @if(isset($social)) @method('PUT') @endif

        <div class="row formtype">
          <div class="col-md-4">
            <div class="form-group">
              <label>Nom du réseau</label>
              <input
                class="form-control @error('name') is-invalid @enderror"
                type="text"
                name="name"
                value="{{ old('name', $social->name ?? '') }}"
              />
              @error('name')
                <p class="text-danger fs-md">{{ $message }}</p>
              @enderror
            </div>
          </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Lien</label>
            <input
              class="form-control @error('link') is-invalid @enderror"
              type="text"
              name="link"
              value="{{ old('link', $social->link ?? '') }}"
            />
            @error('link')
              <p class="text-danger fs-md">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Icon</label>
            <input
              class="form-control @error('icon') is-invalid @enderror"
              type="text"
              name="icon"
              value="{{ old('icon', $social->icon ?? '') }}"
            />
            @error('icon')
              <p class="text-danger fs-md">{{ $message }}</p>
            @enderror
          </div>
        </div>
        </div>

        <div class="mt-3 ml-2 text-start">
          <button type="submit" class="btn btn-primary ">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
@endsection
