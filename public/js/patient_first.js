$(document).ready(function(){
	var input = document.querySelector("#patient_phone");
	var input2 = document.querySelector("#next_phone");
	var input3 = document.querySelector("#emergency_phone");

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

		var iti2=window.intlTelInput(input2, {
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

		var iti3=window.intlTelInput(input3, {
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
			$("#patient_phone").val("+"+iti.getSelectedCountryData().dialCode);
		});

		input2.addEventListener("countrychange", function() {
			console.log(iti2.getSelectedCountryData().dialCode);
			$("#next_phone").val("+"+iti2.getSelectedCountryData().dialCode);
		});
		input3.addEventListener("countrychange", function() {
			console.log(iti2.getSelectedCountryData().dialCode);
			$("#emergency_phone").val("+"+iti2.getSelectedCountryData().dialCode);
		});
	


	var timer;
	$("#patient_languages").keydown(function(e){ 		
	  	clearTimeout(timer);
	  	var $this =$(this);
	  	timer = setTimeout(function (event) {
	        var input = $this.val();
	        var str = input.split(",");	        
	        if (e.keyCode === 13) {  
	        	$this.val('');	
	        	for(var i =0 ; i< str.length; i++){
		          	var count =0;
		          	if($.trim(str[i]) != ""){
		            	$("#top").find(".lang").each(function(){            
		              		if($.trim(str[i]) == $(this).text()){
		               			count =1;
		              		}
		            	});
		          		if(count == 0){         
		          			$("#top").append("<li><div class='lang'>"+ $.trim(str[i]) +"</div><span class='delete_lang'><img src='../admin/doctor/images/x_tag.svg'></span></li>");
		          		}
		          	}
		        }  		        
		    }else if(e.keyCode === 188){		    		    			    	
		        for(var i =0 ; i< str.length; i++){
		          	var count =0;
		          	if($.trim(str[i]) != ""){
		            	$("#top").find(".lang").each(function(){            
		              		if($.trim(str[i]) == $(this).text()){
		               			count =1;
		              		}
		            	});
		          		if(count == 0){         
		          			$("#top").append("<li><div class='lang'>"+ $.trim(str[i]) +"</div><span class='delete_lang'><img src='../admin/doctor/images/x_tag.svg'></span></li>");
		          		}
		          	}
		        } 
		    }      
	  	}, 500);
	  	if(e.keyCode == 13){
			return false;		
		}	  	
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

	$("#patient_languages").focusout(function(e){ 
		var input = $(this).val();
        var str = input.split(",");	        
        $(this).val('');	
    	for(var i =0 ; i< str.length; i++){
          	var count =0;
          	if($.trim(str[i]) != ""){
            	$("#top").find(".lang").each(function(){            
              		if($.trim(str[i]) == $(this).text()){
               			count =1;
              		}
            	});
          		if(count == 0){         
          			$("#top").append("<li><div class='lang'>"+ $.trim(str[i]) +"</div><span class='delete_lang'><img src='../admin/doctor/images/x_tag.svg'></span></li>");
          		}
          	}
        }
	});

	$('#patient_languages').keyup(function() {
		var caps = jQuery('#patient_languages').val();
		caps = caps.charAt(0).toUpperCase() + caps.slice(1);
		caps = capitalize_Words(caps);		
        jQuery('#patient_languages').val(caps);
	});

	$('#patient_origin_state').keyup(function() {
		var caps = jQuery('#patient_origin_state').val(); 
		caps = caps.charAt(0).toUpperCase() + caps.slice(1);
        jQuery('#patient_origin_state').val(caps);
	});

	$(document).on('click','.delete_lang',function(e) {          
	  	$(this).closest('li').remove();
	  	/*var val = "";
	    $("#top").find(".lang").each(function(){
	      	if(val == ""){
	       		val = $(this).text();
	       	}else{
	        	val = val+ ","+$(this).text();
	       }
	    });
	    $("#patient_languages").val(val);*/
	});

	/*    =============== ajax =====  ====== */

	$(".patient_phone").keydown(function(e) {
	 	 if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 173,189,109,219,221,57,48,61,187]) !== -1 ||((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67) && (e.ctrlKey === true || e.metaKey === true)) ||
	    (e.keyCode >= 35 && e.keyCode <= 40)) {
	    	return;
	  	}
	  	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	     	e.preventDefault();
	  	}
	});

	$("#patient_first_name").keyup(function(){
	  	var patient_first_name = document.getElementById('patient_first_name').value
	    patient_first_name = patient_first_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
	    	return letter.toUpperCase();
	    });
	    $("#patient_first_name").val(patient_first_name);
	});
	$("#patient_last_name").keyup(function(){
	    var patient_last_name = document.getElementById('patient_last_name').value
	    patient_last_name = patient_last_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
	     	return letter.toUpperCase();
	    });
	    $("#patient_last_name").val(patient_last_name);
	});
	$("form#profile").submit(function(event){
	  	event.preventDefault();
	  	var profile = document.forms.profile;
	  	var formProfileData = new FormData(profile);
	  	var file = $('input[type=file]')[0].files[0];
	  	if(file != "" && typeof file !== typeof undefined ){
	  		formProfileData.append('images', file); 
	  	}
	  	var languages = "";
	  	if($("#top").find(".lang").length > 0){
			$("#top").find(".lang").each(function(){
				var val = $(this).text();				
				if(languages == ""){
					languages = $.trim(val);
				}else{
					languages = languages+","+$.trim(val);
				}
			});
		}
		if(languages != "" && typeof languages !== typeof undefined ){
	  		formProfileData.append('languages', languages); 
	  	}
	  	var imge_name  =  $('input[type=file]').val();
	  	var image_type =  imge_name.substr( (imge_name.lastIndexOf('.') +1) );
	  	var profile_id = formProfileData.get('profile_id');
	  	var patient_first_name = formProfileData.get('patient_first_name');
	  	var patient_first_name =  patient_first_name.trim();
	  	var patient_last_name = formProfileData.get('patient_last_name');
	  	var patient_last_name =  patient_last_name.trim();
	  	var patient_phone = formProfileData.get('patient_phone');
	  	var patient_phone =  patient_phone.trim();
	  	var patient_martial_status = formProfileData.get('patient_martial_status');
	  	var patient_martial_status =  patient_martial_status.trim();
	  	var patient_address = formProfileData.get('patient_address');
	  	var patient_address =  patient_address.trim();	  		  	
	  	var patient_origin_state = formProfileData.get('patient_origin_state');
	  	var patient_origin_state =  patient_origin_state.trim();
	  	var patient_insurance = formProfileData.get('patient_insurance');
	  	var patient_insurance =  patient_insurance.trim();
		var emergency_phone = formProfileData.get('emergency_phone');
	  	var emergency_phone =  emergency_phone.trim();
	      
	  	if(patient_first_name==""){ 
	    	$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide first name </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	    	return false; 
	  	}

	  	if(patient_last_name==""){        
	    	$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide last name </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	    	return false;
	  	}

	  	if(patient_phone==""){   
	    	$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide mobile no </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	    	return false;
	  	}

	  	if(isNaN(patient_phone)){    
	    	$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide mobile no is numeric!</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	    	return false; 
	  	}
	  	if(patient_phone.length >15){    
	  		$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide limitation 10-15 mobile number</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
	  	}

	  	if(patient_phone.length < 10){    
	  		$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide 10 digite mobile number</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
		}
		if(emergency_phone==""){   
	    	$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide emergency mobile no </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	    	return false;
	  	}

	  	if(isNaN(emergency_phone)){    
	    	$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide emergency mobile no is numeric!</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	    	return false; 
	  	}
	  	if(emergency_phone.length >15){    
	  		$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide limitation 10-15 emergency mobile number</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
	  	}

	  	if(emergency_phone.length < 10){    
	  		$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide 10 digite emergency mobile number</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
	 	} 
	  	if(patient_address==""){
	  		$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide address </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
	 	}

	  	if(patient_origin_state==""){
	   		$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide state of origin </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
	  	}

	  	if(patient_martial_status==""){ 
	  		$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide marital status</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
	  	}	

	  	if(languages==""){
	  		$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please add minimum one language is required </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
	  	}

	  	if(patient_insurance==""){
	  		$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide insurance </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
	    }

	    var site_url = $('#site_url').text();
	    $.ajax({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		     url:  site_url+'/patient/profile',
		    type: "POST",             
		    data: formProfileData, 
		    enctype: 'multipart/form-data',
		    contentType: false,      
		    cache: false,             
		    processData:false, 
		    dataType: 'json',       
		    success: function(data){
		      	if(data.success =='1' ){
		       	 	$(".messages").html('<div class="alert alert-success-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-check"></span></div><div class="alert_text">'+data.message+'</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
		      	}else if(data.success == '0'){
		        	$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">'+data.message+'</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
		      	}
		    }
	    });
	    var profile_imgPath = $('#uploadPreview').attr('src');
	    $('.profile_image').css('background-image', 'url(' + profile_imgPath + ')');
	    var patient_first_name = $('#patient_first_name').val();
	    var patient_last_name = $('#patient_last_name').val();
	    var first_last = patient_first_name+' '+patient_last_name;
	    document.getElementById('username').innerHTML = first_last;
	});

	 /*    ===============end  ajax =====  ====== */   

	/*==================preview Image =============== */
	function readURL(input) {
	  	if (input.files && input.files[0]) {
	    	var reader = new FileReader();
	      		reader.onload = function(e) {
	        	$('#uploadPreview').attr('src', e.target.result);
	      	}
	     	reader.readAsDataURL(input.files[0]);
	  	}
	}

	$("#uploading").change(function() {
	    readURL(this);
	});
	  /*===================end preview Image ================*/

	$("#scroll").on("click", function() {
	  	$('html, body').animate({scrollTop: -0}, 500);
	    return true;
	});
	$('.nav-link').click(function(){
	  	$('#profile')[0].reset();
	});


	/* ================ Notification  start ============== */
	$("form#notifications_other").submit(function(event){
	  	event.preventDefault();
	  	var notification = document.forms.notifications_other;
	  	var formNotificationData = new FormData(notification);
	  	var site_url = $('#site_url').text();
	  	$.ajax({
	    	headers: {
	      		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    	},
	    	url:  site_url+'/patient/profile_notification', 
	    	type: "POST",             
	    	data: formNotificationData, 
	    	contentType: false,      
	    	cache: false,             
	    	processData:false, 
	    	dataType: 'json',       
	    	success: function(data){
	      		if(data.success =='1' ){
	        		$(".messages1").html('<div class="alert alert-success-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-check"></span></div><div class="alert_text">'+data.message+'</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	      		}else if(data.success =='0'){ 
	        		$(".messages1").html('<div class="alert alert-success-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-check"></span></div><div class="alert_text">'+data.message+'</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	      		}
	    	}
	  	});
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
	/* ================ Notification End ============== */
	/* ================ Accont reset password start ============== */

	$("form#accountSetting").submit(function(event){
	  	event.preventDefault();
	  	var account = document.forms.accountSetting;
	  	var formAccountData = new FormData(account);

	  	var accountEmail = formAccountData.get('account_email');
	  	var accountEmail =  accountEmail.trim();
	  	var accountPassword = formAccountData.get('account_password');
	  	var accountPassword =  accountPassword.trim();
	  	var newPassword = formAccountData.get('account_new_password');
	  	var newPassword =  newPassword.trim();
	  	var confirmPassword = formAccountData.get('account_conf_password');
	  	var confirmPassword =  confirmPassword.trim();
	  	if(accountEmail==""){
	  		$(".messages_account").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide email address </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false; 
	  	}
	  	if(accountPassword==""){
	  	$(".messages_account").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide current password </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false;
	  	}

	  	if(newPassword==""){
	  	$(".messages_account").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide new password </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false;
	  	}
	  	if(confirmPassword==""){
	  	$(".messages_account").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide confirm password </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false;
	  	}

	  	if(newPassword != confirmPassword){
	  	$(".messages_account").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please provide confirm same as new passsword </div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	  		return false;
	  	}
	  	var site_url = $('#site_url').text();
	  	$.ajax({
	    	headers: {
	      		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    	},
	    	url:  site_url+'/patient/account_setting', 
	    	type: "POST",             
	    	data: formAccountData, 
	    	contentType: false,      
	    	cache: false,             
	    	processData:false, 
	    	dataType: 'json',       
	    	success: function(data){
	      		if(data.success =='1' ){
	      			alert(data['message']);
	      			window.location.href = site_url+'/patient/logout';
	        		//$(".messages_account").html('<div class="alert alert-success-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-check"></span></div><div class="alert_text">'+data.message+'</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
	      		}else if(data.success =='0'){ 
	        		$(".messages_account").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">'+data.message+'</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
		      	}
	    	}
	  	});

	});
	/* ================ Accont reset password End ============== */
});

function notificationDetail(data){
	var id = $(data).attr("data-id");
	var type = $(data).attr("data-type");
	var site_url = $('#site_url').text();
	if(type == "appt"){
		window.location.href = site_url+'/patient/appointment_detail/'+id;
	}else if(type == "health_history"){
		window.location.href = site_url+'/patient/history_detail/'+id;
	}else if(type == "bill"){
		window.location.href = site_url+'/patient/paybill/'+id;
	}
}


function capitalize_Words(str)
{
 return str.replace(/,\s*([a-z])/g, function(d,e) { return ", "+e.toUpperCase() });
}
function blockPopupFn() {
	swal({
		text: "This feature is not available to you yet",
	}); 
	return;
}
