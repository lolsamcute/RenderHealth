<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'patients';

    /**
     * Run the migrations.
     * @table patients
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('patient_unique_id')->nullable()->default(null);
            $table->string('patient_username', 20);
            $table->string('patient_password');
            $table->string('patient_first_name', 50)->nullable()->default(null);
            $table->string('patient_middle_name')->nullable()->default(null);
            $table->string('patient_last_name', 50)->nullable()->default(null);
            $table->string('patient_gender', 20)->nullable()->default(null);
            $table->string('patient_email');
            $table->string('patient_phone', 50)->nullable()->default(null);
            $table->text('patient_address')->nullable()->default(null);
            $table->text('patient_visited_hospital')->nullable()->default(null);
            $table->string('patient_doctor_name', 50)->nullable()->default(null);
            $table->string('patient_doctor_phone', 50)->nullable()->default(null);
            $table->string('patient_martial_status', 20)->nullable()->default(null);
            $table->bigInteger('patient_date_of_birth')->nullable()->default(null);
            $table->string('patient_blood_type', 11)->nullable()->default(null);
            $table->string('patient_origin_state', 11)->nullable()->default(null);
            $table->text('patient_languages')->nullable()->default(null);
            $table->string('patient_insurance', 11)->nullable()->default(null);
            $table->bigInteger('patient_end_subscription');
            $table->string('patient_profile_img')->nullable()->default(null);
            $table->string('timezone', 50)->nullable()->default(null);
            $table->string('remember_token')->nullable()->default(null);
            $table->string('fp_token')->nullable()->default(null);

            $table->index(["patient_unique_id"], 'patient_unique_id');
            $table->nullableTimestamps();
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
