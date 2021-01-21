<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthHistoryMedicationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'health_history_medications';

    /**
     * Run the migrations.
     * @table health_history_medications
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('health_history_id');
            $table->bigInteger('doctor_id');
            $table->bigInteger('patient_id');
            $table->string('medi_name');
            $table->integer('medi_type');
            $table->text('medi_procedure');
            $table->integer('quantity');
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
