@extends('layouts.admin')

@section('title')
    Update Comment
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Comment</h3>
            <div class="card-tools">
                <a href="{{ route('comment.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Comment</a>
            </div>
        </div>
        <form method="POST" action="{{ route('comment.update',$comment->id) }}">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="name">Text</label>
                <textarea  type="text" name="text"  id="text" class="form-control @error('text') is-invalid @enderror"  required placeholder="Comment" >{{$comment->text}} </textarea>
                @error('text')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="users_id">User</label>
                <select  class="form-control select2" name="users_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $comment->users_id ? 'selected' : '' }}>
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
                <label for="name">Model type</label>
                <select  name="commentable_type"  id="commentable_type" class="form-control select2" data-placeholder="Выберите Модуль" style="width: 100%;">
                        @if($comment->commentable_type == "App\Models\Course")
                        <option value="Course">Course</option>
                        <option value="Module">Module</option>
                        @else
                        <option value="Module">Module</option>
                        <option value="Course">Course</option>
                        @endif
                </select>
                @error('commentable_type')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="commentable_id">Records</label>
                <select name="commentable_id" id="commentable_id" class="form-control select2" style="width: 100%;">
                    @foreach($recordsOfModel as $record)
                        <option value="{{ $record->id }}" {{ $record->id == $comment->commentable_id ? 'selected' : '' }}>
                            {{ $record->name }}
                        </option>
                    @endforeach
                </select>
                @error('commentable_id')
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
        $('#commentable_type').on('change', function() {
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
                    $('#commentable_id').html(options);
                }
            });
        });
    });
</script>

