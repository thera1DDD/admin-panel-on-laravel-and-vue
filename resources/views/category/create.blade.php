@extends('layouts.admin')

@section('title')
    Добавить категорию
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новую категорию</h3>
        <div class="card-tools">
            <a href="{{ route('category.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все категории</a>
        </div>
    </div>
    <form method="POST" action="{{ route('category.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Категория</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название категории">
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Путь</label>
                <input type="text" name="path"  id="path" class="form-control @error('path') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название категории">
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Местоположение</label>
                <select  name="type" id="status" class="form-control select2" style="width: 100%;">
                    <option value="footer">Footer</option>
                    <option value="header">Header</option>
                    <option value="menu">Menu</option>
                </select>
                @error('type')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Создать</button>
        </div>
    </form>
</div>
@endsection
