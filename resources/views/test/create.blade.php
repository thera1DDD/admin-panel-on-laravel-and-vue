@extends('layouts.admin')

@section('title')
Create Test
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add new Test</h3>
        <div class="card-tools">
            <a href="{{ route('test.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Test</a>
        </div>
    </div>
    <form method="POST" action="{{ route('test.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название">
            @error('name')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Module type</label>
            <select  name="testable_type"  id="testable_type" class="form-control select2" data-placeholder="Выберите Модуль" style="width: 100%;">
                <option value="modules">Module</option>
                <option value="courses">Course</option>
            </select>
            @error('testable_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="testable_id">Module</label>
            <select name="testable_id" id="testable_id" class="form-control select2" style="width: 100%;">

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
        // Обработчик изменения выбранной модели
        $('#testable_type').on('change', function() {
            var modelName = $(this).val();

            // Отправить AJAX запрос на сервер
            $.ajax({
                url: 'api/get-model-records',
                type: 'GET',
                data: { testable_type: modelName },
                success: function(response) {
                    console.log(response);
                    // Очистить второй "select"
                    $('#testable_id').empty();

                    // Добавить полученные записи во второй "select"
                    $.each(response.records, function(index, record) {
                        $('#testable_id').append($('<option></option>').text(record.name).val(record.id));
                    });

                },
                error: function() {
                    console.log('Ошибка при получении записей');
                }
            });
        });
    });
</script>

