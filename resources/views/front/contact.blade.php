@extends('front.app')

@section('title', 'Page de contact')

@section('main_section')
  <div class="section-title mb-0">
    <h4 class="m-0 text-uppercase font-weight-bold">
      Contactez nous !
    </h4>
  </div>
  <div class="bg-white border border-top-0 p-4 mb-3">
    <div class="mb-4">
      <h6 class="text-uppercase font-weight-bold">Nos contacts</h6>

      <div class="mb-3">
        <div class="d-flex align-items-center mb-2">
          <i class="fa fa-map-marker-alt text-info mr-2"></i>
          <h6 class="font-weight-bold mb-0">Notre siege</h6>
        </div>
        <p class="m-0">123 Street, New York, USA</p>
      </div>
      <div class="mb-3">
        <div class="d-flex align-items-center mb-2">
          <i class="fa fa-envelope-open text-info mr-2"></i>
          <h6 class="font-weight-bold mb-0">Envoyez nous un email</h6>
        </div>
        <p class="m-0">info@example.com</p>
      </div>
      <div class="mb-3">
        <div class="d-flex align-items-center mb-2">
          <i class="fa fa-phone-alt text-info mr-2"></i>
          <h6 class="font-weight-bold mb-0">Appelez-nous</h6>
        </div>
        <p class="m-0">+012 345 6789</p>
      </div>
    </div>
    <h6 class="text-uppercase font-weight-bold mb-3">
      Contactez-nous
    </h6>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{-- Formulaire --}}
    <form action="{{ route('contact.envoi') }}" method="POST">
      @csrf

      <div class="form-row">
        <div class="col-md-6">
          <div class="form-group">
            <input
              type="text"
              name="name"
              class="form-control p-4 @error('name') is-invalid @enderror"
              placeholder="Votre nom"
              required="required"
              value="{{ old('name') }}"
            />
            @error('name')
              <p class="text-danger fs-md">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input
              type="email"
              name="email"
              class="form-control p-4 @error('email') is-invalid @enderror"
              placeholder="Votre email"
              required="required"
              value="{{ old('email') }}"
            />
            @error('email')
              <p class="text-danger fs-md">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>
      <div class="form-group">
        <input
          type="text"
          name="subject"
          class="form-control p-4 @error('subject') is-invalid @enderror"
          placeholder="Sujet"
          required="required"
          value="{{ old('subject') }}"
        />
        @error('subject')
          <p class="text-danger fs-md">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-group">
        <textarea
          class="form-control @error('message') is-invalid @enderror"
          name="message"
          rows="4"
          placeholder="Message"
          required="required"
        >{{ old('$message') }}</textarea>
        @error('message')
          <p class="text-danger fs-md">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <button
          class="btn btn-info font-weight-semi-bold px-4"
          style="height: 50px"
          type="submit"
        >
          Envoyer un message
        </button>
      </div>
    </form>
  </div>
@endsection
