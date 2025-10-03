@extends('front.app')

@section('breaking_news')
  <div class="container-fluid mt-5 mb-3 pt-3">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="d-flex justify-content-between">
            <div
              class="section-title border-right-0 mb-0"
              style="width: 180px"
            >
              <h4 class="m-0 text-uppercase font-weight-bold">Tranding</h4>
            </div>
            <div
              class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center bg-white border border-left-0"
              style="width: calc(100% - 180px); padding-right: 100px"
            >
              @foreach($global_recent_articles as $recent_article)
                <div class="text-truncate">
                  <a class="text-secondary text-uppercase font-weight-semi-bold" href="{{ route('article.details', $recent_article->slug) }}">
                    {{ $recent_article->title }}
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('main_section')
  <!-- News Detail Start -->
  <div class="position-relative mb-3">
    <img
      class="img-fluid w-100"
      src="{{ $article->imageUrl() }}"
      style="object-fit: cover"
    />
    <div class="bg-white border border-top-0 p-4">
      <div class="mb-3">
        <a class="badge badge-info text-uppercase font-weight-semi-bold p-2 mr-2" href="{{ route('category.articles', $article->category->slug) }}">{{ $article->category->name }}</a>
        <a class="text-body" href="">
          @php $time = $article->created_at @endphp
          {{ $time->isoFormat('LL') }}
        </a>
      </div>
      <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">
        {{ $article->title }}
      </h1>
      <p>{{ $article->description }}</p>
    </div>
    <div
      class="d-flex justify-content-between bg-white border border-top-0 p-4"
    >
      <div class="d-flex align-items-center">
        <img
          class="rounded-circle mr-2"
          src="{{ asset('storage/' . $article->author->image) }}"
          width="25"
          height="25"
          alt=""
        />
        <span>{{ $article->author->name }}</span>
      </div>
      <div class="d-flex align-items-center">
        <span class="ml-3"><i class="far fa-eye mr-2"></i>{{ $article->views }}</span>
        <span class="ml-3">
          <i class="far fa-comment mr-2"></i>{{ $article->comments->count() }}
        </span>
      </div>
    </div>
  </div>
  <!-- News Detail End -->

  <!-- Comment List Start -->
  @if($article->isComment)
    <div class="mb-3">
      <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">
          {{ $article->comments->count() }} commentaire{{ $article->comments->count() > 1 ? 's' : '' }}
        </h4>
      </div>
      <div class="bg-white border border-top-0 p-4">

          @forelse($article->comments as $comment)
            <div class="media mb-4">
              <img
                src="{{ asset('back_auth/assets/img/logo.png') }}"
                alt="Image"
                class="img-fluid mr-3 mt-1"
                style="width: 45px"
              />
              <div class="media-body">
                <h6>
                  <a class="text-secondary font-weight-bold" href="">{{ $comment->name }}</a>

                  <small>
                    <i>
                      @php $time = $comment->created_at @endphp
                      {{ $time->isoFormat('LL') }}
                    </i>
                  </small>
                </h6>
                <p>
                  {{ $comment->message }}
                </p>
              </div>
            </div>

          @empty
            <p>Pas encore de commentaire pour cet article.</p>
          @endforelse

      </div>
    </div>
  @endif

  <!-- Comment List End -->

  <!-- Comment Form Start -->
  <div class="mb-3">
    <div class="section-title mb-0">
      <h4 class="m-0 text-uppercase font-weight-bold">
        Laissez un commentaire
      </h4>
    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="bg-white border border-top-0 p-4">
      <form action="{{ route('article.comment', $article->id) }}" method="POST">
        @csrf

        <div class="form-row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="name">Nom *</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" />
              @error('name')
                <p class="text-danger fs-md">{{ $message }}</p>
              @enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="email">Email *</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" />
              @error('email')
                <p class="text-danger fs-md">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="website">Site web</label>
          <input type="url" class="form-control" id="website" name="website" value="{{ old('website') }}" />
        </div>

        <div class="form-group">
          <label for="message">Commentaire *</label>
          <textarea
            id="message"
            cols="30"
            rows="5"
            class="form-control @error('message') is-invalid @enderror"
            name="message"
          >{{ old('message') }}</textarea>
          @error('message')
            <p class="text-danger fs-md">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group mb-0">
          <input
            type="submit"
            value="Laissez un commentaires"
            class="btn btn-info font-weight-semi-bold py-2 px-3"
          />
        </div>
      </form>
    </div>
  </div>
  <!-- Comment Form End -->
@endsection
