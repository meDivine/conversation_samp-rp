<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

/**
 * App\Models\CaptureLog
 *
 * @property int $id
 * @property string $servertime
 * @property int $fraction
 * @property int $server
 * @property string $player
 * @property int $property
 * @property int $owner
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Fraction|null $fracIdToName
 * @method static Builder|CaptureLog newModelQuery()
 * @method static Builder|CaptureLog newQuery()
 * @method static Builder|CaptureLog query()
 * @method static Builder|CaptureLog whereCreatedAt($value)
 * @method static Builder|CaptureLog whereFraction($value)
 * @method static Builder|CaptureLog whereId($value)
 * @method static Builder|CaptureLog whereOwner($value)
 * @method static Builder|CaptureLog wherePlayer($value)
 * @method static Builder|CaptureLog whereProperty($value)
 * @method static Builder|CaptureLog whereServer($value)
 * @method static Builder|CaptureLog whereServertime($value)
 * @method static Builder|CaptureLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CaptureLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'servertime',
        'fraction',
        'server',
        'player',
        'property',
        'owner',
    ];
    /*
     * Олдовый хелпер, нашел сто лет назад и до сих пор использую
     * Вычисляет разность между двумя массивами
     */
    function unique_my_array($array1, $array2): array
    {
        $array3 = [];
        foreach ($array2 as $item) {
            array_push($array3, $item); // если по ключу, то $item['key]
        }
        foreach ($array1 as $key => $item) {
            if (in_array($item, $array3)) unset($array1[$key]); // если по ключу, то $item['key]
        }

        return $array1;
    }

    public function fracIdToName(): HasOne
    {
        return $this->hasOne(Fraction::class, 'id', 'fraction');
    }

    /*
     * Метод записи в бд
     */
    private function addlog($servertime, $server, $fraction,
                           $player, $property, $owner) {
        return self::create([
            'servertime' => $servertime,
            'server' => $server,
            'fraction' => $fraction,
            'player' => $player,
            'property' => $property,
            'owner' => $owner
        ]);
    }
    /*
     * Сравниваю записанные логи с базы и с чекера. Запишу отсутствующие в бд и пошлю уведомление
     */
    public function getLogs(): array
    {
        $all = self::select('servertime', 'server','fraction', 'player', 'property', 'owner')->get()->toArray();
        $bot = new Bot();
        /* $all_logs = [
             'servertime' => $all->servertime,
             'server' => $all['server'],
             'fraction' => $all['fraction'],
             'player' => $all['player'],
             'property' => $all['property'],
             'owner' => $all['owner'],
         ];*/
        $botLogs = $bot->getCaptureLogToday();
        return $this->unique_my_array($botLogs, $all);
    }
    /*
     * Билдим сообщение-шаблон о начале войны за территорию
     */
    private function captureMessage($servertime, $fraction, $owner, $player):string {
        return "\xF0\x9F\x91\x8AНачало войны\xF0\x9F\x91\x8A\n\xF0\x9F\x94\xAA Атакует: $fraction\n\xF0\x9F\x90\xB7 Защищается: $owner\n\xF0\x9F\x92\xAA Инициатор: $player\n\xF0\x9F\x95\x90 Начало: $servertime (МСК)";
    }
    /*
     * Если пустой массив - нет новых логов о каптурах  - fale
     * Иначе true
     */
    private function captureObserveStatus(): bool {
        return !empty($this->getLogs());
    }

    /*
     * Сам наблюдатель
     */
    public function CaptureObserve() {
        $observeStatus = $this->captureObserveStatus();
        if ($observeStatus) {
            $newCaptures = $this->getLogs();
            $fractions = new Fraction();
            foreach ( $newCaptures as $key) {
                $servertime = $key['servertime'];
                $server = $key['server'];
                $fraction = $key['fraction'];
                $player = $key['player'];
                $property = $key['property'];
                $owner = $key['owner'];
                $this->addlog($servertime, $server, $fraction, $player, $property, $owner);
                $this->sendVkMess(165685444, $this->captureMessage($servertime, $fractions->renameFracName($fraction), $fractions->renameFracName($owner), $player));
                $this->sendVkMess(409277011, $this->captureMessage($servertime, $fractions->renameFracName($fraction), $fractions->renameFracName($owner), $player));
            }
        }
    }
    /*
     * Отправим сообщение вк от группы
     */
    private function sendVkMess($user_id, $mess): Response
    {
        $uid = $user_id;
        $message = rawurlencode($mess);
        return Http::post("https://api.vk.com/method/messages.send?user_id=$uid&v=5.81&access_token=883d11ee80ecba881bd87b72b04a868aca67fa17a71f8b620212cf458718aba81a6205e5c02786c0fdfeb&message=$message");

    }
}
