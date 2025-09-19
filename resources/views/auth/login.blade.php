@extends('auth.auth-layout')

@section('title', "Page de connexion")

@section('auth-form')

  <h1>Connexion</h1>
  <p class="account-subtitle">Accèder au dashboard</p>
  <form action="{{ route('login') }}" method="POST">
    @csrf

    <div class="form-group">
      <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
      @error('email')
        <p class="text-danger tw-text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group">
      <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Mot de passe">
      @error('password')
        <p class="text-danger tw-text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group">
      <button class="btn btn-primary btn-block" type="submit">Se connecter</button>
    </div>
  </form>
  <div class="text-center forgotpass"><a href="forgot-password.html">Mot de passe oublié?</a> </div>

  <div class="text-center dont-have">Vous n'avez pas de compte? <a href="{{ route('register') }}">S'inscrire</a></div>

@endsection
