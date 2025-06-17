@extends('layouts.app')

@section('title', $mediaItem->title)

@section('content')
<section class="anime-details spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        {{-- Видеоплеер --}}
        <div class="anime__video__player">
          @if($currentEpisode && $currentEpisode->video_url)
          @php
          $url = $currentEpisode->video_url;
          $isYoutube = Str::contains($url, ['youtube.com', 'youtu.be']);
          if ($isYoutube) {
          // Преобразуем ссылку YouTube в embed-формат
          if (Str::contains($url, 'watch?v=')) {
          parse_str(parse_url($url, PHP_URL_QUERY), $query);
          $youtubeId = $query['v'] ?? null;
          } elseif (Str::contains($url, 'youtu.be/')) {
          $youtubeId = basename(parse_url($url, PHP_URL_PATH));
          }
          $embedUrl = $youtubeId ? "https://www.youtube.com/embed/$youtubeId" : null;
          }
          @endphp

          @if($isYoutube && isset($embedUrl))
          <div class="anime__video__player">
            <iframe width="100%" height="500" src="{{ $embedUrl }}" title="YouTube video player" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
          </div>
          @else
          <div class="anime__video__player">
            <video id="player" playsinline controls data-poster="{{ asset('storage/' . $mediaItem->image) }}">
              <source src="{{ asset('storage/' . $currentEpisode->video_url) }}" type="video/mp4" />
            </video>
          </div>
          @endif
          @else
          <div class="anime__video__player">
            <p>Видео недоступно</p>
          </div>
          @endif

        </div>

        {{-- Список эпизодов --}}
        <div class="anime__details__episodes">
          <div class="section-title">
            <h5>{{ $mediaItem->title }}</h5>
          </div>

          @foreach($mediaItem->episodes->sortBy('episode_number') as $episode)
          <a href="{{ route('media.show', ['slug' => $mediaItem->slug]) }}?episode={{ $episode->episode_number }}"
            @if($currentEpisode && $currentEpisode->episode_number == $episode->episode_number) style="font-weight:
            bold;" @endif>
            Эп {{ $episode->episode_number }}
          </a>
          @endforeach

        </div>

      </div>
    </div>

    @auth
    <div class="row">
      <div class="col-lg-8">
        <div class="anime__details__review">
          <div class="section-title">
            <h5>Отзывы ({{ $mediaItem->comments->count() }})</h5>
          </div>

          @forelse($mediaItem->comments as $comment)
          <div class="anime__review__item">
            <div class="anime__review__item__pic">
              <img src="{{ $comment->user->avatar_url ?? asset('img/user-default.png') }}"
                style="width:100px height:100px" alt="{{ $comment->user->name ?? 'User' }}" />
            </div>
            <div class="anime__review__item__text">
              <h6>{{ $comment->user->name ?? 'Гость' }} - <span>{{ $comment->created_at->format('d.m.Y') }}</span></h6>
              <p>{{ $comment->content }}</p>
            </div>
          </div>
          @empty
          <p>Пока нет отзывов.</p>
          @endforelse
        </div>


        <div class="anime__details__form">
          <div class="section-title">
            <h5>Ваш комментарий</h5>
          </div>
          <form action="{{ route('media.comments.store', ['mediaItem' => $mediaItem->id]) }}" method="POST">

            @csrf
            <textarea name="content" placeholder="Текст комментария" required></textarea>
            <button type="submit">
              <i class="fa fa-location-arrow"></i> Отправить
            </button>
          </form>
        </div>
      </div>
    </div>
    @endauth
  </div>
</section>
@endsection