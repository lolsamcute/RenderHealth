<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'appointment_details';

    /**
     * Run the migrations.
     * @table appointment_details
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('appointment_id');
            $table->bigInteger('patient_id');
            $table->tinyInteger('appointment_type');
            $table->integer('telemedical_type')->nullable()->default(null);
            $table->integer('telemedical_consult_type')->nullable()->default(null)->comment('general=1, speciality =2');
            $table->integer('telemedical_consult_time')->nullable()->default(null)->comment('immediate=1, future=2');
            $table->bigInteger('appoint_created_date');
            $table->tinyInteger('status');
            $table->tinyInteger('call_status');
            $table->tinyInteger('appoint_booking_status');

            $table->index(["appointment_id"], 'appointment_id');
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
