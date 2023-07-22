@extends('layouts.admin')

@section('title')
    Добавить ответ
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Добавить новый ответ</h3>
            <div class="card-tools">
                <a href="{{('surveyAnswer.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все ответы</a>
            </div>
        </div>
        <form method="POST" action="{{route('surveyAnswer.store') }}" enctype="multipart/form-data">
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
                    <label for="name">Вопрос</label>
                    <select name="survey_questions_id"  id="survey_questions_id" class="form-control select2"  style="width: 100%;">
                        <option value="{{ $surveyQuestions->id }}">
                            {{ $surveyQuestions->name }}
                        </option>
                    </select>
                    @error('survey_questions_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Постер</label>
                    <textarea id="image" name="image"  style="width: 500px" class="form-control" rows="15"></textarea>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Добавить</button>
            </div>
        </form>

    </div>
@endsection
