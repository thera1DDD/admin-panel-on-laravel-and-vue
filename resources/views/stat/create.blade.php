@extends('layouts.admin')

@section('title')
Добавить пройденный материал
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить пройденный материал</h3>
        <div class="card-tools">
            <a href="{{ route('stat.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть всё</a>
        </div>
    </div>
    <form method="POST" action="{{ route('stat.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="users_id">Пользователь</label>
                <select name="users_id"  id="users_id" class="form-control select2"  style="width: 100%;">
                    <option></option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach()
                </select>
                @error('users_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="passed_courses_id">Пройденный Курс</label>
                <select name="passed_courses_id"  id="passed_courses_id" class="form-control select2" style="width: 100%;">
                    <option></option>
                    @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}</option>
                    @endforeach()
                </select>
                @error('passed_courses_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="passed_modules_id">Пройденный Модуль</label>
                <select name="passed_modules_id"  id="passed_modules_id" class="form-control select2"  style="width: 100%;">
                    <option></option>
                    @foreach($modules as $module)
                        <option value="{{$module->id}}">{{$module->name}}</option>
                    @endforeach()

                </select>
                @error('passed_modules_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="passed_videos_id">Просмотренное Видео</label>
                <select name="passed_videos_id"  id="passed_videos_id" class="form-control select2" data-placeholder="Выберите Пользователя" style="width: 100%;">
                    <option></option>
                    @foreach($videos as $video)
                        <option value="{{$video->id}}">{{$video->name}}</option>
                    @endforeach()

                </select>
                @error('passed_videos_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Favourite</button>
        </div>
    </form>
</div>
@endsection
