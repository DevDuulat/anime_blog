<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8" />
  <meta name="description" content="Anime Template" />
  <meta name="keywords" content="Anime, unica, creative, html" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Anime | Template</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet" />

  <!-- Css Styles -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/plyr.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" />
</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Header Section Begin -->
  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col-lg-2">
          <div class="header__logo">
            <a href="{{ route('home') }}" style="color: #fff; font-size: 24px; font-weight: 600">
              PlayMix
            </a>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="header__nav">
            <nav class="header__menu mobile-menu">
              <ul>
                <li class="active"><a href="{{ route('home') }}">Главная</a></li>
                <li>
                  <a href="{{ route('home') }}">Категории <span class="arrow_carrot-down"></span></a>
                  <ul class="dropdown">
                    <li><a href="{{ route('home') }}">Категории</a></li>
                    <li><a href="{{ route('home') }}">Кино</a></li>
                    <li>
                      <a href="{{ route('home') }}">Драмма</a>
                    </li>
                    <li>
                      <a href="{{ route('home') }}">Аниме</a>
                    </li>
                  </ul>
                </li>
                <li><a href="{{ route('home') }}">Наш Блог</a></li>
                <li><a href="{{ route('home') }}">Викторины</a></li>
                <li><a href="{{ route('home') }}">Контакты</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="header__right">
            <a href="#" class="search-switch"><span class="icon_search"></span></a>
            <a href="{{ route('login') }}"><span class="icon_profile"></span></a>
          </div>
        </div>
      </div>
      <div id="mobile-menu-wrap"></div>
    </div>
  </header>
  <!-- Header End -->

  <!-- Hero Section Begin -->
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

  <!-- Footer Section Begin -->

  <!-- Footer Section End -->

  <!-- Search model Begin -->
  <div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
      <div class="search-close-switch"><i class="icon_close"></i></div>
      <form class="search-model-form">
        <input type="text" id="search-input" placeholder="Search here....." />
      </form>
    </div>
  </div>
  <!-- Search model end -->

  <!-- Js Plugins -->
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/player.js') }}"></script>
  <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('js/mixitup.min.js') }}"></script>
  <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>