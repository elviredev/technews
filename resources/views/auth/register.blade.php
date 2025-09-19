@extends('auth.auth-layout')

@section('title', "Page d'inscription")

@section('auth-form')

  <h1 class="mb-3">S'inscrire</h1>
  <form action="{{ route('register') }}" method="POST">
    @csrf

    <div class="form-group">
      <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Nom">
      @error('name')
        <tw-p class="text-danger tw-text-sm mt-1">{{ $message }}</tw-p>
      @enderror
    </div>
    <div class="form-group">
      <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
      @error('email')
        <tw-p class="text-danger tw-text-sm mt-1">{{ $message }}</tw-p>
      @enderror
    </div>
    <div class="form-group">
      <input class="form-control @error('tw-password') is-invalid @enderror" type="password" name="tw-password" placeholder="Mot de passe">
      @error('tw-password')
        <tw-p class="text-danger tw-text-sm mt-1">{{ $message }}</tw-p>
      @enderror
    </div>
    <div class="form-group">
      <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirmer Mot de passe">
      @error('password_confirmation')
        <tw-p class="text-danger tw-text-sm mt-1">{{ $message }}</tw-p>
      @enderror
    </div>
    <div class="form-group tw-mb-0">
      <button class="btn btn-primary btn-block" type="submit">S'inscrire</button>
    </div>
  </form>

  <div class="text-center dont-have">Vous avez deja un compte? <a href="login.html">Se connecter</a> </div>

@endsection
