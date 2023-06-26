@extends('layouts.admin')

@section('title')
    Добавить вопрос
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Добавить новый вопрос</h3>
            <div class="card-tools">
                <a href="{{ route('surveyQuestion.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все вопросы</a>
            </div>
        </div>
        <form method="POST" action="{{ route('surveyQuestion.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название">
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <button class="btn btn-primary"  type="submit">Submit</button>
        </form>
    </div>
@endsection


