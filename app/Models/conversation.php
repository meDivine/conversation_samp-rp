<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'social',
        'nickname',
        'about',
        'real_name',
        'leaderships',
        'who_start',
        'agree',
        'disagree',
        'neutral',
        'who_close'
    ];
    /*
     * Создаем голосование
     * Добавим его в Job чтобы после создания голосования приложение профлудило во вконтакте в фоне.
     */
    public function createConversation(int $type, string $social, string $nickname,
                                       string $about, string $realName, string $leaderships,
                                       int $whoStart) {
        return self::create([
            /*
             * тип голосования
             * 1 - администратор
             * 2 - саппорт
             * 3 - прочее
             */
            'type' => $type,
            /*
             * Ссылка на социальные сети выдвигаемого
             */
            'social' => $social,
            /*
             * Игровой ник выдвигаемого
             */
            'nickname' => $nickname,
            /*
             * Краткая инфа о кандидате
             */
            'about' => $about,
            /*
             * Реальное имя
             */
            'real_name' => $realName,
            /*
             * Список лидерств
             */
            'leaderships' => $leaderships,
            /*
             * ID того, кто начал (не VKID )
             */
            'who_start' => $whoStart,
            /*
             * Статистика голосования по дефолту нули
             */
            'agree' => 0,
            'disagree' => 0,
            'neutral' => 0,
            'who_close' => NULL
        ]);
    }
}
