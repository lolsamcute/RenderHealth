<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientLoginTokenTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'patient_login_token';

    /**
     * Run the migrations.
     * @table patient_login_token
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('patient_id');
            $table->text('login_token');
            $table->text('device_token')->nullable()->default(null);
            $table->integer('token_status');
            $table->integer('device_type');

            $table->index(["patient_id"], 'patient_id');


            $table->foreign('patient_id', 'patient_id')
                ->references('patient_unique_id')->on('patients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
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
