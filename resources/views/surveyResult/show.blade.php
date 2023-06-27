@extends('layouts.admin')

@section('title')
    Результаты опроса
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Результаты опроса</h3>

            <div class="card-tools">
{{--                <a href="{{ route('surveyResult.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить Результаты</a>--}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Вопрос</th>
                    <th>Ответ</th>
                    <th>Пользователь</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($surveyResults as $surveyResult)
                    <tr>
                        <td>{{ $surveyResult->id }}</td>
                        <td>{{ $surveyResult->survey_question->name }}</td>
                        <td>{{ $surveyResult->survey_answer->name }}</td>
                        <td>{{ $surveyResult->user->name ?? 'Удаленный пользователь'}}</td>
                        <td>{{ $surveyResult->created_at }}</td>
                        <td>
{{--                            <a style="width: 110px" href="{{ route('surveyResult.edit', $surveyResult->id) }}" class="btn btn-sm btn-warning">Редактировать</a>--}}
{{--                            <br>--}}
                            <form action="{{route('surveyResult.delete',$surveyResult->id) }}" method="post">
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
