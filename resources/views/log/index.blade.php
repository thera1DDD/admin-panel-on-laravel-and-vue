@extends('layouts.admin')

@section('title')
    Логи
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Логи</h3>
            <div class="card-tools">
                <form action="{{ url()->current() }}" method="GET">
                    <input type="text" name="query" placeholder="Поиск по действию...">
                    <button type="submit">Найти/Очистить</button>
                </form>
                <form action="{{ route('log.allDelete') }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Удалить всё</button>
                </form>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Действие</th>
                    <th>Категория</th>
                    <th>Запись</th>
                    <th>Дата</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($logs) > 0)
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->user->name ?? 'Удаленный пользователь'}}</td>
                            <td>{{ $log->action_type }}</td>
                            <td>{{ $log->category }}</td>
                            <td>{{ $log->record }}</td>
                            <td>{{ $log->action_date }}</td>
                            <td>
                                <form action="{{route('log.delete',$log->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input style="width: 105px;"  type="submit" value="Удалить" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                @endif
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
