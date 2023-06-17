@extends('layouts.admin')

@section('title')
    Добавить тест
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Добавить новый тест</h3>
            <div class="card-tools">
                <a href="{{ route('test.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Посмотреть все тесты</a>
            </div>
        </div>
        <form method="POST" action="{{ route('test.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название">
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Код</label>
                <input type="text" name="code"  id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" required placeholder="Код">
                @error('code')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="number">Номер</label>
                <input type="text" name="number"  id="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}" required placeholder="Номер">
                @error('number')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Poster</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="poster" type="file" class="custom-file-input" id="exampleInputFile">
                        @error('poster')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="testable_type">Источник</label>
                <select  name="testable_type"  id="testable_type" class="form-control select2" data-placeholder="Выберите Модуль" style="width: 100%;">
                    <option value="Module">Модули</option>
                    <option value="Course">Курсы</option>
                </select>
                @error('testable_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="testable_id">Записи источника</label>
                <select name="testable_id" id="testable_id" class="form-control select2" style="width: 100%;">
                    @foreach($modules as $module)
                        <option value="{{$module->id}}">{{$module->name}}</option>
                    @endforeach()
                </select>
                @error('testable_id')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <button class="btn btn-primary"  type="submit">Submit</button>
        </form>
    </div>

@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#testable_type').on('change', function() {
            var type = $(this).val();
            $.ajax({
                url: '{{ route("records.by.type", ":type") }}'.replace(':type', type),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var options = '';
                    $.each(data, function(index, record) {
                        options += '<option value="' + record.id + '">' + record.name + '</option>';
                    });
                    $('#testable_id').html(options);
                }
            });
        });
    });

</script>

