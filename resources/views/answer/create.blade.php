@extends('layouts.admin')

@section('title')
    Добавить ответ к вопросу
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Добавить ответ</h3>

        </div>
        <form method="POST" action="{{ route('answer.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Ответ</label>
                    <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Корректность</label>
                    <select name="is_correct"  id="is_correct" class="form-control select2" data-placeholder="IsCorrect" style="width: 100%;">
                        <option value="1">Правильный</option>
                        <option value="0">Не правильный</option>
                    </select>
                    @error('is_correct')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Вопрос</label>
                    <select name="questions_id"  id="questions_id" class="form-control select2" data-placeholder="Выберите question" style="width: 100%;">
                        <option value="{{$question->id}}">{{$question->name}}</option>
                    </select>
                    @error('questions_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create answer</button>
            </div>
        </form>

    </div>
@endsection
