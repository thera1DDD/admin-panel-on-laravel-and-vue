@extends('layouts.admin')

@section('title')
    Comment
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Comment</h3>

            <div class="card-tools">
                <a href="{{ route('comment.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new comment</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Text</th>
                    <th>User</th>
                    <th>Model</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->text }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->commentable_type }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>
                            <a style="width: 66px"  href="{{ route('comment.edit', $comment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>

                            <form action="{{route('comment.delete',$comment->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="height: 30px;"  type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
