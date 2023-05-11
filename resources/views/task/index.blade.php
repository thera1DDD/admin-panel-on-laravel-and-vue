@extends('layouts.admin')

@section('title')
Слова для проверки
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Слова</h3>

        <div class="card-tools">
            <a href="{{ route('task.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить новое слово</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Слово</th>
                    <th>Название задания</th>
                    <th>Описание</th>
                    <th>Модуль</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->word }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->module->name }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>
                            <a style="width: 66px" href="{{ route('task.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>

                            <form action="{{route('task.delete',$task->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="height: 30px;"  type="submit" value="Delete" class="btn btn-danger">
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
