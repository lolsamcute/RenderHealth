<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmoDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'hmo_details';

    /**
     * Run the migrations.
     * @table hmo_details
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('hmo_id');
            $table->string('hmo_first_name');
            $table->string('hmo_middle_name')->nullable()->default(null);
            $table->string('hmo_last_name');
            $table->string('hmo_email');
            $table->string('hmo_phone_number');
            $table->string('hmo_username');
            $table->string('hmo_password');
            $table->text('hmo_company_name');
            $table->string('hmo_position');
            $table->bigInteger('created_date');
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
