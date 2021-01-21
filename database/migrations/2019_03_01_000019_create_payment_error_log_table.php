<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentErrorLogTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'payment_error_log';

    /**
     * Run the migrations.
     * @table payment_error_log
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('error_id')->nullable()->default(null);
            $table->bigInteger('billing_id')->nullable()->default(null);
            $table->bigInteger('patient_id')->nullable()->default(null);
            $table->bigInteger('transaction_id')->nullable()->default(null);
            $table->longText('error_msg');
            $table->bigInteger('created_time');
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
