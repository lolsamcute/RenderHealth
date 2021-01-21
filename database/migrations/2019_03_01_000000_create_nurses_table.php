<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNursesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'nurses';

    /**
     * Run the migrations.
     * @table nurses
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('nurse_id');
            $table->bigInteger('hospital_id');
            $table->string('mdcn_register_no');
            $table->bigInteger('folio_number');
            $table->string('nurse_password');
            $table->string('nurse_first_name', 50);
            $table->string('nurse_last_name', 50);
            $table->string('nurse_email');
            $table->text('nurse_picture');
            $table->string('nurse_education_school');
            $table->string('nurse_degree', 50);
            $table->string('nurse_speciality', 50);
            $table->text('nurse_languages');
            $table->string('nurse_religion', 50);
            $table->string('nurse_ethnicity');
            $table->integer('nurse_years_practised');
            $table->tinyInteger('participate_render_platform');
            $table->longText('nurse_info');
            $table->string('nurse_timezone')->nullable()->default(null);
            $table->string('nurse_phone', 50);
            $table->string('nurse_state', 50);
            $table->string('nurse_country', 50);
            $table->string('remember_token');
            $table->string('fp_token');
            $table->integer('active_status')->default('1')->comment('1=>active,0=>inactive');
            $table->integer('access_to_hospital')->default('3')->comment('1=>Entry Patient Data,2=>Access Hospital Billings,3=>both');
            $table->integer('access_to_patient_record')->comment('1=>Access to Full Patient Record,2=>Limited Patient Record');
            $table->bigInteger('nurse_created_date');

            $table->index(["nurse_id"], 'doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
