@extends('layouts.admin')

@section('title')
Обновления сайта
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Обновления</h3>
        <div class="card-tools">
            <a href="{{ route('upgrade.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить обновления</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Текст</th>
                    <th>Заголовок</th>
                    <th>Дата</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($upgrades as $upgrade)
                    <tr>
                        <td>{{ $upgrade->id }}</td>
                        <td>{{ $upgrade->text }}</td>
                        <td>{{ $upgrade->header }}</td>
                        <td>{{ $upgrade->created_at }}</td>
                        <td>
                            <a style="width: 66px" href="{{ route('upgrade.edit', $upgrade->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>
                            <form action="{{route('upgrade.delete',$upgrade->id) }}" method="post">
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
