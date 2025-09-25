@extends('back.app')

@section('title', 'Dashboard - Réseaux Sociaux')

@section('dashboard-header')
  <div class="row align-items-center">
    <div class="col">
      <div class="mt-5">
        <h4 class="card-title float-left mt-2">Réseaux Sociaux</h4>
        <a
          href="{{ route('social.create') }}"
          class="btn btn-primary float-right veiwbutton"
        >
          Ajouter un réseau social
        </a>
      </div>
    </div>
  </div>
@endsection

@section('dashboard-content')
  <div class="row">
    <div class="col-sm-12">
      <div class="card card-table">
        <div class="card-body booking_card">
          <div class="table-responsive">
            <table class="datatable table table-stripped table table-hover table-center mb-0">
              <thead>
              <tr>
                <th>ID Media</th>
                <th>Icon</th>
                <th>Nom</th>
                <th>Lien</th>
                <th class="text-right">Actions</th>
              </tr>
              </thead>
              <tbody>
              @foreach($socials as $social)
                <tr>
                  <td>LIEN-00{{ $social->id }}</td>
                  <td><i class="{{ $social->icon }}"></i></td>
                  <td>{{ $social->name }}</td>
                  <td><a href="">{{ $social->link }}</a></td>
                  <td class="text-right">
                    <div class="dropdown dropdown-action">
                      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v ellipse_color"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('social.edit', $social) }}">
                          <i class="fas fa-pencil-alt m-r-5"></i> Modifier
                        </a>
                        <button
                          class="dropdown-item text-danger"
                          data-toggle="modal"
                          data-target="#delete_asset_{{ $social->id }}">
                          <i class="fas fa-trash-alt m-r-5"></i> Supprimer
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>

                {{-- Modale --}}
                <div id="delete_asset_{{ $social->id }}" class="modal fade delete-modal" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-body text-center">
                        <img src="{{ asset('back_auth/assets/img/sent.png') }}" alt="" width="50" height="46" />
                        <h3 class="delete_class">
                          Etes vous sûr de vouloir supprimer ce réseau social ?
                        </h3>
                        <div class="m-t-20">
                          <button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
                          <form action="{{ route('social.destroy', $social) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Supprimer</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
