@extends('layouts.admin')

@section('title')
    Книги/Документы
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Книги/Документы</h3>
            <div class="card-tools">
                <a href="{{ route('artwork.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить книгу</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Файл</th>
                    <th>Язык</th>
                    <th>Тип Файла</th>
                    <th>Обложка</th>
                    <th>Действие</th>
                    <th>Дата создания</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($artworks as $artwork)
                    <tr>
                        <td>{{ $artwork->id }}</td>
                        <td>{{ $artwork->name }}</td>
                        <td>{{ $artwork->description }}</td>
                        <td><a href="{{ $artwork->filename }}">{{$artwork->filename}}</a></td>
                        <td>{{ $artwork->language->name ?? 'None'}}</td>
                        <td>@if($artwork->documentType=='book'){{'Книга'}}@else {{'Документ'}}@endif</td>
                        <td> <img src="{{getImage($artwork->poster)}}" style="width: 300px"> </td>
                        <td>{{ $artwork->created_at }}</td>
                        <td>
                            <a style="width:110px" href="{{ route('artwork.edit', $artwork->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('artwork.delete',$artwork->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="width:110px"  type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
