@extends('layouts.admin')

@section('title')
    Колоны
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Колоны футера</h3>
        <div class="card-tools">
            <a href="{{ route('column.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить категорию</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Очередь</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($columns as $column)
                    <tr>
                        <td>{{$column->id}}</td>
                        <td>{{$column->name}}</td>
                        <td>{{$column->queue}}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('column.edit',$column->id )}}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <form action="{{route('column.delete',$column->id)}}" method="post">
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
