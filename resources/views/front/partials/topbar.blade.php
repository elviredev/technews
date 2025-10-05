<div class="container-fluid d-none d-lg-block">
  <div class="row align-items-center bg-dark px-lg-5">
    <div class="col-lg-9">
      <nav class="navbar navbar-expand-sm bg-dark p-0">
        <ul class="navbar-nav ml-n2">
          <li class="nav-item border-right border-secondary">
            @php $time = \Carbon\Carbon::now() @endphp
            <a class="nav-link text-body small" href="#">
              {{ ucfirst($time->translatedFormat('l')) }}, {{ $time->isoFormat('LL') }}
            </a>
          </li>

          @auth
            @php $user = auth()->user(); @endphp

            {{-- Admin ou Author → Dashboard --}}
            @if($user->hasRole(['admin','author']))
              <li class="nav-item">
                <a class="nav-link text-body small" href="{{ route('dashboard') }}">Dashboard</a>
              </li>
            @endif

            {{-- Visitor → Logout seulement --}}
            @if($user->hasRole(['visitor']))
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="nav-link btn btn-link text-body small p-0 mt-1">Logout</button>
                </form>
              </li>
            @endif
          @else
            {{-- Utilisateur non connecté → Login --}}
            <li class="nav-item">
              <a class="nav-link text-body small" href="{{ route('login') }}">Login</a>
            </li>
          @endauth

        </ul>
      </nav>
    </div>
    <div class="col-lg-3 text-right d-none d-md-block">
      <nav class="navbar navbar-expand-sm bg-dark p-0">
        <ul class="navbar-nav ml-auto mr-n2">
          @forelse($global_socials as $item)
            <li class="nav-item">
              <a class="nav-link text-body" href="{{ $item->link }}">
                <small class="{{ $item->icon }}"></small>
              </a>
            </li>
          @empty
            {{-- Rien à afficher si pas de socials --}}
          @endforelse
        </ul>
      </nav>
    </div>
  </div>
  <div class="row align-items-center bg-white py-3 px-lg-5">
    <div class="col-lg-4">
      <a href="/" class="navbar-brand p-0 d-none d-lg-block">
        <h1 class="m-0 display-4 text-uppercase text-info">
          Tech<span class="text-secondary font-weight-normal">News</span>
        </h1>
      </a>
    </div>
    <div class="col-lg-8 text-center text-lg-right">
      <a href="https://freewebsitecode.com"><img class="img-fluid" src="{{ asset('front/img/ads-728x90.png') }}" alt=""/></a>
    </div>
  </div>
</div>
