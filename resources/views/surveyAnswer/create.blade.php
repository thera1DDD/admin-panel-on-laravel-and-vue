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
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Добавить</button>
        </div>
    </form>

</div>
@endsection
