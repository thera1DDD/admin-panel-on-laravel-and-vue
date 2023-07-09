@extends('layouts.admin')

@section('title')
    Отзывы/Комментарии
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Отзывы</h3>

            <div class="card-tools">
                <a href="{{ route('comment.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new comment</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Текст</th>
                    <th>Пользователь</th>
                    <th>Видео-отзыв</th>
                    <th>Источник</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->text }}</td>
                        <td>{{ $comment->username }}</td>
                        <td><a href="{{$comment->video_link }}">Отзыв</a></td>
                        <td>{{ $comment->commentable->name ?? 'Удаленный источник' }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>
                            <a style="width: 110px"  href="{{ route('comment.edit', $comment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>
                            <form action="{{route('comment.delete',$comment->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="width: 110px;"  type="submit" value="Delete" class="btn btn-danger">
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
