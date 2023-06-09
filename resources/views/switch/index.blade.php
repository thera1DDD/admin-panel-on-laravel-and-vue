@extends('layouts.admin')

@section('title')
    Переключатели словаря
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Переключатели</h3>

        <div class="card-tools">
            <a href="{{ route('switchLang.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить переключатель</a>
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
                    <th>Переключатель</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($switchLangs as $switchLang)
                    <tr>
                        <td>{{ $switchLang->id }}</td>
                        <td>{{ $switchLang->name }}</td>
                        <td>{{ $switchLang->description }}</td>
                        <td>{{ $switchLang->switch }}</td>
                        <td>{{ $switchLang->created_at }}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('switchLang.edit', $switchLang->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('switchLang.delete',$switchLang->id) }}" method="post">
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
