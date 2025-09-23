@extends('back.app')

@section('title', 'Dashboard - Créer une catégorie')

@section('dashboard-header')
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title mt-5">
        {{ isset($category) ? 'Modifier' : 'Créer' }} une catégorie
      </h3>
    </div>
  </div>
@endsection


@section('dashboard-content')
  <div class="row">
    <div class="col-lg-12">
      <form action="{{ isset($category) ? route('category.update', $category) : route('category.store') }}" method="POST">
        @csrf
        @if(isset($category))
          @method('PUT')
        @endif

        <div class="row formtype">
          <div class="col-md-4">
            <div class="form-group">
              <label for="name">Nom de la categorie</label>
              <input
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $category->name ?? '') }}"
              />
              @error('name')
                <p class="text-danger fs-md">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="description">Description</label>
              <textarea
                class="form-control @error('description') is-invalid @enderror"
                rows="5"
                id="description"
                name="description"
              >{{ old('description', $category->description ?? '') }}</textarea>
              @error('description')
                <p class="text-danger fs-md">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="isActive">Statut</label>
              <select class="form-control @error('isActive') is-invalid @enderror" id="isActive" name="isActive">
                <option value="1" @selected(old('isActive', $category->isActive ?? 1) == 1)>
                  Activée
                </option>
                <option value="0" @selected(old('isActive', $category->isActive ?? 1) == 0)>
                  Désactivée
                </option>
              </select>
              @error('isActive')
                <p class="text-danger fs-md">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary buttonedit1">
          Enregistrer
        </button>
      </form>
    </div>
  </div>
@endsection
