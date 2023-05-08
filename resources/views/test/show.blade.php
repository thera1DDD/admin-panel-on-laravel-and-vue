@extends('layouts.admin')

@section('title')
  Questions of test
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Questions</h3>

            <div class="card-tools">
                <a href="{{ route('question.index') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> See all questions</a>
            </div>
        </div>
        <!-- /.card-header -->

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td><a href="{{route('question.show', $question->id)}}">{{$question->name}}</a></td>
                        <td>{{ $question->created_at }}</td>
                        <td>
                            <a style="width: 66px"  href="{{ route('question.edit', $question->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>
                            <form action="{{route('question.delete',$question->id) }}" method="post">
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
        <!-- /.card-body -->
    </div>
@endsection
