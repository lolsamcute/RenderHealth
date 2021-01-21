<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientHealthDiaryTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'patient_health_diary';

    /**
     * Run the migrations.
     * @table patient_health_diary
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('diary_id');
            $table->bigInteger('patient_id');
            $table->tinyInteger('feeling_details')->nullable()->default(null);
            $table->text('symptom_details')->nullable()->default(null);
            $table->text('medication_details')->nullable()->default(null);
            $table->bigInteger('created_date');
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
