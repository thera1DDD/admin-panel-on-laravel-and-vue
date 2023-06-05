@extends('layouts.admin')

@section('title')
    Редактировать статистику
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('stat.update',$stat->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="users_id">Пользователь</label>
                        <select name="users_id"  id="users_id" class="form-control select2" style="width: 100%;">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $stat->users_id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="courses_id">Курс</label>
                        <select name="courses_id"  id="courses_id" class="form-control select2" style="width: 100%;">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $stat->courses_id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('courses_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="passed_courses_id">Пройденный Курс</label>
                        <select name="passed_courses_id"  id="courses_id" class="form-control select2" style="width: 100%;">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $stat->passed_courses_id ? 'selected' : '' }}>
                                    {{$course->name}}
                                </option>
                                <option></option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="passed_tasks_id">Пройденные задание</label>
                        <select name="passed_tasks_id"  id="passed_tasks_id" class="form-control select2" style="width: 100%;">
                            @foreach($tasks as $task)
                                <option value="{{ $task->id }}" {{ $task->id == $stat->passed_tasks_id ? 'selected' : '' }}>
                                    {{$task->name}}
                                </option>
                                <option></option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="passed_modules_id">Пройденный Модуль</label>
                        <select name="passed_modules_id"  id="passed_modules_id" class="form-control select2" style="width: 100%;">
                            @foreach($modules as $module)
                                <option value="{{ $module->id }}" {{ $module->id == $stat->passed_modules_id ? 'selected' : '' }}>
                                    {{ $module->name }}
                                </option>
                            @endforeach
                            <option></option>
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="passed_videos_id">Просмотренное видео</label>
                        <select name="passed_videos_id"  id="passed_videos_id" class="form-control select2" style="width: 100%;">

                            @foreach($videos as $video)
                                <option value="{{ $video->id }}" {{ $video->id == $stat->passed_videos_id ? 'selected' : '' }}>
                                    {{ $video->name }}
                                </option>
                            @endforeach
                            <option></option>
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Редактировать" >
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
