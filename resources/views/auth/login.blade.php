@extends('layouts.app')

@section('title', 'Вход')

@section('content')

<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="{{ asset('img/normal-breadcrumb.jpg') }}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="normal__breadcrumb__text">
          <h2>PlayMix</h2>
          <p>Добро пожаловать на нашу платформу</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Login Section Begin -->
<section class="login spad">
  <div class="container">
    <div class="row">
      <!-- Форма входа -->
      <div class="col-lg-6">
        <div class="login__form">
          <h3>Вход</h3>

          <!-- Статус сессии -->
          @if (session('status'))
          <div class="alert alert-success mb-4">
            {{ session('status') }}
          </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="input__item">
              <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus />
              <span class="icon_mail"></span>
            </div>
            @error('email')
            <div class="text-danger mb-2">{{ $message }}</div>
            @enderror

            <!-- Пароль -->
            <div class="input__item">
              <input type="password" name="password" placeholder="Пароль" required />
              <span class="icon_lock"></span>
            </div>
            @error('password')
            <div class="text-danger mb-2">{{ $message }}</div>
            @enderror

            <!-- Запомнить меня -->
            <div class="mt-3 mb-3 d-flex align-items-center">
              <input type="checkbox" id="remember_me" name="remember" class="me-2" />
              <label for="remember_me" class="mb-0">Запомнить меня</label>
            </div>

            <button type="submit" class="site-btn">Войти</button>

            <!-- Забыл пароль -->
            @if (Route::has('password.request'))
            <a class="forget_pass d-block mt-3" href="{{ route('password.request') }}">
              Забыли пароль?
            </a>
            @endif
          </form>
        </div>
      </div>

      <!-- Блок регистрации -->
      <div class="col-lg-6">
        <div class="login__register">
          <h3>У вас нет учетной записи?</h3>
          <a href="{{ route('register') }}" class="primary-btn">Зарегистрируйтесь сейчас</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Login Section End -->

@endsection