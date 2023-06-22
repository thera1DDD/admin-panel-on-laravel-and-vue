@extends('layouts.admin')

@section('title')
    Добавить пользователя
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить пользователя</h3>
        <div class="card-tools">
            <a href="{{ route('users.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все языки</a>
        </div>
    </div>
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Язык">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Фамилия</label>
                <input type="text" name="surname"  id="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}" required placeholder="Язык">
                @error('surname')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="patronymic">Отчество</label>
                <input type="text" name="patronymic"  id="patronymic" class="form-control @error('patronymic') is-invalid @enderror" value="{{ old('patronymic') }}" required placeholder="Отчество">
                @error('patronymic')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Почта</label>
                <input type="text" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Почта">
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="text" name="password"  id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required placeholder="Язык">
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Фото</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="photo" type="file" class="custom-file-input" id="exampleInputFile">
                        @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Роль</label>
                <select name="role"  id="role" class="form-control select2" style="width: 100%;">
                    <option value="user">Пользователь</option>
                    <option value="moderator">Модератор</option>
                    <option value="admin">Администратор</option>
                </select>
                @error('role')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Телефон</label>
                <input type="text" name="phone"  id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required placeholder="Язык">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Добавить</button>
        </div>
    </form>
</div>
@endsection
