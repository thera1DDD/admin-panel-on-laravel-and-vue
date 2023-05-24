@extends('layouts.admin')

@section('title')
    Добавить язык
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новый язык</h3>
        <div class="card-tools">
            <a href="{{ route('language.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все языки</a>
        </div>
    </div>
    <form method="POST" action="{{ route('language.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Язык</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Язык">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Language</button>
        </div>
    </form>
</div>
@endsection
