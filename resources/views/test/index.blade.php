@extends('layouts.admin')

@section('title')
    Tests
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Test</h3>

            <div class="card-tools">
                <a href="{{ route('test.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new test</a>
                <a href="{{ route('question.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new question</a>
                <a href="{{ route('answer.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new answer</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tests as $test)
                    <tr>
                        <td>{{ $test->id }}</td>
                        <td><a href="{{route('test.show', $test->id)}}">{{$test->name}}</a></td>
                        <td>{{ $test->testable_type }}</td>

                        <td>{{ $test->created_at }}</td>
                        <td>
                            <a style="width: 66px" href="{{ route('test.edit', $test->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>

                            <form action="{{route('test.delete',$test->id) }}" method="post">
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
