<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthHistoryAttachmentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'health_history_attachments';

    /**
     * Run the migrations.
     * @table health_history_attachments
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('patient_attachment_id');
            $table->bigInteger('patient_history_id');
            $table->bigInteger('patient_id');
            $table->string('patient_lab_name')->nullable()->default(null);
            $table->integer('attachment_type');
            $table->string('patient_attachment_name')->nullable()->default(null);
            $table->integer('type')->default('1');
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
