@extends('layouts.admin')

@section('title')

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Задания</h3>
            <div class="card-tools">
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название задания</th>
                    <th>Курс</th>
                    <th>Время прохождения</th>
                    <th>Прохождение</th>
                    <th>Дата прохождения</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tasksResults as $taskResult)
                    <tr>
                        <td>{{ $taskResult->id }}</td>
                        <td>{{ $taskResult->task->name }}</td>
                    @if($taskCourse = $taskResult->task->module)
                        <td>{{$taskCourse->course->name ?? 'Удаленный курс'}} </td>
                    @endif
                        <td>{{ $taskResult->passing_time }}</td>
                        <td>@if($taskResult->is_passed == 1){{'Пройден'}} @else{{'Не пройден'}}@endif</td>
                        <td>{{ $taskResult->created_at }}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('tasksResult.edit',$taskResult->id )}}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <form action="{{route('tasksResult.delete',$taskResult->id)}}" method="post">
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
