<div class="container-fluid bg-dark pt-5 px-sm-3 px-md-5 mt-5">
  <div class="row py-4">
    <div class="col-lg-3 col-md-6 mb-5">
      <h5 class="mb-4 text-white text-uppercase font-weight-bold">
        Contactez nous
      </h5>
      <p class="font-weight-medium">
        <i class="fa fa-map-marker-alt mr-2"></i>{{ $global_settings->address }}
      </p>
      <p class="font-weight-medium">
        <i class="fa fa-phone-alt mr-2"></i>{{ $global_settings->phone }}
      </p>
      <p class="font-weight-medium">
        <i class="fa fa-envelope mr-2"></i>{{ $global_settings->email }}
      </p>
      <h6 class="mt-4 mb-3 text-white text-uppercase font-weight-bold">
        Suivez nous
      </h6>
      <div class="d-flex justify-content-start">
        @foreach($global_socials as $item)
            <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href="{{ $item->link }}">
              <i class="{{ $item->icon }}"></i>
            </a>
        @endforeach
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <h5 class="mb-4 text-white text-uppercase font-weight-bold">
        Infos Populaires
      </h5>
      @foreach($global_popular_articles as $popular_article)
        <div class="mb-3">
          <div class="mb-2">
            <a
              class="badge badge-info text-uppercase font-weight-semi-bold p-1 mr-2"
              href="{{ route('category.articles', $popular_article->category->slug) }}"
            >
              {{ $popular_article->category->name }}
            </a>
            <p class="text-body d-inline">
              @php $time = $popular_article->created_at @endphp
              <small>{{ $time->isoFormat('LL') }}</small>
            </p>
          </div>
          <a
            class="small text-body text-uppercase font-weight-medium"
            href="{{ route('article.details', $popular_article->slug) }}"
          >
            {{ $popular_article->title }}
          </a>
        </div>
      @endforeach

    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <h5 class="mb-4 text-white text-uppercase font-weight-bold">
        Catégories
      </h5>
      <div class="m-n1">
        @foreach($global_categories as $category)
          <a
            href="{{ route('category.articles', $category->slug) }}"
            class="btn btn-sm btn-secondary m-1"
          >
            {{ $category->name }}
          </a>
        @endforeach
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <h5 class="mb-4 text-white text-uppercase font-weight-bold">
        Flickr Photos
      </h5>
      <div class="row">
        @foreach($global_recent_articles as $article)
          <div class="col-4 mb-3">
            <a href="{{ route('article.details', $article->slug) }}">
              <img src="{{ $article->imageUrl() }}" style="width: 80px; height: 64px; object-fit: cover;" alt=""/>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div
  class="container-fluid py-4 px-sm-3 px-md-5"
  style="background: #111111"
>
  <p class="m-0 text-center">
    &copy; <a href="#">{{ $global_settings->web_site_name }}</a>. Tous droits réservés. Design par
    <a href="https://freewebsitecode.com">Freewebsitecode</a><br />
  </p>
</div>
