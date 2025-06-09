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
              <li class="nav-item dropdown" style="position: relative;">
                <a href="#" class="nav-link">Категории <span class="arrow_carrot-down"></span></a>

                <ul class="dropdown">
                  @foreach($categories as $category)
                  <li class="submenu-parent" style="position: relative;">
                    <a href="{{ route('category.show', $category->slug) }}"
                      class="{{ $category->children->count() ? 'submenu-toggle' : '' }}">
                      {{ $category->name }}
                      @if($category->children->count())
                      <span class="arrow_carrot-right"></span>
                      @endif
                    </a>

                    @if($category->children->count())
                    <ul class="dropdown-sub">
                      @foreach($category->children as $child)
                      <li>
                        <a href="{{ route('category.show', $child->slug) }}">{{ $child->name }}</a>
                      </li>
                      @endforeach
                    </ul>
                    @endif
                  </li>
                  @endforeach
                </ul>
              </li>


              <li><a href="{{ route('posts.index') }}">Наш Блог</a></li>
              <li><a href="{{ route('quiz') }}">Викторины</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="header__right">
          <a href="{{ route('login') }}"><span class="icon_profile"></span></a>
        </div>
      </div>
    </div>
    <div id="mobile-menu-wrap"></div>
  </div>
</header>
<!-- Header End -->