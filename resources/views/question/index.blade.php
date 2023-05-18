@extends('layouts.admin')

@section('title')
    Вопросы
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Вопрос</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Вопрос</th>
                    <th>Тест</th>
                    <th>Дата создания</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td><a href="{{route('question.show', $question->id)}}">{{$question->name}}</a></td>
                        <td>{{ $question->test->name }}</td>
                        <td>{{ $question->created_at }}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('question.edit', $question->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('question.delete',$question->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="width: 110px" type="submit" value="Удалить" class="btn btn-danger">
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
