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
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
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
            <a
              href="{{ route('home') }}"
              style="color: #fff; font-size: 24px; font-weight: 600">
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
  <section class="hero">
    <div class="container">
      <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="{{ asset('img/hero/hero-1.jpg') }}">
          <div class="row">
            <div class="col-lg-6">
              <div class="hero__text">
                <div class="label">Adventure</div>
                <h2>Fate / Stay Night: Unlimited Blade Works</h2>
                <p>After 30 days of travel across the world...</p>
                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="hero__items set-bg" data-setbg="{{ asset('img/hero/hero-1.jpg') }}">
          <div class="row">
            <div class="col-lg-6">
              <div class="hero__text">
                <div class="label">Adventure</div>
                <h2>Fate / Stay Night: Unlimited Blade Works</h2>
                <p>After 30 days of travel across the world...</p>
                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="hero__items set-bg" data-setbg="{{ asset('img/hero/hero-1.jpg') }}">
          <div class="row">
            <div class="col-lg-6">
              <div class="hero__text">
                <div class="label">Adventure</div>
                <h2>Fate / Stay Night: Unlimited Blade Works</h2>
                <p>After 30 days of travel across the world...</p>
                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Product Section Begin -->
  <section class="product spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="trending__product">
              <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Сейчас в тренде</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                  <a href="#" class="primary-btn">Посмотреть все<span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
         <div class="row">
              @foreach($trendingAnime as $anime)
              <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                      <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $anime->image) }}">
                          <div class="ep">{{ $anime->type->value }}</div>
                          <div class="view"><i class="fa fa-eye"></i> {{ $anime->views }}</div>
                      </div>
                      <div class="product__item__text">
                          <ul>
                              <li>{{ $anime->category->name }}</li>
                          </ul>
                          <h5><a href="{{ route('anime.show', $anime->slug) }}">{{ $anime->title }}</a></h5>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
            <div class="row">

            </div>
          </div>

             <div class="recent__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Последние</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                <a href="#" class="primary-btn">Посмотреть все<span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
            <div class="row">
              @foreach($recentAnime as $anime)
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $anime->image) }}">
                    <div class="ep">{{ $anime->type->value }}</div>
                    <div class="view"><i class="fa fa-eye"></i> {{ $anime->views }}</div>
                  </div>
                  <div class="product__item__text">
                    <ul>
                      <li>{{ $anime->category->name }}</li>
                    </ul>
                    <h5>
                      <a href="{{ route('anime.show', $anime->slug) }}">{{ $anime->title }}</a>
                    </h5>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>

          <div class="popular__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Популярные</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                <a href="#" class="primary-btn">Посмотреть все<span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
            <div class="row">
              @foreach($popularAnime as $anime)
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $anime->image) }}">
                    <div class="ep">{{ $anime->type->value }}</div>
                    <div class="view"><i class="fa fa-eye"></i> {{ $anime->views }}</div>
                  </div>
                  <div class="product__item__text">
                    <ul>
                      <li>{{ $anime->category->name }}</li>
                    </ul>
                    <h5>
                      <a href="{{ route('anime.show', $anime->slug) }}">{{ $anime->title }}</a>
                    </h5>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- Остальные секции (recent__product, live__product) можно аналогично переделать с использованием Blade -->

        </div>
        <div class="col-lg-4 col-md-6 col-sm-8">
          <div class="product__sidebar">
            <div class="product__sidebar__view">
              <div class="section-title">
                <h5>Наш блог</h5>
              </div>
              <ul class="filter__controls">
                <li class="active" data-filter="*">Day</li>
                <li data-filter=".week">Week</li>
                <li data-filter=".month">Month</li>
                <li data-filter=".years">Years</li>
              </ul>
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
    </div>
  </section>
  <!-- Product Section End -->

  <!-- Footer Section Begin -->
  <footer class="footer">
    <div class="page-up">
      <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="footer__logo">
            <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="" /></a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="footer__nav">
            <ul>
              <li class="active"><a href="{{ route('home') }}">Homepage</a></li>
              <li><a href="{{ route('home') }}">Categories</a></li>
              <li><a href="{{ route('home') }}">Our Blog</a></li>
              <li><a href="{{ route('home') }}">Contacts</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3">
          <p>
            Copyright &copy;
            <script>
              document.write(new Date().getFullYear());
            </script>
            All rights reserved | This template is made with
            <i class="fa fa-heart" aria-hidden="true"></i> by
            <a href="https://colorlib.com" target="_blank">Colorlib</a>
          </p>
        </div>
      </div>
    </div>
  </footer>
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