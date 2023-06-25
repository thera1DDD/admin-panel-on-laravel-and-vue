@extends('layouts.admin')

@section('title')
    Воспроиздведение
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Videos</h3>
            <div class="card-tools">
                <a href="{{ route('video.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new video</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <video id="video" controls></video>
            <script>
                var video = document.getElementById('video');
                if(Hls.isSupported()) {
                    var hls = new Hls();
                    hls.loadSource("{{getImage($video_file_path)  }}");
                    hls.attachMedia(video);
                    hls.on(Hls.Events.MANIFEST_PARSED,function() {
                        video.play();
                    });
                }
                else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                    video.src = "{{ getImage($video_file_path) }}";
                    video.addEventListener('loadedmetadata',function() {
                        video.play();
                    });
                }
            </script>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
