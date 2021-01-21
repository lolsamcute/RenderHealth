<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('/patient/patient_appointment', 'Patient\AppointmentController@patient_appointment'); //Patient hospital appointment
Auth::routes();
Route::get('/home', 'HomeController@index');
  //Rotes for patient portal
  Route::prefix('patient')->group(function() {
    Route::get('/signup', 'Auth\PatientController@showRegisterForm')->name('patient.register'); //Patient Signup
    Route::post('/signup', 'Auth\PatientController@register')->name('patient.register.submit'); //Patient Signup
    Route::get('/login', 'Auth\PatientController@showLoginForm')->name('patient.login'); //Patient login
    Route::post('/login', 'Auth\PatientController@login')->name('patient.login.submit'); //Patient login
    Route::get('/save_transac_det', 'Auth\PatientController@saveTranDetails');  //Patient save transaction details
    Route::get('/dashboard/{return?}', 'Patient\PatientDashboardController@index')->name('patient.dashboard'); //Patient dashboard when clicking on appointment list telemedical appointment
    Route::post('/appointment_details', 'Patient\PatientDashboardController@appointmentDetails'); //Patient save transaction details
    Route::get('/immediate_tele_details/{id}/{speciality?}', 'Patient\PatientDashboardController@immediateTelemedical'); //Immediate telemedical appointment
    Route::get('/future_tele_details/{id}/{doctor_id}/{date}/{time}/{speciality?}', 'Patient\PatientDashboardController@futureTelemedical'); //Future telemedical appointment
    Route::get('/telemedical_doctors_listing/{id}/{date}/{type}/{speciality?}', 'Patient\PatientDashboardController@doctorListing'); //Get doctor listing forspecific date and speciality
    Route::get('/immediate_speciality_details/{id}', 'Patient\PatientDashboardController@specialityTelemedical'); //Speciality listing
    Route::post('/save_book_details', 'Patient\PatientDashboardController@saveBookDetails'); //Save booking details
    Route::get('/my_appointments/{type?}/{spe?}/{hosp?}', 'Patient\PatientDashboardController@myAppointments'); //My appointments list with filters
    Route::get('/logout', 'Auth\PatientController@logout')->name('patient.logout'); //Patient logout
    Route::post('/forgotpassword', 'Auth\PatientController@forgotpassword'); //Patient forgot password
    Route::get('/recoverpassword/{user_id}/{fptoken}', 'Auth\PatientController@recoverpassword'); //Patient recover password
    Route::post('/resetpassword', 'Auth\PatientController@resetpasswordform'); //Patient reset password form
    Route::get('/appointment_detail/{id?}', 'Patient\PatientDashboardController@appointmentDetail'); //Patient appointment detail
    Route::get('/health_diary', 'Patient\PatientHealthDiaryController@healthDiary'); //Patient heath diary
    Route::get('/add_new_diary', 'Patient\PatientHealthDiaryController@addNewDiary'); //Patient add new health diary
    Route::get('/my_profile', 'Patient\PatientPagesController@myProfile'); //Patient profile
    Route::get('/notifications', 'Patient\PatientPagesController@notifications'); //Patient notfication settings
    Route::get('/settings', 'Patient\PatientPagesController@settings'); //Patient settings
    Route::post('/profile', 'Patient\PatientPagesController@profile'); //Patient update profile
    Route::post('/profile_notification', 'Patient\PatientPagesController@profileNotification'); //Patient update notifcations
    Route::post('/account_setting', 'Patient\PatientPagesController@accountSetting'); //Patient update profile
    Route::get('/billing', 'Patient\PatientPagesController@billing'); //Patient billing list
    Route::get('/paybill/{id}', 'Patient\PatientPagesController@paybill'); //Patient billing detail
    Route::get('/update_timezone/{time_zone}/{dst}', 'Patient\PatientDashboardController@updateTimezone'); //Patient update timezone

    //Appointments
    Route::get('/hospital_appointment/{id}', 'Patient\PatientDashboardController@hospitalAppointment'); //Patient hospital appointment
    Route::get('/appointment', 'Patient\AppointmentController@index'); //Patient hospital appointment
    Route::get('/get_paitint_by_doctor/{id?}','Patient\AppointmentController@getPaitintByDoctor'); //get doctor
    Route::post('/save_appointment_details', 'Patient\AppointmentController@saveAppointmentDetails'); //Save booking details


    Route::get('/hospital_doctors_listing/{id}', 'Patient\PatientDashboardController@hospitalDoctorListing'); //Patient hosptial doctor availability
    Route::get('/doctors_availability_listing/{id}/{date}/{key}', 'Patient\PatientDashboardController@doctorAvailabilityListing'); //Patient doctor availability for particular date
    //with login
    Route::get('/doctors_availability_listing_new/{id}/{date}/{key}/{patient_id}', 'Patient\PatientDashboardController@doctorAvailabilityListingLogin'); //Patient doctor availability for particular date
    //end with login
    Route::post('/save_diary_details', 'Patient\PatientHealthDiaryController@saveDiaryDetails'); //Patient save diary detail
    Route::post('/upload_diary_attachments', 'Patient\PatientHealthDiaryController@uploadDiaryAttachments'); //Patient upload diary attachments
    Route::get('/monthly_health_diary/{month}', 'Patient\PatientHealthDiaryController@monthlyHealthDiary'); //Patient monthly diaries
    Route::get('/view_health_diary/{diary_id}', 'Patient\PatientHealthDiaryController@viewHealthDiary'); //Patient view health diary
    Route::get('/view_diary/{diary_id}', 'Patient\PatientHealthDiaryController@ViewDiary'); //Patient view health diary
    Route::get('/delete_health_diary/{diary_id}', 'Patient\PatientHealthDiaryController@deleteHealthDiary'); //Patient delete health diary
    Route::get('/edit_health_diary/{diary_id}', 'Patient\PatientHealthDiaryController@editHealthDiary'); //Patient edit health diary
    Route::get('/delete_diary_images/{attach_id}', 'Patient\PatientHealthDiaryController@deleteDiaryImages'); //Patient delete diary images
    Route::post('/delete_add_diary_image', 'Patient\PatientHealthDiaryController@deleteAddDiaryImage'); //Patient delete add diary images
    Route::get('/health_history_list/{month?}/{spe?}/{hosp?}', 'Patient\PatientHealthHistoryController@index'); //Patient health history listing
    Route::get('/history_detail/{id}', 'Patient\PatientHealthHistoryController@historyDetail'); //Patient health history detail
    Route::get('/monthly_billing_list/{month}', 'Patient\PatientPagesController@monthlyBillingList'); //Patient monthly billing list
    Route::post('/pay_billing','Patient\PatientPagesController@payBilling'); //Patient pay bill
    Route::post('/pay_billing_cash','Patient\PatientPagesController@payBillingCash');  //Patient pay bill by cash
    Route::get('/download_pdf/{id}','Patient\PatientPagesController@downloadBillingPdf'); //Patient download bill
    Route::get('/downloadrecords/{id}','Patient\PatientPagesController@Downloadrecords'); // Download original records
    Route::post('/check_appoint_connection','Patient\PatientDashboardController@checkAppointConnection'); //Patient check if call is intiated by doctor and devices have been allowed
       Route::get('/checknotification','Patient\PatientDashboardController@checknotification'); //Patient check if call is intiated by doctor and devices have been allowed
//Patient save diary detail
    Route::post('/disconnect_conn_status', 'Patient\PatientDashboardController@disconnectConnectStatus'); //Patient disconnect call on page refresh or any other scenario
    Route::get('/calling_patient/{call_id}/{a_id}/{id}/{p_id}/{type}', 'Patient\PatientDashboardController@callingPatient'); //Patient calling
    Route::get('/send_mail/{msg}/{p_id}', 'Patient\PatientDashboardController@sendMail'); //Patient sending mail
    Route::get('/free_doctor', 'Auth\PatientController@freeDoctorAppt'); //Patient get free doctor
    Route::post('/check_connection', 'Patient\PatientDashboardController@checkConnection'); //Patient get call status
    Route::post('/reshedule_detail', 'Patient\PatientPagesController@resheduleDetail'); //view reschedule appointment
    Route::post('/update_appointments','Patient\PatientPagesController@updateAppointments'); //update appointment
    Route::post('/cancel_booking','Patient\PatientPagesController@cancelBooking'); //cancel appointment
    Route::post('/send_records','Patient\PatientPagesController@SendRecords'); //cancel appointment
    Route::get('/send_mail_with_template/{p_id}/{history_id}', 'Patient\PatientDashboardController@sendMailTemplate'); //Doctor send mail
 });

 //Rotes for doctor portal
  Route::prefix('doctor')->group(function() {
    Route::get('/login', 'Auth\DoctorController@showDoctorLoginForm')->name('doctor.login'); //Doctor login
    Route::post('/login', 'Auth\DoctorController@login')->name('doctor.login.submit'); //Doctor login
    Route::get('/logout', 'Auth\DoctorController@logout')->name('doctor.logout'); //Doctor logout
	Route::get('/dashboard', 'Doctor\DoctorDashboardController@index')->name('doctor.dashboard'); //Doctor dashboard
	Route::get('/all_appointments', 'Doctor\DoctorDashboardController@allAppointments')->name('doctor.all_appointments'); //Doctor all appointments
    Route::get('/send_mail/{msg}/{p_id}', 'Doctor\DoctorDashboardController@sendMail'); //Doctor send mail
 Route::post('/getpatientdetail','Doctor\DoctorDashboardController@Getpatientdetail'); 
	// Route::get('/test_hospital', 'Doctor\DoctorDashboardController@hospitalAppointmentsAjax')->name('doctor.test_hospital');
	// Route::get('/test_telemedical', 'Doctor\DoctorDashboardController@telemedicalAppointmentsAjax')->name('doctor.test_telemedical');
	Route::get('/all_appointments_ajax/{time?}', 'Doctor\DoctorDashboardController@allAppointmentsAjax'); //Doctor appointment filteration
	Route::post('/save_appointments_hosp', 'Doctor\DoctorDashboardController@saveAppointments')->name('doctor.save_appointments_hosp'); //Doctor save hospital appointment
	Route::post('/save_appointments_tele', 'Doctor\DoctorDashboardController@saveTeleAppointments')->name('doctor.save_appointments_tele'); //Doctor save telemedical appointment
    Route::post('/tokbox_connection', 'Doctor\DoctorDashboardController@tokBoxConnection'); //Doctor make tokobx connection
    Route::post('/make_connection', 'Doctor\DoctorDashboardController@makeTokboxConnect'); //Doctor send puch notification
    Route::get('/calling_patient/{call_id}/{a_id}/{id}/{p_id}/{type}', 'Doctor\DoctorDashboardController@callingPatient'); //Doctor making call after other end user acceptance
     Route::get('/doctors_availability_listing/{type}/{date}', 'Doctor\DoctorDashboardController@doctorAvailabilityListing'); //Patient doctor availability for particular date
     Route::get('/doctors_availability_delete/{id}', 'Doctor\DoctorDashboardController@doctorAvailabilityDelete'); //Delete added availability for particular date
    Route::get('/initiating_call/{a_id}', 'Doctor\DoctorDashboardController@initiatingCall'); //Doctor intiating call
    Route::post('/check_connection', 'Doctor\DoctorDashboardController@checkConnection'); //Doctor send call status
    Route::post('/check_appoint_connection', 'Doctor\DoctorDashboardController@checkAppointConnection'); //check call has been initiated
    Route::post('/change_status', 'Doctor\DoctorDashboardController@changeStatus'); //check change in status for call
    Route::post('/disconnect_status', 'Doctor\DoctorDashboardController@disconnectStatus'); //disconnecting call not accepted by patient
    Route::post('/disconnect_conn_status', 'Doctor\DoctorDashboardController@disconnectConnectStatus'); //disconnecting call accepted by patient
    Route::get('/telemedical_appoinment/{time?}', 'Doctor\DoctorPagesController@telemedicalAppoinment'); //telemeical appointments
    Route::get('/hospital_appoinment/{time?}', 'Doctor\DoctorPagesController@hospitalAppoinment'); //Hospital appointments

    //Patients
    Route::get('/search_patient', 'Doctor\DoctorPagesController@searchPatient'); //Search Patient
    Route::get('/patients', 'Doctor\PatientsController@index'); //Search Patient
    Route::post('/patients/create', 'Doctor\PatientsController@create'); //Create Patient
    Route::get('/patients/getInfo/{id?}','Doctor\PatientsController@show');
    Route::post('/patients/update','Doctor\PatientsController@edit');
    Route::get('/patients/medical_records/{id}','Doctor\PatientsController@medicalRecordList');   // Medical record o doctor
    Route::get('/patients/view_record/{id}','Doctor\PatientsController@viewRecord'); // View records of doctor
    Route::get('/patients/edit_medical_record/{id}','Doctor\PatientsController@editRecord'); //edit medical record
    Route::post('/patients/save_medical_record','Doctor\PatientsController@saveMedicalRecord'); //Save medical record
    Route::get('/patients/add_new_record/{id}','Doctor\PatientsController@addRecord'); //add new health history


    Route::post('/profile', 'Doctor\DoctorPagesController@profile'); //Patient update profile
    
    Route::get('/view_all_billings/{id?}', 'Doctor\DoctorPagesController@billings'); //view all billings
    Route::get('/dispute_billings', 'Doctor\DoctorPagesController@disputeBillings'); //view disputed billings
    Route::get('/dispute_billing_detail/{id}', 'Doctor\DoctorPagesController@disputeBillingDetail'); //view disputed billings detail
    Route::get('/billing_detail/{id}/{pid?}', 'Doctor\DoctorPagesController@billingDetail'); //view billings detail
    Route::get('/settings', 'Doctor\DoctorPagesController@settings'); //view doctor settings
    Route::post('/reshedule_detail', 'Doctor\DoctorDashboardController@resheduleDetail'); //view reschedule appointment
    Route::get('/update_timezone/{time_zone}/{dst}', 'Doctor\DoctorDashboardController@updateTimezone'); //view update timezone
    Route::get('/patient_search_result', 'Doctor\DoctorPagesController@patientSearchResult'); //view serach result
    Route::post('/silent_notification', 'Doctor\DoctorDashboardController@silentNotification'); //view sending silent notification
    Route::post('/availability_booking','Doctor\DoctorDashboardController@availabilityBooking'); //checking doctors availability
    Route::post('/cancel_booking','Doctor\DoctorDashboardController@cancelBooking'); //cancel appointment
    Route::get('/appointment_detail/{id?}','Doctor\DoctorDashboardController@appointmentDetail'); //view appointment
    Route::post('/update_appointments','Doctor\DoctorDashboardController@updateAppointments'); //update appointment
    Route::get('/medical_records/{id}','Doctor\DoctorHealthHistoryController@medicalRecordList'); //get health history listing
    Route::get('/add_new_record/{id}','Doctor\DoctorHealthHistoryController@addRecord'); //add new health history
    Route::get('/edit_medical_record/{id}','Doctor\DoctorHealthHistoryController@editRecord'); //edit medical record
    Route::get('/view_record/{id}','Doctor\DoctorHealthHistoryController@viewRecord'); //view prticular medical record
    Route::post('/save_medical_record','Doctor\DoctorHealthHistoryController@saveMedicalRecord'); //ave medical record
    Route::post('/account_setting','Doctor\DoctorDashboardController@accountSetting'); //account settings
    Route::post('/save_bill_details','Doctor\DoctorHealthHistoryController@saveBillDetails'); //save billing details
    Route::post('/pay_billing','Doctor\DoctorPagesController@payBilling'); //pay billing
    Route::post('/pay_billing_cash','Doctor\DoctorPagesController@payBillingCash');  //Patient pay bill by cash
    Route::post('/disconnect_allowed_status','Doctor\DoctorDashboardController@disconnectAllowedStatus'); //change allowed devices status
    Route::post('/schedule_appointment','Doctor\DoctorPagesController@scheduleAppointment'); // Appointments popup
    Route::post('/add_new_appointments','Doctor\DoctorPagesController@addNewAppointment'); // Add new appointment
    Route::get('/delete_history_images/{attach_id}','Doctor\DoctorHealthHistoryController@deleteHistoryImages'); // delete health history images
    Route::get('/delete_history_medication/{medi_id}','Doctor\DoctorHealthHistoryController@deleteHistoryMedication'); // delete health history medication
    Route::get('/immediate_telemedical/{id}/{pid}/{speciality?}','Doctor\DoctorPagesController@immediateTelemedical'); // immediate telemedical appointment
    Route::get('/telemedical_doctors_listing/{id}/{pid}/{date}/{type}/{speciality?}', 'Doctor\DoctorPagesController@doctorListing'); // immediate doctor listing
    Route::get('/immediate_speciality_details/{id}/{pid}', 'Doctor\DoctorPagesController@specialityTelemedical'); // immediate speciality listing
    Route::get('/future_tele_details/{id}/{doctor_id}/{pid}/{date}/{time}/{speciality?}', 'Doctor\DoctorPagesController@futureTelemedical'); // Future telemedical appointment with speciality
    Route::get('/paybill/{id}', 'Doctor\DoctorPagesController@paybill'); //Patient billing detail
    Route::post('/save_book_details', 'Doctor\DoctorPagesController@saveBookDetails'); // Save booking details
    Route::post('/addbillingdispute', 'Doctor\DoctorPagesController@AddBillingDispute'); // Add Billing Dispute
        // Edit blood group of patient
      Route::post('/editbloodgroup', 'Doctor\DoctorDashboardController@EditBloodGroup'); 
      Route::get('/view_diary/{diary_id}', 'Doctor\DoctorHealthHistoryController@ViewDiary'); //Patient view health diary
});

//Rotes for nurse portal
Route::prefix('nurse')->group(function() {
    //same functionss as doctor portal
    Route::get('/login', 'Auth\NurseController@showNurseLoginForm')->name('nurse.login');
    Route::post('/login', 'Auth\NurseController@login')->name('nurse.login.submit');
    Route::get('/logout', 'Auth\NurseController@logout')->name('nurse.logout');
    Route::get('/dashboard', 'Nurse\NurseDashboardController@index')->name('nurse.dashboard');
    Route::get('/all_appointments', 'Nurse\NurseDashboardController@allAppointments')->name('nurse.all_appointments');
    Route::get('/all_appointments_ajax/{time?}', 'Nurse\NurseDashboardController@allAppointmentsAjax');
    Route::post('/save_appointments_hosp', 'Nurse\NurseDashboardController@saveAppointments')->name('nurse.save_appointments_hosp');
    Route::post('/save_appointments_tele', 'Nurse\NurseDashboardController@saveTeleAppointments')->name('nurse.save_appointments_tele');
    Route::get('/telemedical_appoinment', 'Nurse\NursePagesController@telemedicalAppoinment');
    Route::get('/appointment_detail/{id?}','Nurse\NurseDashboardController@appointmentDetail');
    Route::post('/reshedule_detail', 'Nurse\NurseDashboardController@resheduleDetail');
    Route::post('/cancel_booking','Nurse\NurseDashboardController@cancelBooking');
    Route::get('/search_patient', 'Nurse\NursePagesController@searchPatient');
    Route::get('/view_all_billings/{id?}', 'Nurse\NursePagesController@billings');
    Route::get('/dispute_billings', 'Nurse\NursePagesController@disputeBillings');
    Route::get('/dispute_billing_detail/{id}', 'Nurse\NursePagesController@disputeBillingDetail');
    Route::get('/billing_detail/{id}/{pid?}', 'Nurse\NursePagesController@billingDetail');
    Route::get('/settings', 'Nurse\NursePagesController@settings');
    Route::get('/update_timezone/{time_zone}/{dst}', 'Nurse\NurseDashboardController@updateTimezone');
    Route::get('/patient_search_result', 'Nurse\NursePagesController@patientSearchResult');
    Route::post('/availability_booking','Nurse\NurseDashboardController@availabilityBooking');
    Route::post('/update_appointments','Nurse\NurseDashboardController@updateAppointments');
    Route::get('/medical_records/{id}','Nurse\NurseHealthHistoryController@medicalRecordList');
    Route::get('/add_new_record/{id}','Nurse\NurseHealthHistoryController@addRecord');
    Route::get('/edit_medical_record/{id}','Nurse\NurseHealthHistoryController@editRecord');
    Route::get('/view_record/{id}','Nurse\NurseHealthHistoryController@viewRecord');
    Route::post('/save_medical_record','Nurse\NurseHealthHistoryController@saveMedicalRecord');
    Route::post('/account_setting','Nurse\NurseDashboardController@accountSetting');
    Route::post('/save_bill_details','Nurse\NurseHealthHistoryController@saveBillDetails');
    Route::post('/pay_billing','Nurse\NursePagesController@payBilling');    
      Route::post('/pay_billing_cash','Nurse\NursePagesController@payBillingCash');  //Patient pay bill by cash
    Route::post('/schedule_appointment','Nurse\NursePagesController@scheduleAppointment');
    Route::post('/add_new_appointments','Nurse\NursePagesController@addNewAppointment');
    Route::get('/delete_history_images/{attach_id}','Nurse\NurseHealthHistoryController@deleteHistoryImages');
    Route::get('/delete_history_medication/{medi_id}','Nurse\NurseHealthHistoryController@deleteHistoryMedication');
    Route::post('/addbillingdispute', 'Nurse\NursePagesController@AddBillingDispute'); // Add Billing Dispute
     Route::post('/getpatientdetail','Nurse\NurseDashboardController@Getpatientdetail'); 
});

//Rotes for employee portal
 Route::prefix('employee')->group(function() {
    //same functionss as doctor portal
    Route::get('/login', 'Auth\EmployeeController@showEmployeeLoginForm')->name('employee.login');
    Route::post('/login', 'Auth\EmployeeController@login')->name('employee.login.submit');
    Route::get('/logout', 'Auth\EmployeeController@logout')->name('employee.logout');
    Route::get('/dashboard', 'Employee\EmployeeDashboardController@index')->name('employee.dashboard');
    Route::get('/all_appointments', 'Doctor\DoctorDashboardController@allAppointments')->name('doctor.all_appointments');
    Route::get('/test_hospital', 'Doctor\DoctorDashboardController@hospitalAppointmentsAjax')->name('doctor.test_hospital');
    Route::get('/test_telemedical', 'Doctor\DoctorDashboardController@telemedicalAppointmentsAjax')->name('doctor.test_telemedical');
    Route::get('/all_appointments_ajax/{time?}', 'Doctor\DoctorDashboardController@allAppointmentsAjax');
    Route::post('/save_appointments_hosp', 'Doctor\DoctorDashboardController@saveAppointments')->name('doctor.save_appointments_hosp');
    Route::post('/save_appointments_tele', 'Doctor\DoctorDashboardController@saveTeleAppointments')->name('doctor.save_appointments_tele');
    Route::get('/telemedical_appoinment', 'Doctor\DoctorPagesController@telemedicalAppoinment');
    Route::get('/search_patient', 'Doctor\DoctorPagesController@searchPatient');
    Route::get('/view_all_billings', 'Doctor\DoctorPagesController@billings');
    Route::get('/dispute_billings', 'Doctor\DoctorPagesController@disputeBillings');
    Route::get('/dispute_billing_detail', 'Doctor\DoctorPagesController@disputeBillingDetail');
    Route::get('/billing_detail/{id}', 'Doctor\DoctorPagesController@billingDetail');
    Route::get('/settings', 'Doctor\DoctorPagesController@settings');
    Route::post('/reshedule_detail', 'Doctor\DoctorDashboardController@resheduleDetail');
    Route::get('/update_timezone/{time_zone}/{dst}', 'Doctor\DoctorDashboardController@updateTimezone');
    Route::get('/patient_search_result', 'Doctor\DoctorPagesController@patientSearchResult');
    Route::post('/silent_notification', 'Doctor\DoctorDashboardController@silentNotification');
    Route::post('/availability_booking','Doctor\DoctorDashboardController@availabilityBooking');
    Route::post('/cancel_booking','Doctor\DoctorDashboardController@cancelBooking');
    Route::get('/appointment_detail/{id?}','Doctor\DoctorDashboardController@appointmentDetail');
    Route::post('/update_appointments','Doctor\DoctorDashboardController@updateAppointments');
    Route::get('/medical_records/{id}','Doctor\DoctorHealthHistoryController@medicalRecordList');
    Route::get('/add_new_record/{id}','Doctor\DoctorHealthHistoryController@addRecord');
    Route::get('/edit_medical_record/{id}','Doctor\DoctorHealthHistoryController@editRecord');
    Route::get('/view_record/{id}','Doctor\DoctorHealthHistoryController@viewRecord');
    Route::post('/save_medical_record','Doctor\DoctorHealthHistoryController@saveMedicalRecord');
    Route::post('/account_setting','Doctor\DoctorDashboardController@accountSetting');
    Route::post('/save_bill_details','Doctor\DoctorHealthHistoryController@saveBillDetails');
    Route::post('/pay_billing','Doctor\DoctorPagesController@payBilling');
    Route::post('/disconnect_allowed_status','Doctor\DoctorDashboardController@disconnectAllowedStatus');
    Route::post('/schedule_appointment','Doctor\DoctorPagesController@scheduleAppointment');
    Route::post('/add_new_appointments','Doctor\DoctorPagesController@addNewAppointment');
    Route::get('/delete_history_images/{attach_id}','Doctor\DoctorHealthHistoryController@deleteHistoryImages');
    Route::get('/delete_history_medication/{medi_id}','Doctor\DoctorHealthHistoryController@deleteHistoryMedication');
});

//Rotes for hospital portal
Route::prefix('hospital')->group(function() {
    //same functionss as doctor portal
    Route::get('/login', 'Auth\HospitalController@showHospitalLoginForm')->name('hospital.login');
    Route::post('/login', 'Auth\HospitalController@login')->name('hospital.login.submit');
    Route::get('/logout', 'Auth\HospitalController@logout')->name('hospital.logout');
    Route::get('/dashboard', 'Hospital\HospitalDashboardController@index')->name('hospital.dashboard');
    Route::get('/all_doctors', 'Hospital\HospitalDashboardController@AllDoctors')->name('hospital.all_doctors');
    Route::get('/all_appointments', 'Hospital\HospitalDashboardController@allAppointments')->name('doctor.all_appointments');
    Route::get('/all_appointments/{id}', 'Hospital\HospitalDashboardController@allAppointments')->name('admin.all_appointments'); //Doctor all appointments
    Route::get('/test_hospital', 'Doctor\DoctorDashboardController@hospitalAppointmentsAjax')->name('doctor.test_hospital');
    Route::get('/test_telemedical', 'Doctor\DoctorDashboardController@telemedicalAppointmentsAjax')->name('doctor.test_telemedical');
    Route::get('/all_appointments_ajax/{time?}', 'Hospital\HospitalDashboardController@allAppointmentsAjax');
    Route::post('/save_appointments_hosp', 'Doctor\DoctorDashboardController@saveAppointments')->name('doctor.save_appointments_hosp');
    Route::post('/save_appointments_tele', 'Doctor\DoctorDashboardController@saveTeleAppointments')->name('doctor.save_appointments_tele');
    Route::get('/telemedical_appoinment', 'Doctor\DoctorPagesController@telemedicalAppoinment');
    Route::get('/search_patient', 'Doctor\DoctorPagesController@searchPatient');
    Route::get('/view_all_billings', 'Doctor\DoctorPagesController@billings');
    Route::get('/dispute_billings', 'Doctor\DoctorPagesController@disputeBillings');
    Route::get('/dispute_billing_detail', 'Doctor\DoctorPagesController@disputeBillingDetail');
    Route::get('/billing_detail/{id}', 'Doctor\DoctorPagesController@billingDetail');
    Route::get('/settings', 'Doctor\DoctorPagesController@settings');
    Route::post('/reshedule_detail', 'Doctor\DoctorDashboardController@resheduleDetail');
    Route::get('/update_timezone/{time_zone}/{dst}', 'Hospital\HospitalDashboardController@updateTimezone');
    Route::get('/patient_search_result', 'Doctor\DoctorPagesController@patientSearchResult');
    Route::post('/silent_notification', 'Doctor\DoctorDashboardController@silentNotification');
    Route::post('/availability_booking','Doctor\DoctorDashboardController@availabilityBooking');
    Route::post('/cancel_booking','Doctor\DoctorDashboardController@cancelBooking');
    Route::get('/appointment_detail/{id?}','Doctor\DoctorDashboardController@appointmentDetail');
    Route::post('/update_appointments','Doctor\DoctorDashboardController@updateAppointments');
    Route::get('/medical_records/{id}','Doctor\DoctorHealthHistoryController@medicalRecordList');
    Route::get('/add_new_record/{id}','Doctor\DoctorHealthHistoryController@addRecord');
    Route::get('/edit_medical_record/{id}','Doctor\DoctorHealthHistoryController@editRecord');
    Route::get('/view_record/{id}','Doctor\DoctorHealthHistoryController@viewRecord');
    Route::post('/save_medical_record','Doctor\DoctorHealthHistoryController@saveMedicalRecord');
    Route::post('/account_setting','Doctor\DoctorDashboardController@accountSetting');
    Route::post('/save_bill_details','Doctor\DoctorHealthHistoryController@saveBillDetails');
    Route::post('/pay_billing','Doctor\DoctorPagesController@payBilling');
    Route::post('/disconnect_allowed_status','Doctor\DoctorDashboardController@disconnectAllowedStatus');
    Route::post('/schedule_appointment','Doctor\DoctorPagesController@scheduleAppointment');
    Route::post('/add_new_appointments','Doctor\DoctorPagesController@addNewAppointment');
    Route::get('/delete_history_images/{attach_id}','Doctor\DoctorHealthHistoryController@deleteHistoryImages');
    Route::get('/delete_history_medication/{medi_id}','Doctor\DoctorHealthHistoryController@deleteHistoryMedication');
});

//Rotes for admin portal
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showAdminLoginForm')->name('admin.login'); //admin login
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit'); //admin login
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout'); //admin logout
    Route::get('/dashboard', 'Admin\AdminDashboardController@index')->name('admin.dashboard'); //admin dashboard
    Route::get('/all_hospitals', 'Admin\AdminDashboardController@AllHospitals')->name('admin.hospitals'); //all hospitals listing
    Route::get('/update_timezone/{time_zone}/{dst}', 'Admin\AdminDashboardController@updateTimezone'); //update timezone
    Route::post('/accept_hospital', 'Admin\AdminDashboardController@AcceptHospitalRequest'); //accept hospital
    Route::post('/ignore_hospital', 'Admin\AdminDashboardController@IgnoreHospitalRequest'); //ignore hospital
    Route::post('/add_hospital', 'Admin\AdminDashboardController@AddNewHospital'); //add new hospital
    Route::post('/edit_hospital', 'Admin\AdminDashboardController@EditNewHospital'); //edit hospital
    Route::post('/get_states', 'Admin\AdminDashboardController@GetStates'); //get states list
    Route::post('/get_lgas_city', 'Admin\AdminDashboardController@Get_LGACity'); //get states list
    Route::get('/hospital_detail/{id?}','Admin\AdminDashboardController@HospitalDetail'); //hospital detail
    Route::post('/change_doctor_status', 'Admin\AdminDashboardController@ChangeDoctorStatus'); //change doctor status
    Route::post('/remove_doctor', 'Admin\AdminDashboardController@RemoveDoctor'); //remove docotr
    Route::post('/update_doctor_details', 'Admin\AdminDashboardController@UpdateDoctorDetails'); //update doctor details
    Route::get('/search_patient_by_admin', 'Admin\AdminDashboardController@SearchPatient'); //search patient
    Route::get('/all_employees', 'Admin\AdminDashboardController@AllEmployees'); //all employees
    Route::post('/change_emp_status', 'Admin\AdminDashboardController@ChangeEmployeeStatus'); //change employee status
    Route::post('/remove_employee', 'Admin\AdminDashboardController@RemoveEmployee'); //remove employee
    Route::post('/update_emp_details', 'Admin\AdminDashboardController@UpdateEmployeeDetails'); //update employee details
    Route::post('/search_emp_by_admin', 'Admin\AdminDashboardController@SearchEmployee'); //search employee by admin
    Route::get('/search_emp_by_admin', 'Admin\AdminDashboardController@SearchEmployee'); //search patient
    Route::post('/add_employee', 'Admin\AdminDashboardController@AddNewEmployee'); //add new employee
    Route::post('/edit_employee', 'Admin\AdminDashboardController@EditNewEmployee'); //add new employee
    Route::get('/testemail/{id}', 'Admin\AdminDashboardController@SendMailTest'); //send mail
     Route::get('/signupemail/{type}/{id}', 'Admin\AdminDashboardController@SignupEmail'); //Doctor send mail
    Route::get('/reminder_health_diary/{id?}', 'Admin\ReminderController@ReminderHealthDiary'); //health diary reminder
    Route::get('/reminder_for_health_diary', 'Admin\ReminderController@ReminderHealthDiaryCron'); //health diary reminder cron
    Route::get('/all_doctors', 'Admin\AdminDashboardController@AllDoctors'); //all Doctors
    Route::get('/view_doctors_billing', 'Admin\AdminDashboardController@AllBillingDoctors'); //all billing Doctors
    Route::get('/view_disputes_billing', 'Admin\AdminPagesController@AllDisputedDoctors'); //all Disputed billing Doctors
    Route::get('/view_dispute_billing/{id?}', 'Admin\AdminPagesController@Disputedbilling'); //all billing Doctors
    Route::get('/dispute_billing_detail/{id?}', 'Admin\AdminPagesController@disputeBillingDetail'); //all billing Doctors
    Route::get('/view_all_billings/{id?}', 'Admin\AdminDashboardController@billings');  // View billing by doctors
    Route::get('/billing_detail/{id}/{did?}', 'Admin\AdminDashboardController@billingDetail'); //view billings detail
    Route::get('/appointment_detail/{id?}','Admin\AdminDashboardController@appointmentDetail'); //view appointments of a particular doctor
    Route::get('/all_appointments/{id}', 'Admin\AdminDashboardController@allAppointments')->name('admin.all_appointments'); //Doctor all appointments
    Route::get('/all_appointments_ajax/{time?}', 'Admin\AdminDashboardController@allAppointmentsAjax'); //Doctor appointment filteration
    Route::post('/add_doctor', 'Admin\AdminDashboardController@AddNewDoctor'); //add new employee
    Route::post('/add_member', 'Admin\AdminDashboardController@AddNewMember'); //add new Member/Patient
    Route::post('/search_dr_by_admin', 'Admin\AdminDashboardController@SearchDoctor'); //search Doctor by admin
    Route::post('/search_hosp_by_admin', 'Admin\AdminDashboardController@SearchHospital'); //search Hospital by admin
    Route::post('/add_nurse', 'Admin\AdminDashboardController@AddNewNurse'); //add new employee
    Route::post('/update_nurse_details', 'Admin\AdminDashboardController@UpdateNurseDetails'); //update Nurse details
    Route::post('/remove_nurse', 'Admin\AdminDashboardController@RemoveNurse'); //remove docotr
    Route::post('/add_administrator', 'Admin\AdminDashboardController@AddNewAdmin'); //add new employee
    Route::post('/update_admin_details', 'Admin\AdminDashboardController@UpdateAdminDetails'); //update Nurse details
    Route::post('/remove_admin', 'Admin\AdminDashboardController@RemoveAdmin'); //remove docotr
    Route::post('/addbillingdispute', 'Admin\AdminPagesController@AddBillingDispute'); // Add Billing Dispute
    Route::post('/pay_billing','Admin\AdminPagesController@payBilling'); //pay billing
    Route::post('/pay_billing_cash','Admin\AdminPagesController@payBillingCash');  //Patient pay bill by cash
    Route::get('/medical_records/{id}','Admin\AdminDashboardController@medicalRecordList');   // Medical record o doctor
    Route::get('/view_record/{id}','Admin\AdminDashboardController@viewRecord'); // View records of doctor
    Route::get('/edit_medical_record/{id}','Admin\AdminDashboardController@editRecord'); //edit medical record
    Route::post('/save_medical_record','Admin\AdminDashboardController@saveMedicalRecord'); //Save medical record
    Route::get('/add_new_record/{id}','Admin\AdminDashboardController@addRecord'); //add new health history
    Route::post('/getdoctors', 'Admin\AdminDashboardController@GetDoctors'); //get states list
    Route::get('/view_hospital_billing', 'Admin\AdminDashboardController@AllBillingHospitals'); //all billing Hospitals
    Route::get('/search_patient', 'Admin\AdminPagesController@searchPatient'); //Search Patient
    Route::post('/save_bill_details','Admin\AdminPagesController@saveBillDetails');

  Route::get('/hospital_billing/{id?}', 'Admin\AdminDashboardController@Billingbyhospital');  // View billing by doctors

  Route::get('/patient_search_result', 'Admin\AdminPagesController@patientSearchResult'); //view serach result

 Route::post('/getpatientdetail','Admin\AdminDashboardController@Getpatientdetail'); 
 Route::post('/view_hospital_user','Admin\AdminDashboardController@ViewUser'); // hospital detail
 Route::post('/get_hospital_user_data','Admin\AdminDashboardController@ViewUser'); //Get hospital user detail
 Route::post('/edit_hospital_user', 'Admin\AdminDashboardController@EditUser'); //add new employee

  //  Deals 
  Route::get('/deals', 'Admin\DealsController@index');  // Get all deals
  Route::get('/deals/get-categories','Admin\DealsController@getCategories');
  Route::post('/deals/create','Admin\DealsController@create');
  Route::get('/deals/getDeal/{id?}','Admin\DealsController@show');
  Route::post('/deals/update','Admin\DealsController@edit');
  Route::post('/deals/remove','Admin\DealsController@remove');

  //hospital
  Route::get('/hospital/{hosp_id?}','Admin\AdminDashboardController@HospitalDetailEdit'); //hospital detail
  Route::post('/hospital/remove','Admin\AdminDashboardController@RemoveHospital');
  Route::post('/get_speciality_by_facility', 'Admin\AdminDashboardController@GetFacilityWiseSpeciality'); //get facility wise list speciality

  //Employee
  Route::get('/employee/{id?}','Admin\AdminDashboardController@viewemployee');
  Route::get('/hospital/{hosp_id?}','Admin\AdminDashboardController@HospitalDetailEdit'); //hospital detail

  //  Appointment 
  Route::get('/appointment', 'Admin\AdminDashboardController@AllAppointment');  // Get all appointment
  Route::post('/reshedule_detail', 'Admin\AdminDashboardController@resheduleDetailForAdmin'); //view reschedule appointment
  Route::post('/cancel_booking','Admin\AdminDashboardController@cancelBookingForAdmin'); //cancel appointment

  //Health Record
  Route::get('/health-record', 'Admin\AdminDashboardController@AllHealthRecord');  // Get all Health Record
});
