<?php

namespace App\Http\Controllers;

use App\Models\CaptureLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class VkontakteAuth extends Controller
{

    public function redirect(): RedirectResponse
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback() {
        /*
         * Берём данные из вк
         */
        $vkontakte = Socialite::driver('vkontakte')->user();
        //dd($vkontakte);
        $user = new User();
        /*
         * Создаем юзера или ищем инфу о нем
         */
        $createOrRegister = $user->createOrRegister($vkontakte->getEmail(), $vkontakte->getName(),
            $vkontakte->getAvatar(), $vkontakte->getId());
        /*
         * Авторизуемся с данными
         */
        Auth::login($createOrRegister);
        /*
         * Обновим данные о юзере
         */
        $user->updateUser($vkontakte->getId(), $vkontakte->getAvatar(),
            $vkontakte->getName(), $vkontakte->getEmail());
        /*
         * переход на стартовую страницу
         */
        return redirect(route('home'));
    }

    public function test() {
            $newuser = User::find(1);
            Auth::login($newuser, true);
            return Auth::user()->name;
    }
}
