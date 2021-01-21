<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'hospitals';

    /**
     * Run the migrations.
     * @table hospitals
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('hosp_id');
            $table->string('mdcn_register_no');
            $table->bigInteger('folio_number');
            $table->string('hosp_password');
            $table->string('hosp_name', 50);
            $table->string('hosp_email');
            $table->text('hosp_picture');
            $table->string('hosp_education_school');
            $table->string('hosp_degree', 50);
            $table->string('hosp_speciality', 50);
            $table->text('hosp_languages');
            $table->string('hosp_religion', 50);
            $table->string('hosp_ethnicity');
            $table->integer('hosp_years_practised');
            $table->tinyInteger('participate_render_platform');
            $table->longText('hosp_info');
            $table->string('hosp_timezone')->nullable()->default(null);
            $table->string('hosp_phone', 50);
            $table->text('hosp_address')->nullable()->default(null);
            $table->string('hosp_state', 50);
            $table->string('hosp_country', 50);
            $table->string('remember_token');
            $table->string('fp_token');
            $table->integer('pending_status')->comment('0=>unapproved,1=>approved,2=>ignored');
            $table->integer('access_to_record')->default('1')->comment('1=>full,2=>limited');
            $table->bigInteger('hosp_created_date');

            $table->index(["hosp_id"], 'doctor_id');
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
