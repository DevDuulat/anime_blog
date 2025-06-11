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
                <h4 class="text-white">Результаты поиска по запросу: "{{ $query }}"</h4>
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
              <p class="text-white">По вашему запросу ничего не найдено.</p>
            </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <x-blog-sidebar :posts="$posts" title="Последние статьи" :showFilters="true" />
      <!-- End Sidebar -->
    </div>
  </div>
</section>
@endsection