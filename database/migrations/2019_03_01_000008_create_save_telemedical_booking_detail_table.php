<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaveTelemedicalBookingDetailTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'save_telemedical_booking_detail';

    /**
     * Run the migrations.
     * @table save_telemedical_booking_detail
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('booking_id');
            $table->bigInteger('appointment_id')->nullable()->default(null);
            $table->string('booking_name');
            $table->bigInteger('patient_id');
            $table->bigInteger('doctor_id')->nullable()->default(null);
            $table->integer('specialist_id');
            $table->string('hospital_name');
            $table->bigInteger('hospital_id');
            $table->string('mobile_number');
            $table->text('symptoms')->nullable()->default(null);
            $table->tinyInteger('sharing_status')->nullable()->default(null);
            $table->integer('terms_conditions')->nullable()->default(null);
            $table->bigInteger('appointment_time')->nullable()->default(null);
            $table->integer('status')->default('1');
            $table->integer('approved_status');
            $table->tinyInteger('call_status');
            $table->tinyInteger('allowed_status');
            $table->bigInteger('created_at');
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
