<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"/>
  <title>@yield('title')</title>

  {{-- Dashboard Links CSS --}}
    @include('back.partials.styles')
  {{-- Fin Dashbord Links CSS --}}
</head>

<body>
{{-- Main wrapper --}}
<div class="main-wrapper">

    {{-- Debut Header --}}
    @include('back.partials.header')
    {{-- Fin Header --}}


    {{-- Debut Sidebar --}}
    @include('back.partials.sidebar')
    {{-- Fin Sidebar --}}


  {{-- Contenu de la page --}}
  <div class="page-wrapper">
    <div class="content container-fluid">

      <div class="page-header mt-5">
        @yield('dashboard-header')
      </div>

      @yield('dashboard-content')

    </div>
  </div>
  {{-- Fin Contenu de la page --}}

</div>
{{-- Fin Main wrapper --}}

  {{-- Scripts dashboard --}}
  @include('back.partials.scripts')
  {{-- Fin Script Dashboard --}}

{{-- Alertes flottantes iziToast --}}
@if(session()->get('error'))
  <script>
    iziToast.error({
      title: 'Erreur',
      position: 'topRight',
      message: '{{ session()->get('error') }}'
    })
  </script>
@endif

@if(session()->get('success'))
  <script>
    iziToast.success({
      title: 'Succès',
      position: 'topRight',
      message: '{{ session()->get('success') }}'
    })
  </script>
@endif
</body>
</html>

