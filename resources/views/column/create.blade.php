@extends('layouts.admin')

@section('title')
    Добавить колону для футера
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Добавить новую категорию</h3>
        <div class="card-tools">
            <a href="{{ route('column.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все категории</a>
        </div>
    </div>
    <form method="POST" action="{{ route('column.store') }}" enctype="multipart/form-data" >
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название категории">
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Очередь</label>
                <input type="text" name="queue"  id="queue" class="form-control @error('queue') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название категории">
                @error('queue')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Создать</button>
        </div>
    </form>
</div>
@endsection
