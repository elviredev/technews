<link
  rel="shortcut icon"
  type="image/x-icon"
  href="{{ asset('back_auth/assets/img/logo.png') }}"
/>
<link rel="stylesheet" href="{{ asset('back_auth/assets/css/bootstrap.min.css') }}" />
<link
  rel="stylesheet"
  href="{{ asset('back_auth/assets/plugins/fontawesome/css/fontawesome.min.css') }}"
/>
<link rel="stylesheet" href="{{ asset('back_auth/assets/plugins/fontawesome/css/all.min.css') }}" />
<link rel="stylesheet" href="{{ asset('back_auth/assets/css/feathericon.min.css') }}" />
<link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css" />
<link rel="stylesheet" href="{{ asset('back_auth/assets/plugins/morris/morris.css') }}" />
<link rel="stylesheet" href="{{ asset('back_auth/assets/css/style.css') }}" />

{{-- iziToast--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}

<style>
  /* Style du conteneur généré par bootstrap-tagsinput */
  .bootstrap-tagsinput {
    display: block !important;   /* au lieu de inline-block */
    width: 100% !important;      /* occupe toute la largeur */
    min-width: 0;                /* important dans les flexbox */
    box-sizing: border-box;
    padding: 0.375rem 0.75rem;   /* même padding qu'un .form-control */
    border: 1px solid #ced4da;   /* même bordure qu'un input */
    border-radius: 0.375rem;     /* idem */
    background-color: #fff;
    line-height: 1.5;
  }

  /* Style des tags */
  .bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: #ffffff;
    background: #2196f3;
    padding: 3px 7px;
    border-radius: 3px;
    display: inline-block;
  }

  /* Croix de suppression */
  .bootstrap-tagsinput .tag [data-role="remove"] {
    margin-left: 5px;
    cursor: pointer;
  }

  .bootstrap-tagsinput .tag [data-role="remove"]:after {
    content: "×"; /* caractère croix */
    padding: 0 2px;
  }

  .bootstrap-tagsinput .tag [data-role="remove"]:hover {
    color: #ff0000; /* rouge au survol */
  }

  /* Input interne du plugin */
  .bootstrap-tagsinput input {
    border: none;
    outline: none;
    background: transparent;
    box-shadow: none;
    width: auto !important;  /* pas fixe, s'adapte */
    min-width: 100px;        /* largeur min quand vide */
    flex: 1;                 /* s'étend dans le conteneur */
  }
</style>
