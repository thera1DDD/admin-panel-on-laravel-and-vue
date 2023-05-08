@extends('layouts.admin')

@section('title')
    Demo Videos
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Demo Videos</h3>

            <div class="card-tools">
                <a href="{{ route('demovideo.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new demovideo</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Course</th>
                    <th>Video_file</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($demovideos as $demovideo)
                    <tr>
                        <td>{{ $demovideo->id }}</td>
                        <td>{{ $demovideo->name }}</td>
                        <td>{{ $demovideo->description }}</td>
                        <td>{{ $demovideo->course->name}}</td>
                        <td><a href="{{route('demovideo.play', $demovideo->id)}}">{{$demovideo->video_file}}</a></td>
                        <td>{{ $demovideo->created_at }}</td>
                        <td>
                            <a style="width: 66px"  href="{{ route('demovideo.edit', $demovideo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>
                            <form action="{{route('demovideo.delete',$demovideo->id) }}" method="post">
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
