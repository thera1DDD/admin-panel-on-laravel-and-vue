@extends('layouts.admin')

@section('title')
Добавить обновления
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новые обновления</h3>
        <div class="card-tools">
            <a href="{{ route('popularQuestion.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Просмотреть все обновления</a>
        </div>
    </div>
    <form method="POST" action="{{ route('popularQuestion.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="question">Вопрос</label>
                <textarea  type="text" name="question"  id="question" class="form-control @error('text') is-invalid @enderror"  required placeholder="Вопрос" > </textarea>
                @error('text')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="answer">Ответ</label>
                <textarea  type="text" name="answer"  id="answer" class="form-control @error('text') is-invalid @enderror"  required placeholder="Ответ" > </textarea>
                @error('text')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Активность</label>
                <select  name="status"  id="status" class="form-control select2" style="width: 100%;">
                    <option value="1">Активен</option>
                    <option value="0">Не Активен</option>
                </select>
                @error('status')
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
