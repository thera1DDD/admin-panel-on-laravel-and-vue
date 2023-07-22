@extends('layouts.admin')

@section('title')
    Демовидео
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Демовидео</h3>

            <div class="card-tools">
                <a href="{{ route('demovideo.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить демовидео</a>
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
                    <th>Описание №2</th>
                    <th>Курс</th>
                    <th>Видео</th>
                    <th>Постер</th>
                    <th>Дата создания</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($demovideos as $demovideo)
                    <tr>
                        <td>{{ $demovideo->id }}</td>
                        <td>{{ $demovideo->name }}</td>
                        <td>{{ $demovideo->description }}</td>
                        <td>{{ $demovideo->course_card_description }}</td>
                        <td>{{ $demovideo->course->name}}</td>
                        <td><a href="{{route('demovideo.play', $demovideo->id)}}">{{$demovideo->video_file}}</a></td>
                        <td><img src="{{getImage($demovideo->poster)}}" style="width: 200px"></td>
                        <td>{{ $demovideo->created_at }}</td>
                        <td>
                            <a style="width: 130px"  href="{{ route('demovideo.edit', $demovideo->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-user-edit"></i> Редактировать</a>
                            <br>
                            <form action="{{route('demovideo.delete',$demovideo->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button style="width: 130px"  class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Удалить </button>
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
