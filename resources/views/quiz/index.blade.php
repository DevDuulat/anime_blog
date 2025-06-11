@extends('layouts.app')
@section('content')
<section class="product spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="trending__product">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
              <div class="section-title">
                <h4>Викторины про аниме</h4>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="btn__all">
                <a href="#" class="primary-btn">
                  Посмотреть все <span class="arrow_right"></span>
                </a>
              </div>
            </div>
          </div>
          <div class="row">
            @foreach($quizzes as $quiz)
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic">
                  <img src="{{ asset('storage/' . $quiz->image) }}" alt="{{ $quiz->title }}" class="img-fluid">
                  <div class="ep">{{ $quiz->category->name }}</div>
                </div>


                <div class="product__item__text">
                  <ul>
                    <li>Категория: {{ $quiz->category->name }}</li>
                  </ul>
                  <h5>
                    <a href="{{ route('quizzes.show', $quiz->id) }}">{{ $quiz->title }}</a>
                  </h5>
                </div>
              </div>
            </div>

            @endforeach

          </div>

        </div>

      </div>
      <x-blog-sidebar :posts="$posts" title="Последние статьи" :showFilters="true" />
    </div>
  </div>
</section>
@endsection