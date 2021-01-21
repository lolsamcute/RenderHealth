<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalLoginTokenTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'hospital_login_token';

    /**
     * Run the migrations.
     * @table hospital_login_token
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('hosp_id');
            $table->string('app_version');
            $table->text('login_token');
            $table->text('device_token')->nullable()->default(null);
            $table->integer('token_status');
            $table->integer('device_type');
            $table->integer('device_id');

            $table->index(["hosp_id"], 'patient_id');
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
       Schema::dropIfExists($this->tableName);
     }
}
