@extends('layouts.admin')

@section('title')
    Фото
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Фото</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <img src="{{$image}}">
        </div>
        <!-- /.card-body -->
    </div>
@endsection
