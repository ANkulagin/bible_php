<?php


// Имеющийся интерфейс
interface MediaPlayer
{
    public function play(string $fileName): void;
}

// Конкретная реализация медиаплеера
class AudioPlayer implements MediaPlayer
{
    public function play(string $fileName): void
    {
        echo "Играет аудиофайл: $fileName\n";
    }
}

// Интерфейс аудиоплеера
interface AdvancedMediaPlayer
{
    public function playMp4(string $fileName): void;
}

// Конкретная реализация аудиоплеера
class Mp4Player implements AdvancedMediaPlayer
{
    public function playMp4(string $fileName): void
    {
        echo "Играет MP4 файл: $fileName\n";
    }
}

// Адаптер для аудиоплеера, чтобы он мог работать с MediaPlayer
class MediaAdapter implements MediaPlayer
{
    private AdvancedMediaPlayer $advancedMediaPlayer;

    public function __construct(string $audioType)
    {
        if ($audioType === 'mp4') {
            $this->advancedMediaPlayer = new Mp4Player();
        }
    }

    public function play(string $fileName): void
    {
        if ($this->advancedMediaPlayer instanceof AdvancedMediaPlayer) {
            $this->advancedMediaPlayer->playMp4($fileName);
        } else {
            echo "Неподдерживаемый формат аудио: $fileName\n";
        }
    }
}

// Пример использования
$audioPlayer = new AudioPlayer();
$audioPlayer->play("song.mp3");

$adapter = new MediaAdapter('mp4');
$adapter->play("movie.mp4");


