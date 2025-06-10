@extends('layouts.app')

@section('title', 'Редактировать профиль')

@section('content')

<section class="login spad " style="margin-bottom: 150px">
  <div class="container">
    <div class="row ">
      <div class="col-lg-6">
        <div class="login__form">
          <h3>Данный аккаунта</h3>
          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="input__item">
              <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Никнейм" />
              <span class="icon_profile"></span>
            </div>
            <div class="input__item">
              <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Email" />
              <span class="icon_mail"></span>
            </div>
            <div class="input__item">
              <input type="password" name="password" placeholder="Новый пароль (по желанию)" />
              <span class="icon_lock"></span>
            </div>
            <div class="input__item">
              <input type="password" name="password_confirmation" placeholder="Подтверждение пароля" />
              <span class="icon_lock"></span>
            </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="login__register">

          <h3>Ваша аватарка</h3>
          <div class="mb-3">
            <img id="avatarPreview" src="{{ auth()->user()->avatar_url }}" alt="Аватар пользователя"
              style="width: 150px; height: auto" />
          </div>

          <div class="mb-3">
            <label for="avatar" class="btn btn-success site-btn">Выбрать аватарку</label>
            <input type="file" name="avatar" id="avatar" accept="image/*" style="display: none"
              onchange="previewAvatar(event)" />
          </div>
          <div class="mb-3">
            <button type="submit" class="site-btn">Обновить данные</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>



<script>
  function previewAvatar(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('avatarPreview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
</script>
@endsection