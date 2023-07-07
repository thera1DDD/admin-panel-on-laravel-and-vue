@extends('layouts.admin')

@section('title')
    Редактировать ответ
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('surveyAnswer.update',$surveyAnswer->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Ответ</label>
                    <div class="form-group">
                        <input type="text" value="{{ $surveyAnswer->name ?? old('name') }}" name="name" class="form-control" placeholder="Ответ">
                    </div>
                    <div class="form-group">
                        <label for="courses_id">Вопрос</label>
                        <select  name="survey_questions_id"  id="survey_questions_id"  class="form-control select2" data-placeholder="Module" style="width: 100%;">
                            @foreach($surveyQuestions as $surveyQuestion)
                                <option value="{{ $surveyQuestion->id }}" {{ $surveyQuestion->id == $surveyAnswer->survey_questions_id ? 'selected' : '' }}>
                                    {{ $surveyQuestion->name }}
                                </option>
                            @endforeach()
                        </select>
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
