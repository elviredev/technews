<div class="col-lg-4">
  <!-- Social Follow debut -->
  <div class="mb-3">
    <div class="section-title mb-0">
      <h4 class="m-0 text-uppercase font-weight-bold">Suivez Nous</h4>
    </div>
    <div class="bg-white border border-top-0 p-3">
      <a
        href=""
        class="d-block w-100 text-white text-decoration-none mb-3"
        style="background: #39569e"
      >
        <i class="fab fa-facebook-f text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, 0.2)"></i>
        <span class="font-weight-medium">12,345 Fans</span>
      </a>
      <a
        href=""
        class="d-block w-100 text-white text-decoration-none mb-3"
        style="background: #52aaf4"
      >
        <i class="fab fa-twitter text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, 0.2)"></i>
        <span class="font-weight-medium">12,345 Followers</span>
      </a>
      <a
        href=""
        class="d-block w-100 text-white text-decoration-none mb-3"
        style="background: #0185ae"
      >
        <i class="fab fa-linkedin-in text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, 0.2)"></i>
        <span class="font-weight-medium">12,345 Connects</span>
      </a>
      <a
        href=""
        class="d-block w-100 text-white text-decoration-none mb-3"
        style="background: #c8359d"
      >
        <i class="fab fa-instagram text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, 0.2)"></i>
        <span class="font-weight-medium">12,345 Followers</span>
      </a>
      <a
        href=""
        class="d-block w-100 text-white text-decoration-none mb-3"
        style="background: #dc472e"
      >
        <i class="fab fa-youtube text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, 0.2)"></i>
        <span class="font-weight-medium">12,345 Subscribers</span>
      </a>
      <a
        href=""
        class="d-block w-100 text-white text-decoration-none"
        style="background: #055570"
      >
        <i class="fab fa-vimeo-v text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, 0.2)"></i>
        <span class="font-weight-medium">12,345 Followers</span>
      </a>
    </div>
  </div>
  <!-- Social Follow fin -->

  <!-- Ads Start -->
  <div class="mb-3">
    <div class="section-title mb-0">
      <h4 class="m-0 text-uppercase font-weight-bold">
        Publicité
      </h4>
    </div>
    <div class="bg-white text-center border border-top-0 p-3">
      <a href="">
        <img class="img-fluid" src="{{ asset('front/img/news-800x500-2.jpg') }}" alt=""/>
      </a>
    </div>
  </div>
  <!-- Ads fin -->

  <!-- Recents News debut -->
  <div class="mb-3">
    <div class="section-title mb-0">
      <h4 class="m-0 text-uppercase font-weight-bold">Récents</h4>
    </div>

    <div class="bg-white border border-top-0 p-3">

      @foreach($global_recent_articles as $article)
        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px">
          <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-1">
            <div class="mb-2">
              <a
                class="badge badge-info text-uppercase font-weight-semi-bold p-1 mr-2"
                href="{{ route('category.articles', $article->category->slug) }}"
              >
                {{ $article->category->name }}
              </a>
              <p class="text-body d-inline">
                @php $time = $article->created_at @endphp
                <small> {{ $time->isoFormat('LL') }}</small>
              </p>
            </div>
            <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="{{ route('article.details', $article->slug) }}">
              {{ \Illuminate\Support\Str::limit($article->title, 40, '...') }}
            </a>
          </div>
        </div>
      @endforeach

    </div>
  </div>
  <!-- Recents News fin -->

  <!-- Newsletter debut -->
  <div class="mb-3">
    <div class="section-title mb-0">
      <h4 class="m-0 text-uppercase font-weight-bold">Newsletter</h4>
    </div>
    <div class="bg-white text-center border border-top-0 p-3">
      <p>
        Aliqu justo et labore at eirmod justo sea erat diam dolor diam
        vero kasd
      </p>
      <div class="input-group mb-2" style="width: 100%">
        <input
          type="text"
          class="form-control form-control-lg"
          placeholder="Votre Email"
        />
        <div class="input-group-append">
          <button class="btn btn-info font-weight-bold px-3">
            S'inscrire
          </button>
        </div>
      </div>
      <small>Lorem ipsum dolor sit amet elit</small>
    </div>
  </div>
  <!-- Newsletter fin -->

  <!-- Tags debut -->
  <div class="mb-3">
    <div class="section-title mb-0">
      <h4 class="m-0 text-uppercase font-weight-bold">Tags</h4>
    </div>
    <div class="bg-white border border-top-0 p-3">
      <div class="d-flex flex-wrap m-n1">
        @foreach($global_tags as $tag)
          <a href="{{ route('tag.articles', $tag->name) }}" class="btn btn-sm btn-outline-secondary m-1">{{ $tag->name }}</a>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Tags fin -->
</div>
