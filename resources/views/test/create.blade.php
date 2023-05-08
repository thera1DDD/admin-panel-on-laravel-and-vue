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
                <label for="name">Model type</label>
                <select  name="testable_type"  id="testable_type" class="form-control select2" data-placeholder="Выберите Модуль" style="width: 100%;">
                    <option value="Module">Module</option>
                    <option value="Course">Course</option>
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

