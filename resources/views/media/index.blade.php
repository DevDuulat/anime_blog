@extends('layouts.app')

@section('content')
<section class="product-page spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="product__page__content">
          <div class="product__page__title">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-6">
                <div class="section-title">
                  <h4>
                    {{ isset($category) ? $category->name : 'Все медиа' }}
                  </h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="product__page__filter">
                  <p>Сортировать по:</p>
                  <form method="GET">
                    <select name="sort" onchange="this.form.submit()">
                      <option value="title" {{ request('sort')=='title' ? 'selected' : '' }}>A-Z</option>
                      <option value="views" {{ request('sort')=='views' ? 'selected' : '' }}>Просмотры</option>
                      <option value="created_at" {{ request('sort')=='created_at' ? 'selected' : '' }}>Сначала новые
                      </option>
                    </select>
                  </form>
                </div>
              </div>
            </div>
          </div>

          @if(isset($category) && $category->children->isNotEmpty())
          <ul class="blog-filter__controls">
            @foreach($category->children as $child)
            <li class="blog-dropdown-toggle">
              <a href="{{ route('category.show', $child->slug) }}">{{ $child->name }}</a>
            </li>
            @endforeach
          </ul>
          @endif

          <div class="row">
            @forelse($mediaItems as $media)
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $media->image) }}">
                  <div class="ep">{{ $media->type }}</div>
                  <div class="comment"><i class="fa fa-comments"></i> {{ $media->comments_count ?? 0 }}</div>
                  <div class="view"><i class="fa fa-eye"></i> {{ $media->views }}</div>
                </div>
                <div class="product__item__text">
                  <ul>
                    <li>{{ $media->category->name ?? 'Без категории' }}</li>
                  </ul>
                  <h5>
                    <a href="{{ route('media.show', $media->slug) }}">{{ $media->title }}</a>
                  </h5>
                </div>
              </div>
            </div>
            @empty
            <div class="col-12 text-white">
              <p>Нет медиафайлов{{ isset($category) ? ' в этой категории' : '' }}.</p>
            </div>
            @endforelse
          </div>

          <div class="product__pagination">
            {{ $mediaItems->appends(request()->input())->links() }}
          </div>
        </div>
      </div>

      {{-- Sidebar --}}
      <div class="col-lg-4 col-md-6 col-sm-8">
        <div class="product__sidebar">
          <div class="product__sidebar__view">
            <div class="section-title">
              <h5>Наш Блог</h5>
            </div>
            <div class="filter__gallery">
              @foreach($blogPosts as $post)
              <div class="product__sidebar__view__item set-bg" data-setbg="{{ asset('storage/' . $post->image) }}">
                <div class="ep">{{ $post->category->name }}</div>
                <div class="view"><i class="fa fa-eye"></i> {{ $post->views }}</div>
                <h5><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h5>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      {{-- End Sidebar --}}
    </div>
  </div>
</section>
@endsection