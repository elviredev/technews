@extends('back.app')

@section('title', 'Dashboard - Articles')

@section('dashboard-header')
  <div class="row align-items-center">
    <div class="col">
      <div class="mt-5">
        <h4 class="card-title float-left mt-2">Articles</h4>
        <a href="{{ route('article.create') }}" class="btn btn-primary float-right veiwbutton ">Ajouter un article</a>
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
                <th>ID Article</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Date</th>
                <th>Publication</th>
                <th>Partage</th>
                <th>Commentaires</th>
                <th>Auteur</th>
                <th class="text-right">Actions</th>
              </tr>
              </thead>
              <tbody>
              @foreach($articles as $article)
                <tr>
                  <td>ART-00{{ $article->id }}</td>
                  <td>
                    <img src="{{ $article->imageUrl() }}" alt="{{ $article->title }}" style="width: 64px; height: 64px; object-fit: contain">
                  </td>
                  <td>{{ $article->title }}</td>
                  <td>{{ $article->category->name }}</td>
                  <td>{{ $article->created_at->format('d-m-Y') }}</td>
                  <td>
                    <div class="actions">
                      @if($article->isActive == 1)
                        <a href="#" class="btn btn-sm bg-success-light mr-2">Publié</a>
                      @else
                        <a href="#" class="btn btn-sm bg-default-light mr-2">Non Publié</a>
                      @endif
                    </div>
                  </td>
                  <td>
                    <div class="actions">
                      @if($article->isSharable == 1)
                        <a href="#" class="btn btn-sm bg-success-light mr-2">Activé</a>
                      @else
                        <a href="#" class="btn btn-sm bg-default-light mr-2">Désactivé</a>
                      @endif
                    </div>
                  </td>
                  <td>
                    <div class="actions">
                      @if($article->isComment == 1)
                        <a href="#" class="btn btn-sm bg-success-light mr-2">Activé</a>
                      @else
                        <a href="#" class="btn btn-sm bg-default-light mr-2">Désactivé</a>
                      @endif
                    </div>
                  </td>
                  <td>
                    <h2 class="table-avatar">
                      <a href="{{ route('profile.edit') }}" class="avatar avatar-sm mr-2">
                        <img class="avatar-img rounded-circle" src="{{ asset('storage/' . $article->author->image) }}" alt="User Image">
                      </a>
                      <a href="{{ route('profile.edit') }}">{{ $article->author->name }} <span>#00{{ $article->author->id }}</span></a>
                    </h2>
                  </td>
                  <td class="text-right">
                    <div class="dropdown dropdown-action">
                      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('article.show', $article) }}">
                          <i class="fas fa-eye m-r-5"></i> Voir
                        </a>
                        <a class="dropdown-item" href="{{ route('article.edit', $article) }}">
                          <i class="fas fa-pencil-alt m-r-5"></i> Modifier
                        </a>
                        <button
                          class="dropdown-item text-danger"
                          data-toggle="modal"
                          data-target="#delete_asset_{{ $article->id }}">
                          <i class="fas fa-trash-alt m-r-5"></i> Supprimer
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>

                {{-- Modale --}}
                <div id="delete_asset_{{ $article->id }}" class="modal fade delete-modal" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-body text-center">
                        <img src="{{ asset('back_auth/assets/img/sent.png') }}" alt="" width="50" height="46" />
                        <h3 class="delete_class">
                          Etes vous sûr de vouloir supprimer cet article ?
                        </h3>
                        <div class="m-t-20">
                          <button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
                          <form action="{{ route('article.destroy', $article) }}" method="POST" style="display: inline;">
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


