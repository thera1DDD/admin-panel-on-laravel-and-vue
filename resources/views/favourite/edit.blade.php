@extends('layouts.admin')

@section('title')
    Редактировать избранное
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('favourite.update',$favourite->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="users_id">Пользователь</label>
                        <select name="users_id"  id="users_id" class="form-control select2" data-placeholder="Выберите Пользователя" style="width: 100%;">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $favourite->users_id ? 'selected' : '' }}>
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
                        <select name="courses_id"  id="courses_id" class="form-control select2" data-placeholder="Выберите Пользователя" style="width: 100%;">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $favourite->courses_id ? 'selected' : '' }}>
                                    {{ $course->name }}
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
                        <input type="submit" class="btn btn-primary" value="Редактировать" >
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
