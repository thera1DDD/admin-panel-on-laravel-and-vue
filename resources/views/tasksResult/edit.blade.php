@extends('layouts.admin')

@section('title')
    Редактировать результаты
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('tasksResult.update',$tasksResult->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="users_id">Пользователь</label>
                        <select name="users_id"  id="users_id" class="form-control select2"  style="width: 100%;">
                            @foreach($users as $user)
                                <option value="{{$user->id }}" {{$user->id == $tasksResult->users_id ? 'selected' : ''}}>
                                    {{$user->name }}
                                </option>
                            @endforeach()
                        </select>
                        @error('users_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tasks_id">Задание</label>
                        <select name="tasks_id"  id="tasks_id" class="form-control select2"  style="width: 100%;">
                            @foreach($tasks as $task)
                                <option value="{{$task->id }}" {{$task->id == $tasksResult->tasks_id ? 'selected' : ''}}>
                                    {{$task->name }}
                                </option>
                            @endforeach()
                        </select>
                        @error('tasks_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="is_passed">Пройденность</label>
                        <select name="is_passed"  id="is_passed" class="form-control select2" style="width: 100%;">
                            <option value="1" {{ $tasksResult->is_passed == 1 ? 'selected' : '' }}>Пройден</option>
                            <option value="0" {{ $tasksResult->is_passed == 0 ? 'selected' : '' }}>Не пройден</option>
                        </select>
                        @error('is_passed')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label for="questions_correct">Время прохождения</label>
                    <div class="form-group">
                        <input type="text" value="{{ $tasksResult->passing_time }}" name="passing_time" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Сохранить" >
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
