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
                <h4>{{ $quiz->title }}</h4>
                <h4 class="mt-4" style="color: #fff">
                  Вопросов: {{ $questionNumber }} / {{ $totalQuestions }}
                </h4>
              </div>
            </div>
          </div>

          <form action="{{ route('quizzes.process', [$quiz->id, $currentQuestion->id]) }}" method="POST">
            @csrf
            <div class="row d-flex justify-content-center text-center">
              <div class="col-12 d-flex flex-column align-items-center">
                @if($currentQuestion->image)
                <img src="{{ asset('storage/' . $currentQuestion->image) }}" alt="Вопрос" class="img-fluid mb-4"
                  style="object-fit: contain; height: 220px" />
                @endif

                <h4 class="mb-4" style="color: #fff">
                  {{ $currentQuestion->question_text }}
                </h4>

                <div class="d-flex flex-column mb-4" style="color: #fff; width: 100%; min-width: 320px">
                  @foreach($currentQuestion->answers as $answer)
                  <label class="form-check cast-quiz" style="cursor: pointer">
                    <input class="form-check-input" type="radio" name="answer" value="{{ $answer->id }}" required />
                    <span class="form-check-label">{{ $answer->answer_text }}</span>
                  </label>
                  @endforeach
                </div>

                <button type="submit" class="btn btn-primary site-btn">Ответить</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
        // Можно добавить обработчики для анимации или AJAX
        const quizItems = document.querySelectorAll('.cast-quiz');

        quizItems.forEach(item => {
            item.addEventListener('click', function() {
                quizItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
@endpush