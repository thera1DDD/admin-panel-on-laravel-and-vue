@extends('layouts.admin')

@section('title')
    Редактировать модуль
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('aboutUs.update',$aboutUs->id)}}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Ответ</label>
                            <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Вопрос</label>
                            <select name="survey_questions_id"  id="survey_questions_id" class="form-control select2"  style="width: 100%;">
                                <option value="{{ $surveyQuestions->id }}">
                                    {{ $surveyQuestions->name }}
                                </option>
                            </select>
                            @error('survey_questions_id')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Постер</label>
                            <textarea id="image" name="image"  style="width: 500px" class="form-control" rows="15"></textarea>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
