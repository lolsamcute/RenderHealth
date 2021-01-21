<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'billing_details';

    /**
     * Run the migrations.
     * @table billing_details
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('billing_id');
            $table->integer('billing_date');
            $table->bigInteger('paid_date')->nullable()->default(null);
            $table->bigInteger('patient_id');
            $table->bigInteger('doctor_id')->nullable()->default(null);
            $table->bigInteger('nurse_id')->nullable()->default(null);
            $table->bigInteger('employee_id')->nullable()->default(null);
            $table->bigInteger('hospital_id');
            $table->bigInteger('assignee_type');
            $table->bigInteger('history_id');
            $table->string('invoice_number');
            $table->integer('payable_amount');       
            $table->integer('disputed');
            $table->integer('paid_amount')->nullable()->default('0');
            $table->tinyInteger('seen_status');
            
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
