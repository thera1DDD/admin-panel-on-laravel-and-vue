@extends('layouts.admin')

@section('title')
    Вопросы опроса
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Опрос</h3>
            <div class="card-tools">
                <a href="{{ route('surveyQuestion.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить новый вопрос</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Вопрос</th>
                    <th>Дата создания</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($surveyQuestions as $surveyQuestion)
                    <tr>
                        <td>{{ $surveyQuestion->id }}</td>
                        <td><a href="{{route('surveyQuestion.show', $surveyQuestion->id)}}">{{$surveyQuestion->name}}</a></td>
                        <td>{{ $surveyQuestion->created_at }}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('surveyQuestion.edit', $surveyQuestion->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <form action="{{route('surveyQuestion.delete',$surveyQuestion->id) }}" method="post">
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
