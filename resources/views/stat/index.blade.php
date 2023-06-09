@extends('layouts.admin')

@section('title')
Пройденный материал пользователя
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Прогресс</h3>

        <div class="card-tools">
            <a href="{{ route('stat.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить прогресс пользователя</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Курс</th>
                    <th>Пользователь</th>
                    <th>Пройденный Модуль</th>
                    <th>Пройденный Тест</th>
                    <th>Пройденное Задание</th>
                    <th>Просмотренное Видео</th>
                    <th>Пройденный Курс</th>
                    <th>Дата создания</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($stats as $stat)
                    <tr>
                        <td>{{ $stat->id }}</td>
                        <td>@if(isset($stat->course->name)){{ $stat->course->name }}@else{{''}}@endif</td>
                        <td>@if(isset($stat->user->name)){{ $stat->user->name }}@else{{''}}@endif</td>
                        <td>@if(isset($stat->module->name)){{ $stat->module->name }}@else{{''}}@endif</td>
                        <td>@if(isset($stat->test->name)){{ $stat->test->name }}@else{{''}}@endif</td>
                        <td>@if(isset($stat->task->name)){{ $stat->task->name }}@else{{''}}@endif</td>
                        <td>@if(isset($stat->video->name)){{ $stat->video->name }}@else{{''}}@endif</td>
                        <td>@if(isset($stat->course->name)){{ $stat->course->name }}@else{{''}}@endif</td>
                        <td>{{ $stat->created_at }}</td>
                        <td>
                            <a style="width: 66px" href="{{ route('stat.edit', $stat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>
                            <form action="{{route('stat.delete',$stat->id) }}" method="post">
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
