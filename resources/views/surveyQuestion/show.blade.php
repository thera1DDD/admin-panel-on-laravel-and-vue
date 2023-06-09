@extends('layouts.admin')

@section('title')
    Ответы вопроса
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ответы</h3>

            <div class="card-tools">
                <a href="{{ route('surveyAnswer.create',$id)}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить Ответ</a>
                <a href="{{ route('surveyQuestion.index')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Все вопросы</a>
            </div>
        </div>
        <!-- /.card-header -->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ответ</th>
                    <th>Постер</th>
                    <th>Дата</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($surveyAnswers as $surveyAnswer)
                    <tr>
                        <td>{{ $surveyAnswer->id }}</td>
                        <td>{{ $surveyAnswer->name }}</td>
                        <td> {!!$surveyAnswer->image !!} </td>
                        <td>{{ $surveyAnswer->created_at }}</td>
                        <td>
                            <a style="width: 110px"  href="{{ route('surveyAnswer.edit', $surveyAnswer->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <form action="{{route('surveyAnswer.delete',$surveyAnswer->id) }}" method="post">
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
