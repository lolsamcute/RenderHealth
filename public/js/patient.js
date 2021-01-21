$(document).ready(function(){
		var input = document.querySelector("#phone");
		var iti=window.intlTelInput(input, {
			initialCountry: "ng",
			onlyCountries: ['ng'],
		geoIpLookup: function(callback) {
		$.get('https://ipinfo.io', function() {}, "jsonp").done(function(resp) {
		var countryCode = (resp && resp.country) ? resp.country : "";
		callback(countryCode);
		return false;
		});
		},
		//hiddenInput: "full_number",

		utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
		});
		input.addEventListener("countrychange", function() {
		console.log(iti.getSelectedCountryData().dialCode);
		$("#phone").val("+"+iti.getSelectedCountryData().dialCode);
		});

$(".re_pass").keyup(function(event){			
		var pass = $(".patient_password").val();
		var re_pass = $(this).val();
		if(pass != re_pass){
			$(".error_text").text("Passwords don't match");
			$(".error_msg").css("display","block");
			$(".updateBtn").prop("disabled", true);
		}else{
			$(".error_text").text("");
			$(".error_msg").css("display","none");
			$(".updateBtn").prop("disabled", false);			
		}
	});
	$(".co_pass").keyup(function(event){			
		var pass = $(".new_password").val();
		var re_pass = $(this).val();
		if(pass != re_pass){
			$(".error_text").text("Passwords don't match");
			$(".error_msg").css("display","block");
			$(".updateBtn").prop("disabled", true);
		}else{
			$(".error_text").text("");
			$(".error_msg").css("display","none");
			$(".updateBtn").prop("disabled", false);			
		}
	});

	$('#forgot_password').on('show.bs.modal', function(e) {
		$(".success_modal_text").text('');
		$(".error_modal_text").text('');
		$(".success_modal_msg").css("display","none");
		$(".error_modal_msg").css("display","none");   
		$('#forgot_form')[0].reset();
    });

	$(".patient_phone").keydown(function(e) {
		//alert(e.keyCode);
	    // Allow: backspace, delete, tab, escape, enter and .
	    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 173,189,109,219,221,57,48,61,187]) !== -1 ||
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

  	$('.patient_email, .forgot_email').keypress(function(e){
	    if(e.which === 32){
	        return false;
	    }
	});

  	var $error_msg = $("#error_msg");
	$error_msg.on("close.bs.alert", function () {
		$error_msg.hide();
		return false;
	});

	var $success_msg = $("#success_msg");
	$success_msg.on("close.bs.alert", function () {
		$success_msg.hide();
		return false;
	});

	var $error_modal_msg = $("#error_modal_msg");
	$error_modal_msg.on("close.bs.alert", function () {
		$error_modal_msg.hide();
		return false;
	});

	var $success_modal_msg = $("#success_modal_msg");
	$success_modal_msg.on("close.bs.alert", function () {
		$success_modal_msg.hide();
		return false;
	});
});

function signup(data){	
	var form_data = new FormData(data);	
	var site_url = $('#site_url').text();
	var timezone_offset_minutes = new Date().getTimezoneOffset();
	timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
	form_data.append("timezone", timezone_offset_minutes);
	var url = site_url+"/patient/signup";
	var patient_user_name = $.trim($( ".patient_username" ).val());
	if(patient_user_name == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter user name." );
		$(".error_msg").css("display","block");
		return false;
	}
	var patient_first_name = $.trim($( ".patient_first_name" ).val());
	if(patient_first_name == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter first name." );
		$(".error_msg").css("display","block");
		return false;
	}
	else if(patient_first_name.length > 20)
	{		
		$( ".error_text" ).text( "Please enter at most 20 characters in first name." );
		$(".error_msg").css("display","block");
		return false;
	}
	var middle_name_length = $( ".patient_middle_name" ).val();
	if(middle_name_length.length > 0){
		var patient_middle_name = $.trim($( ".patient_middle_name" ).val());
		if(patient_middle_name == "") {		
			$(".error_text").text('');
			$( ".error_text" ).text( "Please enter proper middle name." );
			$(".error_msg").css("display","block");
			return false;
		}else if(patient_middle_name.length > 20)
		{		
			$( ".error_text" ).text( "Please enter at most 20 characters in middle name." );
			$(".error_msg").css("display","block");
			return false;
		}
	}
	var patient_last_name = $.trim($( ".patient_last_name" ).val());
	if(patient_last_name == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter last name." );
		$(".error_msg").css("display","block");
		return false;
	}
	else if(patient_last_name.length > 20)
	{		
		$( ".error_text" ).text( "Please enter at most 20 characters in last name." );
		$(".error_msg").css("display","block");
		return false;
	}
	var patient_email = $.trim($( ".patient_email" ).val());
	if(patient_email == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter email." );
		$(".error_msg").css("display","block");
		return false;
	}
	else if( !isValidEmailAddress(patient_email) ) {
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter proper format email." );
		$(".error_msg").css("display","block");
		return false;
	}

	var patient_phone = $.trim($( ".patient_phone" ).val());
	if(patient_phone == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter phone number." );
		$(".error_msg").css("display","block");
		return false;
	}else if(patient_phone.length > 15)
	{		
		$( ".error_text" ).text( "Phone number is invalid" );
		$(".error_msg").css("display","block");
		return false;
	}	

	var patient_password = $.trim($( ".patient_password" ).val());
	if(patient_password == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter password." );
		$(".error_msg").css("display","block");
		return false;
	}

	var c_password = $.trim($( ".c_password" ).val());
	if(c_password == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter confirm password." );
		$(".error_msg").css("display","block");
		return false;
	}
	var num = $( "#select_num" ).val();
	var day = $( "#select_day" ).val();
	var year = $( "#year" ).val();
	if(num == "" || day == "" || year=="") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter birth details." );
		$(".error_msg").css("display","block");
		return false;
	}
	
	if($( ".patient_terms_cond" ).is(":checked") == false) {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please agree with the terms and conditions." );
		$(".error_msg").css("display","block");
		return false;
	}
	
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({				
		type: 'POST',
		url: url,		
		data: form_data,
		processData: false,
    	contentType: false,
		dataType: 'json',
		success: function (response) {
			if(response['success'] == '1')
			{		
				$(".error_msg").css("display","none");
				$(".success_text").text('');
				$( ".success_text" ).text( "You have been successfully registered." );
				$(".success_msg").css("display","block");	
				setTimeout(function(){ parent.location =response['redirect_url']; }, 1500);					 				
			}
			else
			{
				$(".success_msg").css("display","none");
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

function patientLogin(data){			
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/login";
	var patient_email = $.trim($( ".patient_email" ).val());
	if(patient_email == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter email." );
		$(".error_msg").css("display","block");
		return false;
	}
	else if( !isValidEmailAddress(patient_email) ) {
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter proper format email." );
		$(".error_msg").css("display","block");
		return false;
	}

	var patient_password = $.trim($( ".patient_password" ).val());
	if(patient_password == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter password." );
		$(".error_msg").css("display","block");
		return false;
	}

	var remember = 0;
	if($("#remember").is(":checked")){
		remember = 1;
	}
	
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({				
		type: 'POST',
		url: url,		
		data: {"patient_email":patient_email,"patient_password":patient_password,"remember":remember},		
		dataType: 'json',
		success: function (response) {
			if(response['success'] == '1')
			{		
				$(".success_msg").css("display","none");
				$(".error_msg").css("display","none");							
				update_timezone();				 				
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

function update_timezone(){
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
			var url = document.referrer.replace('patient_appointment','appointment');
			console.log(url);
			
			parent.location =url;
			// window.location.href =  url;
			// if(redirect_appointment && redirect_appointment.indexOf("url=")){
			// 	var url_redirect = redirect_appointment.replace('url=','');
			// 	parent.location ="/appointment/"+url_redirect;
			// }else{	
			// 	 parent.location =result['redirect_url'];	
			// // }
		}
	});	
}

function forgotpassword(data){
	$(".resend_link").addClass("m-loader");		
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/forgotpassword";

	var forgot_email = $.trim($( ".forgot_email" ).val());
	if(forgot_email == "") {	
		$(".resend_link").removeClass("m-loader");	
		$(".error_modal_text").text('');
		$( ".error_modal_text" ).text( "Please enter email." );
		$(".error_modal_msg").css("display","block");
		return false;
	}
	else if( !isValidEmailAddress(forgot_email) ){
		$(".resend_link").removeClass("m-loader");
		$(".error_modal_text").text('');
		$(".error_modal_text" ).text( "Please enter proper format email." );
		$(".error_modal_msg").css("display","block");
		return false;
	}	

	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({				
		type: 'POST',
		url: url,		
		data: {"patient_email":forgot_email},		
		dataType: 'json',
		success: function (response) {
			$(".resend_link").removeClass("m-loader");
			if(response['success'] == '1')
			{	
				$(".error_modal_msg").css("display","none");
				$(".success_modal_text").text(response['message']);
				$(".success_modal_msg").css("display","block");						
				//setTimeout(function(){ $('#forgot_password').modal('hide'); }, 3000);										 				
			}
			else
			{	
				$(".success_modal_msg").css("display","none");			
				$(".error_modal_text").text(response['message']);
				$(".error_modal_msg").css("display","block");
			}
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
	return false;

}

function resetpassword(data){	
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/resetpassword";	

	var new_password = $.trim($( ".new_password" ).val());
	if(new_password == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter password." );
		$(".error_msg").css("display","block");
		return false;
	}else if(new_password.length < 6)
	{		
		$( ".error_text" ).text( "Please enter at least 6 characters in password." );
		$(".error_msg").css("display","block");
		return false;
	}	

	var confirm_new_password = $.trim($( ".confirm_new_password" ).val());
	if(confirm_new_password == "") {		
		$(".error_text").text('');
		$( ".error_text" ).text( "Please enter confirm password." );
		$(".error_msg").css("display","block");
		return false;
	}
	
	var user_id = $(".user_id").val();
	var FPtoken = $(".FPtoken").val();

	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({				
		type: 'POST',
		url: url,		
		data: {"new_password":new_password,"fptoken":FPtoken,"user_id":user_id},		
		dataType: 'json',
		success: function (response) {
			if(response['success'] == '1')
			{	
				$(".error_msg").css("display","none");							
				parent.location =response['redirect'];					 				
			}
			else
			{
				$(".success_msg").css("display","none");
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

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
