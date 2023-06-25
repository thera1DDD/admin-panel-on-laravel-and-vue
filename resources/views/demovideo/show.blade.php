@extends('layouts.admin')

@section('title')
    Воспроизведение
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Демонстративное видео</h3>
            <div class="card-tools">
                <a href="{{ route('demovideo.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить видео</a>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- Ваш код HTML для воспроизведения видео -->
        <div class="card-body table-responsive p-0">
            <video id="video" controls></video>
        </div>

    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        // Получение ссылки на видеоэлемент
        var video = document.getElementById('video');

        if (Hls.isSupported()) {
            // Создание экземпляра Hls
            var hls = new Hls();

            // Загрузка и воспроизведение M3U8 файла
            hls.loadSource("{{ getImage($video_file_path) }}");
            hls.attachMedia(video);

            hls.on(Hls.Events.MANIFEST_PARSED, function() {
                video.play();
            });
        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            // Воспроизведение M3U8 файла с использованием стандартного видеоэлемента
            video.src = "{{ getImage($video_file_path) }}";
            video.addEventListener('loadedmetadata', function() {
                video.play();
            });
        }
    });
</script>
<!-- /.card-body -->
