<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientNotificationSettingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'patient_notification_settings';

    /**
     * Run the migrations.
     * @table patient_notification_settings
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->bigInteger('patient_id');
            $table->string('Notification_unique_id');
            $table->tinyInteger('appointment_activity_email');
            $table->tinyInteger('newsletter_subscription');
            $table->tinyInteger('patient_history_notification');
            $table->tinyInteger('appointment_activity_push');
            $table->tinyInteger('appointment_activity_sms');
            $table->tinyInteger('appointment_cancel_email');
            $table->tinyInteger('appointment_cancel_push');
            $table->tinyInteger('appointment_cancel_sms');
            $table->tinyInteger('appointment_reschedule_email');
            $table->tinyInteger('appointment_reschedule_push');
            $table->tinyInteger('appointment_reschedule_sms');
            $table->tinyInteger('patient_history_push');
            $table->tinyInteger('patient_appt_reminder_push');
            $table->tinyInteger('patient_appt_reminder_sms');
            $table->tinyInteger('patient_bill_push');
            $table->tinyInteger('patient_bill_sms');
            $table->tinyInteger('heath_diary_push');
            $table->tinyInteger('outstanding_bill_push');
            $table->tinyInteger('outstanding_bill_email');
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
