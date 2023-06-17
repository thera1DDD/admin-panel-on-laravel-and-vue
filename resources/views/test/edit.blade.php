@extends('layouts.admin')

@section('title')
    Update Test
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Test</h3>
            <div class="card-tools">
                <a href="{{ route('test.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Test</a>
            </div>
        </div>
        <form method="POST" action="{{ route('test.update',$test->id) }}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <textarea  type="text" name="name"  id="text" class="form-control @error('text') is-invalid @enderror"  required placeholder="Test" >{{$test->name}} </textarea>
                @error('text')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="number">Номер</label>
                <textarea  type="text" name="number"  id="text" class="form-control @error('text') is-invalid @enderror"  required placeholder="Test" >{{$test->number}} </textarea>
                @error('number')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="number">Код</label>
                <textarea  type="text" name="code"  id="text" class="form-control @error('text') is-invalid @enderror"  required placeholder="Test" >{{$test->code}} </textarea>
                @error('code')
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
                <label for="name">Model type</label>
                <select  name="testable_type"  id="testable_type" class="form-control select2" data-placeholder="Выберите Модуль" style="width: 100%;">
                    @if($test->testable_type == "App\Models\Course")
                        <option value="Course">Course</option>
                        <option value="Module">Module</option>
                    @else
                        <option value="Module">Module</option>
                        <option value="Course">Course</option>
                    @endif
                </select>
                @error('testable_type')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="testable_id">Records</label>
                <select name="testable_id" id="testable_id" class="form-control select2" style="width: 100%;">
                    @foreach($recordsOfModel as $record)
                        <option value="{{ $record->id }}" {{ $record->id == $test->testable_id ? 'selected' : '' }}>
                            {{ $record->name }}
                        </option>
                    @endforeach
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

