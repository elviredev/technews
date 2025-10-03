@extends('front.app')

@section('main_section')
  <div class="row">

    @foreach($articles as $article)
      <div class="col-lg-6">
        <div class="position-relative mb-3">
          <img
            class="img-fluid w-100"
            src="{{ $article->imageUrl() }}"
            style="object-fit: cover"
          />
          <div class="bg-white border border-top-0 p-4">
            <a
              class="badge badge-info text-uppercase font-weight-semi-bold p-2 mb-2"
              href="{{ route('category.articles', $article->category->slug) }}"
            >
              {{ $article->category->name }}
            </a>
            <div class="mb-2">
              <p class="text-body">
                @php $time = $article->created_at @endphp
                <small>{{ $time->isoFormat('LL') }}</small>
              </p>
            </div>
            <a
              class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
              href="{{ route('article.details', $article->slug) }}"
            >
              {{ $article->title }}
            </a>
          </div>
          <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
            <div class="d-flex align-items-center">
              <img
                class="rounded-circle mr-2"
                src="{{ asset('storage/' . $article->author->image) }}"
                width="25"
                height="25"
                alt="Image Auteur"
              />
              <small>{{ $article->author->name }}</small>
            </div>
            <div class="d-flex align-items-center">
              <small class="ml-3"><i class="far fa-eye mr-2"></i>{{ $article->views }}</small>
              <small class="ml-3"><i class="far fa-comment mr-2"></i>{{ $article->comments->count() }}</small>
            </div>
          </div>
        </div>
      </div>
    @endforeach

  </div>
@endsection

