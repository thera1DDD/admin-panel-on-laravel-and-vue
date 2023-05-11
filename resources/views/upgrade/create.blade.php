@extends('layouts.admin')

@section('title')
Добавить обновления
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новые обновления</h3>
        <div class="card-tools">
            <a href="{{ route('upgrade.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Просмотреть все обновления</a>
        </div>
    </div>
    <form method="POST" action="{{ route('upgrade.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Текст</label>
                <textarea  type="text" name="text"  id="text" class="form-control @error('text') is-invalid @enderror"  required placeholder="Текст" > </textarea>
                @error('text')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

        <div class="form-group">
            <label for="name">Заголовок</label>
            <input type="text" name="header"  id="header" class="form-control @error('header') is-invalid @enderror"  required placeholder="Заголовок">
            @error('name')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Добавить обновления</button>
        </div>
        </div>
    </form>
</div>
@endsection
