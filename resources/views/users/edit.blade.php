@extends('layouts.admin')

@section('title')
    Редактировать язык
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Имя</label>
                    <div class="form-group">
                        <input type="text" value="{{ $user->name }}" name="name" class="form-control" placeholder="Имя">
                    </div>
                    <label for="name">Фамилия</label>
                    <div class="form-group">
                        <input type="text" value="{{ $user->surname }}" name="surname" class="form-control" placeholder="Фамилия">
                    </div>
                    <label for="name">Отчество</label>
                    <div class="form-group">
                        <input type="text" value="{{ $user->patronymic }}" name="patronymic" class="form-control" placeholder="Отчество">
                    </div>
                    <label for="name">Почта</label>
                    <div class="form-group">
                        <input type="text" value="{{ $user->email }}" name="email" class="form-control" placeholder="Язык">
                    </div>
                    <label for="name">Телефон</label>
                    <div class="form-group">
                        <input type="text" value="{{ $user->phone ?? old('name') }}" name="phone" class="form-control" placeholder="Язык">
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
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Пользователь</option>
                            <option value="moderator" {{ $user->role == 'moderator' ? 'selected' : '' }}>Модератор</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Администратор</option>
                        </select>
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Редактировать" >
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
