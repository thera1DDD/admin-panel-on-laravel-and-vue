@extends('layouts.admin')

@section('title')
Добавить учителя
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить учителя</h3>
        <div class="card-tools">
            <a href="{{ route('teacher.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i>Посмотреть всех учителей</a>
        </div>
    </div>
    <form method="POST" action="{{ route('teacher.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Должность</label>
                <input type="text" name="position"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Пользователь</label>
                <select name="users_id"  id="users_id" class="form-control select2" data-placeholder="Выберите пользователя" style="width: 100%;">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach()
                </select>
                @error('users_id')
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
