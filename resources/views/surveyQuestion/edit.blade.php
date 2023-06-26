@extends('layouts.admin')

@section('title')
        Редактировать вопрос
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Обновить вопрос</h3>
            <div class="card-tools">
                <a href="{{ route('surveyQuestion.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все вопросы</a>
            </div>
        </div>
        <form method="POST" action="{{ route('surveyQuestion.update',$surveyQuestion->id) }}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <textarea  type="text" name="name"  id="text" class="form-control @error('text') is-invalid @enderror"  required placeholder="Test" >{{$surveyQuestion->name}} </textarea>
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


