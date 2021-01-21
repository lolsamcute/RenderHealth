<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorAvailabilityTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'doctor_availability';

    /**
     * Run the migrations.
     * @table doctor_availability
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('availability_id');
            $table->bigInteger('doctor_id');
            $table->bigInteger('availability_date');
            $table->longText('availability_time');
            $table->integer('type')->nullable()->default(null)->comment('"1"=>telemedical, "2"=>"hospital"');
            $table->tinyInteger('booking_status');
            $table->bigInteger('created_date');

            $table->index(["doctor_id"], 'doctor_id');


            $table->foreign('doctor_id', 'doctor_id')
                ->references('doctor_id')->on('doctors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
