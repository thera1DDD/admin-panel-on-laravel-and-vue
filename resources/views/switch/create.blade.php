@extends('layouts.admin')

@section('title')
    Добавить переключатель для словаря
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новый переключатель</h3>
        <div class="card-tools">
            <a href="{{ route('switchLang.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все языки</a>
        </div>
    </div>
    <form method="POST" action="{{ route('switchLang.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Название на сайте</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название на сайте">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" name="description"  id="description" class="form-control @error('description') is-invalid @enderror"  required placeholder="Описание">
                @error('description')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="switch">Переключатель</label>
                <input type="text" name="switch"  id="switch" class="form-control @error('switch') is-invalid @enderror" value="{{ old('switch') }}" required placeholder="Переключатель">
                @error('switch')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Создать</button>
             </div>
        </div>
    </form>
</div>
@endsection
