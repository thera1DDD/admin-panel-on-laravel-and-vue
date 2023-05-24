@extends('layouts.admin')

@section('title')
    Модули
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Модули</h3>

            <div class="card-tools">
                <a href="{{ route('module.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавть новый моудль</a>
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
                    <th>Номер</th>
                    <th>Курс</th>
                    <th>Главное фото</th>
                    <th>Slug</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($modules as $module)
                    <tr>
                        <td>{{ $module->id }}</td>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->description }}</td>
                        <td>{{ $module->number }}</td>
                        <td>{{ $module->course->name}}</td>
                        <td>{{ $module->main_image }}</td>
                        <td>{{ $module->slug }}</td>
                        <td>{{ $module->created_at }}</td>
                        <td>
                            <a style="width: 110px"  href="{{ route('module.edit', $module->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('module.delete',$module->id) }}" method="post">
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
