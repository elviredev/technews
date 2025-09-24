@extends('back.app')

@section('title', 'Dashboard - Auteurs')

@section('dashboard-header')
  <div class="row align-items-center">
    <div class="col">
      <div class="mt-5">
        <h4 class="card-title float-left mt-2">Les Auteurs</h4>
        <a
          href="{{ route('author.create') }}"
          class="btn btn-primary float-right veiwbutton"
        >
          Ajouter un auteur
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
            <table
              class="datatable table table-stripped table table-hover table-center mb-0"
            >
              <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th class="text-right">Actions</th>
              </tr>
              </thead>
              <tbody>
              @foreach($authors as $author)
                <tr>
                  <td>AUT-00{{ $author->id }}</td>
                  <td>
                    <h2 class="table-avatar">
                      <a href="{{ route('profile.edit') }}" class="avatar avatar-sm mr-2">
                        <img
                          class="avatar-img rounded-circle"
                          src="{{ isset($author->image) ? asset('storage/' . $author->image) : asset('back_auth/assets/img/no_image.jpg') }}"
                          alt="User Image"
                        />
                      </a>
                      <a href="{{ route('profile.edit') }}">{{ $author->name }}</a>
                    </h2>
                  </td>

                  <td>{{ $author->email }}</td>

                  <td class="text-right">
                    <div class="dropdown dropdown-action">
                      <a
                        href="#"
                        class="action-icon dropdown-toggle"
                        data-toggle="dropdown"
                        aria-expanded="false"
                      >
                        <i class="fas fa-ellipsis-v ellipse_color"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('author.edit', $author) }}">
                          <i class="fas fa-pencil-alt m-r-5"></i>
                          Modifier
                        </a>
                        <button
                          class="dropdown-item text-danger"
                          data-toggle="modal"
                          data-target="#delete_asset_{{ $author->id }}">
                          <i class="fas fa-trash-alt m-r-5"></i> Supprimer
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>

                {{-- Modale --}}
                <div id="delete_asset_{{ $author->id }}" class="modal fade delete-modal" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-body text-center">
                        <img src="{{ asset('back_auth/assets/img/sent.png') }}" alt="" width="50" height="46" />
                        <h3 class="delete_class">
                          Etes vous sûr de vouloir supprimer cet auteur ?
                        </h3>
                        <div class="m-t-20">
                          <button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
                          <form action="{{ route('author.destroy', $author) }}" method="POST" style="display: inline;">
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
