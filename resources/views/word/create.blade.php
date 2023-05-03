@extends('layouts.admin')

@section('title')
Create Words
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add new Word</h3>
        <div class="card-tools">
            <a href="{{ route('word.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Word</a>
        </div>
    </div>
    <form method="POST" action="{{ route('word.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Word">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Word</button>
        </div>
    </form>
</div>
@endsection
