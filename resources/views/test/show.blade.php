@extends('layouts.admin')

@section('title')
    Вопросы теста
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Вопросы</h3>

            <div class="card-tools">
                <a href="{{ route('question.create',$id)}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить вопрос</a>
                <a href="{{ route('test.index')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Все тесты</a>
            </div>
        </div>
        <!-- /.card-header -->

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Вопрос</th>
                    <th>Дата</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td><a href="{{route('question.show', $question->id,)}}">{{$question->name}}</a></td>
                        <td>{{ $question->created_at }}</td>
                        <td>
                            <a style="width: 110px"  href="{{ route('question.edit', $question->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <form action="{{route('question.delete',$question->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="width: 110px"  type="submit" value="Удалить" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        <!-- /.card-body -->
    </div>
@endsection
