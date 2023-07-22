@extends('layouts.admin')

@section('title')
    Добавить демовидео
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"> Добавить демовидео</h3>
        <div class="card-tools">
            <a href="{{ route('demovideo.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Просмотреть все демовидео</a>
        </div>
    </div>
    <form method="POST" action="{{ route('demovideo.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea id="description" name="description"  style="width: 500px" class="form-control" rows="7"></textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="course_card_description">Описание 2</label>
                <textarea id="course_card_description" name="course_card_description"  style="width: 500px" class="form-control" rows="7"></textarea>
                @error('course_card_description')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Курс</label>
                <select name="courses_id"  id="courses_id" class="form-control select2" data-placeholder="Выберите курс" style="width: 100%;">
                    @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}</option>
                    @endforeach()
                </select>
                @error('courses_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Демовидео</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="video_file" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Выберите видео</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Постер</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="poster" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Выберите фото</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cоздать</button>
        </div>
    </form>
</div>
@endsection
