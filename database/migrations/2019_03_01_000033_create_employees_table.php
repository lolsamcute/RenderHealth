<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'employees';

    /**
     * Run the migrations.
     * @table employees
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('employee_id');
            $table->string('mdcn_register_no');
            $table->bigInteger('folio_number');
            $table->string('employee_password');
            $table->string('employee_first_name', 50);
            $table->string('employee_last_name', 50);
            $table->string('employee_email');
            $table->text('employee_picture');
            $table->string('employee_education_school');
            $table->string('employee_degree', 50);
            $table->string('employee_speciality', 50);
            $table->text('employee_languages');
            $table->string('employee_religion', 50);
            $table->string('employee_ethnicity');
            $table->integer('employee_years_practised');
            $table->tinyInteger('participate_render_platform');
            $table->longText('employee_info');
            $table->string('employee_timezone')->nullable()->default(null);
            $table->string('employee_phone', 50);
            $table->string('employee_state', 50);
            $table->string('employee_country', 50);
            $table->string('employee_address', 200);
            $table->string('employee_role', 50);
            $table->string('remember_token');
            $table->string('fp_token');
            $table->integer('active_status')->default('1')->comment('1=>active,0=>inactive,2=>removed');
            $table->integer('access_to_hospital')->default('3')->comment('1=>Entry Patient Data,2=>Access Hospital Billings,3=>both');
            $table->integer('access_to_patient_record')->comment('1=>Access to Full Patient Record,2=>Limited Patient Record');
            $table->bigInteger('employee_created_date');

            $table->index(["employee_id"], 'doctor_id');
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
