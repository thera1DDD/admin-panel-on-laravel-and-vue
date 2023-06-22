@extends('layouts.admin')

@section('title')
    Update Photo
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Photo</h3>
            <div class="card-tools">
                <a href="{{ route('photo.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Photo</a>
            </div>
        </div>
        <form method="POST" action="{{ route('photo.update',$photo->id) }}" enctype="multipart/form-data" >
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="filename">Photo</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="filename" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
                @error('filename')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Model type</label>
                <select name="photoable_type"  id="photoable_type" class="form-control select2" data-placeholder="Выберите Модуль" style="width: 100%;">
                        @if($photo->photoable_type == "App\Models\Course")
                        <option value="Course">Course</option>
                        <option value="Module">Module</option>
                        @else
                        <option value="Module">Module</option>
                        <option value="Course">Course</option>
                        @endif
                </select>
                @error('photoable_type')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="photoable_id">Records</label>
                <select name="photoable_id" id="photoable_id" class="form-control select2" style="width: 100%;">
                    @foreach($recordsOfModel as $record)
                        <option value="{{ $record->id }}" {{ $record->id == $photo->photoable_id ? 'selected' : '' }}>
                            {{ $record->name }}
                        </option>
                    @endforeach
                </select>
                @error('photoable_id')
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
        $('#photoable_type').on('change', function() {
            var type = $(this).val();
            $.ajax({
                url: '{{ route("photoRecords.by.type", ":type") }}'.replace(':type', type),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var options = '';
                    $.each(data, function(index, record) {
                        options += '<option value="' + record.id + '">' + record.name + '</option>';
                    });
                    $('#photoable_id').html(options);
                }
            });
        });
    });
</script>

