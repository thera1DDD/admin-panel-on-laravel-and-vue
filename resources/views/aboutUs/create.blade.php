@extends('layouts.admin')

@section('title')
    Добавить цитаты о нас
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новые цитаты о нас</h3>
        <div class="card-tools">
            <a href="{{ route('aboutUs.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все цитаты</a>
        </div>
    </div>
    <form method="POST" action="{{ route('aboutUs.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Первая цитата</label>
            <textarea id="image" name="firstQuote"  style="width: 500px" class="form-control" rows="4"></textarea>
            @error('image')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Вторая цитата</label>
            <textarea id="image" name="secondQuote"  style="width: 500px" class="form-control" rows="4"></textarea>
            @error('image')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">SVG Фото</label>
            <textarea id="image" name="image"  style="width: 500px" class="form-control" rows="15"></textarea>
            @error('image')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="big_image">Главное фото</label>
            <div class="input-group">
                <div class="custom-file">
                    <input name="big_image" type="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Выберите фото</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">Загрузка</span>
                </div>
            </div>
            @error('big_image')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="text_content">Основной текст</label>
            <textarea id="text_content" name="text_content"  style="width: 500px" class="form-control" rows="10"></textarea>
            @error('text_content')
            <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
            @enderror
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Добавить</button>
        </div>
    </form>
</div>
@endsection
