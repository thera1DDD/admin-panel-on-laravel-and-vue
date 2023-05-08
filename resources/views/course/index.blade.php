@extends('layouts.admin')

@section('title')
    Courses
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Course</h3>

            <div class="card-tools">
                <a href="{{ route('course.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new course</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Language</th>
                    <th>Main Image</th>
                    <th>Slug</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->language->name}}</td>
                        <td><a href="{{route('course.play', $course->id)}}">{{$course->main_image}}</a></td>
                        <td>{{ $course->slug }}</td>
                        <td>{{ $course->created_at }}</td>
                        <td>
                            <a style="width: 66px" href="{{ route('course.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>

                            <form action="{{route('course.delete',$course->id) }}" method="post">
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
