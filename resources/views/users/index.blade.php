@extends('layouts.admin')

@section('title')
 Пользователи
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Пользователи</h3>

        <div class="card-tools">
            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить пользователя</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Почта</th>
                    <th>Фото</th>
                    <th>Роль</th>
                    <th>Телефон</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->patronymic }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{getImage($user->photo)}}" style="width: 200px"></td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('users.delete',$user->id) }}" method="post">
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
