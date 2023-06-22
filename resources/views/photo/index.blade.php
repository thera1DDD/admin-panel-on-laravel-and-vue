@extends('layouts.admin')

@section('title')
    Фото
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Фото</h3>

            <div class="card-tools">
                <a href="{{ route('photo.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить новое фото</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Файл</th>
                    <th>Источник</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($photos as $photo)
                    <tr>
                        <td>{{ $photo->id }}</td>
                        <td>{{ $photo->filename }}</td>
                        <td>{{ $photo->photoable->name ?? 'Удаленный источник' }}</td>
                        <td>{{ $photo->created_at }}</td>
                        <td>
                            <a style="width: 110px"  href="{{ route('photo.edit', $photo->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('photo.delete',$photo->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="width: 110px" type="submit" value="Удалить" class="btn btn-danger">
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
