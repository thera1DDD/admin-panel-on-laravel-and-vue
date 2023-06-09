@extends('layouts.admin')

@section('title')
    Курсы
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Курс</h3>

            <div class="card-tools">
                <a href="{{ route('course.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Cоздать новый курс</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Код курса</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Язык</th>
                    <th>Slug</th>
                    <th>Дата загрузки</th>
                    <th>Главное фото</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->code }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->language->name}}</td>
                        <td>{{ $course->slug }}</td>
                        <td>{{ $course->created_at }}</td>
                        <td><img src="{{getImage($course->main_image)}}" style="width: 200px"></td>
                        <td>
                            <a style="width: 110px" href="{{ route('course.edit', $course->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('course.delete',$course->id) }}" method="post">
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
