@extends('layouts.admin')

@section('title')
    Answers
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Answer</h3>

            <div class="card-tools">
                <a href="{{ route('test.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new test</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Answer</th>
                    <th>Question</th>
                    <th>Correct</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($answers as $answer)
                    <tr>
                        <td>{{ $answer->id }}</td>
                        <td>{{$answer->name}}</a></td>
                        <td>{{ $answer->question->name }}</td>
                        @if($answer->is_correct==1)
                            <td style="color: green" >Правильный</td>
                        @else
                            <td style="color: red" >Не правильный</td>
                        @endif
                        <td>{{ $answer->created_at }}</td>
                        <td>
                            <a style="width: 66px" href="{{ route('answer.edit', $answer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>
                            <form action="{{route('answer.delete',$answer->id) }}" method="post">
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
