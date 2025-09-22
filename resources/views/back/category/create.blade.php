@extends('back.app')

@section('title', 'Dashboard - Créer une catégorie')

@section('dashboard-header')
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title mt-5">
        @if(isset($category)) Modifier @else Ajouter @endif
        une catégorie
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
                value="{{ isset($category) ? old('name', $category->name) : old('name') }}"
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
              >{{ isset($category) ? old('description', $category->description) : old('description') }}</textarea>
              @error('description')
                <p class="text-danger fs-md">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="isActive">Statut</label>
              <select class="form-control @error('isActive') is-invalid @enderror" id="isActive" name="isActive">
                <option @if(isset($category)) @selected($category->isActive == 1) @endif value="1">Activée</option>
                <option @if(isset($category)) @selected($category->isActive == 0) @endif value="0">Désactivée</option>
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
