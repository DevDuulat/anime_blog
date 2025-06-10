@extends('layouts.app')
@section('title', 'Главная')
@section('content')

<!-- Hero Section Begin -->
<section class="hero">
  <div class="container">
    <div class="hero__slider owl-carousel">
      <div class="hero__items set-bg" data-setbg="{{ asset('img/hero/hero-1.jpg') }}">
        <div class="row">
          <div class="col-lg-6">
            <div class="hero__text">
              <div class="label">Приключения</div>
              <h2>Fate / Stay Night: Unlimited Blade Works</h2>
              <p>После 30 дней путешествий по всему миру...</p>
              <a href="#"><span>Смотреть сейчас</span> <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="hero__items set-bg" data-setbg="{{ asset('img/hero/bg-1.jpg') }}">
        <div class="row">
          <div class="col-lg-6">
            <div class="hero__text">
              <div class="label">Приключения</div>
              <h2>Fate / Stay Night: Unlimited Blade Works</h2>
              <p>После 30 дней путешествий по всему миру...</p>
              <a href="#"><span>Смотреть сейчас</span> <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="hero__items set-bg" data-setbg="{{ asset('img/hero/hero-1.jpg') }}">
        <div class="row">
          <div class="col-lg-6">
            <div class="hero__text">
              <div class="label">Приключения</div>
              <h2>Fate / Stay Night: Unlimited Blade Works</h2>
              <p>После 30 дней путешествий по всему миру...</p>
              <a href="#"><span>Смотреть сейчас</span> <i class="fa fa-angle-right"></i></a>

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
                <a href="{{ route('media.index') }}" class="primary-btn">Посмотреть все<span
                    class="arrow_right"></span></a>
              </div>
            </div>
          </div>
          <div class="row">
            @foreach($trendingMedia as $media)

            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $media->image) }}">
                  <div class="ep">{{ $media->type->value }}</div>
                  <div class="view"><i class="fa fa-eye"></i> {{ $media->views }}</div>
                </div>
                <div class="product__item__text">
                  <ul>
                    <li>{{ $media->category->name }}</li>
                  </ul>
                  <h5><a href="{{ route('media.detail', $media->slug) }}">{{ $media->title }}</a></h5>
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
                <a href="{{ route('media.index') }}" class="primary-btn">Посмотреть все<span
                    class="arrow_right"></span></a>
              </div>
            </div>
          </div>
          <div class="row">
            @foreach($recentMedia as $media)
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $media->image) }}">
                  <div class="ep">{{ $media->type->value }}</div>
                  <div class="view"><i class="fa fa-eye"></i> {{ $media->views }}</div>
                </div>
                <div class="product__item__text">
                  <ul>
                    <li>{{ $media->category->name }}</li>
                  </ul>
                  <h5>
                    <a href="{{ route('media.detail', $media->slug) }}">{{ $media->title }}</a>
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
                <a href="{{ route('media.index') }}" class="primary-btn">Посмотреть все<span
                    class="arrow_right"></span></a>
              </div>
            </div>
          </div>
          <div class="row">
            @foreach($popularMedia as $media)
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $media->image) }}">
                  <div class="ep">{{ $media->type->value }}</div>
                  <div class="view"><i class="fa fa-eye"></i> {{ $media->views }}</div>
                </div>
                <div class="product__item__text">
                  <ul>
                    <li>{{ $media->category->name }}</li>
                  </ul>
                  <h5>
                    <a href="{{ route('media.detail', $media->slug) }}">{{ $media->title }}</a>
                  </h5>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <!-- Остальные секции (recent__product, live__product) можно аналогично переделать с использованием Blade -->

      </div>
      <x-blog-sidebar :posts="$blogPosts" title="Последние статьи" :showFilters="true" />
    </div>
  </div>
</section>
<!-- Product Section End -->






@endsection