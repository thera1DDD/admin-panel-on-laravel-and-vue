@extends('layouts.admin')

@section('title')
Create Favourites
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add new Favourite</h3>
        <div class="card-tools">
            <a href="{{ route('favourite.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Favourite</a>
        </div>
    </div>
    <form method="POST" action="{{ route('favourite.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="users_id">Пользователь</label>
                <select name="users_id"  id="users_id" class="form-control select2" data-placeholder="Выберите Пользователя" style="width: 100%;">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach()
                </select>
                @error('user_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="users_id">Курс</label>
                <select name="courses_id"  id="courses_id" class="form-control select2" data-placeholder="Выберите Пользователя" style="width: 100%;">
                    @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}</option>
                    @endforeach()
                </select>
                @error('user_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Favourite</button>
        </div>
    </form>
</div>
@endsection
