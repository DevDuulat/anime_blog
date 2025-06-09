@extends('layouts.app')

@section('content')
<section class="product-page spad">
  <div class="container">
    <div class="row">
      <!-- Основной контент -->
      <div class="col-lg-8">
        <div class="product__page__content">
          <div class="product__page__title">
            <div class="row mb-3">
              <div class="col-12">
                <h4>Результаты поиска по запросу: "{{ $query }}"</h4>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- Результаты MediaItems -->
            @foreach($mediaItems as $media)
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $media->image) }}">
                  <div class="ep">{{ $media->type }}</div>
                  <div class="view"><i class="fa fa-eye"></i> {{ $media->views }}</div>
                </div>
                <div class="product__item__text">
                  <ul>
                    <li>{{ optional($media->category)->name }}</li>
                  </ul>
                  <h5><a href="{{ route('media.show', $media->slug) }}">{{ $media->title }}</a></h5>
                </div>
              </div>
            </div>
            @endforeach

            <!-- Результаты Post -->
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $post->image) }}">
                  <div class="view"><i class="fa fa-eye"></i> {{ $post->views ?? 0 }}</div>
                </div>
                <div class="product__item__text">
                  <ul>
                    <li>{{ optional($post->category)->name }}</li>
                  </ul>
                  <h5><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h5>
                </div>
              </div>
            </div>
            @endforeach

            @if($mediaItems->isEmpty() && $posts->isEmpty())
            <div class="col-12">
              <p>По вашему запросу ничего не найдено.</p>
            </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4 col-md-6 col-sm-8">
        <div class="product__sidebar">
          <div class="product__sidebar__view">
            <div class="section-title">
              <h5>Последние посты</h5>
            </div>
            <div class="filter__gallery">
              @foreach($blogPosts ?? [] as $post)
              <div class="product__sidebar__view__item set-bg" data-setbg="{{ asset('storage/' . $post->image) }}">
                <div class="ep">{{ optional($post->category)->name }}</div>
                <div class="view"><i class="fa fa-eye"></i> {{ $post->views ?? 0 }}</div>
                <h5><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h5>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->
    </div>
  </div>
</section>
@endsection