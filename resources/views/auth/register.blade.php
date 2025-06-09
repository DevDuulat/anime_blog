@extends('layouts.app')

@section('title', 'Регистрация')

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

<!-- Register Section Begin -->
<section class="login spad">
  <div class="container">
    <div class="row">
      <!-- Форма регистрации -->
      <div class="col-lg-6">
        <div class="login__form">
          <h3>Регистрация</h3>

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input__item">
              <input type="text" name="name" placeholder="Никнейм" value="{{ old('name') }}" required />
              <span class="icon_profile"></span>
            </div>
            @error('name')
            <div class="text-danger mb-2">{{ $message }}</div>
            @enderror

            <div class="input__item">
              <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
              <span class="icon_mail"></span>
            </div>
            @error('email')
            <div class="text-danger mb-2">{{ $message }}</div>
            @enderror

            <div class="input__item">
              <input type="password" name="password" placeholder="Пароль" required />
              <span class="icon_lock"></span>
            </div>
            @error('password')
            <div class="text-danger mb-2">{{ $message }}</div>
            @enderror

            <div class="input__item">
              <input type="password" name="password_confirmation" placeholder="Повторный пароль" required />
              <span class="icon_lock"></span>
            </div>

            <button type="submit" class="site-btn">Зарегистрироваться</button>
          </form>
        </div>
      </div>

      <!-- Перенаправление на вход -->
      <div class="col-lg-6">
        <div class="login__register">
          <h3>У меня уже есть учетная запись!</h3>
          <a href="{{ route('login') }}" class="primary-btn">Войти</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Register Section End -->

@endsection