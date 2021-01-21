<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/patient_login', 'Api\PatientController@login');
Route::post('/patient_signup', 'Api\PatientController@register');
Route::post('/forgot_password', 'Api\PatientController@forgotpassword');
Route::post('/doctors_detail', 'Api\PatientAppointmentController@sendDoctorDetails');
Route::post('/doctors_search_detail', 'Api\PatientAppointmentController@doctorSearchDetails');
Route::post('/doctors_availability', 'Api\PatientAppointmentController@doctorsAvailaibility');
Route::post('/hospital_search_detail', 'Api\PatientAppointmentController@hospitalSearchDetails');
Route::post('/appointment_detail', 'Api\PatientAppointmentController@addAppointmentDetails');
Route::post('/fetch_doctor', 'Api\PatientAppointmentController@fetchTelemedicalDoctor');
Route::post('/save_booking', 'Api\PatientAppointmentController@saveBookingDetails');
Route::post('/doctor_listing', 'Api\PatientAppointmentController@doctorListing');
Route::post('/availability_listing', 'Api\PatientAppointmentController@doctorAvailaibility');
Route::post('/patient_appointments', 'Api\PatientAppointmentController@patientAppointments');
Route::post('/doctor_appointments', 'Api\PatientAppointmentController@doctorAppointments');
Route::post('/hospital_listing', 'Api\PatientAppointmentController@hospitalListing');
Route::post('/specialist_category_listing', 'Api\PatientAppointmentController@doctorSpecialistCategories');
Route::post('/my_appointments', 'Api\PatientAppointmentController@myAppointments');
Route::post('/single_appointment_detail', 'Api\PatientAppointmentController@appointmentDetail');
Route::post('/hospital_doctors', 'Api\PatientAppointmentController@hospitalDoctors');
Route::post('/logout', 'Api\PatientController@logout');
//20 aug 2018
Route::post('/doctor_appointment_listing', 'Api\DoctorAppointmentController@doctorAppointmentListing');
Route::post('/search_patient', 'Api\DoctorAppointmentController@searchPatient');
Route::post('/search_patient_data', 'Api\DoctorAppointmentController@searchPatientData');
Route::post('/tokbox_details', 'Api\DoctorAppointmentController@tokBoxConnection');
Route::post('/diconnect_status', 'Api\DoctorAppointmentController@updateDisconnectStatus');
Route::post('/add_health_diary', 'Api\PatientHealthDiaryController@addHealthDiary');
Route::post('/monthly_health_diary', 'Api\PatientHealthDiaryController@monthlyHealthDiary');
Route::post('/view_health_diary', 'Api\PatientHealthDiaryController@viewHealthDiary');
Route::post('/delete_health_diary', 'Api\PatientHealthDiaryController@deleteHealthDiary');
Route::post('/edit_health_diary', 'Api\PatientHealthDiaryController@editHealthDiary');
Route::post('/diary_start_date', 'Api\PatientHealthDiaryController@startDateDiary');
//02 nov 2018
Route::post('/patient_profile_update', 'Api\PatientController@profileUpdate');
Route::post('/get_profile', 'Api\PatientController@getProfile');
Route::post('/notification_update', 'Api\PatientController@notificationUpdate');
Route::post('/get_notification_settings', 'Api\PatientController@getNotificationSettings');
Route::post('/update_account_settings', 'Api\PatientController@updateAccountSettings');
Route::post('/health_history_list', 'Api\PatientHealthHistoryController@healthHistoryListing');
Route::post('/health_history_view', 'Api\PatientHealthHistoryController@healthHistoryView');
Route::post('/billing_list', 'Api\PatientBillingController@billingList');
Route::post('/billing_view', 'Api\PatientBillingController@billingView');
Route::post('/pay_billing', 'Api\PatientBillingController@PayBilling');
Route::post('/make_payment', 'Api\PatientBillingController@billPayment');
Route::post('/user_notification', 'Api\PatientAppointmentController@UserNotification');
Route::get('/thirtymin_notification', 'Api\PatientController@apptThirtyMinNotification');
Route::get('/tenmin_notification', 'Api\PatientController@apptTenMinNotification');
Route::get('/send_thirtyappt_notification/{appt_id}/{user_id}', 'Api\PatientController@sendThirtyApptNotification');
Route::get('/send_tenappt_notification/{appt_id}/{user_id}', 'Api\PatientController@sendTenApptNotification');

//13 june 2019 Shahnaj
Route::post('/availability_listing', 'Api\DoctorAppointmentController@doctorAvailaibility');

// Route::prefix('admin')->group(function() {
//  Deals 
Route::get('/deals','Api\DealsController@index');  // Get all deals
Route::get('/deals/get-categories','Api\DealsController@getCategories');
Route::get('/deals/getDeal/{category_id?}/{id?}','Api\DealsController@show');
//Deal Category
Route::get('/deals/{category_id?}/{sort_value?}','Api\DealsController@showDealsList');
Route::get('/dealscategory','Api\DealsController@dealsCategory');  // Get all deals
//specialist
Route::get('/specialist','Api\PatientAppointmentController@typeSpecialist');  // Get all deals
//get hospital by specialiist
Route::get('/gethospital/{specialist?}/{sort_value?}','Api\HospitalsController@getHospitalBySpecialist');  // Get all gethospital by spelialist and sort

Route::post('/search_hospital','Api\HospitalsController@searchHospital');  // Get all hospital by type of speciality/state/city 
Route::get('/get_state_wise_lga/{state_id?}','Api\HospitalsController@getStateWiseLGA');  // Get all gethospital by spelialist and sort

Route::post('/save_request_information','Api\PatientController@saveRequestInformation');  // Save request information form on frontend
Route::post('/save_schedule_demo','Api\PatientController@saveScheduleDemo');  // Save schedule demo form on front end 
Route::post('/save_get_listed_on_render','Api\PatientController@savegetListedOnRender');  // save get listed on render form 

//new
Route::post('/availability_listing_new', 'Api\PatientAppointmentController@doctorAvailaibility');