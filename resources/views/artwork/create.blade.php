@extends('layouts.admin')

@section('title')
Добавить книгу
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новую книгу</h3>
        <div class="card-tools">
            <a href="{{ route('artwork.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все книги</a>
        </div>
    </div>
    <form method="POST" action="{{ route('artwork.store') }}" enctype="multipart/form-data">
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
                <label for="name">Описание</label>
                <input type="text" name="description"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('description') }}" required placeholder="Описание">
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Язык</label>
                <select name="languages_id"  id="languages_id" class="form-control select2" data-placeholder="Выберите язык" style="width: 100%;">
                    @foreach($languages as $language)
                        <option value="{{$language->id}}">{{$language->name}}</option>
                    @endforeach()
                </select>
                @error('language_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="documentType">Тип файла</label>
                <select  name="documentType" id="status" class="form-control select2" style="width: 100%;">
                    <option value="book">Книга</option>
                    <option value="document">Документ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="filename">Файл</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="filename" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="filename">Выберите файл</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
                @error('filename')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create</button>
        </div>
    </form>
</div>
@endsection
