@extends('layouts.admin')

@section('title')
    Videos
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Videos</h3>

            <div class="card-tools">
                <a href="{{ route('video.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new video</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Код</th>
                    <th>Название</th>
                    <th>Номер</th>
                    <th>Описание</th>
                    <th>Модуль</th>
                    <th>Видео</th>
                    <th>Постер</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($videos as $video)
                    <tr>
                        <td>{{ $video->id }}</td>
                        <td>{{ $video->code }}</td>
                        <td>{{ $video->name }}</td>
                        <td>{{ $video->number }}</td>
                        <td>{{ $video->description }}</td>
                        <td>{{ $video->module->name}}</td>
                        <td><a href="{{route('video.play', $video->id)}}">{{$video->video_file}}</a></td>
                        <td><img src="{{getImage($video->poster)}}" style="width: 150px"></td>
                        <td>{{ $video->created_at }}</td>
                        <td>
                            <a style="width: 110px"  href="{{ route('video.edit', $video->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <form action="{{route('video.delete',$video->id) }}" method="post">
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
