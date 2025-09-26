@extends('back.app')

@section('title', 'Dashboard - Paramètres')


@section('dashboard-content')
  <div class="row">
    <div class="col-lg-12">
      <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h3 class="page-title">Paramètres de base</h3>
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="form-group">
              <label>Nom du site <span class="text-danger">*</span></label>
              <input
                class="form-control @error('web_site_name') is-invalid @enderror"
                name="web_site_name"
                type="text"
                value="{{ old('web_site_name', $settings->web_site_name ?? '') }}"
              />
              @error('web_site_name')
                <p class="fs-md text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Uploader un logo</label>
              <div class="custom-file mb-3">
                <input
                  type="file"
                  class="custom-file-input"
                  id="customFile"
                  name="logo"
                />
                <label class="custom-file-label" for="customFile">Choisir un logo</label>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Adresse</label>
              <input
                class="form-control "
                type="text"
                name="address"
                value="{{ old('address', $settings->address ?? '') }}"
              />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Téléphone</label>
              <input
                class="form-control "
                type="text"
                name="phone"
                value="{{ old('phone', $settings->phone ?? '') }}"
              />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Email</label>
              <input
                class="form-control "
                type="email"
                name="email"
                value="{{ old('email', $settings->email ?? '') }}"
              />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Description <span class="text-danger">*</span></label>
              <textarea
                class="form-control @error('about') is-invalid @enderror"
                rows="5"
                id="comment"
                name="about"
              >{{ old('about', $settings->about ?? '') }}</textarea>
              @error('about')
                <p class="fs-md text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <button type="submit" class="btn btn-primary buttonedit1">Enregistrer les modifications</button>

        </div>
      </form>
    </div>
  </div>

  {{-- Mise à jour du label logo lorsqu'un logo est téléchargé  --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const fileInput = document.querySelector('.custom-file-input');
      const fileLabel = document.querySelector('.custom-file-label');

      if (fileInput) {
        fileInput.addEventListener('change', function (e) {
          let fileName = e.target.files[0]?.name || 'Choisir un logo';
          fileLabel.textContent = fileName;
        });
      }
    });
  </script>
@endsection
