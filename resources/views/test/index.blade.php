@extends('layouts.admin')

@section('title')
    Тесты
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Тест</h3>
            <div class="card-tools">
                <a href="{{ route('test.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить новый тест</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Источник</th>
                    <th>Дата создания</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tests as $test)
                    <tr>
                        <td>{{ $test->id }}</td>
                        <td><a href="{{route('test.show', $test->id)}}">{{$test->name}}</a></td>
                        <td>{{ $test->testable->name }}</td>

                        <td>{{ $test->created_at }}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('test.edit', $test->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('test.delete',$test->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="width: 110px;"  type="submit" value="Удалить" class="btn btn-danger">
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
