@extends('layouts.admin')

@section('title')
   Редактировать популярные вопросы
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('popularQuestion.update',$popularQuestion->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="question">Вопрос</label>
                        <textarea  type="text" name="question"  id="question"  class="form-control @error('text') is-invalid @enderror"  required placeholder="Текст" > {{$popularQuestion->question}}</textarea>
                        @error('question')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="answer">Ответ</label>
                        <textarea  type="text" name="answer"  id="answer"  class="form-control @error('text') is-invalid @enderror"  required placeholder="Текст" > {{$popularQuestion->answer}}</textarea>
                        @error('answer')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Активность</label>
                        <select  name="status"  id="status" class="form-control select2" style="width: 100%;">
                            @if($popularQuestion->status == 1)
                                <option value="1">Активен</option>
                                <option value="0">Не Активен</option>
                            @else
                                <option value="0">Не Активен</option>
                                <option value="1">Активен</option>
                            @endif

                        </select>
                        @error('status')
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
