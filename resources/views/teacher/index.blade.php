@extends('layouts.admin')

@section('title')
   Учителя
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Учителя</h3>

            <div class="card-tools">
                <a href="{{ route('teacher.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>Добавить учителя</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Должность</th>
                    <th>Дата</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->user->name ?? 'Удаленный пользователь'}}</td>
                        <td>{{ $teacher->position}}</td>
                        <td>{{ $teacher->created_at }}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('teacher.delete',$teacher->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="height: 30px;"  type="submit" value="Удалить" class="btn btn-danger">
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
