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
     * Мутатор по измению числовых типов на буквенные
     */
    public function getTypeAttribute()
    {
        $type = [
            0    =>    'Администратор',
            1    =>    'Помощник',
            2    =>    'Остальные',
        ];
        return $type[ $this->attributes['type'] ];
    }
    /*
     * Создаем голосование
     * Вызывать будем через Job
     */
    public function createConversation(int $type, string $social, string $nickname,
                                       string $about, string $realName, string $leaderships,
                                       int $whoStart) {
        return self::create([
            /*
             * тип голосования
             * 0 - администратор
             * 1 - саппорт
             * 2 - прочее
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

    /*
     * Подтянем еще и название профиля для вывода имени, а не ида юзера
     */
    public function profile()
    {
        return $this->hasOne(User::class, 'id', 'who_start');
    }

    /*
     * Получим логи выдвигаемого из другой таблицы
     */
    public function convlog() {
        return $this->hasOne(conv_stats::class, 'conv_id');
    }

    /*
     * Получение данных в роуте,если данных нет, то 404 ошибка
     */
    public function getConvers($id) {
        return self::findOrFail($id);
    }


}
