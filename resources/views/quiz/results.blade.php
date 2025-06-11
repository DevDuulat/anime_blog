@extends('layouts.app')

@section('content')
<section class="product spad">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="trending__product">
          <div class="row">
            <div class="col-12">
              <div class="section-title">
                <h4 class="text-white">Результаты викторины: {{ $quiz->title }}</h4>
              </div>
            </div>
          </div>

          <div class="row d-flex justify-content-center text-center">
            <div class="col-md-8 col-12">
              <div class="quiz-results-card">
                <!-- Круговой индикатор -->
                <div class="results-progress" data-percent="{{ $scorePercentage }}">

                  <div class="progress-text text-white">
                    <span>{{ $scorePercentage }}%</span>
                  </div>
                </div>

                <h3 class="mt-4" style="color: #fff">
                  Правильных ответов: {{ $correctAnswers }} из {{ $totalQuestions }}
                </h3>

                <div class="results-actions mt-5">
                  <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-primary site-btn mr-3">
                    Пройти ещё раз
                  </a>
                  <a href="{{ route('home') }}" class="btn btn-outline-light">
                    На главную
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('styles')
<style>
  .quiz-results-card {
    background: #1e1e2d;
    padding: 30px;
    border-radius: 10px;
    margin-top: 20px;
  }

  .results-progress {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
  }

  .progress-circle {
    transform: rotate(-90deg);
  }

  .progress-circle-bg {
    fill: none;
    stroke: #2d2d3d;
    stroke-width: 10;
  }

  .progress-circle-fill {
    fill: none;
    stroke: #e53637;
    stroke-width: 10;
    stroke-dasharray: 565.48;
    transition: stroke-dashoffset 1s ease;
  }

  .progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 2.5rem;
    font-weight: bold;
    color: #fff;
  }

  .results-actions {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
  }

  @media (max-width: 576px) {
    .results-actions {
      flex-direction: column;
    }
  }
</style>
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
        // Анимация прогресс-бара
        const progressCircle = document.querySelector('.progress-circle-fill');
        const percent = document.querySelector('.results-progress').getAttribute('data-percent');
        const offset = 565.48 - (565.48 * percent) / 100;
        progressCircle.style.strokeDashoffset = offset;
    });
</script>
@endpush