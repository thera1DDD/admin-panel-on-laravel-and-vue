@extends('layouts.admin')

@section('title')
    Воспроизведение
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
        <!-- HTML-код для воспроизведения видео -->
        <div class="card-body table-responsive p-0">
            <video id="video" controls></video>
        </div>


    </div>
@endsection
<!-- Подключение библиотеки Hls.js -->
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<!-- Ваш собственный JavaScript код -->
<script>
    // Получение ссылки на видеоэлемент
    var video = document.getElementById('video');

    // Создание экземпляра Hls
    var hls = new Hls();

    // Загрузка и воспроизведение M3U8 файла
    hls.loadSource("{{ getImage($video_file_path) }}");
    hls.attachMedia(video);

    // Обработчик события после загрузки плейлиста
    hls.on(Hls.Events.MANIFEST_PARSED, function() {
        // Получение всех доступных вариантов качества видео
        var availableQualities = hls.levels.map(function(level) {
            return level.height;
        });

        // Функция для выбора наилучшего варианта качества в зависимости от скорости интернета
        function selectQuality() {
            // Получение текущей скорости интернета (в мегабитах в секунду)
            var connectionSpeed = navigator.connection.downlink || 0;

            // Выбор наилучшего варианта качества
            var bestQuality = Math.max.apply(null, availableQualities.filter(function(quality) {
                return quality <= connectionSpeed;
            }));

            // Установка выбранного варианта качества
            hls.currentLevel = hls.levels.findIndex(function(level) {
                return level.height === bestQuality;
            });
        }

        // Вызов функции выбора качества при начале воспроизведения
        video.addEventListener('play', selectQuality);
    });

    // Включение автоматического изменения качества при изменении скорости интернета
    if (navigator.connection && navigator.connection.addEventListener) {
        navigator.connection.addEventListener('change', selectQuality);
    }
</script>
<!-- /.card-body -->
