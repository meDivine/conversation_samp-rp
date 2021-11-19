<?php

use App\Models\Fraction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fractions', function (Blueprint $table) {
            $table->id();
            $table->string('frac_name', 32);
        });
        /*
         * Запись всех игровых фракций в бд
         * Ид записи сопоставим с идом фракции в /apanel
         */
        $frac = [
            /*
             * 1
             */
            [
                'frac_name' => 'Police LS'
            ],
            [
                'frac_name' => 'FBI'
            ],
            [
                'frac_name' => 'Army LV'
            ],
            [
                'frac_name' => 'Medic'
            ],
            [
                'frac_name' => 'LCN'
            ],
            [
                'frac_name' => 'Yakuza'
            ],
            [
                'frac_name' => 'Mayor'
            ],
            [
                'frac_name' => 'Russian Mafia'
            ],
            [
                'frac_name' => 'News SF'
            ],
            /*
             * 10
             */
            [
                'frac_name' => 'News LS'
            ],
            [
                'frac_name' => 'Instructors'
            ],
            [
                'frac_name' => 'Rifa'
            ],
            [
                'frac_name' => 'Grove street'
            ],
            [
                'frac_name' => 'Ballas'
            ],
            [
                'frac_name' => 'Vagos'
            ],
            [
                'frac_name' => 'Aztec'
            ],
            [
                'frac_name' => 'Police SF'
            ],
            [
                'frac_name' => 'Police LV'
            ],
            [
                'frac_name' => 'Army SF'
            ],
            /*
             * 20
             */
            [
                'frac_name' => 'News LV'
            ],
            [
                'frac_name' => 'Hells Angels MC'
            ],
            [
                'frac_name' => 'Mongols MC'
            ],
            [
                'frac_name' => 'Pagans MC'
            ],
            [
                'frac_name' => 'Outlaws MC'
            ],
            [
                'frac_name' => 'Sons of Silence MC'
            ],
            [
                'frac_name' => 'Warlocks MC'
            ],
            [
                'frac_name' => 'Highwaymen MC'
            ],
            [
                'frac_name' => 'Bandidos MC'
            ],
            [
                'frac_name' => 'Free Souls MC'
            ],
            /*
             * 30
             */
            [
                'frac_name' => 'Vagos MC'
            ],
        ];
        Fraction::insert($frac);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fractions');
    }
}
