@extends('layouts.admin')

@section('title')
    Добавить видео
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новое видео</h3>
        <div class="card-tools">
            <a href="{{ route('video.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Просмотреть все видео</a>
        </div>
    </div>
    <form method="POST" action="{{ route('video.store') }}" enctype="multipart/form-data">
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
                <label for="name">Код</label>
                <input type="text" name="code"  id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" required placeholder="Код">
                @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="number">Номер</label>
                <input type="text" name="number"  id="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}" required placeholder="Номер">
                @error('number')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Описание</label>
                <input type="text" name="description"  id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required placeholder="Описание">
                @error('description')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Модуль</label>
                <select name="modules_id"  id="modules_id" class="form-control select2"  style="width: 100%;">
                    @foreach($modules as $module)
                        <option value="{{$module->id}}">{{$module->name}}</option>
                    @endforeach()
                </select>
                @error('module_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Видео</label>
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
                        @error('poster')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label class="custom-file-label" for="exampleInputFile">Выберите фото</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Создать</button>
        </div>
    </form>
</div>
@endsection
