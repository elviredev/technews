@extends('back.app')

@section('title', 'Dashboard - Ajouter un article')

@section('dashboard-header')
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="page-title mt-5">
          {{ isset($article) ? 'Modifier' : 'Créer' }} un article
        </h3>
      </div>
    </div>
  </div>
@endsection

@section('dashboard-content')
  <div class="row">
    <div class="col-lg-12">
      <form action="{{ isset($article) ? route('article.update', $article) : route('article.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($article)) @method('PUT') @endif

        <div class="row formtype">
          @if(isset($article))
            <div class="col-12 mb-3">
              <img src="{{ $article->imageUrl() }}" alt="{{ $article->title }}" style="width: 100%; height: 200px; object-fit: cover" >
            </div>
          @endif

          <div class="col-md-4">
            <div class="form-group">
              <label for="title">Titre de l'article</label>
              <input
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                type="text"
                value="{{ old('title', $article->title ?? '') }}"
              />
              @error('title')
                <p class="fs-md text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="category_id">Categorie</label>
              <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                @foreach($categories as $category)
                  <option
                    value="{{ $category->id }}"
                    @selected(old('category_id', $article->category_id ?? $categories->first()->id) == $category->id)
                  >
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
              @error('category_id')
                <p class="fs-md text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Uploader une image</label>
              <div class="custom-file mb-3">
                <input
                  type="file"
                  class="custom-file-input form-control @error('image') is-invalid @enderror"
                  id="customFile"
                  name="image"
                />
                @error('image')
                  <p class="fs-md text-danger">{{ $message }}</p>
                @enderror
                <label class="custom-file-label" for="customFile">Choisir une image</label>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="description">Description</label>
              <textarea
                class="form-control @error('description') is-invalid @enderror"
                rows="5"
                id="description"
                name="description">{{ old('description', $article->description ?? '') }}</textarea>
                @error('description')
                  <p class="fs-md text-danger">{{ $message }}</p>
                @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <h6>Publication</h6>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  id="article_active"
                  name="isActive"
                  value="1"
                  @checked(old('isActive', $article->isActive ?? 1) == 1)
                >
                <label class="form-check-label" for="article_active">Publier</label>
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  id="article_inactive"
                  name="isActive"
                  value="0"
                  @checked(old('isActive', $article->isActive ?? 1) == 0)
                >
                <label class="form-check-label" for="article_inactive">Ne pas publier</label>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <h6>Partages</h6>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  id="article_share_active"
                  name="isSharable"
                  value="1"
                  @checked(old('isSharable', $article->isSharable ?? 1) == 1)
                >
                <label class="form-check-label" for="article_share_active">Partageable</label>
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  id="article_share_inactive"
                  name="isSharable"
                  value="0"
                  @checked(old('isSharable', $article->isSharable ?? 1) == 0)
                >
                <label class="form-check-label" for="article_share_inactive">Non Partageable</label>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <h6>Commentaires</h6>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  id="article_comment_active"
                  name="isComment"
                  value="1"
                  @checked(old('isComment', $article->isComment ?? 1) == 1)
                >
                <label class="form-check-label" for="article_comment_active">Autorisé</label>
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  id="article_comment_inactive"
                  name="isComment"
                  value="0"
                  @checked(old('isComment', $article->isComment ?? 1) == 0)
                >
                <label class="form-check-label" for="article_comment_inactive">Non autorisé</label>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary buttonedit1">Enregistrer l'article</button>
        </div>

      </form>
    </div>
  </div>

  {{-- Mise à jour du label image lorsqu'une image est téléchargée  --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const fileInput = document.querySelector('.custom-file-input');
      const fileLabel = document.querySelector('.custom-file-label');

      if (fileInput) {
        fileInput.addEventListener('change', function (e) {
          let fileName = e.target.files[0]?.name || 'Choisir une image';
          fileLabel.textContent = fileName;
        });
      }
    });
  </script>
@endsection
