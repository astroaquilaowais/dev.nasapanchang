<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKundalisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kundalis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('locality');
            $table->string('pin');
            $table->date('dob');
            $table->string('tob'); // Time of birth
            $table->string('gmt');
            $table->string('lmt');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('ayan');
            $table->string('ayan_name');
            $table->string('cst');
            $table->string('dst');
            $table->string('subtime');
            $table->string('timezone');
            $table->string('juliyan');
            $table->string('lmt_birthtime');
            $table->string('gmt_birthtime');
            $table->string('timedifference');


            // Sun Rise/Set
            $table->string('sunRiseYesterday');
            $table->string('sunSetYesterday');
            $table->string('sunRiseToday');
            $table->string('sunSetToday');
            $table->string('sunRiseTomorrow');
            $table->string('sunSetTomorrow');
            $table->string('moonRiseYesterday');
            $table->string('moonSetYesterday');
            $table->string('moonRiseToday');
            $table->string('moonSetToday');
            $table->string('moonRiseTomorrow');
            $table->string('moonSetTomorrow');

            $table->string('choice');
            $table->string('sub_choice');

            $table->text('saryana_dms_ascendant')->nullable();
            $table->text('saryana_dms_sun')->nullable();
            $table->text('saryana_dms_moon')->nullable();
            $table->text('saryana_dms_mercury')->nullable();
            $table->text('saryana_dms_venus')->nullable();
            $table->text('saryana_dms_mars')->nullable();
            $table->text('saryana_dms_juipter')->nullable();
            $table->text('saryana_dms_saturn')->nullable();
            $table->text('saryana_dms_rahu')->nullable();
            $table->text('saryana_dms_ketu')->nullable();

            $table->text('nirayana_dms_ascendant')->nullable();
            $table->text('nirayana_dms_sun')->nullable();
            $table->text('nirayana_dms_moon')->nullable();
            $table->text('nirayana_dms_mercury')->nullable();
            $table->text('nirayana_dms_venus')->nullable();
            $table->text('nirayana_dms_mars')->nullable();
            $table->text('nirayana_dms_juipter')->nullable();
            $table->text('nirayana_dms_saturn')->nullable();
            $table->text('nirayana_dms_rahu')->nullable();
            $table->text('nirayana_dms_ketu')->nullable();



            $table->text('sary_degree_ascendant')->nullable();
            $table->text('sary_degree_sun')->nullable();
            $table->text('sary_degree_moon')->nullable();
            $table->text('sary_degree_mercury')->nullable();
            $table->text('sary_degree_venus')->nullable();
            $table->text('sary_degree_mars')->nullable();
            $table->text('sary_degree_juipter')->nullable();
            $table->text('sary_degree_saturn')->nullable();
            $table->text('sary_degree_rahu')->nullable();
            $table->text('sary_degree_ketu')->nullable();

            $table->text('niray_degree_ascendant')->nullable();
            $table->text('niray_degree_sun')->nullable();
            $table->text('niray_degree_moon')->nullable();
            $table->text('niray_degree_mercury')->nullable();
            $table->text('niray_degree_venus')->nullable();
            $table->text('niray_degree_mars')->nullable();
            $table->text('niray_degree_juipter')->nullable();
            $table->text('niray_degree_saturn')->nullable();
            $table->text('niray_degree_rahu')->nullable();
            $table->text('niray_degree_ketu')->nullable();

            $table->string('planet_selection');

            $table->text('degree_input');

            $table->float('starting_degree1');
            $table->float('ending_degree1');
            $table->float('range1');

            $table->float('starting_degree2');
            $table->float('ending_degree2');
            $table->float('range2');

            $table->float('starting_degree3');
            $table->float('ending_degree3');
            $table->float('range3');

            $table->float('starting_degree4');
            $table->float('ending_degree4');
            $table->float('range4');

            $table->float('starting_degree5');
            $table->float('ending_degree5');
            $table->float('range5');

            $table->float('starting_degree6');
            $table->float('ending_degree6');
            $table->float('range6');

            $table->float('starting_degree7');
            $table->float('ending_degree7');
            $table->float('range7');

            $table->float('starting_degree8');
            $table->float('ending_degree8');
            $table->float('range8');

            $table->float('starting_degree9');
            $table->float('ending_degree9');
            $table->float('range9');

            $table->float('starting_degree10');
            $table->float('ending_degree10');
            $table->float('range10');

            $table->float('starting_degree11');
            $table->float('ending_degree11');
            $table->float('range11');

            $table->float('starting_degree12');
            $table->float('ending_degree12');
            $table->float('range12');

            $table->float('house1')->nullable();
            $table->float('house2')->nullable();
            $table->float('house3')->nullable();
            $table->float('house4')->nullable();
            $table->float('house5')->nullable();
            $table->float('house6')->nullable();
            $table->float('house7')->nullable();
            $table->float('house8')->nullable();
            $table->float('house9')->nullable();
            $table->float('house10')->nullable();
            $table->float('house11')->nullable();
            $table->float('house12')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kundalis');
    }
}
