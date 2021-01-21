<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthHistoryTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'health_history';

    /**
     * Run the migrations.
     * @table health_history
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('history_id');
            $table->bigInteger('patient_id');
            $table->bigInteger('doctor_id')->nullable()->default(null);
            $table->bigInteger('nurse_id')->nullable()->default(null);
            $table->bigInteger('employee_id')->nullable()->default(null);
            $table->bigInteger('hospital_id')->nullable()->default(null);
            $table->integer('assignee_type');
            $table->string('temperature', 20);
            $table->integer('temprature_type');
            $table->integer('measuring_type');
            $table->integer('pulse');
            $table->integer('respiratory_rate');
            $table->integer('bp_sys');
            $table->integer('bp_dia');
            $table->longText('general_notes')->nullable()->default(null);
            $table->longText('plan')->nullable()->default(null);
            $table->longText('cvs_det')->nullable()->default(null);
            $table->longText('respiratory_det')->nullable()->default(null);
            $table->longText('abdomen_det')->nullable()->default(null);
            $table->longText('cns_det')->nullable()->default(null);
            $table->float('rbc_det')->nullable()->default(null);
            $table->float('wbc_det')->nullable()->default(null);
            $table->float('hb_det')->nullable()->default(null);
            $table->integer('hmt_det')->nullable()->default(null);
            $table->integer('plt_det')->nullable()->default(null);
            $table->float('ch_ldl_det')->nullable()->default(null);
            $table->float('ch_hdl_det')->nullable()->default(null);
            $table->bigInteger('created_date')->nullable()->default(null);
            $table->bigInteger('updated_date');
            $table->bigInteger('updated_doc');
            $table->bigInteger('updated_nurse')->nullable()->default(null);
            $table->bigInteger('updated_employee')->nullable()->default(null);
            $table->integer('updated_hospital');

            $table->index(["history_id"], 'history_id');
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
