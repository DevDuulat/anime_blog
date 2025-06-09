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
              <li><a href="{{ route('posts.index') }}">Наш Блог</a></li>
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