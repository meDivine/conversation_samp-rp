<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Screen\AsSource;

/**
 * @method static find(conversation $conv)
 */
class conversation extends Model
{
    use HasFactory;
    use asSource;

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
        'who_close',
        'forum_link'
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
                                       int $whoStart, string $forum)
    {
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
             * ID того, кто начал
             */
            'who_start' => $whoStart,
            /*
             * Статистика голосования по дефолту нули
             */
            'who_close' => NULL,
            /*
             * Ссылка на форумник
             */
            'forum_link' => $forum
        ]);
    }

    /*
     * Подтянем еще и название профиля для вывода имени, а не ида юзера
     */
    public function profile(): HasOne {
        return $this->hasOne(User::class, 'id', 'who_start');
    }

    public function closeInfo(): HasOne {
        return $this->hasOne(User::class, 'id', 'who_close');
    }

    /*
     * Получим логи выдвигаемого из другой таблицы
     */
    public function convlog(): HasOne {
        return $this->hasOne(conv_stats::class, 'conv_id');
    }

    /*
     * Получение данных в роуте,если данных нет, то 404 ошибка
     */
    public function getConvers($id) {
        return self::where('id' , $id)
            ->whereNull('who_close')
            ->firstOrFail();
    }
    /*
     * Статистика по голосам в голосовании
     */
    public function convVote(): HasMany {
        return $this->hasMany(conv_voting::class, 'conv_id');
    }
}
