@extends('layouts.admin')

@section('title')
    Ответы на популярные вопросы
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Ответы и вопросы</h3>
        <div class="card-tools">
            <a href="{{ route('popularQuestion.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить обновления</a>
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
                    <th>Активность</th>
                    <th>Дата создания</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($popularQuestions as $popularQuestion)
                    <tr>
                        <td>{{ $popularQuestion->id }}</td>
                        <td>{{ $popularQuestion->question }}</td>
                        <td>{{ $popularQuestion->answer }}</td>
                        <td>@if($popularQuestion->status==1){{'Активен'}}@else{{'Не активен'}}@endif</td>
                        <td>{{ $popularQuestion->created_at }}</td>
                        <td>
                            <a style="width: 66px" href="{{ route('popularQuestion.edit', $popularQuestion->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>
                            <form action="{{route('popularQuestion.delete',$popularQuestion->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="height: 30px;"  type="submit" value="Delete" class="btn btn-danger">
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
