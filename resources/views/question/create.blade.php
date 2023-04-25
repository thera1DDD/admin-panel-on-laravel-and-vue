@extends('layouts.admin')

@section('title')
Create Question
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add new Question</h3>
        <div class="card-tools">
            <a href="{{ route('question.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Question</a>
        </div>
    </div>
    <form method="POST" action="{{ route('question.store') }}" enctype="multipart/form-data">
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
                <label for="name">Test</label>
                <select name="tests_id"  id="tests_id" class="form-control select2" data-placeholder="Выберите тест" style="width: 100%;">
                    @foreach($tests as $test)
                        <option value="{{$test->id}}">{{$test->name}}</option>
                    @endforeach()
                </select>
                @error('tests_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create question</button>
        </div>
    </form>

</div>
@endsection
