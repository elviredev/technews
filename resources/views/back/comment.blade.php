@extends('back.app')

@section('title', 'Dashboard - Commentaires')

@section('dashboard-header')
  <div class="row align-items-center">
    <div class="col">
      <div class="mt-5">
        <h4 class="card-title float-left mt-2">Commentaires</h4>
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
                <th>ID Comentaire</th>
                <th>Auteur</th>
                <th>Article</th>
                <th>Message</th>
                <th>Date</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
              </tr>
              </thead>
              <tbody>

              @foreach($comments as $comment)
                <tr>
                  <td>COM-00{{ $comment->id }}</td>
                  <td>
                    <h2 class="table-avatar">
                      <a href="" class="avatar avatar-sm mr-2">
                        <img
                          class="avatar-img rounded-circle"
                          src="{{ asset('back_auth/assets/img/logo.png') }}"
                          alt="Logo"
                        />
                      </a>
                    <a href="">{{ $comment->name }}</a>
                    </h2>
                  </td>
                  <td>{{ $comment->article->title }}</td>
                  <td>{{ $comment->message }}</td>
                  <td>
                    @php $time = $comment->created_at @endphp
                    {{ $time->isoFormat('LL') }}
                  </td>

                  <td>
                    <span class="badge badge-pill {{ $comment->isActive == 1 ? 'inv-badge' : 'inv-badge-default' }}">
                      {{ $comment->isActive == 1 ? 'Activé' : 'Désactivé' }}
                    </span>
                  </td>

                  <td class="text-right">
                    <div class="dropdown dropdown-action">
                      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v ellipse_color"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">

                          <form
                            action="{{ $comment->isActive == 1 ? route('comment.update', $comment) : route('comment.unlock', $comment) }}"
                            method="POST"
                          >
                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn">
                              <i class="fas fa-pencil-alt m-r-5"></i> @if($comment->isActive == 1) Bloquer @else Débloquer @endif
                            </button>
                          </form>

                        </a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_asset">
                          <form action="{{ route('comment.destroy', $comment) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn text-danger">
                              <i class="fas fa-trash-alt m-r-5"></i> Supprimer
                            </button>
                          </form>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
