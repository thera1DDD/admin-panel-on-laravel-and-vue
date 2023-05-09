@extends('layouts.admin')

@section('title')
Добавить слово для проверки
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новое слово</h3>
        <div class="card-tools">
            <a href="{{ route('task.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все слова</a>
        </div>
    </div>
    <form method="POST" action="{{ route('task.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Слово</label>
                <input type="text" name="word"  id="word" class="form-control @error('word') is-invalid @enderror" value="{{ old('word') }}" required placeholder="Слово">
                @error('word')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="modules_id">Модуль</label>
                <select name="modules_id"  id="modules_id" class="form-control select2" style="width: 100%;">
                    @foreach($modules as $module)
                        <option value="{{$module->id}}">{{$module->name}}</option>
                    @endforeach()
                </select>
                @error('modules_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Language</button>
        </div>
    </form>
</div>
@endsection
