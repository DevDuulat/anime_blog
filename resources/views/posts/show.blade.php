@extends('layouts.app')

@section('title', $post->title)

@section('content')
<section class="blog-details spad">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-8">
        <div class="blog__details__title">
          <h6>{{ $post->category->name ?? 'Без категории' }} <span>- {{ $post->created_at->format('F d, Y') }}</span>
          </h6>
          <h2>{{ $post->title }}</h2>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="blog__details__pic">
          <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" />
        </div>
      </div>

      <div class="col-lg-8">
        <div class="blog__details__content">
          <div class="blog__details__text text-white">
            {!! nl2br(e($post->content)) !!}
          </div>

          <div class="blog__details__tags mt-4">
            <a href="#">{{ $post->category->name ?? 'Без категории' }}</a>
          </div>

          {{-- Пример соседних постов: нужно реализовать логику prev/next --}}
          <div class="blog__details__btns">
            <div class="row">
              <div class="col-lg-6">
                @if($prev)
                <div class="blog__details__btns__item">
                  <h5>
                    <a href="{{ route('posts.show', $prev->slug) }}">
                      <span class="arrow_left"></span> {{ Str::limit($prev->title, 40) }}
                    </a>
                  </h5>
                </div>
                @endif
              </div>
              <div class="col-lg-6">
                @if($next)
                <div class="blog__details__btns__item next__btn">
                  <h5>
                    <a href="{{ route('posts.show', $next->slug) }}">
                      {{ Str::limit($next->title, 40) }} <span class="arrow_right"></span>
                    </a>
                  </h5>
                </div>
                @endif
              </div>
            </div>
          </div>


          {{-- Комментарии --}}
          <div class="blog__details__comment">
            <h4>{{ $post->comments->count() }} комментариев</h4>

            @foreach ($post->comments as $comment)
            <div class="blog__details__comment__item">
              <div class="blog__details__comment__item__pic">
                <img src="{{ $comment->user->avatar_url ?? asset('img/user-default.png') }}" style="width:100px"
                  alt="{{ $comment->user->name ?? 'User' }}" />
              </div>

              <div class="blog__details__comment__item__text">
                <span>{{ $comment->created_at->format('F d, Y') }}</span>
                <h5>{{ $comment->user->name ?? 'Аноним' }}</h5>
                <p>{{ $comment->content }}</p>
              </div>
            </div>
            @endforeach
          </div>

          {{-- Форма комментария --}}
          @auth
          <div class="blog__details__form">
            <h4>Оставить комментарий</h4>
            <form action="{{ route('posts.comments.store', $post->slug) }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-lg-6">
                  <input type="text" placeholder="Имя" name="name" required value="{{ auth()->user()->name }}" />
                </div>
                <div class="col-lg-6">
                  <input type="email" placeholder="Email" name="email" required value="{{ auth()->user()->email }}" />
                </div>
                <div class="col-lg-12">
                  <textarea placeholder="Текст комментария" name="comment" required></textarea>
                  <button type="submit" class="site-btn">Оставить комментарий</button>
                </div>
              </div>
            </form>
          </div>
          @endauth


        </div>
      </div>
    </div>
  </div>
</section>
@endsection