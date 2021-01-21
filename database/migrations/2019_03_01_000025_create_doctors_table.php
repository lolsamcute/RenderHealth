<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'doctors';

    /**
     * Run the migrations.
     * @table doctors
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('doctor_id');
            $table->bigInteger('hospital_id');
            $table->string('mdcn_register_no');
            $table->bigInteger('folio_number');
            $table->string('doctor_password');
            $table->string('doctor_first_name', 50);
            $table->string('doctor_last_name', 50);
            $table->string('doctor_email');
            $table->text('doctor_picture');
            $table->string('doctor_education_school');
            $table->string('doctor_degree', 50);
            $table->string('doctor_speciality', 50);
            $table->text('doctor_languages');
            $table->string('doctor_religion', 50);
            $table->string('doctor_ethnicity');
            $table->integer('doctor_years_practised');
            $table->tinyInteger('participate_render_platform');
            $table->longText('doctor_info');
            $table->string('doctor_tokbox_id');
            $table->text('doctor_tokbox_token');
            $table->string('doctor_timezone')->nullable()->default(null);
            $table->string('doctor_phone', 50);
            $table->string('doctor_state', 50);
            $table->string('doctor_country', 50);
            $table->string('remember_token');
            $table->string('fp_token');
            $table->integer('active_status')->default('1')->comment('1=>active,0=>inactive,2=>removed');
            $table->integer('access_to_hospital')->default('3')->comment('1=>Entry Patient Data,2=>Access Hospital Billings,3=>both');
            $table->integer('access_to_patient_record')->comment('1=>Access to Full Patient Record,2=>Limited Patient Record');
            $table->bigInteger('doctor_created_date');

            $table->index(["doctor_id"], 'doctor_id');
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
