$(document).ready(function(){	
	var value = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
	if(value == 1){
		$(".teleconslt_href").trigger("click");
	}
	var isDST =0;
	Date.prototype.stdTimezoneOffset = function () {
	    var jan = new Date(this.getFullYear(), 0, 1);
	    var jul = new Date(this.getFullYear(), 6, 1);
	    return Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
	}

	Date.prototype.isDstObserved = function () {		
	    return this.getTimezoneOffset() < this.stdTimezoneOffset();
	}

	var today = new Date();
	
	if (today.isDstObserved()) { 
	    isDST = 1;
	}
	var offset = new Date().getTimezoneOffset();	
	offset = offset == 0 ? 0 : -offset;
	var site_url = $('#site_url').text();
	$.ajax({
	 	url: site_url+"/patient/update_timezone/"+offset+"/"+isDST,
	 	type:'GET',
	  	data:{},
	 	success:function(result){
	 		
		}
	});	
	if(!!window.performance && window.performance.navigation.type == 2)
	{
	    window.location.reload();
	}	
	 $(".consult_btn").click(function(){
    	var type = $(this).attr("data-id");
    	$(".second_step").css("display","block");
    	$(".first_step").css("display","none");
    	$(".second_head").text(type+" consultation");
    	$(".second_text").val("Video");
    });

    $('#Telelconsultation').on('hidden.bs.modal', function () {
    	$(".error_msg").css("display","none");
	  	$(".second_step").css("display","none");
	  	$(".third_step").css("display","none");
    	$(".first_step").css("display","flex");
	});

	$("#Telelconsultation").on('shown.bs.modal', function () {		
		$(".tele_appoint").find(".prev").removeClass("date_disable");
		if($(".tele_appoint").find(".prev").css("visibility") == "hidden"){
			$(".tele_appoint").find(".prev").addClass("date_disable");
		}else{
			$(".tele_appoint").find(".prev").removeClass("date_disable");
		}
	});	
$("#reschedule_appointment").on('shown.bs.modal', function () {		
		//availbilityDateUpdate();				
		$("#reschedule_appointment").find(".reshedule_time").find(".prev").removeClass("date_disable");		
		if($("#reschedule_appointment").find(".reshedule_time").find(".prev").css("visibility") == "hidden"){
			$("#reschedule_appointment").find(".reshedule_time").find(".prev").addClass("date_disable");
		}else{
			$("#reschedule_appointment").find(".reshedule_time").find(".prev").removeClass("date_disable");
		}
	});	
	$(".tele_appoint").find("div").on('click',function(){	
		$(".tele_appoint").find(".prev").removeClass("date_disable");
		if($(".tele_appoint").find(".prev").css("visibility") == "hidden"){			
			$(".tele_appoint").find(".prev").addClass("date_disable");
		}else{			
			$(".tele_appoint").find(".prev").removeClass("date_disable");
		} 		
	});

	$(document).on('click',".hosp_datepicker",function(){
		$(".datepicker").find(".prev").removeClass("date_disable");
		if($(".datepicker").find(".prev").css("visibility") == "hidden"){			
			$(".datepicker").find(".prev").addClass("date_disable");
		}else{			
			$(".datepicker").find(".prev").removeClass("date_disable");
		} 		
	});	

	

	//get value of selected state and get list of LGA
	$('#hospital_state_nigeria').on('change', function() {
		var site_url = $('#site_url').text();
		var element = $(this).find('option:selected'); 
		var stateId = element.attr("data-id"); 
		var stateName = element.attr("value"); 
		if(stateId!=0)
		{
			$.ajaxSetup({
	      		headers: {
	          	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      		}
	    	});

			$.ajax({
			url: site_url+"/admin/get_lgas_city",
			type:'POST',
			data:{stateId:stateId},
			success:function(response){

					if(response['success'] == 1)
					{
						$('#lga').html(response['datalga']);
						$('#hosp_city').html(response['datacity']);
			 		}
			 		else
			 		{
			 			$('.alert-danger-outline-addhos').show();
			 			$('.addhos_danger_pop').text(response['message']);
			 		}

				}
			});
		}
	});

	$('#appointment_details').submit(function(e){
		e.preventDefault();
		var hospital_appointment = $.trim($(this).attr('data-id'));
		alert(hospital_appointment);
		$('#hospital_appointment_hidden').val(hospital_appointment);		
		var site_url = $('#site_url').text();
		 $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });

		$.ajax({
		url: site_url+"/patient/search_hospital_appointment",
		type:'GET',
		data:{hospital_appointment:hospital_appointment},
		success:function(result){
				
				if(result['redirect'] == 1){
		 			parent.location =result['redirect_url'];
	                return false;
		 		}

		 		$('#search_emp_modal').trigger('click');

				$(".main_div").html(result);

				if ($('#hostpital_appointment input.form-check-custom').length > 0)
		        {
		            var inputList = $('#hostpital_appointment input.form-check-custom');
		            for (var i = inputList.length - 1; i >= 0; i--) {
		                $(inputList[i]).prettyCheckable();
		            }  }
			}
		});
		
		return false;
	});

	$(".mobile_no").keydown(function(e) {
	    // Allow: backspace, delete, tab, escape, enter and .
	    
	    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 173, 189, 190]) !== -1 ||
	      // Allow: Ctrl+A,Ctrl+C,Ctrl+V, Command+A
	      ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67) && (e.ctrlKey === true || e.metaKey === true)) ||
	      // Allow: home, end, left, right, down, up
	      (e.keyCode >= 35 && e.keyCode <= 40)) {
	      // let it happen, don't do anything
	      return;
	    }
	    // Ensure that it is a number and stop the keypress
	    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	      e.preventDefault();
	    }
	 });

	var $error_modal_msg = $("#error_msg_tele");
	$error_modal_msg.on("close.bs.alert", function () {
		$error_modal_msg.hide();
		return false;
	});

	$(".avail_date").change(function(){
		var avail_date1 =$(this).val();
		$.ajaxSetup({
			headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
		});
		$.ajax({				
			type: 'POST',
			url: url,		
			data: {"avail_date1":avail_date1},		
			dataType: 'json',
			success: function (response) {
				if(response['redirect'] == 1){
		 			parent.location =response['redirect_url'];
	                return false;
		 		}
				if(response['success'] == '1')
				{												
										 				
				}
				else
				{				
					$(".error_text").text(response['message']);
					$(".error_msg").css("display","block");
				}
				return false;			
			},
			error: function (response) {
				console.log('Error:', response);
			}
		});
		return false;
	});

	$(document).on('click',".pagination li",function(){		
		if($(this).hasClass("disable") == false && $(this).hasClass("active") == false){
			 var url1 =$(this).find("a").attr("href");
			 $(this).find("a").attr("href","javascript:void(0);");			 
			 $.ajax({
				 url:url1,
				 type:'GET',				 
				 success:function(result){
				 	if(result['redirect'] == 1){
			 			parent.location =result['redirect_url'];
		                return false;
			 		}
					 $(".main_div").html(result);
				}
			});
		}
			 
	});

	$(document).on("click",".doctors_listing .doctor_exists_main",function(){
		$(".doctors_listing").find(".doctor_exists_main").removeClass("doctor_seleted");
		$(this).addClass("doctor_seleted");
	});

	$(document).on("click",".doctor_expand",function(e){
		e.stopPropagation();
	});


});

//search Hospital appointment
function getDoctors(id){
	var id = $(data).attr("data-appoint_id");
	url = site_url+"/patient/get_doctors_by_appointment/"+id;
	$.ajax({				
		type: 'GET',
		url: url,			
		dataType: 'html',
		success: function (response) {	
			if(response['redirect'] == 1){
	 			parent.location =response['redirect_url'];
                return false;
	 		}					
			$(".main_div").html(response);	
			$(".selected_speciality").text(selected_speciality);		
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}


function savetelemedicaldetails(data){
	var telemedical_type = $(".second_text").val();
	if(telemedical_type == "Audio"){
		var tele_type = 1;
	}else if(telemedical_type == "Video"){
		var tele_type = 2;
	}	
	
	var tele_appointment = 1;

	var consult_type = $(".consult_type1 option:selected").val();
	var consult_time = $(".consult_time option:selected").val();
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/appointment_details";	
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({				
		type: 'POST',
		url: url,		
		data: {"appointment_type":tele_appointment,"telemedical_type":tele_type,"telemedical_consult_type":consult_type,"telemedical_consult_time":consult_time},		
		dataType: 'json',
		success: function (response) {
			if(response['redirect'] == 1){
	 			parent.location =response['redirect_url'];
                return false;
	 		}
			if(response['success'] == '1')
			{	
				if(consult_time == 1){	
					parent.location =response['redirect_url'];
				}else{								
					$(".third_step").css("display","block");
    				$(".second_step").css("display","none");
    				$(".appointment_next").attr("data-appoint_id",response['id']);
    				$(".appointment_next").attr("data-consult_type",consult_type);
    			}					 				
			}
			else
			{				
				$(".error_text").text(response['message']);
				$(".error_msg").css("display","block");
			}
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
	return false;
}
function saveAppointmentDetail(key){
	var health_diary=[];
	$("input:checkbox[name=health_diary]:checked").each(function(){
    health_diary.push($(this).val());
	});
	// var time = '';
	// $('input[type="radio"]:checked').each(function() {
	// 	time = $(this).attr('data-value');
	// });
	var time = $(".doctors_listing").find(".doctor_apponitment_time:checked").val();
	var doctor_id = $(".doctors_listing").find(".doctor_seleted").find("#doctors_id").val();
	if(doctor_id==''){
		swal({
			title: "Please Select Doctor",
			text: "",
			icon: "error",	
		}); 
		return;
	}
	if(time==null){
		swal({
			title: "Please Select time",
			text: "",
			icon: "error",	
		}); 
		return;
	}
	// var time = $(".checked").prev('.time_set').val();
	var appointment_type = '2';
	var hosp_id = $(".doctors_listing").find(".doctor_seleted").find("#hosps_id").val();
	var reanson_for_visit = $("#scheduleAppointmentModel").find('#reanson_for_visit').val();
	
	var site_url = $('#site_url').text();
	var appoint_date = $(".doctors_listing").find(".doctor_seleted").find('.hosp_datepicker').val();
	var d = new Date(appoint_date);
	appoint_date = d.getFullYear()+"-"+('0' + (d.getMonth()+1) ).slice( -2 )+"-"+d.getDate();
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	var url = site_url+"/patient/save_book_details";
	// console.log({"symptoms":reanson_for_visit,"hospital_id":hosp_id,"appointment_type":appointment_type,"doctor_id":doctor_id,"doctor_appoint_date":appoint_date,"appoint_time":time,"health_diary":health_diary});
	// return;
		
	$.ajax({				
		type: 'POST',
		url: url,		
		data: {"symptoms":reanson_for_visit,"hospital_id":hosp_id,"appointment_type":appointment_type,"doctor_id":doctor_id,"doctor_appoint_date":appoint_date,"appoint_time":time,"health_diary":health_diary},		
		dataType: 'json',
		success: function (response) {

			if(response['redirect'] == 1){
				parent.location =response['redirect_url'];
			   return false;
			}		
		   if(response['success'] == '1')
		   {		
			   $(".error_msg_tele").css("display","none");	
			   $(".submit_status").val("1");		
			   $(".submit_id").val(response['id']);
			   alert(response['message']);		
			   parent.location =site_url+'/patient/my_appointments';	
			   $('#collapseTwo').collapse('toggle');	 				
		   }
		   else
		   {				
			   $(".error_text_tele").text(response['message']);
			   $(".error_msg_tele").css("display","block");						
		   }
		   return false;
			// if(response['redirect'] == 1){
				
            //     return false;
	 		// }else{
			// 	swal({
			// 		title:'',
			// 		text: response.message,
			// 		icon: "error",	
			// 	});
			//  }			
			// return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}
function savetelebooking(data){	
	$(".error_msg_tele").css("display","none");
	var patient_name = $(".patient_name").val();
	var mobile_no = $(".mobile_no").val();
	var hospital_id = $(".hospital_name").val();
	var symptoms = $(".symptoms").val();

		if(patient_name == "" || $.trim(patient_name) == ""){
		$(".error_text_tele").text("Please enter patient name");
		$(".error_msg_tele").css("display","block");
		return false;
	}
	var regex = /\d{3}-\d{3}-\d{5}/;
	if(mobile_no == ""){
		$(".error_text_tele").text("Please enter mobile number");
		$(".error_msg_tele").css("display","block");
		return false;
	}else if(mobile_no.length < 11){
		$(".error_text_tele").text("Please enter min 11 digits in mobile number");
		$(".error_msg_tele").css("display","block");
		return false;
	}else if(mobile_no.length > 15){
		$(".error_text_tele").text("Please enter max 15 digits in mobile number");
		$(".error_msg_tele").css("display","block");
		return false;
	}else if(regex.test(mobile_no)){
		$(".error_text_tele").text("Please enter proper mobile number");
		$(".error_msg_tele").css("display","block");
		return false;
	}

	if(hospital_id == ""){
		$(".error_text_tele").text("Please add hospital name");
		$(".error_msg_tele").css("display","block");
		return false;
	}

	if(symptoms == "" || $.trim(symptoms) == ""){
		$(".error_text_tele").text("Please describe the symptoms");
		$(".error_msg_tele").css("display","block");
		return false;
	}

	if($(".terms_cond").is(":checked")){
		var terms_cond = 1;
	}else{
		var terms_cond = 0;
		$(".error_text_tele").text("Please check the terms and conditions.");
		$(".error_msg_tele").css("display","block");
		return false;

	}

	if($(".sharing_status").is(":checked")){
		var sharing_status = 1;
	}else{
		var sharing_status = 0;
	}
	var submit_status = $(".submit_status").val();
	var submit_id = $(".submit_id").val();
	var appointment_id =  $(".appointment_id").val();
	var speciality_id = $(".speciality_id").val();
	var doctor_appoint_date = $(".doctor_appoint_date").val();	
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/save_book_details";	
	var health_diary=[];
	$("input:checkbox[name=health_diary]:checked").each(function(){
    health_diary.push($(this).val());
	});
	console.log(health_diary);
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({				
		type: 'POST',
		url: url,		
		data: {"booking_name":patient_name,"hospital_name":hospital_id,"mobile_number":mobile_no,"terms_conditions":terms_cond,"symptoms":symptoms,"submit_status":submit_status,"submit_id":submit_id,"appointment_id":appointment_id,"sharing_status":sharing_status,"speciality_id":speciality_id,"doctor_appoint_date":doctor_appoint_date,"health_diary":health_diary},		
		dataType: 'json',
		success: function (response) {
			if(response['redirect'] == 1){
	 			parent.location =response['redirect_url'];
                return false;
	 		}			
			if(response['success'] == '1')
			{		
				alert(response['message']);
				$(".error_msg_tele").css("display","none");	
				$(".submit_status").val("1");		
				$(".submit_id").val(response['id']);
				$(".order_no").text(response['id']);
				if(response['doc_name'] != "" && typeof response['doc_name'] !== typeof undefined){
					$(".doc_image").attr("src",site_url+"/admin/doctor/uploads/profile/"+response['doc_pic']);
					$(".doc_name").text(response['doc_name']);
					$(".doc_spe").text(response['doc_spe']);
				}
				//parent.location =site_url+'/patient/my_appointments';				
				$('#collapseTwo').collapse('toggle');	 				
			}
			else
			{							
				if(response['id'] != "" && typeof response['id'] !== typeof undefined){
					alert(response['message']);	
					$(".submit_status").val("1");		
					$(".submit_id").val(response['id']);
					$(".order_no").text(response['id']);
					if(response['success'] == 3){
						parent.location =site_url+'/patient/dashboard';	
					}			
                }else{
					$(".error_text_tele").text(response['message']);
					$(".error_msg_tele").css("display","block");
				}
			}
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
	
}

function saveHospitalAppointment(data){
	$(".error_msg_tele").css("display","none");	
	var hosp_val = $(".hosp_list option:selected").val();	
	if(hosp_val == ""){
		$(".error_text_tele").text("Please select a hospital");
		$(".error_msg_tele").css("display","block");
		return false;
	}
	var symptoms = $(".symptoms").val();	
	if(symptoms == "" || $.trim(symptoms) == ""){
		$(".error_text_tele").text("Please describe the symptoms");
		$(".error_msg_tele").css("display","block");
		return false;
	}	
	
	var appointment_type =  $(".appoint_type").val();	
	var doctor_id = $(".doctors_listing").find(".doctor_seleted").attr("data-doct_id");
	if(doctor_id == "" || typeof doctor_id === typeof undefined){
		$(".error_text_tele").text("Please select a doctor");
		$(".error_msg_tele").css("display","block");
		return false;
	}
	var doctor_appoint_date = $(".doctors_listing").find(".doctor_seleted").find(".hosp_datepicker").val();
	if(doctor_appoint_date == "" || typeof doctor_appoint_date === typeof undefined){
		$(".error_text_tele").text("Please select an appointment date");
		$(".error_msg_tele").css("display","block");
		return false;
	}else{
		var d = new Date(doctor_appoint_date);
		doctor_appoint_date = d.getFullYear()+"-"+('0' + (d.getMonth()+1) ).slice( -2 )+"-"+d.getDate();
	}
	var appoint_time = $(".doctors_listing").find(".doctor_seleted").find(".doctor_apponitment_time:checked").val();
	if(appoint_time == "" || typeof appoint_time === typeof undefined){
		$(".error_text_tele").text("Please select an appointment time");
		$(".error_msg_tele").css("display","block");
		return false;
	}	
	//var health_diary=$("#health_diary").val();
	var health_diary=[];
	$("input:checkbox[name=health_diary]:checked").each(function(){
    health_diary.push($(this).val());
	});
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/save_book_details";		
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});

	
	$.ajax({				
		type: 'POST',
		url: url,		
		data: {"symptoms":symptoms,"hospital_id":hosp_val,"appointment_type":appointment_type,"doctor_id":doctor_id,"doctor_appoint_date":doctor_appoint_date,"appoint_time":appoint_time,"health_diary":health_diary},		
		dataType: 'json',
		success: function (response) {	
			if(response['redirect'] == 1){
	 			parent.location =response['redirect_url'];
                return false;
	 		}		
			if(response['success'] == '1')
			{		
				$(".error_msg_tele").css("display","none");	
				$(".submit_status").val("1");		
				$(".submit_id").val(response['id']);
				alert(response['message']);		
				parent.location =site_url+'/patient/my_appointments';	
				$('#collapseTwo').collapse('toggle');	 				
			}
			else
			{				
				$(".error_text_tele").text(response['message']);
				$(".error_msg_tele").css("display","block");						
			}
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});

}

function sortAppointments(data){	
	var appoint_time = 0;
	$(".appointment_time_sel").each(function(){
		
		if($(this).is(":checked")){
			appoint_time = $(this).val();
		}
	});	
	var spe = [];
	$(".doc_speciality").each(function(){
		if($(this).is(":checked")){
			spe.push($(this).val()); 
		}
	});
	var hosp = 0;
	if($(".hosp_list option:selected").val() != ""){
		hosp = $(".hosp_list option:selected").val();
	}
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/my_appointments/"+appoint_time+"/"+JSON.stringify(spe)+"/"+hosp;
	
	
	$.ajax({				
		type: 'GET',
		url: url,						
		dataType: 'html',
		success: function (response) {	
			if(response['redirect'] == 1){
	 			parent.location =response['redirect_url'];
                return false;
	 		}		
			$(".main_div").html(response);
			if(appoint_time == ""){
				$(".appointment_time").attr("checked",false);
				$(".appointment_fil").find("a").removeClass("checked");
			}
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}

function savefuturebooking(data){	
	//var health_diary=$("#health_diary").val();
	var health_diary=[];
	$("input:checkbox[name=health_diary]:checked").each(function(){
    health_diary.push($(this).val());
	});
	$(".error_msg_tele").css("display","none");	
	var symptoms = $(".symptoms").val();	
	if(symptoms == "" || $.trim(symptoms) == ""){
		$(".error_text_tele").text("Please describe the symptoms");
		$(".error_msg_tele").css("display","block");
		return false;
	}
	
	var submit_status = $(".submit_status").val();
	var submit_id = $(".submit_id").val();
	var appointment_id =  $(".appointment_id").val();
	var doctor_id = $(".doctor_id").val();
	var doctor_appoint_date = $(".doctor_appoint_date").val();
	var speciality_id = $(".speciality_id").val();
	var site_url = $('#site_url').text();
	//var health_diary=$("#health_diary").val();
	var url = site_url+"/patient/save_book_details";		
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({				
		type: 'POST',
		url: url,		
		data: {"symptoms":symptoms,"submit_status":submit_status,"submit_id":submit_id,"appointment_id":appointment_id,"doctor_id":doctor_id,"doctor_appoint_date":doctor_appoint_date,"speciality_id":speciality_id,"health_diary":health_diary},		
		dataType: 'json',
		success: function (response) {	
			if(response['redirect'] == 1){
	 			parent.location =response['redirect_url'];
                return false;
	 		}		
			if(response['success'] == '1')
			{		
				$(".error_msg_tele").css("display","none");	
				$(".submit_status").val("1");		
				$(".submit_id").val(response['id']);
				alert(response['message']);		
				parent.location =site_url+'/patient/my_appointments';	
				$('#collapseTwo').collapse('toggle');	 				
			}
			else
			{				
				$(".error_text_tele").text(response['message']);
				$(".error_msg_tele").css("display","block");						
			}
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
	
}
function blockPopupFn() {
	swal({
		text: "This feature is not available to you yet",
	}); 
	return;
}

//search Hospital appointment
function getDoctors(id,search_val,doctor_id,type_of_speciality,state,lga,hospital_name){
	var id = id;
	var site_url = $('#site_url').text();
	var user_login = $('#user_login').text();
	if(user_login == 'true'){
		window.location.href = site_url+'/patient/appointment?hospital_name='+hospital_name+'&hosp_id='+id+'&doctor_id='+doctor_id+'&type_of_speciality='+type_of_speciality+'&state='+state+'&lga='+lga;
	}else{
		window.location.href = site_url+'/patient/patient_appointment?hospital_name='+hospital_name+'&hosp_id='+id+'&doctor_id='+doctor_id+'&type_of_speciality='+type_of_speciality+'&state='+state+'&lga='+lga;
	}
}

//search appointment
function getDoctorsDetail(id,search_val,doctor_id,type_of_speciality,state,lga,hospital_name){
	var id = id;
	var site_url = $('#site_url').text();
	var user_login = $('#user_login').text();
	if(user_login == 'true'){
		window.location.href = site_url+'/patient/appointment?hospital_name='+hospital_name+'&hosp_id='+id+'&doctor_id='+doctor_id+'&type_of_speciality='+type_of_speciality+'&state='+state+'&lga='+lga;
	}else{
		window.location.href = site_url+'/patient/patient_appointment?hospital_name='+hospital_name+'&hosp_id='+id+'&doctor_id='+doctor_id+'&type_of_speciality='+type_of_speciality+'&state='+state+'&lga='+lga;
	}
	
}


function resetfilters(data){	
	$(".appointment_time_sel").each(function(){
		$(this).prettyCheckable('uncheck');
	});	
	
	$(".doc_speciality").each(function(){
		$(this).prettyCheckable('uncheck');
	});
	$(".hosp_list").val("");
	sortAppointments(data);
}

function futuretelemedical(data){	
	var id = $(data).attr("data-appoint_id");
	var doctor_id = $(data).attr("data-doctor_id");	
	var appoint_time = $(data).parents(".main_data").find(".doctor_apponitment_time:checked").val();	
	var avail_date1 =$(data).parents(".main_data").find(".doc_appoint_date").text();
	var d = new Date(avail_date1);
	avail_date1 = d.getFullYear()+"-"+('0' + (d.getMonth()+1) ).slice( -2 )+"-"+d.getDate();		
	var site_url = $('#site_url').text();	
	if($(".speciality_list").css("display") == "block"){
		var sid = $(".speciality_list").attr("data-id");
		parent.location = site_url+'/patient/future_tele_details/'+id+'/'+doctor_id+'/'+avail_date1+'/'+appoint_time+"/"+sid;
	}else{
		parent.location = site_url+'/patient/future_tele_details/'+id+'/'+doctor_id+'/'+avail_date1+'/'+appoint_time;	
	}
}

function appointemntnext(data){
	var tele_appoint = $(".tele_appoint").data('date');	
	var d = new Date(tele_appoint);
	tele_appoint = d.getFullYear()+"-"+('0' + (d.getMonth()+1) ).slice( -2 )+"-"+d.getDate();		
	var id = $(data).attr("data-appoint_id");
	var type = $(data).attr("data-consult_type");	
	var site_url = $('#site_url').text();
	parent.location = site_url+'/patient/telemedical_doctors_listing/'+id+'/'+tele_appoint+"/"+type;
}
function specialityimmediatebooking(data){
	var sid = $(data).attr("data-id");	
	var id = $(data).attr("data-appoint_id");
	var selected_speciality = $(data).text();
	$(".selected_speciality").text(selected_speciality);
	var site_url = $('#site_url').text();
	parent.location = site_url+'/patient/immediate_tele_details/'+id+'/'+sid;
}

function specialityfuturebooking(data){
	var sid = $(data).attr("data-id");
	var id = $(data).attr("data-appoint_id");
	var date = $(data).attr("data-date");
	var type = $(data).attr("data-type");
	var selected_speciality = $(data).text();  	
	var site_url = $('#site_url').text();
	url = site_url+"/patient/telemedical_doctors_listing/"+id+"/"+date+"/"+type+"/"+sid;
	
	$.ajax({				
		type: 'GET',
		url: url,			
		dataType: 'html',
		success: function (response) {	
			if(response['redirect'] == 1){
	 			parent.location =response['redirect_url'];
                return false;
	 		}					
			$(".main_div").html(response);	
			$(".selected_speciality").text(selected_speciality);		
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}

function hospitalDoctorListing(data){
	if($(data).attr("data-hosp_id") != "" && typeof $(data).attr("data-hosp_id") !== typeof undefined ){
		var val = $(data).attr("data-hosp_id");
		var date = $(data).val();
		var site_url = $('#site_url').text();
		url = site_url+"/patient/hospital_doctors_listing/"+val+"/"+date;
		$(data).datepicker('hide');		
		var id = $(data).parents(".collapse").attr("id");

	}else{
		var val = $(data).val();
		var site_url = $('#site_url').text();
		url = site_url+"/patient/hospital_doctors_listing/"+val;
	}
	
	
	$.ajax({				
		type: 'GET',
		url: url,			
		dataType: 'html',
		success: function (response) {	
			if(response['redirect'] == 1){
	 			parent.location =response['redirect_url'];
                return false;
	 		}					
			$(".doctors_listing").html(response);			
			var date = new Date(); 
		    date = date.getDate()-1;
		    
		    $('.hosp_datepicker').datepicker({
		        startDate: date.toLocaleString(),        
		        format: 'DD, dd MM yyyy'
		        
		    });	

		    $(".hosp_datepicker").find("div").on('click',function(){	
				$(".datepicker").find(".prev").removeClass("date_disable");
				if($(".datepicker").find(".prev").css("visibility") == "hidden"){			
					$(".datepicker").find(".prev").addClass("date_disable");
				}else{			
					$(".datepicker").find(".prev").removeClass("date_disable");
				} 			
			});	

			$(".datepicker").on('click',function(){
				$(".datepicker").find(".prev").removeClass("date_disable");
				if($(".datepicker").find(".prev").css("visibility") == "hidden"){			
					$(".datepicker").find(".prev").addClass("date_disable");
				}else{			
					$(".datepicker").find(".prev").removeClass("date_disable");
				} 		
			});		    
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});

}

function doctorAvailabilityListing(data){
	var val = $(data).attr("data-doct_id");
	var date = $(data).val();
	var patient_id = $(data).attr("data-patient_id");
	var key = $(data).attr("data-key");
	var site_url = $('#site_url').text();
	var user_login = $('#user_login').text();
	if(user_login=='true'){
		url = site_url+"/patient/doctors_availability_listing_new/"+val+"/"+date+"/"+key+"/"+patient_id;	
	}else{
		url = site_url+"/patient/doctors_availability_listing/"+val+"/"+date+"/"+key;	
	}
	// url = site_url+"/patient/doctors_availability_listing/"+val+"/"+date+"/"+key+"/"+patient_id;
	$(data).datepicker('hide');		
	var id = $(data).parents(".collapse").attr("id");
	console.log(key);
	
	$.ajax({				
		type: 'GET',
		url: url,			
		dataType: 'html',
		success: function (response) {
			
			if(response['redirect'] == 1){
				parent.location =response['redirect_url'];
                return false;
			}					
			$("."+key).find(".availability_listing").html(response);	
			$('.availability_listing_list').show();
			$("."+key).find('#schudule-btn-show').show();



				var size_li = $("."+key).find(".availability_listing li").length;
				if(size_li>20){
					$("."+key).find('.appointment_loadmore .loadMore').show();
				}else{
					$("."+key).find('.appointment_loadmore .loadMore').hide();
				}
			  var x = 20;
				  size_li = $("."+key).find(".availability_listing li").length;

				  x=20;
				  $("."+key).find('.availability_listing li:lt('+x+')').css("display","inline-block");
				  $("."+key).find('.availability_listing li:lt('+x+')').show();
				  $("."+key+' .loadMore').click(function () {
					  x= (x+5 <= size_li) ? size_li : size_li;
					  $("."+key).find('.availability_listing li:lt('+x+')').show();
					  $("."+key).find('.availability_listing li:lt('+x+')').css("display","inline-block");
					  $("."+key).find('.appointment_loadmore .loadMore').hide();
				  });
				  $("."+key+' .showLess').click(function () {
					  x=(x-5<0) ? size_li : size_li;
					  $("."+key).find('.availability_listing li').not(':lt('+x+')').hide();
					  
				  });







			// $(".availability_listing").html(response);		  
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});

}
function appointmentdetail(data){
	var id = $(data).parent().attr("data-id");
	var site_url = $('#site_url').text();
	parent.location = site_url+'/patient/appointment_detail/'+id;
}

function historydetail(data){
	var id= $(data).attr("data-id");
	var site_url = $('#site_url').text();
	parent.location = site_url+'/patient/history_detail/'+id;	
}

function payWithPaystack(data){
	var amt = $(data).attr("data-amt");
	var bfr_amt = $(data).attr("data-amt");
	amt = parseFloat(amt)*100;	
	var doc_id = $(data).attr("data-doc_id");	
	var pt_id = $(data).attr("data-pt_id");
	var ap_id = $(".appointment_id").val();
	var bill_id = 34554553454;
	var datetime = new Date()
	var x = Math.random()*10000000000000000;
	x =Math.floor(x/1000000);	
	
	var handler = PaystackPop.setup({		    	
	   	key: 'pk_test_a6adba56deebfcd4e5cb8a4929526844a742537f',
		email: 'shreya.d@iapptechnologies.com',
	  	amount: amt,		
	  	channels:['card','bank'],      	
	  	ref: ''+Math.floor(x + datetime.getTime()/1000), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
	 callback: function(response){ 
      	var site_url = $('#site_url').text();
		var url = site_url+"/patient/pay_billing";	

		$.ajaxSetup({
			headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
		});
		$.ajax({				
			type: 'POST',
			url: url,	
			data: {'transaction_id':response.reference,'billing_id':bill_id,"patient_id":pt_id,"doctor_id":doc_id,"amt":bfr_amt,"appointment_id":ap_id},	
			dataType: 'json',
			success: function (response) {	
				if(response['redirect'] == 1){
		 			parent.location =result['redirect_url'];
	                return false;
		 		}
		 		if(response['success'] == 1){					
					alert(response["message"]);	
					$('#collapseThree').collapse('toggle');			
				}

			$('.widget_card').css("pointer-events","none");
			$(this).attr("disabled",true);
		 	},
			error: function (response) {
				console.log('Error:', response);
			}
		});	
	  },
	  onClose: function(){
	      //alert('window closed');
	  }
	});
	handler.openIframe();
}
// Reshedule booking
function resheduleBooking(data){	
	var appoint_date = $(data).attr("data-appoint_date");	
	var book_id = $(data).attr("data-booking_id");
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/reshedule_detail";	
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({
		url:url,
		type:'POST',
		data:{"book_id": book_id,"appoint_date":appoint_date},		
    	dataType:'html',
		success:function(result){	
			$(".reshedule_detail").html(result);
			var date = new Date(); 
        	date = date.getDate()-1;
			$(".reshedule_time").datepicker({format: 'dd MM yyyy',startDate: date.toLocaleString()});
			$("#reschedule_appointment").modal('show');			
			$(".reshedule_time").children().on('click',function(e){					
				var $this = $(this);	
				setTimeout(function(){		
					if(e.target.nodeName != 'TD'){					
						if($this.find(".datepicker-days").find("tbody").find(".today").length > 0 && ($this.find(".datepicker-days").css("display") == "block" && $this.find(".datepicker-days").find("tbody").find(".today").css("display") == "table-cell")){							
							$(".hidden_date").val(new Date().toDateString());				
						}
					}				
					$("#reschedule_appointment").find(".reshedule_time").find(".prev").removeClass("date_disable");		
					if($("#reschedule_appointment").find(".reshedule_time").find(".prev").css("visibility") == "hidden"){			
						$("#reschedule_appointment").find(".reshedule_time").find(".prev").addClass("date_disable");
					}else{			
						$("#reschedule_appointment").find(".reshedule_time").find(".prev").removeClass("date_disable");
					} 
					//availbilityDateUpdate();
				},100);	
						
			});

			$('#reshedule_time').on('changeDate', function(event) {	 
			    //var a=formatDate(event.date);
			    var a=moment(event.date).format('DD-MM-YYYY');		
			    $("#hidden_date").val(a);
			    availbilityDateUpdate($("#reschedule_appointment"));
			});
						
		},
		
	});
	
}
function availbilityDateUpdate(data){		
	var appoint_date = $(data).find("#hidden_date").val();		
	var book_id = $(data).find("#hidden_book_id").val();
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/reshedule_detail";	
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({				
		type: 'POST',
		url: url,	
		data: {'appoint_date':appoint_date,'book_id':book_id},	
		dataType: 'html',
		success: function (response) {	
			if(response['redirect'] == 1){
	 			parent.location =result['redirect_url'];
                return false;
	 		}	
	 		$(".reshedule_detail").html(response);
			var date = new Date(); 
        	date = date.getDate()-1;
			$(".reshedule_time").datepicker({format: 'dd MM yyyy',startDate: date.toLocaleString()});
			$(".reshedule_time").children().on('click',function(e){					
				var $this = $(this);	
				setTimeout(function(){		
					if(e.target.nodeName != 'TD'){					
						if($this.find(".datepicker-days").find("tbody").find(".today").length > 0 && ($this.find(".datepicker-days").css("display") == "block" && $this.find(".datepicker-days").find("tbody").find(".today").css("display") == "table-cell")){							
							$(".hidden_date").val(new Date().toDateString());				
						}
					}				
					$("#reschedule_appointment").find(".reshedule_time").find(".prev").removeClass("date_disable");		
					if($("#reschedule_appointment").find(".reshedule_time").find(".prev").css("visibility") == "hidden"){			
						$("#reschedule_appointment").find(".reshedule_time").find(".prev").addClass("date_disable");
					}else{			
						$("#reschedule_appointment").find(".reshedule_time").find(".prev").removeClass("date_disable");
					} 
					//availbilityDateUpdate();
				},100);	
						
			});

			$('#reshedule_time').on('changeDate', function(event) {					
			   var a=moment(event.date).format('DD-MM-YYYY');	
			    $("#hidden_date").val(a);
			    availbilityDateUpdate($("#reschedule_appointment")); 
			});			
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});	
	
}
function cancelBooking(data){
	var book_id = $(data).attr("data-booking_id");
	var patient_id = $(data).attr("data-patient_id");
	var doctor_id = $(data).attr("data-doctor_id");
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/cancel_booking";	
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({
		url:url,
		type:'POST',
		data:{"book_id": book_id,"patient_id":patient_id,"doctor_id":doctor_id},		
    	async: false,
		success:function(result){	
			if(result['redirect'] == 1){
	 			parent.location =result['redirect_url'];
                return false;
	 		}
			if(result['success'] == 1){
				location.reload(true);
			}
						
		},
		
	});
}
function updateAppointment(data){
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/update_appointments";
	var  appoint_date = $(data).parents("#reschedule_appointment").find(".hidden_date").val();	
	var patient_id = $(data).parents("#reschedule_appointment").find(".hidden_patient_id").val();
	var doctor_id = $(data).parents("#reschedule_appointment").find(".hidden_doctor_id").val();
	var  book_id = $(data).parents("#reschedule_appointment").find(".hidden_book_id").val();	
	var  appoint_time = $(data).parents("#reschedule_appointment").find(".appoint_time option:selected").val();
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({				
		type: 'POST',
		url: url,	
		data:{'appoint_date':appoint_date,'book_id':book_id,'appoint_time':appoint_time,"patient_id":patient_id,"doctor_id":doctor_id},	
		dataType: 'json',
		success: function (response) {		
			if(response['redirect'] == 1){
	 			parent.location =result['redirect_url'];
                return false;
	 		}	
	 		if(response['error'] == 1){
	 			alert(result['message']);
	 			return false;	
	 		}
			if(response['success'] == 1){
				$("#reschedule_appointment").modal("hide");
				alert("Appointment resheduled successfully");
				location.reload(true);
			}
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});

}
function disableoption(element){
	var value=element.value;
	if(value==2){
		$(".consult_time option[data-id='1']").hide();
		$(".consult_time option[data-id='2']").attr("selected","selected");
	}
	else{
			$(".consult_time option[data-id='1']").show();
			$(".consult_time option[data-id='1']").attr("selected","selected");
	}

}

//Get Patient and doctor
function scheduleAppointmentDetail(id)
{
	if(id){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		var site_url = $('#site_url').text();
		$.ajax({				
			type: 'GET',
			url:  site_url+'/patient/get_paitint_by_doctor/'+id,	
			dataType: 'json',
			success: function (response) {
				console.log("response",response);
				
				if(response){
					$('#scheduleAppointmentModel').modal('show');
					$('#patient_name').text(response.patient_name);
					$('#patient_age').text(response.patient_age);
					$('#patient_gender').text(response.patient_gender=="1"?"Female":"Male");
					$('#patient_address').text(response.patient_address);
					$('#patient_dob').text(response.patient_date_of_birth);
					$('#patient_month_year').text(response.patient_month_year);
					$('#patient_time').text(response.patient_time);
					$('#doctors_id').val(response.doctor_id);
					$('#patient_date').text(response.patient_date);
					$('#doctor_name').text(response.doctor_first_name+" "+response.doctor_last_name);
					$('#doctor_speciality').text(response.doctor_speciality);
					$('#doctor_address').text(response.doctor_address);
					if(response.patient_image){
						$("#patient_image").css("background-image", "url(" + site_url+'/uploads/patient/'+response.patient_image + ")");
						// $('#patient_image').attr("src", site_url+'/uploads/patient/'+response.patient_image);
					}else{
						$("#patient_image").css("background-image","url('http://renderhealth.themezones.com/images/profile.svg')");
					}
					if(response.doctor_picture){
						$("#doctor_picture").css("background-image", "url(" + site_url+'/doctorimages/'+response.doctor_picture + ")");
						// $('#doctor_picture').attr("src", site_url+'/doctorimages/'+response.doctor_picture);
					}else{
						$("#doctor_picture").css("background-image", "url('http://renderhealth.themezones.com/images/profile.svg')");
					}

					$("#patient_image").css("width", "115px");
					$("#patient_image").css("height", "115px");
					$("#patient_image").css("border-radius", "100%");
					$("#patient_image").css("background-size", "cover");
					$("#doctor_picture").css("width", "60px");
					$("#doctor_picture").css("height", "60px");
					$("#doctor_picture").css("border-radius", "100%");
					$("#doctor_picture").css("background-size", "cover");
				}
				return false;			
			},
			error: function (response) {
				console.log('Error:', response);
			}
		});
	}else{
		alert('Invalid Request.');
	}
}
function viewDoctorProfile(id)
	{
		if(id){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var site_url = $('#site_url').text();
			$.ajax({				
				type: 'POST',
				url:  site_url+'/patient/viewdoctor',
				data: {"doctor_id":id},		
				dataType: 'json',
				success: function (response) {
					console.log(response);
					if(response.data){
						$('#view_user').modal('show')
						
							var data = `
							
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">First Name</label>
								<label class="col-6">${response.data.doctor_first_name ? response.data.doctor_first_name : '-'}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Middle Name</label>
								<label class="col-6">${response.data.doctor_middle_name ? response.data.doctor_middle_name : '-'}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Last Name</label>
								<label class="col-6">${response.data.doctor_last_name ? response.data.doctor_last_name : '-'}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Speciality</label>
								<label class="col-6">${response.data.doctor_speciality ? response.data.doctor_speciality : '-'}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Education</label>
								<label class="col-6">${response.data.doctor_education_school ? response.data.doctor_education_school : '-'}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Language</label>
								<label class="col-6">${response.data.doctor_languages ? response.data.doctor_languages : '-'}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Biography</label>
								<label class="col-6">${response.data.biography ? response.data.biography : '-'}</label>
								</div>
							</div>
							`
							$('#view_user_body').html(data);
						
					}
					return false;			
				},
				error: function (response) {
					console.log('Error:', response);
				}
			});
		}else{
			alert('Invalid Request.');
		}
	}