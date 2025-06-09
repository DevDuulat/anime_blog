@extends('layouts.app')

@section('title', $mediaItem->title)

@section('content')
<section class="anime-details spad">
  <div class="container">
    <div class="anime__details__content">
      <div class="row">
        <div class="col-lg-3">
          <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/' . $mediaItem->image) }}">
            <div class="comment"><i class="fa fa-comments"></i> {{ $mediaItem->comments->count() }}</div>
            <div class="view"><i class="fa fa-eye"></i> {{ number_format($mediaItem->views) }}</div>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="anime__details__text">
            <div class="anime__details__title">
              <h3>{{ $mediaItem->title }}</h3>
              <span>Категория: {{ $mediaItem->category->name ?? 'Аниме' }}</span>
            </div>
            <div class="anime__details__rating d-none">
              <div class="rating">
                <a href="#"><i class="fa fa-star"></i></a>
                <a href="#"><i class="fa fa-star"></i></a>
                <a href="#"><i class="fa fa-star"></i></a>
                <a href="#"><i class="fa fa-star"></i></a>
                <a href="#"><i class="fa fa-star-half-o"></i></a>
              </div>
              <span>1.029 Votes</span>
            </div>
            <p>{{ $mediaItem->description }}</p>
            <div class="anime__details__widget">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <ul>
                    <li><span>Тип :</span> {{ $mediaItem->type }}</li>
                    <li><span>Студия:</span> {{ $mediaItem->studio }}</li>
                    <li><span>Дата выхода:</span> {{
                      \Carbon\Carbon::parse($mediaItem->release_date)->translatedFormat('d M. Y г.') }}</li>
                    <li>
                      <span>Жанр:</span>
                      @if(is_array($mediaItem->genres))
                      {{ implode(', ', $mediaItem->genres) }}
                      @else
                      @foreach(json_decode($mediaItem->genres) as $genre)
                      {{ $genre }}@if(!$loop->last), @endif
                      @endforeach
                      @endif
                    </li>
                    <li><span>Просмотры:</span> {{ number_format($mediaItem->views, 0, ',', ' ') }}</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="anime__details__btn">
              <a href="{{ route('media.show', ['slug' => $mediaItem->slug]) }}" class="watch-btn">
                <span>Смотреть сейчас</span>
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-8">
        <div class="anime__details__review">
          <div class="section-title">
            <h5>Отзывы ({{ $mediaItem->comments->count() }})</h5>
          </div>

          @forelse($mediaItem->comments as $comment)
          <div class="anime__review__item">
            <div class="anime__review__item__pic">
              <img src="{{ $comment->user->avatar_url ?? asset('img/anime/review-1.jpg') }}"
                alt="{{ $comment->user->name }}" />
            </div>
            <div class="anime__review__item__text">
              <h6>{{ $comment->user->name }} - <span>{{ $comment->created_at->format('d.m.Y') }}</span></h6>
              <p>{{ $comment->content }}</p>
            </div>
          </div>
          @empty
          <p>Пока нет отзывов.</p>
          @endforelse
        </div>

        @auth
        <div class="anime__details__form">
          <div class="section-title">
            <h5>Ваш отзыв</h5>
          </div>
          <form action="{{ route('media.comments.store', $mediaItem->id) }}" method="POST">
            @csrf
            <textarea name="content" placeholder="Текст комментария" required></textarea>
            <button type="submit">
              <i class="fa fa-location-arrow"></i> Отправить
            </button>
          </form>
        </div>
        @endauth
      </div>

      <div class="col-lg-4 col-md-4">
        <div class="anime__details__sidebar">
          <div class="section-title">
            <h5>Наш Блог</h5>
          </div>
          <div class="filter__gallery">
            @foreach($blogPosts as $post)
            <div class="product__sidebar__view__item set-bg mix day years"
              data-setbg="{{ asset('storage/' . $post->image) }}">
              <div class="ep">{{ $post->category->name }}</div>
              <div class="view">
                <i class="fa fa-comments"></i> {{ $post->comments->count() }}
              </div>
              <h5>
                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
              </h5>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  document.querySelector('.anime__details__pic').style.backgroundImage = `url('{{ asset('storage/' . $mediaItem->image) }}')`;
</script>
@endpush