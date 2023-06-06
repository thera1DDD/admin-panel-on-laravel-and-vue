@extends('layouts.admin')

@section('title')
Create Demovideo
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add new Demovideo</h3>
        <div class="card-tools">
            <a href="{{ route('demovideo.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Demovideos</a>
        </div>
    </div>
    <form method="POST" action="{{ route('demovideo.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <input type="text" name="description"  id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required placeholder="Название">
                @error('description')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Course</label>
                <select name="courses_id"  id="courses_id" class="form-control select2" data-placeholder="Выберите курс" style="width: 100%;">
                    @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}</option>
                    @endforeach()
                </select>
                @error('courses_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Demovideo</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="video_file" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Постер</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="poster" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Demovideo</button>
        </div>
    </form>
</div>
@endsection
