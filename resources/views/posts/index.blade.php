@extends('layouts.app')


@section('content')
<!-- Blog Section Begin -->
<section class="blog spad">
  <div class="container">
    <div class="row">
      <!-- Первый блок с левой стороны -->
      <div class="col-lg-6">
        <div class="row">
          @foreach($posts->take(ceil($posts->count()/2)) as $post)
          @if($loop->first)
          <!-- Первый пост (большой) -->
          <div class="col-lg-12">
            <div class="blog__item set-bg" data-setbg="{{ asset('storage/' . $post->image) }}">
              <div class="blog__item__text">
                <p><span class="icon_calendar"></span> {{ $post->created_at->format('d M Y') }}</p>
                <h4>
                  <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </h4>
              </div>
            </div>
          </div>
          @elseif($loop->iteration <= 3) <!-- Следующие 2 маленьких поста -->
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="blog__item small__item set-bg" data-setbg="{{ asset('storage/' . $post->image) }}">
                <div class="blog__item__text">
                  <p><span class="icon_calendar"></span> {{ $post->created_at->format('d M Y') }}</p>
                  <h4><a href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 40) }}</a></h4>
                </div>
              </div>
            </div>
            @endif
            @endforeach
        </div>
      </div>

      <!-- Второй блок с правой стороны -->
      <div class="col-lg-6">
        <div class="row">
          @foreach($posts->slice(ceil($posts->count()/2)) as $post)
          @if($loop->first)
          <!-- Первый пост в правой колонке (маленький) -->
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="blog__item small__item set-bg" data-setbg="{{ asset('storage/' . $post->image) }}">
              <div class="blog__item__text">
                <p><span class="icon_calendar"></span> {{ $post->created_at->format('d M Y') }}</p>
                <h4><a href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 40) }}</a></h4>
              </div>
            </div>
          </div>
          @elseif($loop->iteration == 2)
          <!-- Второй пост в правой колонке (маленький) -->
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="blog__item small__item set-bg" data-setbg="{{ asset('storage/' . $post->image) }}">
              <div class="blog__item__text">
                <p><span class="icon_calendar"></span> {{ $post->created_at->format('d M Y') }}</p>
                <h4><a href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 40) }}</a></h4>
              </div>
            </div>
          </div>
          @else
          <!-- Остальные посты -->
          <div class="col-lg-{{ $loop->iteration % 2 == 0 ? '6' : '12' }} col-md-6 col-sm-6">
            <div class="blog__item {{ $loop->iteration % 2 == 0 ? 'small__item' : '' }} set-bg"
              data-setbg="{{ asset('storage/' . $post->image) }}">
              <div class="blog__item__text">
                <p><span class="icon_calendar"></span> {{ $post->created_at->format('d M Y') }}</p>
                <h4><a href="{{ route('posts.show', $post->slug) }}">{{ $loop->iteration % 2 == 0 ?
                    Str::limit($post->title, 40) : $post->title }}</a></h4>
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>

    <!-- Пагинация -->
    <div class="row mt-4">
      <div class="col-lg-12">
        {{ $posts->links() }}
      </div>
    </div>
  </div>
</section>
<!-- Blog Section End -->
@endsection