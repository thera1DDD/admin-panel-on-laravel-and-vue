@extends('layouts.admin')

@section('title')
    Редактировать категорию
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('testsResult.update',$testsResult->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="users_id">Пользователь</label>
                        <select name="users_id"  id="users_id" class="form-control select2"  style="width: 100%;">
                            @foreach($users as $user)
                                <option value="{{$user->id }}" {{$user->id == $testsResult->users_id ? 'selected' : ''}}>
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
                        <label for="tests_id">Тест</label>
                        <select name="tests_id"  id="tests_id" class="form-control select2"  style="width: 100%;">
                            @foreach($tests as $test)
                                <option value="{{$test->id }}" {{$test->id == $testsResult->tests_id ? 'selected' : ''}}>
                                    {{$test->name }}
                                </option>
                            @endforeach()
                        </select>
                        @error('tests_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="is_passed">Пройденность</label>
                        <select name="is_passed"  id="is_passed" class="form-control select2" style="width: 100%;">
                            <option value="1" {{ $testsResult->is_passed == 1 ? 'selected' : '' }}>Пройден</option>
                            <option value="0" {{ $testsResult->is_passed == 0 ? 'selected' : '' }}>Не пройден</option>
                        </select>
                        @error('is_passed')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label for="questions_total">Кол-во вопросов</label>
                    <div class="form-group">
                        <input type="text" value="{{ $testsResult->questions_total}}" name="questions_total" class="form-control">
                    </div>
                    <label for="questions_correct">Количество правильных ответов</label>
                    <div class="form-group">
                        <input type="text" value="{{ $testsResult->questions_correct }}" name="questions_correct" class="form-control">
                    </div>
                    <label for="questions_correct">Время прохождения теста</label>
                    <div class="form-group">
                        <input type="text" value="{{ $testsResult->passing_time }}" name="passing_time" class="form-control">
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
