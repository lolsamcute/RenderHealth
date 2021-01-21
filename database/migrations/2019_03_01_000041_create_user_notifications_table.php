<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_notifications';

    /**
     * Run the migrations.
     * @table user_notifications
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('notification_id');
            $table->bigInteger('doctor_id')->nullable()->default(null);
            $table->bigInteger('nurse_id')->nullable()->default(null);
            $table->bigInteger('employee_id')->nullable()->default(null);
            $table->bigInteger('hospital_id')->nullable()->default(null);
            $table->integer('assignee_type')->nullable()->default(null);
            $table->bigInteger('patient_id');
            $table->bigInteger('event_id')->nullable()->default(null);
            $table->string('notification_type', 20);
            $table->string('change_type', 50);
            $table->bigInteger('created_date');
            $table->tinyInteger('status');

            $table->index(["event_id"], 'render_notify_ibfk_3');

            $table->index(["patient_id"], 'render_notify_ibfk_1');


            $table->foreign('patient_id', 'render_notify_ibfk_1')
                ->references('patient_unique_id')->on('patients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
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
