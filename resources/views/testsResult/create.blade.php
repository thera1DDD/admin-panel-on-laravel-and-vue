@extends('layouts.admin')

@section('title')
    Добавить результаты
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новую результаты</h3>
        <div class="card-tools">
            <a href="{{ route('category.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все результаты</a>
        </div>
    </div>
    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data" >
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Пользователь</label>
                <input type="text" name="tests_id"  id="tests_id" class="form-control @error('tests_id') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название категории">
                @error('name')
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
