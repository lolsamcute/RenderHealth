$(document).ready(function(){

	$('#page_url_change').click(function(){
			window.location.href = "search_patient";
		});
	
		$('.admin_email').keypress(function(e){
			if(e.which === 32){
				return false;
			}
		});
	
		var $error_msg = $("#error_msg");
		$error_msg.on("close.bs.alert", function () {
			$error_msg.hide();
			return false;
		});
		//alert(sessionStorage.getItem("is_reloaded"));
	
		if (sessionStorage.getItem("is_reloaded") == 1){ 
				$('#history_nav a[href="#billing_info"]').trigger('click');		
				 if($("#history_nav").find(".active").attr("data-id") == "billing_detail"){
					}
			};
				 sessionStorage.setItem("is_reloaded", 0);
				
	});
	
	var $error_modal_msg = $(".alert-dismissible");
	$error_modal_msg.on("close.bs.alert", function () {
	$error_modal_msg.hide();
	return false;
	});
	
	
	
		$(function() { 
		$("#datepicker-1").datepicker({
		format: 'dd/mm/yyyy'});
		});
		// Don't allow text
		$(".temperature, .pulse_rate, .resp_rate, .bp_syt, .bp_dia, .rbc, .wbc, .hb_rate, .hb_per, .plt, .chl_mil, .chl_ldl,.height,.weight").keydown(function(e) {
			//alert(e.keyCode);
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110,189,109,57,48,187,190]) !== -1 ||
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
	
	//admin login
	function adminLogin(data){
		
		$(".login_admin").addClass("m-loader");			
		var site_url = $('#site_url').text();
		var url = site_url+"/admin/login";
		var admin_email = $.trim($( ".admin_email" ).val());
		if(admin_email == "") {	
			$(".login_admin").removeClass("m-loader");		
			$(".error_text").text('');
			$( ".error_text" ).text( "Please enter email." );
			$(".error_msg").css("display","block");
			return false;
		}
		else if( !isValidEmailAddress(admin_email) ) {
			$(".login_admin").removeClass("m-loader");	
			$(".error_text").text('');
			$( ".error_text" ).text( "Please enter proper format email." );
			$(".error_msg").css("display","block");
			return false;
		}
	
		var admin_password = $.trim($( ".admin_password" ).val());
		if(admin_password == "") {		
			$(".login_admin").removeClass("m-loader");	
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
			data: {"email":admin_email,"password":admin_password,"remember":remember},		
			dataType: 'json',
			success: function (response) {
				$(".login_admin").removeClass("m-loader");	
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
			 url: site_url+"/admin/update_timezone/"+offset+"/"+isDST,
			 type:'GET',
			  data:{},
			 success:function(result){	
				 console.log("hiiiioi");
				
				parent.location =result['redirect_url'];	
			}
		});	
	}
	
	//check valid email
	function isValidEmailAddress(emailAddress) {
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(emailAddress);
	};
	
	
	//start of pagination for listing of hospitals
	$(document).on('click',".next_labs",function(){
	
		var url1 =$(this).attr("data-url");
		$(this).attr("href","javascript:void(0);");
		var $this = $(this);
		var  pen_page ="";
		var  all_page ="";
	
		if(url1.indexOf("pen_page") > -1) 
		{
			all_page = $(".all_page_hidden").val();
			//all_page = 1;
	
			var data = {"all_page": all_page};
		}
		else if(url1.indexOf("all_page") > -1) 
		{
			pen_page = $(".pen_page_hidden").val();
	
			var data = {"pen_page": pen_page};
		}
			 //~ alert(url1);
			$.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result)
				{
					if(result['redirect'] == 1)
					{
						parent.location =result['redirect_url'];
						return false;
					}
	
					$(".main_div").html(result);
				}
			});
			 
		});
	
	
		
	$(document).on('click',".pre_labs",function(){
		
		var url1 =$(this).attr("data-url");
		$(this).attr("href","javascript:void(0);");
		var $this = $(this);
		var  pen_page ="";
		var  all_page ="";
		 
		 
		if(url1.indexOf("pen_page") > -1) {
			 all_page = $(".all_page_hidden").val();
			 //all_page = 1;
			 
			 var data = {"all_page": all_page};
		}else if(url1.indexOf("all_page") > -1) {
			 pen_page = $(".pen_page_hidden").val();
			 
			 var data = {"pen_page": pen_page};
		}
		 //~ alert(url1);
		 $.ajax({
			url:url1,
			type:'GET',
			data:data,
			success:function(result){
				if(result['redirect'] == 1){
					 parent.location =result['redirect_url'];
					return false;
				 }
				$(".main_div").html(result);
			}
		});
		 
	});
	
	//end of pagination for listing of hospitals
	
	
		//accept hospital request
		function accept_hosp(rowid,hospital_id)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
	
			var site_url = $('#site_url').text();
			if(rowid!='' && hospital_id!='')
			{
	
				 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});
				$.ajax({
				url: site_url+"/admin/accept_hospital",
				type:'POST',
				data:{"rowid":rowid,"hospital_id":hospital_id},
				success:function(response){
							if(response['redirect'] == 1){
								 parent.location =result['redirect_url'];
								return false;
							 }
							else if(response['success'] == 1){
								 
								 setTimeout(function() {
									location.reload();
								}, 1500);
	
								$('.alert-success-outline').show();
								$('.pending_success').text(response['message']);
							 }
							 else
							 {
								 $('.alert-danger-outline').show();
								 $('.pending_danger').text(response['message']);
							 }
	
						}
				});
			}
			else
			{
				alert('Parameters missing');
			}
			 
		}
	
		//ignore hospital request
		function ignore_hosp(rowid,hospital_id)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
			
			var r = confirm("Are you sure to ignore this request?");
			if (r == true) {
	
				var site_url = $('#site_url').text();
				if(rowid!='' && hospital_id!='')
				{
					 $.ajaxSetup({
					  headers: {
						  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
					});
					$.ajax({
					url: site_url+"/admin/ignore_hospital",
					type:'POST',
					data:{"rowid":rowid,"hospital_id":hospital_id},
					success:function(response){
							if(response['redirect'] == 1){
								 parent.location =result['redirect_url'];
								return false;
							 }
							else if(response['success'] == 1){
								 
								 setTimeout(function() {
									location.reload();
								}, 1500);
	
								$('.alert-success-outline').show();
								$('.pending_success').text(response['message']);
							 }
							 else
							 {
								 $('.alert-danger-outline').show();
								 $('.pending_danger').text(response['message']);
							 }
	
						}
					});
				}
				else
				{
					alert('Parameters missing');
				}
			   
			} 
			
			
		}		
	
		//add hospital/lab
		$('#add_hospital_form').submit(function(e){
			
			e.preventDefault();
	
			$('.alert-success-outline-addhos').hide();
			$('.alert-danger-outline-addhos').hide();
			$('.addhos_success_pop').text('');
			$('.addhos_danger_pop').text('');
			var mode = $.trim($('#mode').val()); 
			var name_of_facility  = $.trim($('#name_of_facility').val());
			var hosp_email  = $.trim($('#hosp_email').val());
			var patient_phone  = $.trim($('#patient_phone').val());
			var hosp_address  = $.trim($('#hosp_address').val());
			var hospital_state_nigeria  = $.trim($('#hospital_state_nigeria').val());
			var lga  = $.trim($('#lga').val());
			var type_of_facility  = $.trim($('#type_of_facility').val());
			if(name_of_facility=='')
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Please provide Name Of Facility.');
				 return false;
			}
			if(hosp_email=='')
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Please provide Email Address.');
	
				 return false;
			}
			if( !isValidEmailAddress(hosp_email) ) {
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Please provide Valid Email Address.');
	
				 return false;
			}
			if(patient_phone=='')
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Please provide Hospital Phone Number.');
	
				 return false;
			}
			if(patient_phone.length>15)
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Hospital Phone Number maxlength is 15 digits.');
	
				 return false;
			}
			if(patient_phone.length<10)
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Hospital Phone Number cannot be less than 10 digits.');
	
				 return false;
			}
			if(!$.isNumeric(patient_phone))
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Please provide Numeric Phone Number.');
	
				 return false;
			}
			if(hosp_address=='')
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Please provide Address.');
				 return false;
			}
			if(hospital_state_nigeria=='' || hospital_state_nigeria=='0')
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Please Select State.');
				 return false;
			}
			if(lga=='' || lga=='0')
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Please Select LGA.');
				 return false;
			}
			if(type_of_facility=='' || type_of_facility=='0')
			{
				$('.alert-danger-outline-addhos').show();
				 $('.addhos_danger_pop').text('Please Select Type Of Facility.');
				 return false;
			}
			var site_url = $('#site_url').text();
			var URL = site_url+"/admin/add_hospital";
			if(mode == 'EDIT'){
				URL = site_url+"/admin/edit_hospital";
			}
			var formData = $("#add_hospital_form").serialize();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: URL,
			type:'POST',
			data:formData,
			beforeSend: function() {
				$('.loading').addClass('loading-block');
			},
			success:function(response){
					if(response['redirect'] == 1){
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						$('.alert-success-outline-addhos').show();
						$('.addhos_success_pop').text(response['message']);
						$('#add_hospital_lab').modal('hide');
						setTimeout(function() {
						location.reload();
						}, 500);
					 }
					 else
					 {
						 $('.alert-danger-outline-addhos').show();
						 $('.addhos_danger_pop').text(response['message']);
					 }
	
				}
			});
			
			
			
		});
	
		//get value of selected country and get list of states
		$('#hospital_country').on('change', function() {
	
			var site_url = $('#site_url').text();
			var element = $(this).find('option:selected'); 
			var countryId = element.attr("data-id"); 
			var countryName = element.attr("value"); 
			if(countryId!=0)
			{
				$.ajaxSetup({
					  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				});
	
				$.ajax({
				url: site_url+"/admin/get_states",
				type:'POST',
				data:{countryId:countryId},
				success:function(response){
	
						if(response['success'] == 1)
						{
							$('#hospital_state').html(response['data']);
	
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
	
		//get value of selected facility and get list of speciality
		$('#type_of_facility').on('change', function() {
	
			var site_url = $('#site_url').text();
			var element = $(this).find('option:selected'); 
			var facilityId = element.attr("data-id"); 
			var stateName = element.attr("value"); 
			if(facilityId!=0)
			{
				$.ajaxSetup({
					  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				});
	
				$.ajax({
				url: site_url+"/admin/get_speciality_by_facility",
				type:'POST',
				data:{facilityId:facilityId},
				success:function(response){
	
						if(response['success'] == 1)
						{
							$('#hosp_speciality').html(response['dataspeciality']);
							
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
	
		$(".hours .width2201 select").prop('disabled', true);
		//Disabled all hours
		$('#allhours').on('change', function(e,i) {
			$(".row.hours").each(function(e,i){
				$(".hours .width2201 select").prop('disabled', true);
				$('.hours .width2201 select').prop('selectedIndex',0);
			});
		});
		//Disabled all hours
		$('.daycheckbox').on('change', function(e,i) {
			var day = $(this).attr('id');
			$(".row.hours").each(function(){
				$(".hours .width2201 select."+day).prop('disabled', false);
			});
			$('#allhours + a').removeClass('checked');
			// $('#allhours')[0].checked = false;
			//  $("#allhours").checked=false;
		});
	
		//Patient Language
		$(document).ready(function(){
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
		
			$(document).on('click','.delete_lang',function(e) {          
				$(this).closest('li').remove();
			  });
		});
	
		//Dynamic Textbox
		$('.multi-field-wrapper').each(function() {
		var $wrapper = $('.multi-fields', this);
		var i = 2;
		$(".add-field", $(this)).click(function(e) {
			if($('.multi-field').length<6){
				$('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('');
			}else{
				Swal.fire('You can not add more then 6 dependent.');
				return false;
			}
			i++;
		});
		$('.multi-field .remove-field', $wrapper).click(function() {
			if ($('.multi-field', $wrapper).length > 1){
				$(this).parent('.multi-field').remove();
			}
		});
	});
	
	
		//Disabled certified doctor
		$('.doctor_speciality select#doctor_speciality').prop('disabled', true);
		$('input[name="specialistmenu"]').on('change', function(e,i) {
			$('.doctor_speciality select#doctor_speciality').prop('selectedIndex',0);
			if($(this).attr('value')==1) {
				$('.doctor_speciality select#doctor_speciality').prop('disabled', false);
			}else{	
				$('.doctor_speciality select#doctor_speciality').prop('disabled', true);
			}
		});
	
		//Disabled specialist
		$('input[name="access_for_hospital"]').on('change', function(e,i) {
			if($(this).attr('value')==1) {
				$('.certified_doctormenu input#mdcn_register_no').prop('disabled', false);
				$('.certified_doctormenu input#folio_number').prop('disabled', false);
			}else{	
				$('.certified_doctormenu input#mdcn_register_no').prop('disabled', true);
				$('.certified_doctormenu input#folio_number').prop('disabled', true);
				
			}
		});
		
	
			//get value of selected country and get list of states
		$('.nurse_country').on('change', function() {
	
			var site_url = $('#site_url').text();
			var element = $(this).find('option:selected'); 
			var countryId = element.attr("data-id"); 
			var countryName = element.attr("value"); 
			if(countryId!=0)
			{
				$.ajaxSetup({
					  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				});
	
				$.ajax({
				url: site_url+"/admin/get_states",
				type:'POST',
				data:{countryId:countryId},
				success:function(response){
	
						if(response['success'] == 1)
						{
							$('.nurse_state').html(response['data']);
	
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
	
		//active and suspend doctor
		 
		function activate_deactivate_doctor(doctor_id)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
	
			var site_url = $('#site_url').text();
			if(doctor_id!='')
			{
				 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});
				 
				$.ajax({
				url: site_url+"/admin/change_doctor_status",
				type:'POST',
				data:{"doctor_id":doctor_id},
				success:function(response){
						if(response['redirect'] == 1){
							 parent.location =result['redirect_url'];
							return false;
						 }
						else if(response['success'] == 1){
							 
							 var sts = response['update_sts'];
	
							 if(sts==0)
							 {
								 
								 $('#status_row_'+doctor_id).removeClass('badge-danger');
								 $('#status_row_'+doctor_id).removeClass('badge-success');
								 $('#status_row_'+doctor_id).addClass('badge-danger');
								 
								 $('#status_row_'+doctor_id).text('Suspend');
	
								 
								 $('#status_row_'+doctor_id).text('Suspend');
	
								 $('#switch-sm3'+doctor_id).prop('checked', true); 
								 
							 }
							 else if(sts==1)
							 {
								 $('#status_row_'+doctor_id).removeClass('badge-danger');
								 $('#status_row_'+doctor_id).removeClass('badge-success');
								 $('#status_row_'+doctor_id).addClass('badge-success');
								 $('#status_row_'+doctor_id).text('Active User');
	
								 $('#switch-sm3'+doctor_id).prop('checked', false);
							 }
							 
							
						 }
						 else
						 {
							 $('.alert-danger-outline').show();
							 $('.pending_danger').text(response['message']);
							 
						 }
	
					}
				});
			}
			else
			{
				$('.alert-danger-outline').show();
				$('.pending_danger').text('Parameters missing');
			}
			   
			
			
			
		}
	
		//remove doctor     
		function remove_doctor(doctor_id)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
	
			var r = confirm("Are you sure to remove doctor?");
			if (r == true) {
	
				var site_url = $('#site_url').text();
				if(doctor_id!='')
				{
					 $.ajaxSetup({
					  headers: {
						  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
					});
					 
					$.ajax({
					url: site_url+"/admin/remove_doctor",
					type:'POST',
					data:{"doctor_id":doctor_id},
					success:function(response){
							if(response['redirect'] == 1){
									 parent.location =result['redirect_url'];
									return false;
								 }
								else if(response['success'] == 1){
	
									 $('.alert-success-outline').show();
									 $('.pending_success').text('Parameters missing');
	
									 setTimeout(function() {
										location.reload();
									}, 1500);
	
									
								 }
								 else
								 {
									 $('.alert-danger-outline').show();
									 $('.pending_danger').text(response['message']);
								 }
	
						}
					});
				}
				else
				{
					$('.alert-danger-outline').show();
					 $('.pending_danger').text('Parameters missing');
				
				}
			}
			
		}
	
		//update doctor access details
		function update_doctor_details(obj,event)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
	
			event.preventDefault();
			formId = obj.id;
			var formData = $('#'+formId).serialize();
			var site_url = $('#site_url').text();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: site_url+"/admin/update_doctor_details",
			type:'POST',
			data:formData,
			success:function(response){
					if(response['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						$('.alert-success-outline').show();
						 $('.pending_success').text(response['message']);
	
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline').show();
						 $('.pending_danger').text(response['message']);
					 }
	
				}
			});
		}
	
	
		//update Nurse access details
		function update_nurse_details(obj,event)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
	
			event.preventDefault();
			formId = obj.id;
			var formData = $('#'+formId).serialize();
			var site_url = $('#site_url').text();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: site_url+"/admin/update_nurse_details",
			type:'POST',
			data:formData,
			success:function(response){
					if(response['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						$('.alert-success-outline').show();
						 $('.pending_success').text(response['message']);
	
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline').show();
						 $('.pending_danger').text(response['message']);
					 }
	
				}
			});
		}
	
		//remove doctor     
		function remove_nurse(nurse_id)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
	
			var r = confirm("Are you sure to remove Nurse?");
			if (r == true) {
	
				var site_url = $('#site_url').text();
				if(nurse_id!='')
				{
					 $.ajaxSetup({
					  headers: {
						  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
					});
					 
					$.ajax({
					url: site_url+"/admin/remove_nurse",
					type:'POST',
					data:{"nurse_id":nurse_id},
					success:function(response){
							if(response['redirect'] == 1){
									 parent.location =result['redirect_url'];
									return false;
								 }
								else if(response['success'] == 1){
	
									 $('.alert-success-outline').show();
									 $('.pending_success').text('Parameters missing');
	
									 setTimeout(function() {
										location.reload();
									}, 1500);
	
									
								 }
								 else
								 {
									 $('.alert-danger-outline').show();
									 $('.pending_danger').text(response['message']);
								 }
	
						}
					});
				}
				else
				{
					$('.alert-danger-outline').show();
					 $('.pending_danger').text('Parameters missing');
				
				}
			}
			
		}
	
		//update Administrator access details
		function update_admin_details(obj,event)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
	
			event.preventDefault();
			formId = obj.id;
			var formData = $('#'+formId).serialize();
			var site_url = $('#site_url').text();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: site_url+"/admin/update_admin_details",
			type:'POST',
			data:formData,
			success:function(response){
					if(response['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						$('.alert-success-outline').show();
						 $('.pending_success').text(response['message']);
	
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline').show();
						 $('.pending_danger').text(response['message']);
					 }
	
				}
			});
		}
	
		//remove Administrator     
		function remove_administrator(admin_id)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
	
			var r = confirm("Are you sure to remove Administrator?");
			if (r == true) {
	
				var site_url = $('#site_url').text();
				if(nurse_id!='')
				{
					 $.ajaxSetup({
					  headers: {
						  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
					});
					 
					$.ajax({
					url: site_url+"/admin/remove_admin",
					type:'POST',
					data:{"admin_id":admin_id},
					success:function(response){
							if(response['redirect'] == 1){
									 parent.location =result['redirect_url'];
									return false;
								 }
								else if(response['success'] == 1){
	
									 $('.alert-success-outline').show();
									 $('.pending_success').text('Parameters missing');
	
									 setTimeout(function() {
										location.reload();
									}, 1500);
	
									
								 }
								 else
								 {
									 $('.alert-danger-outline').show();
									 $('.pending_danger').text(response['message']);
								 }
	
						}
					});
				}
				else
				{
					$('.alert-danger-outline').show();
					 $('.pending_danger').text('Parameters missing');
				
				}
			}
			
		}
	
		//pagination for doctors,nurses,admins for hospital detail screen
		$(document).on('click',".next_docs",function(){
	
			 var url1 =$(this).attr("data-url");
			 $(this).attr("href","javascript:void(0);");
			 var $this = $(this);
			 var  doc_page ="";
			 var  nurse_page ="";
			 var  ad_page ="";
			 
			 if(url1.indexOf("doc_page") > -1) {
				 
				 /*nurse_page = $(".nurse_page_hidden").val();
				 ad_page = $(".ad_page_hidden").val();*/
				 nurse_page = 1;
				 ad_page = 1;
				 //all_page = 1;
				 
				 var data = {"nurse_page": nurse_page,"ad_page":ad_page};
			 }else if(url1.indexOf("nurse_page") > -1) {
				 /*doc_page = $(".doc_page_hidden").val();
				 ad_page = $(".ad_page_hidden").val();*/
	
				 doc_page =1;
				 ad_page = 1;
				 
				 var data = {"doc_page": doc_page,"ad_page":ad_page};
			 }
			 else if(url1.indexOf("ad_page") > -1) {
				 /*doc_page = $(".doc_page_hidden").val();
				 nurse_page = $(".nurse_page_hidden").val();*/
	
				 doc_page =1;
				 nurse_page = 1;
				 
				 var data = {"doc_page": doc_page,"nurse_page":nurse_page};
			 }
	
			 //~ alert(url1);
			 $.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result){
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
					$(".main_div").html(result);
					if($('input.form-check-custom').length > 0)
					{
						var inputList = $('input.form-check-custom');
						for (var i = inputList.length - 1; i >= 0; i--) {
							$(inputList[i]).prettyCheckable();
						}
					}
				}
			});
			 
		});
		
		$(document).on('click',".pre_docs",function(){
		
		  var url1 =$(this).attr("data-url");
			 $(this).attr("href","javascript:void(0);");
			 var $this = $(this);
			 var  doc_page ="";
			 var  nurse_page ="";
			 var  ad_page ="";
			 
			 if(url1.indexOf("doc_page") > -1) {
				 
				 /*nurse_page = $(".nurse_page_hidden").val();
				 ad_page = $(".ad_page_hidden").val();*/
				 nurse_page = 1;
				 ad_page = 1;
				 //all_page = 1;
				 
				 var data = {"nurse_page": nurse_page,"ad_page":ad_page};
			 }else if(url1.indexOf("nurse_page") > -1) {
				 /*doc_page = $(".doc_page_hidden").val();
				 ad_page = $(".ad_page_hidden").val();*/
	
				 doc_page =1;
				 ad_page = 1;
				 
				 var data = {"doc_page": doc_page,"ad_page":ad_page};
			 }
			 else if(url1.indexOf("ad_page") > -1) {
				 /*doc_page = $(".doc_page_hidden").val();
				 nurse_page = $(".nurse_page_hidden").val();*/
	
				 doc_page =1;
				 nurse_page = 1;
				 
				 var data = {"doc_page": doc_page,"nurse_page":nurse_page};
			 }
		 //~ alert(url1);
		 $.ajax({
			url:url1,
			type:'GET',
			data:data,
			success:function(result){
				if(result['redirect'] == 1){
					 parent.location =result['redirect_url'];
					return false;
				 }
	
				$(".main_div").html(result);
	
				if ($('input.form-check-custom').length > 0)
				{
					var inputList = $('input.form-check-custom');
					for (var i = inputList.length - 1; i >= 0; i--) {
						$(inputList[i]).prettyCheckable();
					}
				}
			}
		});
		 
		});
	
		//end of pagination for doctors,nurses,admins for hospital detail screen
	
	
		//start of pagination for members/patients
		$(document).on('click',".pre_mem",function(){
	
			 var url1 =$(this).attr("data-url");
			 $(this).attr("href","javascript:void(0);");
			 var $this = $(this);
			 var  mem_page ="";
			 
			 
			 if(url1.indexOf("mem_page") > -1) {
				 search_page = 1;
				 var data = {"search_page": search_page};
			 }
	
			 //~ alert(url1);
			 $.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result){
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
					 
					 
	
					$(".main_div").html(result);
				}
			});
			 
		});
		
		$(document).on('click',".next_mem",function(){
		
				var url1 =$(this).attr("data-url");
				$(this).attr("href","javascript:void(0);");
				var $this = $(this);
				var  mem_page ="";
	
	
				if(url1.indexOf("mem_page") > -1) {
				search_page = 1;
				var data = {"search_page": search_page};
				}
	
			 //~ alert(url1);
			 $.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result){
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
	
					$(".main_div").html(result);
				}
			});
		 
		});
		//end of pagination for members/patients
	
	
		//search members/patients
		$('#search_patient_form').submit(function(e){
			
			e.preventDefault();
	
	
			var patient_name = $.trim($('#patient_name').val());
			var patient_surname = $.trim($('#patient_surname').val());
			var patient_dob = $.trim($('#patient_dob').val());
			var patient_recno = $.trim($('#patient_recno').val());
	
			$('#patient_name_hidden').val(patient_name);
			$('#patient_surname_hidden').val(patient_surname);
			$('#patient_dob_hidden').val(patient_dob);
			$('#patient_recno_hidden').val(patient_recno);
	
			if(patient_recno==""){
			if(patient_name=="" || patient_surname=="" ||patient_dob==""  ){
			//if(patient_name=="" || medical_record=="" || surename=="" || dob==""){
				$(".modal-body").prepend('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please Fill First Name,Surname,Date of Birth</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');		
					return false;
			}
		}
	
			//	var formData = $("#search_patient_form").serialize();
			var site_url = $('#site_url').text();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: site_url+"/admin/search_patient_by_admin",
			type:'GET',
			data:{patient_name:patient_name,patient_surname:patient_surname,
				patient_dob:patient_dob,patient_recno:patient_recno},
			success:function(result){
					
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
	
					 $('#search_patient_modal').trigger('click');
	
					$(".main_div").html(result);
				}
			});
			
		});
	
		//start of pagination for search members/patients
		$(document).on('click',".pre_search_mem",function(){
	
			var patient_name = $('#patient_name_hidden').val();
			var patient_surname = $('#patient_surname_hidden').val();
			var patient_dob = $('#patient_dob_hidden').val();
			var patient_recno = $('#patient_recno_hidden').val();
	
			var url1 =$(this).attr("data-url");
			$(this).attr("href","javascript:void(0);");
			var $this = $(this);
			var  mem_page ="";
			 
			 
			if(url1.indexOf("mem_page") > -1) 
			{
				search_page = 1;
				var data = {search_page: search_page,patient_name:patient_name,patient_surname:patient_surname,
				patient_dob:patient_dob,patient_recno:patient_recno};
			}
			else
			{
				var data = {patient_name:patient_name,patient_surname:patient_surname,
				patient_dob:patient_dob,patient_recno:patient_recno,search_page: search_page};
			}
	
			$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			//~ alert(url1);
			$.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result){
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
					 
					$(".main_div").html(result);
				}
			});
			 
		});
		
		$(document).on('click',".next_search_mem",function(){
	
			var patient_name = $('#patient_name_hidden').val();
			var patient_surname = $('#patient_surname_hidden').val();
			var patient_dob = $('#patient_dob_hidden').val();
			var patient_recno = $('#patient_recno_hidden').val();
	
		
			var url1 =$(this).attr("data-url");
			$(this).attr("href","javascript:void(0);");
			var $this = $(this);
			var  mem_page ="";
	
	
			if(url1.indexOf("mem_page") > -1) 
			{
				search_page = 1;
				var data = {search_page: search_page,patient_name:patient_name,patient_surname:patient_surname,
				patient_dob:patient_dob,patient_recno:patient_recno};
			}
			else
			{
				var data = {patient_name:patient_name,patient_surname:patient_surname,
				patient_dob:patient_dob,patient_recno:patient_recno,search_page: search_page};
			}
	
			$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
			 //~ alert(url1);
			 $.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result){
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
	
					$(".main_div").html(result);
				}
			});
		 
		});
		//end of pagination for members/patients
	
		//start of pagination for members/patients
		$(document).on('click',".pre_emp",function(){
	
			 var url1 =$(this).attr("data-url");
			 $(this).attr("href","javascript:void(0);");
			 var $this = $(this);
			 var  emp_page ="";
			 
			 
			 if(url1.indexOf("emp_page") > -1) {
				 search_page = 1;
				 var data = {"search_page": search_page};
			 }
	
			 //~ alert(url1);
			 $.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result){
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
					 
					$(".main_div").html(result);
					if ($('#hostpital_appointment input.form-check-custom').length > 0)
					{
						var inputList = $('#hostpital_appointment input.form-check-custom');
						for (var i = inputList.length - 1; i >= 0; i--) {
							$(inputList[i]).prettyCheckable();
						}
					}
				}
			});
			 
		});
		
		$(document).on('click',".next_emp",function(){
		
				var url1 =$(this).attr("data-url");
				$(this).attr("href","javascript:void(0);");
				var $this = $(this);
				var  emp_page ="";
	
				if(url1.indexOf("emp_page") > -1) {
				search_page = 1;
				var data = {"search_page": search_page};
				}
	
			  
			 $.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result){
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
	
					$(".main_div").html(result);
					if ($('#hostpital_appointment input.form-check-custom').length > 0)
					{
						var inputList = $('#hostpital_appointment input.form-check-custom');
						for (var i = inputList.length - 1; i >= 0; i--) {
							$(inputList[i]).prettyCheckable();
						}
					}
				}
			});
		 
		});
		//end of pagination for members/patients
	
		
	
		//update employee access details
		function update_emp_details(obj,event)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
	
			event.preventDefault();
			formId = obj.id;
			var formData = $('#'+formId).serialize();
			var site_url = $('#site_url').text();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: site_url+"/admin/update_emp_details",
			type:'POST',
			data:formData,
			success:function(response){
					if(response['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						$('.alert-success-outline').show();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						 $('.pending_success').text(response['message']);
	
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline').show();
						 $('.pending_danger').text(response['message']);
					 }
	
				}
			});
		}
	
		//remove employee
		 
		function remove_emp(emp_id)
		{
			$('.alert-danger-outline').hide();
			$('.alert-success-outline').hide();
			$('.pending_success').text('');
			$('.pending_danger').text('');
			var r = confirm("Are you sure to remove employee?");
			if (r == true) 
			{
				var site_url = $('#site_url').text();
				if(emp_id!='')
				{
					$.ajaxSetup({
						  headers: {
						  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						  }
					});
					 
					$.ajax({
						url: site_url+"/admin/remove_employee",
						type:'POST',
						data:{"emp_id":emp_id},
						success:function(response)
						{
							if(response['redirect'] == 1)
							{
								 parent.location =result['redirect_url'];
								return false;
							 }
							else if(response['success'] == 1)
							{
								 $('.alert-success-outline').show();
								$('.pending_success').text(response['message']);
	
								 setTimeout(function() {
									location.reload();
								}, 1500);
	
									
							 }
							 else
							 {
								 $('.alert-danger-outline').show();
								 $('.pending_danger').text(response['message']);
							 }
	
						}
					});
				}
				else
				{
					$('.alert-danger-outline').show();
					$('.pending_danger').text('Parameters missing');
					
				}
			}
			
		}
	
		//search employee
		$('#search_emp_form').submit(function(e){		
			e.preventDefault();
			var name_or_id = $.trim($('#name_or_id').val());
			$('#name_or_id_hidden').val(name_or_id);		
			var site_url = $('#site_url').text();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: site_url+"/admin/search_emp_by_admin",
			type:'POST',
			data:{name_or_id:name_or_id},
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
	
		//start of pagination for search employee
		$(document).on('click',".pre_search_emp",function(){
	
			var name_or_id = $('#name_or_id_hidden').val();
			
	
			var url1 =$(this).attr("data-url");
			$(this).attr("href","javascript:void(0);");
			var $this = $(this);
			var  emp_page ="";
			 
			 
			if(url1.indexOf("emp_page") > -1) 
			{
				search_page = 1;
				var data = {search_page: search_page,name_or_id:name_or_id};
			}
			else
			{
				var data = {search_page: search_page,name_or_id:name_or_id};
			}
	
			$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			//~ alert(url1);
			$.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result){
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
					 
					$(".main_div").html(result);
	
					if ($('input.form-check-custom').length > 0)
					{
						var inputList = $('input.form-check-custom');
						for (var i = inputList.length - 1; i >= 0; i--) {
							$(inputList[i]).prettyCheckable();
						}
					}
				}
			});
			 
		});
		
		$(document).on('click',".next_search_emp",function(){
	
			var name_or_id = $('#name_or_id_hidden').val();
			
	
			var url1 =$(this).attr("data-url");
			$(this).attr("href","javascript:void(0);");
			var $this = $(this);
			var  emp_page ="";
			 
			 
			if(url1.indexOf("emp_page") > -1) 
			{
				search_page = 1;
				var data = {search_page: search_page,name_or_id:name_or_id};
			}
			else
			{
				var data = {search_page: search_page,name_or_id:name_or_id};
			}
	
			$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
			 //~ alert(url1);
			 $.ajax({
				url:url1,
				type:'GET',
				data:data,
				success:function(result){
					if(result['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
	
					$(".main_div").html(result);
	
					if ($('input.form-check-custom').length > 0)
					{
						var inputList = $('input.form-check-custom');
						for (var i = inputList.length - 1; i >= 0; i--) {
							$(inputList[i]).prettyCheckable();
						}
					}
				}
			});
		 
		});
		//end of search pagination for employee
		$("div[id^='myModal']").each(function(){
	  
			var currentModal = $(this);
			
			//click next
			currentModal.find('.btn-next').click(function(){
			  currentModal.modal('hide');
			  currentModal.closest("div[id^='myModal']").nextAll("div[id^='myModal']").first().modal('show'); 
			});
			
			//click prev
			currentModal.find('.btn-prev').click(function(){
			  currentModal.modal('hide');
			  currentModal.closest("div[id^='myModal']").prevAll("div[id^='myModal']").first().modal('show'); 
			});
		  
		  });
		  
		//add new employee
		$('#add_emp_form').submit(function(e){
			
			e.preventDefault();
	
			$('.alert-success-outline-addemp').hide();
			$('.alert-danger-outline-addemp').hide();
			$('.addhos_success_emp').text('');
			$('.addhos_danger_emp').text('');
			var allowedExtensions = ['jpg','jpeg','png'];
			var mode = $.trim($('#mode').val()); 
			var first_name  = $.trim($('#first_name').val());
			// var middle_name  = $.trim($('#middle_name').val());
			var surname  = $.trim($('#surname').val());
			var emp_ph  = $.trim($('#employee_phone').val());
			var employee_alternative_phone  = $.trim($('#employee_alternative_phone').val());
			var employee_email  = $.trim($('#employee_email').val());
			var emp_address  = $.trim($('#emp_address').val());
			var password  = $.trim($('#password').val());
			var state  = $.trim($('#hospital_state_nigeria').val());
			
			if(first_name=='')
			{
				$('.alert-danger-outline-addemp').show();
				 $('.addemp_danger_pop').text('Please provide employee first name.');
	
				 return false;
			}
			// if(middle_name=='')
			// {
			// 	$('.alert-danger-outline-addemp').show();
			 // 	$('.addemp_danger_pop').text('Please provide employee middle name.');
	
			 // 	return false;
			// }
			if(surname=='')
			{
				$('.alert-danger-outline-addemp').show();
				 $('.addemp_danger_pop').text('Please provide employee surname.');
	
				 return false;
			}
			if(employee_email=='')
			{
				$('.alert-danger-outline-addemp').show();
				 $('.addemp_danger_pop').text('Please provide employee email address.');
	
				 return false;
			}
			if(emp_ph=='')
			{
				$('.alert-danger-outline-addemp').show();
				 $('.addemp_danger_pop').text('Please provide employee phone number.');
	
				 return false;
			}
			if(emp_ph.length>15)
			{
				$('.alert-danger-outline-addemp').show();
				 $('.addemp_danger_pop').text('Employee phone number maxlength is 15 digits.');
	
				 return false;
			}
			if(emp_ph.length<10)
			{
				$('.alert-danger-outline-addemp').show();
				 $('.addemp_danger_pop').text('Employee phone number cannot be less than 10 digits.');
	
				 return false;
			}
			if(!$.isNumeric(emp_ph))
			{
				$('.alert-danger-outline-addemp').show();
				 $('.addemp_danger_pop').text('Please provide numeric employee phone number.');
	
				 return false;
			}
			if(emp_address=='')
			{
				$('.alert-danger-outline-addemp').show();
				 $('.addemp_danger_pop').text('Please provide employee address.');
	
				 return false;
			}
			// if(country==0)
			// {
			// 	$('.alert-danger-outline-addemp').show();
			 // 	$('.addemp_danger_pop').text('Please provide employee country.');
	
			 // 	return false;
			// }
			if(state=='' || state=='0')
			{
				$('.alert-danger-outline-addemp').show();
				 $('.addemp_danger_pop').text('Please provide employee state.');
	
				 return false;
			}
			var filename = $('#select_photo_file').val();
	
			file = filename.toLowerCase(),
			extension = file.substring(file.lastIndexOf('.') + 1);
	   
			if (filename !='undefined' && filename !='')
			{
	
				var size = parseFloat($("#select_photo_file")[0].files[0].size / 1024).toFixed(2);
	
				if(size > 500)
				{
					$('.alert-danger-outline-addemp').show();
					 $('.addemp_danger_pop').text('Please upload photo of max:500kb size.');
	
					 return false;
				}
				if ($.inArray(extension,allowedExtensions) == -1) 
				{
					$('.alert-danger-outline-addemp').show();
					 $('.addemp_danger_pop').text('Please upload jpg/png photo.');
	
					 return false;
				}
			}
			else
			{
				if(mode == 'ADD'){
					$('.alert-danger-outline-addemp').show();
					 $('.addemp_danger_pop').text('Please upload employee profile photo.');
					return false;
				}
			}
	
			if(password=='')
			{
				if(mode == 'ADD'){
					$('.alert-danger-outline-addemp').show();
					$('.addemp_danger_pop').text('Please provide Employee Password.');
					return false;
				}
			}
			var check_access_for_hospital = $("#add_emp_form input:checked").length > 0;
	
			if (!check_access_for_hospital)
			{
	
				$('.alert-danger-outline-addemp').show();
				$('.addemp_danger_pop').text('Please choose access for hospital.');
	
				return false;
			}
	
			var data = new FormData(this);
			var languages = "";
			if ($("#top").find(".lang").length > 0) {
				$("#top").find(".lang").each(function() {
					var val = $(this).text();
					if (languages == "") {
						languages = $.trim(val);
					} else {
						languages = languages + "," + $.trim(val);
					}
				});
			}
			if (languages != "" && typeof languages !== typeof undefined) {
				data.append('languages', languages);
			}
			data.append('image',$('#select_photo_file').prop('files')[0]);
			var timezone_offset_minutes = new Date().getTimezoneOffset();
				timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
			data.append("timezone", timezone_offset_minutes);
			
			//var formData = $("#add_emp_form").serialize();
			var site_url = $('#site_url').text();
			var URL = site_url+"/admin/add_employee";
			if(mode == 'EDIT'){
				URL = site_url+"/admin/edit_employee";
			}
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: URL,
			type:'POST',
			data:data,
			processData: false,
			contentType: false,
			beforeSend: function() {
				$('.loading').addClass('loading-block');
			},
			success:function(response){
					if(response['redirect'] == 1){
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						$('.alert-success-outline-addemp').show();
						$('.addemp_success_pop').text(response['message']);
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline-addemp').show();
						 $('.addemp_danger_pop').text(response['message']);
					 }
	
				}
			});
			
			
			
		});
	
		//search Doctor
		$('#search_dr_form').submit(function(e){		
			e.preventDefault();
			var name_or_id = $.trim($('#name_or_id').val());
			$('#name_or_id_hidden').val(name_or_id);		
			var site_url = $('#site_url').text();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: site_url+"/admin/search_dr_by_admin",
			type:'POST',
			data:{name_or_id:name_or_id},
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
						}
					}
				}
			});
			
			return false;
		});
	
		//add new Doctor
		$('#add_dr_form').submit(function(e){		
			e.preventDefault();
			var dataId = $(this).attr('data-id');
			var mode = $.trim($('#mode').val()); 
			$('.alert-success-outline-adddr').hide();
			$('.alert-danger-outline-adddr').hide();
			$('.addhos_success_emp').text('');
			$('.addhos_danger_emp').text('');
			var allowedExtensions = ['jpg','jpeg','png'];
	
			// var doctor_title  = $.trim($('#doctor_title').val());
			var doctor_first_name  = $.trim($('#doctor_first_name').val());
			// var doctor_middle_name  = $.trim($('#doctor_middle_name').val());
			var doctor_last_name  = $.trim($('#doctor_last_name').val());
			var doctor_email  = $.trim($('#doctor_email').val());
			var doctor_phone  = $.trim($('#dr_ph').val());
			var doctor_gender  = $.trim($('#doctor_gender').val());
			// var doctor_role  = $.trim($('#doctor_role').val());
			var doctor_username  = $.trim($('#doctor_username').val());
			var doctor_password  = $('#doctor_password').val();	
			var confirmPassword  = $('#confirmPassword').val();	
			// if(doctor_title=='' || doctor_title=='0')
			// {
			// 	$('.alert-danger-outline-adddr').show();
			 // 	$('.adddr_danger_pop').text('Please provide Doctor Title.');
	
			 // 	return false;
			// }
			if(doctor_first_name=='')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide Doctor First Name.');
	
				 return false;
			}
			// if(doctor_middle_name=='')
			// {
			// 	$('.alert-danger-outline-adddr').show();
			 // 	$('.adddr_danger_pop').text('Please provide Doctor Middle Name.');
	
			 // 	return false;
			// }
			if(doctor_last_name=='')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide Doctor Surname.');
	
				 return false;
			}
			if( !isValidEmailAddress(doctor_email) ) {
				$('.alert-danger-outline-adddr').show();
					 $('.adddr_danger_pop').text('Please provide Valid Email Address.');
		
					 return false;
			}
			if(doctor_phone=='')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide Doctor Phone Number.');
	
				 return false;
			}
			if(doctor_phone.length>15)
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Doctor Phone Number maxlength is 15 digits.');
	
				 return false;
			}
			if(doctor_phone.length<10)
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Doctor Phone Number cannot be less than 10 digits.');
	
				 return false;
			}
			if(!$.isNumeric(doctor_phone))
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide Numeric Phone Number.');
	
				 return false;
			}
			if(doctor_gender=='')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide Gender.');
	
				 return false;
			}
			// if(doctor_role=='' || doctor_role=='0')
			// {
			// 	$('.alert-danger-outline-adddr').show();
			 // 	$('.adddr_danger_pop').text('Please provide Doctor Role.');
	
			 // 	return false;
			// }
			if(doctor_username=='')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide Doctor Username.');
	
				 return false;
			}
			
			if(doctor_password=='')
			{
				if(mode == 'ADD'){
					$('.alert-danger-outline-adddr').show();
					$('.adddr_danger_pop').text('Please provide Doctor Password.');
					return false;
				}
			}else{
				if(confirmPassword != doctor_password){
					$('.alert-danger-outline-adddr').show();
					$('.adddr_danger_pop').text('Please provide Doctor Confirm Password.');
					return false;
				}
			}
			
			var filename = $('#select_photo_file').val();
	
			file = filename.toLowerCase(),
			extension = file.substring(file.lastIndexOf('.') + 1);
			
			if (filename !='undefined' && filename !='')
			{
	
				var size = parseFloat($("#select_photo_file")[0].files[0].size / 1024).toFixed(2);
	
				if(size > 500)
				{
					$('.alert-danger-outline-adddr').show();
					 $('.addemp_danger_pop').text('Please upload photo of max:500kb size.');
	
					 return false;
				}
				if ($.inArray(extension,allowedExtensions) == -1) 
				{
					$('.alert-danger-outline-adddr').show();
					 $('.addemp_danger_pop').text('Please upload jpg/png photo.');
	
					 return false;
				}
			}
			else
			{
				if(mode == 'ADD'){
					$('.alert-danger-outline-adddr').show();
					$('.adddr_danger_pop').text('Please upload doctor profile photo.');
					return false;
				}
			}
			var data = new FormData(this);
			data.append('image',$('#select_photo_file').prop('files')[0]);
	
			data.append('dataId',dataId);
				var timezone_offset_minutes = new Date().getTimezoneOffset();
				timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
			data.append("timezone", timezone_offset_minutes);
			var languages = "";
			if ($("#top").find(".lang").length > 0) {
				$("#top").find(".lang").each(function() {
					var val = $(this).text();
					if (languages == "") {
						languages = $.trim(val);
					} else {
						languages = languages + "," + $.trim(val);
					}
				});
			}
			if (languages != "" && typeof languages !== typeof undefined) {
				data.append('languages', languages);
			}
			//var formData = $("#add_emp_form").serialize();
			var site_url = $('#site_url').text();
			var URL = site_url+"/admin/add_doctor";
			if(mode == 'EDIT'){
				URL = site_url+"/admin/edit_hospital_user";
				data.append("role",'doctor');
			}
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
			
			$.ajax({
			url: URL,
			type:'POST',
			data:data,
			processData: false,
			contentType: false,
			beforeSend: function() {
				$('.loading').addClass('loading-block');
			},
			success:function(response){
					if(response['redirect'] == 1){
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						$('.alert-success-outline-adddr').show();
						$('.adddr_success_pop').text(response['message']);
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline-adddr').show();
						 $('.adddr_danger_pop').text(response['message']);
					 }
	
				}
			});
			
		});
				// Folio number validation
				$('input[name="folio_number"]').keyup(function(e)   {
				if (/\D/g.test(this.value))
				{
				// Filter non-digits from input value.
				this.value = this.value.replace(/\D/g, '');
				}
				});
	
		//add new Member/Patient
	
		$('#add_member_form').submit(function(e){		
			e.preventDefault();
	
			$('.alert-success-outline-addmember').hide();
			$('.alert-danger-outline-addmember').hide();
			//$('.addmember_success_member').text('');
			$('.addmember_danger_pop').text('');
			var allowedExtensions = ['jpg','jpeg','png'];
			var patient_first_name  = $.trim($('.patient_first_name').val());
			// var patient_middle_name  = $.trim($('.patient_middle_name').val());
			var patient_last_name  = $.trim($('.patient_last_name').val());
			var patient_address  = $.trim($('.patient_address').val());
			var patient_state  = $.trim($('.patient_state').val());
			var patient_city  = $.trim($('.patient_city').val());
			// var religion  = $.trim($('.religion').val());
			// var patient_insurance  = $.trim($('.patient_insurance').val());
			// var patient_visited_hospital  = $.trim($('.patient_visited_hospital').val());
			var patient_email  = $.trim($('#patient_email').val());
			var patient_phone = $.trim($( ".patient_phone" ).val());
			var patient_password = $.trim($( ".patient_password" ).val());
			var c_password = $.trim($( ".c_password" ).val());
			var num = $( "#select_num" ).val();
			var day = $( "#select_day" ).val();
			var year = $( "#year" ).val();
			
			if(patient_first_name=='')
			{
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please provide Patient First Name.');
	
				 return false;
			}
			// if(patient_middle_name=='')
			// {
			// 	$('.alert-danger-outline-addmember').show();
			 // 	$('.addmember_danger_pop').text('Please provide Patient Middle Name.');
	
			 // 	return false;
			// }
			if(patient_last_name=='')
			{
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please provide Patient Last Name.');
	
				 return false;
			}
			if(patient_email=='')
			{
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please provide Valid Email Address.');
	
				 return false;
			}
			if( !isValidEmailAddress(patient_email) ) {
			$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please provide Valid Email Address.');
	
				 return false;
			}
			if(patient_phone.length!='')
			{
			if(patient_phone.length>15)
			{
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Phone number maxlength is 15 digits.');
	
				 return false;
			}
			if(patient_phone.length<10)
			{
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Phone number cannot be less than 10 digits.');
	
				 return false;
			}
			if(!$.isNumeric(patient_phone))
			{
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please provide numeric phone number.');
	
				 return false;
			}}
			if(patient_password == "") {		
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please provide Password.');
				return false;
			}
			if(c_password == "") {		
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please provide Confirm Password.');
			return false;
			}
			if(patient_password != c_password) {
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Password and Confirm password should be same.');
				return false;
			}
			if(patient_address=='')
			{
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please provide Patient Address.');
				 return false;
			}
			if(patient_state=='' || patient_state=='0')
			{
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please Select State.');
				 return false;
			}
			if(patient_city=='' || patient_city=='0')
			{
				$('.alert-danger-outline-addmember').show();
				 $('.addmember_danger_pop').text('Please Enter City.');
				 return false;
			}
			// if(patient_origin_state=='')
			// {
			// 	$('.alert-danger-outline-addmember').show();
			 // 	$('.addmember_danger_pop').text('Please provide Patient State of Origin.');
	
			 // 	return false;
			// }
			// if(religion=='')
			// {
			// 	$('.alert-danger-outline-addmember').show();
			 // 	$('.addmember_danger_pop').text('Please provide Patient Religion.');
	
			 // 	return false;
			// }
			// if(patient_insurance=='')
			// {
			// 	$('.alert-danger-outline-addmember').show();
			 // 	$('.addmember_danger_pop').text('Please provide Patient Insurance.');
	
			 // 	return false;
			// }
			// if(patient_visited_hospital=='')
			// {
			// 	$('.alert-danger-outline-addmember').show();
			 // 	$('.addmember_danger_pop').text('Please provide Patient Preffered Hospital.');
	
			 // 	return false;
			// }
			
			
			if(num == "" || day == "" || year=="") {		
				$('.alert-danger-outline-addmember').show();
				$('.addmember_danger_pop').text('Please Enter Birth Details.');
				return false;
			}	
				   
			var data = new FormData(this);
			
			var timezone_offset_minutes = new Date().getTimezoneOffset();
			timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
			data.append("timezone", timezone_offset_minutes);
			
			//var formData = $("#add_emp_form").serialize();
			var site_url = $('#site_url').text();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
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
				data.append('languages', languages); 
			  }
			  
			$.ajax({
			url: site_url+"/admin/add_member",
			type:'POST',
			data:data,
			processData: false,
			contentType: false,
			beforeSend: function() {
				$('.loading').addClass('loading-block');
			},
			success:function(response){
					if(response['redirect'] == 1){
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						$('.alert-success-outline-addmember').show();
						$('.addmember_success_pop').text(response['message']);
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline-addmember').show();
						 $('.addmember_danger_pop').text(response['message']);
					 }
	
				}
			});
				
			
		});
	
			//add new Nurse from hospital tab
		$('#add_nurse_form').submit(function(e){		
			e.preventDefault();
			var dataId = $(this).attr('data-id');
			var mode = $.trim($('#mode').val()); 
			//alert(67);
			$('.alert-success-outline-addnurse').hide();
			$('.alert-danger-outline-addnurse').hide();
			$('.addhos_success_emp').text('');
			$('.addhos_danger_emp').text('');
			var allowedExtensions = ['jpg','jpeg','png'];
	
			var nurse_title  = $.trim($('#nurse_title').val());
			var nurse_first_name  = $.trim($('#nurse_first_name').val());
			var nurse_middle_name  = $.trim($('#nurse_middle_name').val());
			var nurse_last_name  = $.trim($('#nurse_last_name').val());
			var nurse_email  = $.trim($('#nurse_email').val());
			var nurse_ph  = $.trim($('#nurse_ph').val());
			var nurse_gender  = $.trim($('#nurse_gender').val());
			var nurse_username  = $.trim($('#nurse_username').val());
			var nurse_password  = $.trim($('#nurse_password').val());
			var nurse_confirmPassword  = $.trim($('#nurse_confirmPassword').val());
			if(nurse_title=='')
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide Nurse Title.');
	
				 return false;
			}
			if(nurse_first_name=='')
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide Nurse First Name.');
	
				 return false;
			}
			// if(nurse_middle_name=='')
			// {
			// 	$('.alert-danger-outline-addnurse').show();
			 // 	$('.addnurse_danger_pop').text('Please provide Nurse Middle Name.');
	
			 // 	return false;
			// }
			if(nurse_last_name=='')
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide Nurse Surname.');
	
				 return false;
			}
			if(nurse_email=='')
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide Valid Email Address.');
	
				 return false;
			}
			if( !isValidEmailAddress(nurse_email) ) {
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide Valid Email Address.');
	
				 return false;
			}
			if(nurse_role=='')
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide Nurse Role.');
	
				 return false;
			}
	
			
			if(nurse_username=='')
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide Nurse User Name.');
	
				 return false;
			}
			if(nurse_gender=='')
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide Nurse Gender.');
	
				 return false;
			}
			
			if(nurse_password=='')
			{
				if(mode == 'ADD'){
					$('.alert-danger-outline-addnurse').show();
					$('.addnurse_danger_pop').text('Please provide Nurse Password.');
					return false;
				}
			}else{
				if(nurse_confirmPassword != nurse_password){
					$('.alert-danger-outline-addnurse').show();
					$('.addnurse_danger_pop').text('Please provide Nurse Confirm Password.');
					return false;
				}
			}
			
			if(nurse_ph=='')
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide Nurse phone number.');
	
				 return false;
			}
			if(nurse_ph.length>15)
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Nurse phone number maxlength is 15 digits.');
	
				 return false;
			}
			if(nurse_ph.length<10)
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Nurse phone number cannot be less than 10 digits.');
	
				 return false;
			}
			if(!$.isNumeric(nurse_ph))
			{
				$('.alert-danger-outline-addnurse').show();
				 $('.addnurse_danger_pop').text('Please provide numeric phone number.');
	
				 return false;
			}
	
			var data = new FormData(this);
			var languages = "";
			if ($(".master_top").find(".lang").length > 0) {
				$(".master_top").find(".lang").each(function() {
					var val = $(this).text();
					if (languages == "") {
						languages = $.trim(val);
					} else {
						languages = languages + "," + $.trim(val);
					}
				});
			}
			if (languages != "" && typeof languages !== typeof undefined) {
				data.append('languages', languages);
			}
			var filename = $('#select_photo_file_nurse').val();
			file = filename.toLowerCase(),
			extension = file.substring(file.lastIndexOf('.') + 1);
	   
			if (filename !='undefined' && filename !='')
			{
	
				var size = parseFloat($("#select_photo_file_nurse")[0].files[0].size / 1024).toFixed(2);
	
				if(size > 500)
				{
					$('.alert-danger-outline-addnurse').show();
					 $('.addnurse_danger_pop').text('Please upload photo of max:500kb size.');
	
					 return false;
				}
				if ($.inArray(extension,allowedExtensions) == -1) 
				{
					$('.alert-danger-outline-addnurse').show();
					 $('.addnurse_danger_pop').text('Please upload jpg/png photo.');
	
					 return false;
				}
				data.append('image',$('#select_photo_file_nurse').prop('files')[0]);
			}
			else
			{
				if(mode == 'ADD'){
					$('.alert-danger-outline-addnurse').show();
					$('.addnurse_danger_pop').text('Please upload Nurse profile photo.');
	
					return false;
				}
			}
			// Timezone
			//var formData = $("#add_emp_form").serialize();
			var site_url = $('#site_url').text();
			data.append('dataId',dataId);
				var timezone_offset_minutes = new Date().getTimezoneOffset();
				timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
			data.append("timezone", timezone_offset_minutes);
			
			var site_url = $('#site_url').text();
			var URL = site_url+"/admin/add_nurse";
			if(mode == 'EDIT'){
				URL = site_url+"/admin/edit_hospital_user";
				data.append("role",'nurse');
			}
	
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: URL,
			type:'POST',
			data:data,
			processData: false,
			contentType: false,
			beforeSend: function() {
				$('.loading').addClass('loading-block');
			},
			success:function(response){
					if(response['redirect'] == 1){
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						$('.alert-success-outline-addnurse').show();
						$('.addnurse_success_pop').text(response['message']);
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline-addnurse').show();
						 $('.addnurse_danger_pop').text(response['message']);
					 }
	
				}
			});
			
		});
	
		//add new Administrator from hospital tab
		$('#add_admin_form').submit(function(e){		
			e.preventDefault();
			var dataId = $(this).attr('data-id');
			var mode = $.trim($('#mode').val()); 
			//alert(67);
			$('.alert-success-outline-addadmin').hide();
			$('.alert-danger-outline-addadmin').hide();
			$('.addhos_success_emp').text('');
			$('.addhos_danger_emp').text('');
			var allowedExtensions = ['jpg','jpeg','png'];
	
			var admin_title  = $.trim($('#admin_title').val());
			var admin_first_name  = $.trim($('#admin_first_name').val());
			var admin_middlename  = $.trim($('#admin_middlename').val());
			var admin_last_name  = $.trim($('#admin_last_name').val());
			var admin_email  = $.trim($('#admin_email').val());
			var admin_ph  = $.trim($('#admin_ph').val());
			var admin_gender  = $.trim($('#admin_gender').val());
			var admin_role  = $.trim($('#admin_role').val());
			var admin_username  = $.trim($('#admin_username').val());
			var admin_password  = $.trim($('#admin_password').val());
			var admin_confirmPassword  = $.trim($('#admin_confirmPassword').val());
			
			if(admin_title=='')
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide Admin Title.');
	
				 return false;
			}
			if(admin_first_name=='')
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide Admin First Name.');
	
				 return false;
			}
			// if(admin_middlename=='')
			// {
			// 	$('.alert-danger-outline-addadmin').show();
			 // 	$('.addadmin_danger_pop').text('Please provide Admin Middle Name.');
	
			 // 	return false;
			// }
			if(admin_last_name=='')
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide Admin Surname.');
	
				 return false;
			}
			if(admin_gender=='')
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide Admin Gender.');
	
				 return false;
			}
			if(admin_role=='')
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide Admin Role.');
	
				 return false;
			}
			if(admin_username=='')
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide Admin User Name.');
	
				 return false;
			}
			if(admin_ph=='')
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide phone number.');
	
				 return false;
			}
			if(admin_ph.length>15)
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Phone number maxlength is 15 digits.');
	
				 return false;
			}
			if(admin_ph.length<10)
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Phone number cannot be less than 10 digits.');
	
				 return false;
			}
			if(!$.isNumeric(admin_ph))
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide numeric phone number.');
	
				 return false;
			}
			if(admin_email=='')
			{
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide Email Address.');
	
				 return false;
			}
			if( !isValidEmailAddress(admin_email) ) {
				$('.alert-danger-outline-addadmin').show();
				 $('.addadmin_danger_pop').text('Please provide Valid Email Address.');
	
				 return false;
			}
	
			if(admin_password=='')
			{
				if(mode == 'ADD'){
					$('.alert-danger-outline-addadmin').show();
					$('.addadmin_danger_pop').text('Please provide Administrator Password.');
					return false;
				}
			}else{
				if(admin_confirmPassword != admin_password){
					$('.alert-danger-outline-addadmin').show();
					$('.addadmin_danger_pop').text('Please provide Administrator Confirm Password.');
					return false;
				}
			}
	
			var data = new FormData(this);
			var filename = $('#select_photo_file_admin').val();
	
			file = filename.toLowerCase(),
			extension = file.substring(file.lastIndexOf('.') + 1);
	   
			if (filename !='undefined' && filename !='')
			{
	
			var size = parseFloat($("#select_photo_file_admin")[0].files[0].size / 1024).toFixed(2);
	
				if(size > 500)
				{
					$('.alert-danger-outline-addadmin').show();
					 $('.addadmin_danger_pop').text('Please upload photo of max:500kb size.');
	
					 return false;
				}
				if ($.inArray(extension,allowedExtensions) == -1) 
				{
					$('.alert-danger-outline-addadmin').show();
					 $('.addadmin_danger_pop').text('Please upload jpg/png photo.');
	
					 return false;
				}
				data.append('image',$('#select_photo_file_admin').prop('files')[0]);
			}
			else
			{
				if(mode == 'ADD'){
					$('.alert-danger-outline-addadmin').show();
					$('.addadmin_danger_pop').text('Please upload profile photo.');
	
					return false;
				}
			}
			
			//var formData = $("#add_emp_form").serialize();
			var site_url = $('#site_url').text();
			data.append('dataId',dataId);
				var timezone_offset_minutes = new Date().getTimezoneOffset();
				timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
			data.append("timezone", timezone_offset_minutes);
			
			var site_url = $('#site_url').text();
			var URL = site_url+"/admin/add_administrator";
			if(mode == 'EDIT'){
				URL = site_url+"/admin/edit_hospital_user";
				data.append("role",'admin');
			}
	
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: URL,
			type:'POST',
			data:data,
			processData: false,
			contentType: false,
			beforeSend: function() {
				$('.loading').addClass('loading-block');
			},
			success:function(response){
					if(response['redirect'] == 1){
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						$('.alert-success-outline-addadmin').show();
						$('.addadmin_success_pop').text(response['message']);
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline-addadmin').show();
						 $('.addadmin_danger_pop').text(response['message']);
					 }
	
				}
			});
			
		});
	
		//add new Deal
		$('#addDeal').submit(function(e){		
			e.preventDefault();
			var mode = $.trim($('#mode').val()); 
			$('.alert-success-outline-adddr').hide();
			$('.alert-danger-outline-adddr').hide();
			$('.addhos_success_emp').text('');
			$('.addhos_danger_emp').text('');
	
			var deal_facility = $.trim($('#deal_facility').val());
			var title  = $.trim($('#title').val());
			var previous_price  = $.trim($('#previous_price').val());
			var current_price  = $.trim($('#current_price').val());
			var deal_categories  = $.trim($('#deal_categories').val());
			var current_price  = $.trim($('#current_price').val());
			var allowedExtensions = ['jpg','jpeg','png'];
	
			var num1 = $("#select_num").val();
			var day1 = $("#select_day").val();
			var year1 = $("#year").val();
	
			var num2 = $("#deal_select_num").val();
			var day2 = $("#deal_select_day").val();
			var year2 = $("#deal_year").val();
	
			if(deal_facility=='' || deal_facility=='0')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please Select Facility.');
				 return false;
			}
	
			if(title=='')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide Title.');
				 return false;
			}
	
			if(previous_price=='')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide previous price.');
				 return false;
			}
	
			if(!$.isNumeric(previous_price))
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide numeric value for previous price.');
				 return false;
			}
	
			if(current_price=='')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide current price.');
	
				 return false;
			}
	
			if(!$.isNumeric(current_price))
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide numeric value for current price.');
				 return false;
			}
		
			if(num1 == "" || day1 == "" || year1 =="") {		
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please Enter Start Date.');
				return false;
			}
	
			if(num2 == "" || day2 == "" || year2 =="") {		
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please Enter End Date.');
				return false;
			}
	
			if(year1 == year2){
				if(day1 == day2){
					if(num1 >= num2){
						$('.alert-danger-outline-adddr').show();
						$('.adddr_danger_pop').text('Please Enter Valid End Date.');
					   return false;
					}
				}else{
	
				}	
			}
	
			if(year1 > year2){
				$('.alert-danger-outline-adddr').show();
				$('.adddr_danger_pop').text('Please Enter Valid End Date.');
				return false;
			}
	
			if(deal_categories=='')
			{
				$('.alert-danger-outline-adddr').show();
				 $('.adddr_danger_pop').text('Please provide deal categories.');
				 return false;
			}
	
			var formdata = new FormData(this);
			var filename = $('#select_photo_file_admin').val();
	
			file = filename.toLowerCase(),
			extension = file.substring(file.lastIndexOf('.') + 1);
	   
			if (filename !='undefined' && filename !=''){
				var size = parseFloat($("#select_photo_file_admin")[0].files[0].size / 1024).toFixed(2);
				if(size > 500){
					$('.alert-danger-outline-adddr').show();
					 $('.adddr_danger_pop').text('Please upload photo of max:500kb size.');
					 return false;
				}
				if($.inArray(extension,allowedExtensions) == -1) 
				{
					$('.alert-danger-outline-adddr').show();
					 $('.adddr_danger_pop').text('Please upload jpg/png photo.');
					 return false;
				}
				formdata.append('image',$('#select_photo_file_admin').prop('files')[0]);
			}else{
				if(mode == 'ADD'){
					$('.alert-danger-outline-adddr').show();
					$('.adddr_danger_pop').text('Please upload profile photo.');
					return false;
				}
			}
	
			console.log('formdata',formdata);
			var site_url = $('#site_url').text();
			var URL = site_url+"/admin/deals/create";
			if(mode == 'EDIT'){
				URL = site_url+"/admin/deals/update";
			}
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: URL,
			type:'POST',
			data: formdata,
			processData: false,
			contentType: false,
			beforeSend: function() {
				$('.loading').addClass('loading-block');
			},
			success:function(response){
					if(response['redirect'] == 1){
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						 parent.location =result['redirect_url'];
						return false;
					}
					else if(response['success'] == 1)
					{
						setTimeout(function(){ $('.loading').removeClass('loading-block'); }, 1000);
						$('.alert-success-outline-adddr').show();
						$('.adddr_success_pop').text(response['message']);
						$("#myform").trigger('reset');
						setTimeout(function() {
						location.reload();
						}, 1500);
					 }
					 else
					 {
						 $('.alert-danger-outline-adddr').show();
						 $('.adddr_danger_pop').text(response['message']);
					 }
	
				}
			});
		});
	
	
		function preview(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$('#preview-image').attr('src', e.target.result);
	
				}
				
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		function previewNurse(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$('#preview-image_nurse').attr('src', e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		function previewAdmin(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$('#preview-image_admin').attr('src', e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$("#select_photo_file").change(function(){
			preview(this);
		});
		 $("#select_photo_file_nurse").change(function(){
			previewNurse(this);
		});
		  $("#select_photo_file_admin").change(function(){
			previewAdmin(this);
		});
	
		//reset modal form
		$('.modal').on('hidden.bs.modal', function(){
	
			var site_url = $('#site_url').text();
			var default_image = $('#default_image').val();
	
			var formId = $(this).find("form").attr('id');
	
			allcheckbox = "#"+formId+" input:checkbox";
			allradio = "#"+formId+" input:radio";
			
			$(this).find('form').trigger('reset');
	
			//reset all checkboxes
	
			$(allcheckbox).each(function() {
	
				$(this).prettyCheckable('uncheck');
				 
			});
	
			//reset all radio buttons
			$(allradio).each(function() {
	
				$(this).prettyCheckable('uncheck');
				 
			});
	
			$('.alert-danger-outline').css("display", "none");
			$('.alert-success-outline').css("display", "none");
	
			//reset preview image
			$('#preview-image').attr('src',default_image);
	
		});
	
		//search Hospital
		$('#search_hosp_form').submit(function(e){		
			e.preventDefault();
			var name_or_id = $.trim($('#name_or_id').val());
			$('#name_or_id_hidden').val(name_or_id);		
			var site_url = $('#site_url').text();
			 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
	
			$.ajax({
			url: site_url+"/admin/search_hosp_by_admin",
			type:'POST',
			data:{name_or_id:name_or_id},
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
						}
					}
				}
			});
			
			return false;
		});
	
	$(document).on('click',".next1, .pre1",function(){	
			if($(this).hasClass("disable") == false && $(this).hasClass("active") == false){
				var url1 =$(this).attr("data-url");
				 $(this).attr("href","javascript:void(0);");			 
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
	function billingInfo(data){
		sessionStorage.setItem("is_reloaded", 1);
		var site_url = $('#site_url').text();
		var id = $(data).attr("data-id");
		var url = site_url+"/admin/view_record/"+id;	
		parent.location = url;
	}
	// Save medical record by admin
		
	function saveHealthHistory(data){	
		$(".error_text_history").text('');
		$(".error_msg_history").css("display","none");
		var form_data = new FormData($("#add_medical_record")[0]);
		var i = 0;
		var attach_err = 0;
		var attach_type =[];
		var attach_cnt = 0;	
		var attach_type_err = 0;
		var centre_name = [];
		var centre_cnt = 0;
		var centre_err = 0;
		var f_error = 0;
		jQuery.each(jQuery("#add_medical_record").find("#imaging_docs").find('tr:not(:first-child)'), function() {				
			if($(this).css("display") != "none"){		
				if(jQuery(this).find('.historyattachment').length > 0){
					var attach = jQuery(this).find('.historyattachment')[0].files[0];			
					if(attach != "" && typeof attach !== typeof undefined ){	
						i++;	
						form_data.append('attachments'+i+'',jQuery(this).find('.historyattachment')[0].files[0]);					
						attach_err = 0;
					}else{
						attach_err = 1;
					}			
	
					if($.trim($(this).find(".attach_type option:selected").val()) != ""){
						attach_type[attach_cnt] = $.trim($(this).find(".attach_type option:selected").val());
						attach_cnt++;	
						attach_type_err = 0;		
					}else{
						attach_type_err = 1;				
						
					}	
	
					if($.trim($(this).find(".centre_name").val()) != ""){
						centre_name[centre_cnt] = $.trim($(this).find(".centre_name").val());
						centre_cnt++;	
						centre_err = 0;		
					}else{
						centre_err = 1;				
						
					}					
					if((attach_err == 0 &&  attach_type_err == 0 && centre_err == 0) || (attach_err == 1 &&  attach_type_err == 1 && centre_err == 1)){	
						if(attach_err == 0 &&  attach_type_err == 0 && centre_err == 0){
							var attach_type_arr = JSON.stringify(attach_type);
							form_data.append('attach_type', attach_type_arr);	
							var centre_name_arr = JSON.stringify(centre_name);
							form_data.append('centre_name', centre_name_arr);					
						}
					}else{
						$(".error_text_history").text('');
						$(".error_text_history" ).text( "Please enter all the details for attachments." );
						$(".error_msg_history").css("display","block");
						f_error = 1;
						
					}
				}
			}		    		
		});
	
		form_data.append('imagesLength', i); 
		var medi_name = [];
		var medi_type = [];
		var medi_procedure = [];
		var medi_quantity = [];
		var name_cnt= 0;
		var type_cnt = 0;
		var procedure_cnt = 0;
		var quantity_cnt = 0;	
		var name_err = 0;
		var type_err = 0;
		var procedure_err = 0;
		var quantity_err = 0;	
		var patient_id = $(".patient_id").val();
		if($("#add_medical_record").find('#comp_file').length > 0){
			var len = $("#add_medical_record").find('#comp_file')[0].files.length;	
			if(len > 0){
				form_data.append('record_attach_len', len);
				for (var i = 0; i < len ; i++) {
					var file = $("#add_medical_record").find('#comp_file')[0].files[i];
					if(file != "" && typeof file !== typeof undefined ){
						form_data.append('record_attach'+i+'', file);
					} 
				}
			}	
		}	
	
		var hospital_id =$(".hospital_id").val();
		if($.trim(hospital_id) == ""){
			$(".error_text_history").text('');
			$( ".error_text_history" ).text( "Please Select Hospital." );
			$(".error_msg_history").css("display","block");
			return false;
		}
		var doctor_id =$(".doctor_list").val();
		if($.trim(doctor_id) == ""){
			$(".error_text_history").text('');
			$( ".error_text_history" ).text( "Please Select Doctor." );
			$(".error_msg_history").css("display","block");
			return false;
		}
		
		var temperature =$(".temperature").val();
		/*if($.trim(temperature) == ""){
			$(".error_text_history").text('');
			$( ".error_text_history" ).text( "Please enter temperature." );
			$(".error_msg_history").css("display","block");
			return false;
		}*/
		var pulse = $(".pulse_rate").val();
		/*if($.trim(pulse) == ""){
			$(".error_text_history").text('');
			$( ".error_text_history" ).text( "Please enter pulse rate." );
			$(".error_msg_history").css("display","block");
			return false;
		}*/
		var resp_rate =$(".resp_rate").val();
		/*if($.trim(resp_rate) == ""){
			$(".error_text_history").text('');
			$( ".error_text_history" ).text( "Please enter respiratory rate." );
			$(".error_msg_history").css("display","block");
			return false;
		}*/
		var bp_syt =$(".bp_syt").val();
		var bp_dia =$(".bp_dia").val();
		/*if($.trim(bp_syt) == "" && $.trim(bp_dia) == ""){
			$(".error_text_history").text('');
			$( ".error_text_history" ).text( "Please enter blood pressure." );
			$(".error_msg_history").css("display","block");
			return false;
		}*/
		var temprature_type = $(".temprature_type option:selected").val();	
		form_data.append('temprature_type', temprature_type);
	
		var degree_type = $(".degree_type.temp_active").attr("data-type");	
		form_data.append('degree_type', degree_type);	
	
		$(".medication_table").find("tr:not(:first-child)").each(function(){ 	
			
			if($(this).css("display") != "none"){	
					
				if($(this).attr("data-id") == "" || typeof $(this).attr("data-id")  === typeof undefined){		
					if($.trim($(this).find(".medi_name").val()) != ""){
						medi_name[name_cnt] = $.trim($(this).find(".medi_name").val());
						name_cnt++;	
						name_err = 0;		
					}else{
						name_err = 1;				
						
					}
					if($.trim($(this).find(".medi_type option:selected").val()) != ""){
						medi_type[type_cnt] = $.trim($(this).find(".medi_type option:selected").val());
						type_cnt++;	
						type_err = 0;		
					}else{
						type_err = 1;				
						
					}
					if($.trim($(this).find(".medi_procedure").val()) != ""){
						medi_procedure[procedure_cnt] = $.trim($(this).find(".medi_procedure").val());
						procedure_cnt++;
						procedure_err = 0;			
					}else{
						procedure_err = 1;				
						
					}
					if($.trim($(this).find(".medi_quantity").val()) != ""){		
						if($.trim($(this).find(".medi_quantity").val()) > 0){
							medi_quantity[quantity_cnt] = $.trim($(this).find(".medi_quantity").val());
							quantity_cnt++;	
							quantity_err = 0;
						}else if($.trim($(this).find(".medi_quantity").val()) == 0){
							quantity_err = 2;
						}		
					}else{
						quantity_err = 1;				
						
					}				
	
					if((name_err == 0 &&  type_err == 0 && procedure_err == 0 && quantity_err == 0) || (name_err == 1 &&  type_err == 1 && procedure_err == 1 && quantity_err == 1)){	
						if(name_err == 0 &&  type_err == 0 && procedure_err == 0 && quantity_err == 0){
							var medi_name_arr = JSON.stringify(medi_name);
							form_data.append('medi_name', medi_name_arr);	
							var medi_type_arr = JSON.stringify(medi_type);
							form_data.append('medi_type', medi_type_arr);
							var medi_procedure_arr = JSON.stringify(medi_procedure);						
							form_data.append('medi_procedure', medi_procedure_arr);	
							var medi_quantity_arr = JSON.stringify(medi_quantity);
							form_data.append('medi_quantity', medi_quantity_arr);	
						}
					}else if(quantity_err == 2){
						$(".error_text_history").text('');
						$(".error_text_history" ).text( "Please enter quantity above 0." );
						$(".error_msg_history").css("display","block");
						f_error = 1;
					}else{
						$(".error_text_history").text('');
						$(".error_text_history" ).text( "Please enter all the medication details." );
						$(".error_msg_history").css("display","block");
						f_error = 1;
						
					}
				}
			}	
			
		});	
		
		if(f_error == 1){
			return false;
		}
	
		var edit = 0;
		if($(".edit").val() != "" && typeof $(".edit").val() !== typeof undefined ){
			edit =1;
		}
		var site_url = $('#site_url').text();
		  $.ajax({
			headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:  site_url+'/admin/save_medical_record', 
			type: "POST",    
			enctype: 'multipart/form-data',         
			data: form_data, 
			contentType: false,      
			cache: false,             
			processData:false, 
			dataType: 'json',       
			success: function(result){
				if(result['redirect'] == 1){
					 parent.location =result['redirect_url'];
					return false;
				 }
				 if(result['success'] == 0)
				{				
					$(".error_text_history").text(result['message']);
					$(".error_msg_history").css("display","block");
					return false;
				}
				if(result['success'] == 1)
				{
					if(edit == 1){
						alert("Medical record edited successfully");
						location.href = site_url+"/admin/medical_records/"+patient_id;
					}else{
						  alert("Medical record added successfully");
						  location.href = site_url+"/admin/medical_records/"+patient_id;
					  }
				  }
			}
		  });
	}
	//
	
	function PossibleDiagnosis(data){
		$('#possible_diagnosis_value').val(data.value);
		if(data.value == "Other"){
			$('#possible_diagnosis_value').show();
			$('#possible_diagnosis_value').val('');
		}else{
			$('#possible_diagnosis_value').hide();
		}
	}
	//get value of selected country and get list of states
	function getdoctors(current){
	
			var site_url = $('#site_url').text();
			var element = current.value;
			if(element!=0)
			{
				$.ajaxSetup({
					  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				});
	
				$.ajax({
				url: site_url+"/admin/getdoctors",
				type:'POST',
				data:{hospital_id:element},
				success:function(response){				
	
						if(response.success == 1)
						{
							console.log(response.data);
							$('.doctor_list').html(response.data);
	
						 }
						 else
						 {
							 $('.alert-danger-outline-addhos').show();
							 $('.addhos_danger_pop').text(response.message);
						 }
	
					}
				});
			}
			else{
				$('.doctor_list').html('<option value="0">Select Doctor</option>');
			}
	}
	$(".degree_type").click(function(){
			  $(".degree_type").removeClass("temp_active");
			  $(this).addClass("temp_active");
		  });
	
	/*// Make billing dispute
	function makebillingdispute(){
		var site_url = $('#site_url').text();
			
				$.ajaxSetup({
					  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				});
	
				$.ajax({
				url: site_url+"/admin/addbillingdispute",
				type:'POST',
				data:{},
				success:function(response){				
	
						if(response.success == 1)
						{
							console.log(response.data);
							$('.doctor_list').html(response.data);
	
						 }
						 else
						 {
							 $('.alert-danger-outline-addhos').show();
							 $('.addhos_danger_pop').text(response.message);
						 }
	
					}
				});
			
	}*/
	// Make billing dispute
	function makebillingdispute(billing_id,dispute){
		var site_url = $('#site_url').text();
			
				$.ajaxSetup({
					  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				});
	
				$.ajax({
				url: site_url+"/admin/addbillingdispute",
				type:'POST',
				data:{billing_id:billing_id,dispute:dispute},
				success:function(response){				
	
						if(response.success == 1)
						{
							//alert(dispute);
							if(dispute==1){
							$(".disputed").css("display","none");
							$(".undisputed").css("display","block");
						
							}else{
							$(".undisputed").css("display","none");
							$(".disputed").css("display","block");					
						}			
	
	
						 }
						 else
						 {
							 $('.alert-danger-outline-addhos').show();
							 $('.addhos_danger_pop').text(response.message);
						 }
	
					}
				});
				}
				// Give option to user to pay by cash or by card
	
	
	function selectpaytype(current,event){
		$(".radio_div").css("display","none");
			$(".paybill_type").css("display","block");
		$(current ).siblings( ".radio_div" ).css("display","block");
	
		 var target = event.target;
		 target.style.display = 'none';
	}
		function getselectedvalue(current,event){
		var paytype= event.target.value;
	
		if(paytype==2){
		$(current ).parent().parent().siblings(".cash_input").find("#pay_bill_popup").trigger("click");
		//$("#pay_bill_popup").trigger("click");
		}
		if(paytype==1){
		
		$(current ).parent().parent().siblings( ".cash_input" ).find("#pay_bill_popup").hide();
		$(current ).parent().parent().siblings( ".cash_input" ).css("display","block");	
		$(current ).parent().parent().siblings( ".cash_input" ).find("#myModal").modal('show');
	
		}
	
		}
	
		function paybycash(event){
		var site_url = $('#site_url').text();
		var url = site_url+"/admin/pay_billing_cash";		
		var amount=$("input[name='pay_amount']").val();
		var doc_id = $(event).attr("data-doc_id");	
		var pt_id = $(event).attr("data-pt_id");
		//alert(pt_id);
		var bill_id = $(event).attr("data-bill_id");
		$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
		});
		$.ajax({				
		type: 'POST',
		url: url,	
		data: {'amount':amount,'billing_id':bill_id,"patient_id":pt_id,"doctor_id":doc_id,"amt":amount,"cash_card":"cash"},	
		dataType: 'json',
		success: function (response) {	
		if(response['redirect'] == 1){
		parent.location =result['redirect_url'];
		return false;
		}
		if(response['success'] == 1){					
		alert(response["message"]);	
		parent.location =site_url+'/admin/billing_detail/'+bill_id+'/'+doc_id;		
		}
		},
		error: function (response) {
		console.log('Error:', response);
		}
		});
		}
		function getpaypopup(){
			$(".cash_input").hide();
			//$("#paybill_type").show();
		}
		function limitmax(e,amount){
			var lmit=e.target.value;
			if (lmit > amount
			&& e.keyCode !== 46 // keycode for delete
			&& e.keyCode !== 8 // keycode for backspace
		   ) {
		   e.preventDefault();
		  $("#pay_amount").val(amount);
		}
	
		}
		function payWithPaystack(data){
		var amt = $(data).attr("data-amt");
		var bfr_amt = $(data).attr("data-amt");
		amt = parseFloat(amt)*100;	
		//alert(amt);
		var doc_id = $(data).attr("data-doc_id");	
		var pt_id = $(data).attr("data-pt_id");
		var bill_id = $(data).attr("data-bill_id");
		var handler = PaystackPop.setup({		    	
			   key: 'pk_test_a6adba56deebfcd4e5cb8a4929526844a742537f',
				email: 'shreya.d@iapptechnologies.com',
			  amount: amt,		
			  channels:['card','bank'],      	
			  ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
			  metadata: {
			 custom_fields: [
				{
					display_name: "Mobile Number",
					variable_name: "mobile_number",
					value: "+2348012345678"
				}
			 ]
		  },
		  callback: function(response){      	
			  var site_url = $('#site_url').text();
			var url = site_url+"/admin/pay_billing";	
			$.ajaxSetup({
				headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
			});
			$.ajax({				
				type: 'POST',
				url: url,	
				data: {'transaction_id':response.reference,'billing_id':bill_id,"patient_id":pt_id,"doctor_id":doc_id,"amt":bfr_amt},	
				dataType: 'json',
				success: function (response) {	
					if(response['redirect'] == 1){
						 parent.location =result['redirect_url'];
						return false;
					 }
					 if(response['success'] == 1){					
						alert(response["message"]);
						sessionStorage.setItem("is_reloaded", 1);
						parent.location =site_url+'/admin/billing_detail/'+bill_id+'/'+doc_id;	
					}
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
	// Billing related script
		  $(document).on('keyup',".bll_amt",function(){  		
			  var total = 0;
				  $(".bll_amt").each(function(){  
					  if($(this).val() != ""){  							
						  total = parseFloat(total) + parseFloat($(this).val());
					  }
				  });
	
			  $(".bl_ttl").text('₦'+total);
			  $(".save_bling").attr("data-total",total);
		  });
	
		  $('#add_new_billing').on('hidden.bs.modal', function () {
			  $(".bll_amt").each(function(){  
				$(this).val('');
			});
			$(".ser_nm").each(function(){  
				$(this).val('');
			});
			$(".table_modal").find("tr:gt(3):not(:last):not(:nth-last-child(2))").remove();
			$(".bl_ttl").text('₦0');
		});
	
		  function removeitems(data){
		var html = $(data).parents('tr').remove();	
		var total = 0;
		$(".bll_amt").each(function(){  
			if($(this).val() != ""){  							
				total = parseFloat(total) + parseFloat($(this).val());
			}
		});
		$(".bl_ttl").text('₦'+total);
		$(".save_bling").attr("data-total",total);
	
	}
	// save billing for patient
	function savebilling(data){
		$(".error_text_bill").text('');	
		$(".error_msg_bill").css("display","none");
		var bill_amt = {};
		var ser_nm = {};
		var ser_err = 0;
		var bl_err = 0;
		var cnt= 0;
		var idx = 0;
		$(".bll_amt").each(function(){  
			if($(this).parents('tr').css("display") != "none"){	
				if($.trim($(this).val()) != "" && $.trim($(this).val()) != 0){
					bill_amt[cnt] = $.trim($(this).val());
					bl_err = 0;
					cnt++;			
				}else if($.trim($(this).val()) == ""){				
					bl_err = 1;			
					return false;		
				}else if($.trim($(this).val()) == 0){
					bl_err = 2;
					return false;
				}
			}
		});	
		
		if(bl_err == 2){
			$(".error_text_bill").text('');
			$(".error_text_bill" ).text( "Please enter amount above 0." );
			$(".error_msg_bill").css("display","block");
			return false;
		}else if(bl_err == 1){
			$(".error_text_bill").text('');
			$( ".error_text_bill" ).text( "Please enter all the bill amounts." );
			$(".error_msg_bill").css("display","block");
			return false;
		}
		$(".ser_nm").each(function(){ 
			if($(this).parents('tr').css("display") != "none"){ 
				if($.trim($(this).val()) != ""){
					ser_nm[idx] = $.trim($(this).val());
					idx++;
				}else{
					ser_err = 1;				
					return false;
				}
			}
		});
		
		if(ser_err == 1){
			$(".error_text_bill").text('');
			$( ".error_text_bill" ).text( "Please enter all the service name." );
			$(".error_msg_bill").css("display","block");
			return false;
		}
	
		var patient_id = $(data).attr("data-patient_id");
		//alert(patient_id);
		var history_id = $(data).attr("data-history_id");
		//alert(history_id);
		var total = $(data).attr("data-total");
		//alert(total);
		var site_url = $('#site_url').text();
		var url = site_url+"/admin/save_bill_details";	
		//console.log(url);	
		$.ajaxSetup({
			headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
		});
		$.ajax({				
			type: 'POST',
			url: url,		
			data: {"bill_amt":bill_amt,"ser_nm":ser_nm,"patient_id":patient_id,"total":total,"history_id":history_id},		
			dataType: 'json',
			success: function (response) {	
				if(response['redirect'] == 1){
					 parent.location =response['redirect_url'];
					return false;
				 }		
				if(response['success'] == '1')
				{		
					$(".error_msg_bill").css("display","none");					
					alert(response['message']);		
					$("#add_new_billing").modal("hide");
					sessionStorage.setItem("is_reloaded", 1);
					location.reload(true);
				}
				else
				{				
					$(".error_text_bill").text(response['message']);
					$(".error_msg_bill").css("display","block");						
				}
				return false;			
			},
			error: function (response) {
				console.log('Error:', response);
			}
		});
	}
	
	$(".record_tab_head").click(function(){   	
			  if(!$(this).hasClass('disabled')){	
				  if($(this).attr("data-id") == "billing_detail"){
					  $(".billing_head").css("visibility","visible");
					  $(".left_btns").css("display","none");
				  }else if($(this).attr("data-id") == "view_record"){
					  $(".billing_head").css("visibility","hidden");
					  $(".left_btns").css("display","block");
				  }
			  }
		  });
	
	
	   function addmoreattachments(data){
		var html = $(data).prev().find("tr:last")[0].outerHTML;
		$(data).prev().find("tr:last").before(html);    
		$(data).prev().find("tr:not(:last-child)").css("display","table-row");  
		var length = $("#add_medical_record").find("#imaging_docs").find("tr:not(:first-child):visible").length;        
		$(data).prev().find("tr:eq("+(length)+")").find(".historyattachment").attr("id","historyattachment"+length);
		$(data).prev().find("tr:eq("+(length)+")").find(".historyattachmentlabel").attr('for',"historyattachment"+length);
	}
	
	function addmoremedicines(data){
		var html = $(data).prev().find("tr:last")[0].outerHTML;
		$(data).prev().find("tr:last").after(html);	
		$(data).prev().find("tr:last").css("display","table-row");	
	}
	function removemedications(data){
		$(data).parents('tr').remove();		
	}
	
	function removedbmedications(data){
		$(".error_msg_history").css("display","none");	
		var id = $(data).attr("data-id");
		var site_url = $('#site_url').text();
		var url = site_url+"/doctor/delete_history_medication/"+id;	
		$.ajax({				
			type: 'GET',
			url: url,	
			dataType: 'json',
			success: function (response) {		
				if(response['success'] == '1')
				{		
					$(data).parents('tr').remove();
					var length = $("#add_medical_record").find("#medications").find("tr:not(:first-child):visible").length;					
					if(length == 0){
						$(".add_medicine").trigger("click");
						$("#add_medical_record").find("#medications").find("tr:not(:first-child):visible").find(".delete_images").remove();					
					}											 				
				}
				else
				{				
					$(".error_text_history").text(response['message']);
					$(".error_msg_history").css("display","block");
				}		
							
			},
			error: function (response) {
				console.log('Error:', response);
			}
		});
			
	}
	
	function removeattachment(data){	
		$(data).parents('tr').remove();		
		var length = $("#add_medical_record").find("#imaging_docs").find("tr:not(:first-child):visible").length;
		for(var i=1;i<=length; i++){
			$("#imaging_docs").find(".patient_info_table").find("tr:eq("+(i)+")").find(".historyattachment").attr("id","historyattachment"+i);
		}
	}
	
	function removedbattachment(data){
		$(".error_msg_history").css("display","none");	
		var id = $(data).attr("data-id");
		var site_url = $('#site_url').text();
		var url = site_url+"/doctor/delete_history_images/"+id;	
		$.ajax({				
			type: 'GET',
			url: url,	
			dataType: 'json',
			success: function (response) {		
				if(response['success'] == '1')
				{		
					$(data).parents('tr').remove();		
					var length = $("#add_medical_record").find("#imaging_docs").find("tr:not(:first-child):visible").length;
	
					if(length > 0){
						for(var i=1;i<=length; i++){
							$("#imaging_docs").find(".patient_info_table").find("tr:eq("+(i)+")").find(".historyattachment").attr("id","historyattachment"+i);
						}
					}else{
						$(".add_attachment").trigger("click");
						$("#add_medical_record").find("#imaging_docs").find("tr:not(:first-child):visible").find(".delete_images").remove();
					}											 				
				}
				else
				{				
					$(".error_text_history").text(response['message']);
					$(".error_msg_history").css("display","block");
				}		
							
			},
			error: function (response) {
				console.log('Error:', response);
			}
		});
	}
	
	function openAttachmentImage(data,ext){
		var img_path = $(data).attr("data-img_path");	
		if(ext=="png"|| ext=="jpeg"|| ext=="jpg"){
		var html="<img src='"+img_path+"' class='img_path'>";
		}
		if(ext=="pdf"){
			var html=" <embed src='"+img_path+"#' width='500px' height='500px' />";
		}
		if(ext=="doc" || ext=="docx"){
			var html="<iframe src='https://docs.google.com/viewer?url="+img_path+"&embedded=true' width='500px' height='500px'></iframe>";
		}
	
		$(".attachment_img").html(html);
		$("#attachment_image").modal("show");
	
	}
	
		/*===================search form submit ========================== */
		$("#got").submit(function(event){
			var patient_name = $('#patient_name').val();
			var patient_name = patient_name.trim();
	
			var medical_record = $('#medical_record').val();
			var medical_record = medical_record.trim();
	
			var surename = $('#surename').val();
			var surename = surename.trim();
	
			var dob = $('#datepicker-1').val();
			var dob = dob.trim();
			if(medical_record==""){
			if(patient_name=="" || surename=="" ||dob==""  ){
			//if(patient_name=="" || medical_record=="" || surename=="" || dob==""){
				$(".messages").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text">Please Fill First Name,Surname,Date of Birth</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');		
					return false;
			}
		}
		});
		// Toggle switch radio button
		function getselectedtext(element){
			var id=$(element).attr("id");
			var isChecked = $("#"+id).prop('checked');
		if(isChecked==true){
			  $("[for="+id+"]").text("Deactive User");
		}else{
				  $("[for="+id+"]").text("Active User");
		}
	
		}
		function handleFileSelect(e) {
			
			
		if(!e.target.files) return;
			var error=0;
			$(".non_file").html("");
		var files = e.target.files;
		var length=files.length;
		if(length==1){
					jQuery("#text-show").append("<div class='non_file'>"+files[0].name+"</div>");
		}
		else{
						jQuery("#text-show").append("<div class='non_file'>"+length+" files</div>");
		}
							/*for(var i=0; i < length; i++) {
							var f = files[i];
							var filename=f.name;
							if(length==1){
							jQuery("#text-show").append("<li  style='list-style:none'>"+filename+"</li>");
							}
							var ext= filename.split('.').pop();
	
							/*	if(ext!="pdf"){
							error=1;
							}
							}
							alert("Only Pdf file are allowed");
							return false;*/
	
			
	}
	
	function viewProfile(id, role)
	{
		const hosp_id = $('#hospital_id').val();
		if(id && hosp_id){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var site_url = $('#site_url').text();
			$.ajax({				
				type: 'POST',
				url:  site_url+'/admin/view_hospital_user',
				data: {"id":id,"hospital_id":hosp_id,"role":role},		
				dataType: 'json',
				success: function (response) {
					console.log(response.data.doctor_email);
					if(response.data){
						$('#view_user').modal('show')
						if(role == 'doctor'){
							var data = `
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Email</label>
								<label class="col-6">${response.data.doctor_email ? response.data.doctor_email : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">First Name</label>
								<label class="col-6">${response.data.doctor_first_name ? response.data.doctor_first_name : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Middle Name</label>
								<label class="col-6">${response.data.doctor_middle_name ? response.data.doctor_middle_name : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Last Name</label>
								<label class="col-6">${response.data.doctor_last_name ? response.data.doctor_last_name : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Phone Number</label>
								<label class="col-6">${response.data.doctor_phone ? response.data.doctor_phone : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">User Name</label>
								<label class="col-6">${response.data.doctor_username ? response.data.doctor_username : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Folio Number</label>
								<label class="col-6">${response.data.folio_number ? response.data.folio_number : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Years Practised</label>
								<label class="col-6">${response.data.doctor_years_practised ? response.data.doctor_years_practised : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Hospital ID</label>
								<label class="col-6">${response.data.hospital_id ? response.data.hospital_id : ''}</label>
								</div>
							</div>
							`
							$('#view_user_body').html(data);
						}else if(role == 'nurse'){
							var data = `
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Email</label>
								<label class="col-6">${response.data.nurse_email ? response.data.nurse_email : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">First Name</label>
								<label class="col-6">${response.data.nurse_first_name ? response.data.nurse_first_name : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Middle Name</label>
								<label class="col-6">${response.data.nurse_last_name ? response.data.nurse_last_name : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Last Name</label>
								<label class="col-6">${response.data.nurse_middle_name ? response.data.nurse_middle_name : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Phone Number</label>
								<label class="col-6">${response.data.nurse_phone ? response.data.nurse_phone : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">User Name</label>
								<label class="col-6">${response.data.nurse_username ? response.data.nurse_username : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Hospital ID</label>
								<label class="col-6">${response.data.hospital_id ? response.data.hospital_id : ''}</label>
								</div>
							</div>
							`
							$('#view_user_body').html(data);
						}else if(role == 'admin'){
							var data = `
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Email</label>
								<label class="col-6">${response.data.administrator_email ? response.data.administrator_email : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Name</label>
								<label class="col-6">${response.data.administrator_name ? response.data.administrator_name : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Phone Number</label>
								<label class="col-6">${response.data.administrator_phone ? response.data.administrator_phone : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">User Name</label>
								<label class="col-6">${response.data.administrator_username ? response.data.administrator_username : ''}</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group col-12 row">
								<label class="col-6">Hospital ID</label>
								<label class="col-6">${response.data.hospital_id ? response.data.hospital_id : ''}</label>
								</div>
							</div>
							`
							$('#view_user_body').html(data);
						}
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
	
	function editProfile(id, role)
	{
		const hosp_id = $('#hospital_id').val();
		if(id && hosp_id){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var site_url = $('#site_url').text();
			$.ajax({				
				type: 'POST',
				url:  site_url+'/admin/view_hospital_user',
				data: {"id":id,"hospital_id":hosp_id,"role":role},		
				dataType: 'json',
				success: function (response) {
					console.log(response.data.doctor_email);
					if(response.data){
						if(role == 'doctor'){
							$('#add_doctor').modal('show')
							$('#doctorTitle,#submit_btn').html('Edit Doctor');
							$('#mode').val('EDIT');
							$('#doctor_title').val(response.data.doctor_title ? response.data.doctor_title : '');
							$('#doctor_first_name').val(response.data.doctor_first_name ? response.data.doctor_first_name : '');
							$('#doctor_middle_name').val(response.data.doctor_middle_name ? response.data.doctor_middle_name : '');
							$('#doctor_last_name').val(response.data.doctor_last_name ? response.data.doctor_last_name : '');
							$('#doctor_email').val(response.data.doctor_email ? response.data.doctor_email : '');
							$('#dr_ph').val(response.data.doctor_phone ? response.data.doctor_phone : '');
							$('#years_practised').val(response.data.doctor_years_practised ? response.data.doctor_years_practised : '');
							$('#doctor_gender').val(response.data.doctor_gender==1 ? 1 : 0);
							$('#doctor_role').val(response.data.doctor_role ? response.data.doctor_role : 'doctor');
							$('#biography').val(response.data.biography ? response.data.biography : '');
							$('#doctor_id').val(response.data.doctor_id ? response.data.doctor_id : '');
							$('#doctor_username').val(response.data.doctor_username ? response.data.doctor_username : '');
							$('#doctor_password').val('');
							var res = response.data.doctor_dob.split("-");
							$('#year').val(res[0] ?  res[0] : '');
							$('#select_day').val(res[1] ?  parseInt(res[1]) : '');
							$('#select_num').val(res[2] ?  parseInt(res[2]) : '');
							
							if(response.data.doctor_picture)
							{
								$('#preview-image').attr("src", site_url+'/doctorimages/'+response.data.doctor_picture);
							}
							$('#doctor_username').val(response.data.doctor_username ? response.data.doctor_username : '');
							// console.log("response.doctor_languages",response.data.doctor_languages);
							var languages = response.data.doctor_languages;
							if(languages){
								var lang = languages.split(",");
								lang.forEach(element => {
									$('.input_tags').find('#top').append('<li><div class="lang">'+element+'</div><span class="delete_lang"><i class="fa fa-close"></i></span></li>')
								});
							}
							$('#edu_school').val(response.data.doctor_education_school ? response.data.doctor_education_school : '');
							//Disabled Specialist
							if(response.data.doctor_speciality){
								$('#doctor_speciality').val(response.data.doctor_speciality ? response.data.doctor_speciality : '');
								$('.doctor_speciality select#doctor_speciality').prop('disabled', false);
								$('#Specialist a').addClass('checked');
							}else{
								$('.doctor_speciality select#doctor_speciality').prop('disabled', true);
							}
	
							//Disabled certified doctor
							if(response.data.folio_number || response.data.mdcn_register_no){
								$('#folio_number').val(response.data.folio_number ? response.data.folio_number : '');
								$('#mdcn_register_no').val(response.data.mdcn_register_no ? response.data.mdcn_register_no : '');
								$('.certified_doctormenu input#mdcn_register_no').prop('disabled', false);
								$('.certified_doctormenu input#folio_number').prop('disabled', false);
								$('#certifiedDoctor a').addClass('checked');
							}else{
								$('.certified_doctormenu input#mdcn_register_no').prop('disabled', true);
								$('.certified_doctormenu input#folio_number').prop('disabled', true);
							}
						}else if(role == 'nurse'){alert
							$('#add_nurse').modal('show')
							$('#nurseTitle,#Nurse_submit_btn').html('Edit Nurse');
							$('#mode').val('EDIT');
							$('#nurse_title').val(response.data.nurse_title ? response.data.nurse_title : '');
							$('#nurse_first_name').val(response.data.nurse_first_name ? response.data.nurse_first_name : '');
							$('#nurse_middle_name').val(response.data.nurse_middle_name ? response.data.nurse_middle_name : '');
							$('#nurse_last_name').val(response.data.nurse_last_name ? response.data.nurse_last_name : '');
							$('#nurse_email').val(response.data.nurse_email ? response.data.nurse_email : '');
							$('#nurse_ph').val(response.data.nurse_phone ? response.data.nurse_phone : '');
							$('#nurse_gender').val(response.data.nurse_gender ? response.data.nurse_gender : '');
							$('#nurse_role').val(response.data.nurse_role ? response.data.nurse_role : 'nurse');
							$('#nurse_id').val(response.data.nurse_id ? response.data.nurse_id : '');
							$('#nurse_username').val(response.data.nurse_username ? response.data.nurse_username : '');
							$('#nurse_password').val('');
							var res = response.data.nurse_dob.split("-");
							$('#nurseyear').val(res[0] ? res[0] : '');
							$('#nurseselect_day').val(res[1] ? parseInt(res[1]) : '');
							$('#nurseselect_num').val(res[2] ?  parseInt(res[2]) : '');
							if(response.data.nurse_picture)
							{
								$('#preview-image_nurse').attr("src", site_url+'/nurseimages/'+response.data.nurse_picture);
							}
							var languages = response.data.nurse_languages;
							if(languages){
								var lang = languages.split(",");
								lang.forEach(element => {
									$('.input_tags').find('.master_top').append('<li><div class="lang">'+element+'</div><span class="delete_lang"><i class="fa fa-close"></i></span></li>')
								});
							}
							
							$('.nurse_edu_school').val(response.data.nurse_education_school ? response.data.nurse_education_school : '');
	
						}else if(role == 'admin'){
							$('#add_administrator').modal('show')
							$('#adminTitle,#Admin_submit_btn').html('Edit Administrator');
							$('#mode').val('EDIT');
							$('#admin_title').val(response.data.administrator_title ? response.data.administrator_title : '');
							adminname = response.data.administrator_name.split(" ");
							$('#admin_first_name').val(adminname[0] ? adminname[0] : '');
							$('#admin_middlename').val(adminname[1] ? adminname[1] : '');
							$('#admin_last_name').val(adminname[2] ? adminname[2] : '');
							$('#admin_email').val(response.data.administrator_email ? response.data.administrator_email : '');
							$('#admin_ph').val(response.data.administrator_phone ? response.data.administrator_phone : '');
							$('#admin_gender').val(response.data.administrator_gender==1 ? 1 : 0);
							$('#admin_role').val(response.data.administrator_role ? response.data.administrator_role : 'admin');
							$('#admin_id').val(response.data.admin_id ? response.data.admin_id : '');
							$('#admin_username').val(response.data.administrator_username ? response.data.administrator_username : '');
							$('#admin_password').val('');
							if(response.data.administrator_picture)
							{
								$('#preview-image_admin').attr("src", site_url+'/administratorimages/'+response.data.administrator_picture);
							}
							var res = response.data.administrator_dob.split("-");
							$('#adminyear').val(res[0] ?  res[0] : '');
							$('#adminselect_day').val(res[1] ?  parseInt(res[1]) : '');
							$('#adminselect_num').val(res[2] ?  parseInt(res[2]) : '');
						}
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
	
	function getDealCategories(facility,category_id){
		var site_url = $('#site_url').text();  
		if(facility){
			$.ajax({
				type:"GET",
				url:site_url+"/admin/deals/get-categories?facility_id="+facility,
				success:function(res){               
					if(res){
						$("#deal_categories").empty();
						$("#deal_categories").append('<option value="">Select Category</option>');
						var selected = '';
						$.each(res,function(key,value){
							if(category_id == key){
								selected = 'selected';
							}
							$("#deal_categories").append('<option value="'+key+'" '+selected+'>'+value+'</option>');
							selected = '';
						});
					
					}else{
							$("#deal_categories").append('<option value="">Select Category</option>');
							$("#deal_categories").empty();
					}
				}
			});
		}else{
			$("#deal_categories").append('<option value="">Select Category</option>');
			$("#deal_categories").empty();
		}	
	}
	
		//remove removeDeal     
		function removeDeal(id)
		{
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this deal!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willDelete) => {
			if (willDelete) {
				var site_url = $('#site_url').text();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
	
				$.ajax({
					url: site_url+"/admin/deals/remove",
					type:'POST',
					data:{"id":id},
					success:function(response){
						if(response['redirect'] == 1){
							parent.location =result['redirect_url'];
							return false;
						}else if(response['success'] == 1){
							$('.alert-success-outline').show();
							$('.pending_success').text(response['message']);
	
							setTimeout(function() {
								location.reload();
							}, 1500);
						}else{
							$('.alert-danger-outline').show();
							$('.pending_danger').text('In Valid request!');
						}
					}
				});
	
			} else {
				swal("Your data is safe!");
			}
			}); 
		}
		//remove removeDeal     
		function removeHospital(id)
		{
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this hospital!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willDelete) => {
			if (willDelete) {
				var site_url = $('#site_url').text();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
	
				$.ajax({
					url: site_url+"/admin/hospital/remove",
					type:'POST',
					data:{"id":id},
					success:function(response){
						if(response['redirect'] == 1){
							parent.location =result['redirect_url'];
							return false;
						}else if(response['success'] == 1){
							$('.alert-success-outline').show();
							$('.pending_success').text(response['message']);
	
							setTimeout(function() {
								location.reload();
							}, 1500);
						}else{
							$('.alert-danger-outline').show();
							$('.pending_danger').text('In Valid request!');
						}
					}
				});
	
			} else {
				swal("Your data is safe!");
			}
			}); 
		}
	//remove removePatients     
	function removePatients(id)
	{
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this patients!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		  }).then((willDelete) => {
		if (willDelete) {
			var site_url = $('#site_url').text();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				url: site_url+"/admin/patients/remove",
				type:'POST',
				data:{"id":id},
				success:function(response){
					if(response['redirect'] == 1){
						parent.location =result['redirect_url'];
						return false;
					}else if(response['success'] == 1){
						$('.alert-success-outline').show();
						$('.pending_success').text(response['message']);

						setTimeout(function() {
							location.reload();
						}, 1500);
					}else{
						$('.alert-danger-outline').show();
						$('.pending_danger').text('In Valid request!');
					}
				}
			});

		} else {
			swal("Your data is safe!");
		}
		}); 
	}
	
	function viewDeal(id)
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
				url:  site_url+'/admin/deals/getDeal/'+id,		
				dataType: 'json',
				success: function (response) {
					if(response){
						$('#view_user').modal('show')
						var data = `
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Facility</label>
							<label class="col-6">${response.facility_details.name ? response.facility_details.name : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Category</label>
							<label class="col-6">${response.categories_details.name ? response.categories_details.name : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Start Date</label>
							<label class="col-6">${response.start_date ? response.start_date : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">End Date</label>
							<label class="col-6">${response.end_date ? response.end_date : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Title</label>
							<label class="col-6">${response.title ? response.title : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Previous Price</label>
							<label class="col-6">${response.previous_price ? response.previous_price : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Current Price</label>
							<label class="col-6">${response.current_price ? response.current_price : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">details</label>
							<label class="col-6">${response.details ? response.details : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Restriction</label>
							<label class="col-6">${response.restriction ? response.restriction : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">About Us</label>
							<label class="col-6">${response.about_us ? response.about_us : ''}</label>
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
	
	//editDeal
	function editDeal(id)
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
				url:  site_url+'/admin/deals/getDeal/'+id,	
				dataType: 'json',
				success: function (response) {
					if(response){
						console.log("response",response);
						
						$('#add_deal').modal('show')
						$('#dealTitle,#submit_deal_btn').html('Edit Deal');
						$('#mode').val('EDIT');
						$('#deal_id').val(response.id);
	
						$('#deal_facility').val(response.facility_id ? response.facility_id : '');
						if(response.DealCategories){
							response.DealCategories.forEach(element => {
								$('#deal_categories').append(`<option value="${element.id}"> ${element.name}  </option>`); 
							});
						}
						$('#deal_categories').val(response.category_id ? response.category_id : 0);
						// getDealCategories(response.facility_id,response.category_id);
						$('#title').val(response.title ? response.title : '');
						$('#previous_price').val(response.previous_price ? response.previous_price : '');
						$('#current_price').val(response.current_price ? response.current_price : '');
	
						var res = response.start_date.split("-");
						$('#year').val(res[0] ?  res[0] : '');
						$('#select_day').val(res[1] ?  parseInt(res[1]) : '');
						$('#select_num').val(res[2] ?  parseInt(res[2]) : '');
	
						var res2 = response.end_date.split("-");
						$('#deal_year').val(res2[0] ?  res2[0] : '');
						$('#deal_select_day').val(res2[1] ?  parseInt(res2[1]) : '');
						$('#deal_select_num').val(res2[2] ?  parseInt(res2[2]) : '');
						
						// $('#deal_categories').val(response.category_id ? response.category_id : '');
						$('#details').val(response.details ? response.details : '');
						$('#restriction').val(response.restriction ? response.restriction : '');
						$('#about_us').val(response.about_us ? response.about_us : '');
						if(response.image)
						{
							$('#preview-image_admin').attr("src", site_url+'/dealsimages/'+response.image);
						}
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
	
	//editHospital
	function editHospital(id)
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
				url:  site_url+'/admin/hospital/'+id,	
				dataType: 'json',
				success: function (response) {
					console.log("response",response);
					
					if(response){
						$('#add_hospital_lab').modal('show')
						$('#hospitalTitle').html('Edit Hospital/Laboratorium');
						$('#mode').val('EDIT');
						$('#hosp_id').val(response.hosp_id);
						
						$('#hosp_address').val(response.hosp_address ? response.hosp_address : '');
						$('#hosp_city').val(response.hosp_city ? response.hosp_city : '');
						$('#hosp_email').val(response.hosp_email ? response.hosp_email : '');
						$('#hosp_name').val(response.hosp_name ? response.hosp_name : '');
						$('#lga').val(response.lga ? response.lga : 0);
						if(response.localGovernment){
							response.localGovernment.forEach(element => {
								$('#lga').append(`<option value="${element.name}"> ${element.name}  </option>`); 
							});
						}
						if(response.speciality){
							response.speciality.forEach(element => {
								$('#hosp_speciality').append(`<option value="${element.name}"> ${element.name}  </option>`); 
							});
						}
						// alert(response.serviceofferd);
						
						if(response.serviceofferd !== null){
							var serviceofferd = response.serviceofferd.split(',');
							if(serviceofferd){
								serviceofferd.forEach(element => {							
									$("."+element.replace(' ','-')+ "+ a").addClass('checked'); 
									$("."+element.replace(' ','-')).prop('checked', true);
								});
							}
						}
					
						var hospital_hours = response.hospital_hours;
						if(hospital_hours!=null){
							if(hospital_hours.sunday){
								var sunday = jQuery.parseJSON(hospital_hours.sunday);
								$("#Sunday + a").addClass('checked'); 
								$("#Sunday").prop('checked', true);
								$('.sunday_from').val(sunday[0] ? sunday[0] : '');
								$('.sunday_to').val(sunday[1] ? sunday[1] : '');
								$('.sunday_from').removeAttr('disabled');
								$('.sunday_to').removeAttr('disabled');
							}
							if(hospital_hours.monday){
								var monday = JSON.parse(hospital_hours.monday);
								$("#Monday + a").addClass('checked'); 
								$("#Monday").prop('checked', true);
								$('.monday_from').val(monday[0] ? monday[0] : '');
								$('.monday_to').val(monday[1] ? monday[1] : '');
								$('.monday_from').removeAttr('disabled');
								$('.monday_to').removeAttr('disabled');
							}
							if(hospital_hours.tuesday){
								var tuesday = jQuery.parseJSON(hospital_hours.tuesday);
								$("#Tuesday + a").addClass('checked'); 
								$("#Tuesday").prop('checked', true);
								$('.tuesday_from').val(tuesday[0] ? tuesday[0] : '');
								$('.tuesday_to').val(tuesday[1] ? tuesday[1] : '');
								$('.tuesday_from').removeAttr('disabled');
								$('.tuesday_to').removeAttr('disabled');
							}
							if(hospital_hours.wednesday){
								var wednesday = jQuery.parseJSON(hospital_hours.wednesday);
								$("#Wednesday + a").addClass('checked'); 
								$("#Wednesday").prop('checked', true);
								$('.wednesday_from').val(wednesday[0] ? wednesday[0] : '');
								$('.wednesday_to').val(wednesday[1] ? wednesday[1] : '');
								$('.wednesday_from').removeAttr('disabled');
								$('.wednesday_to').removeAttr('disabled');
							}
							if(hospital_hours.thursday){
								var thursday = jQuery.parseJSON(hospital_hours.thursday);
								$("#Thursday + a").addClass('checked'); 
								$("#Thursday").prop('checked', true);
								$('.thursday_from').val(thursday[0] ? thursday[0] : '');
								$('.thursday_to').val(thursday[1] ? thursday[1] : '');
								$('.thursday_from').removeAttr('disabled');
								$('.thursday_to').removeAttr('disabled');
							}
							if(hospital_hours.friday){
								var friday = jQuery.parseJSON(hospital_hours.friday);
								$("#Friday + a").addClass('checked'); 
								$("#Friday").prop('checked', true);
								$('.friday_from').val(friday[0] ? friday[0] : '');
								$('.friday_to').val(friday[1] ? friday[1] : '');
								$('.friday_from').removeAttr('disabled');
								$('.friday_to').removeAttr('disabled');
							}
							if(hospital_hours.saturday){
								var saturday = jQuery.parseJSON(hospital_hours.saturday);
								$("#Saturday + a").addClass('checked'); 
								$("#Saturday").prop('checked', true);
								$('.saturday_from').val(saturday[0] ? saturday[0] : '');
								$('.saturday_to').val(saturday[1] ? saturday[1] : '');
								$('.saturday_from').removeAttr('disabled');
								$('.saturday_to').removeAttr('disabled');
							}
						}
						
						$('#hosp_state').val(response.hosp_state ? response.hosp_state : 0);
						$('#type_of_facility').val(response.type_of_facility ? response.type_of_facility : 0);
						$('#hosp_speciality').val(response.hosp_speciality ? response.hosp_speciality : 0);
						$('#point_first_name').val(response.point_first_name ? response.point_first_name : '');
						$('#point_surname').val(response.point_surname ? response.point_surname : '');
						$('#point_email').val(response.point_email ? response.point_email : '');
						$('#point_phone').val(response.point_phone ? response.point_phone : '');
						$('#point2_surname').val(response.point2_surname ? response.point2_surname : '');
						$('#point2_first_name').val(response.point2_first_name ? response.point2_first_name : '');
						$('#point2_email').val(response.point2_email ? response.point2_email : '');
						$('#point2_phone').val(response.point2_phone ? response.point2_phone : '');
						$('#name_of_facility').val(response.hosp_name ? response.hosp_name : '');
						$('#patient_phone').val(response.hosp_phone ? response.hosp_phone : '');
						$('#hospital_state_nigeria').val(response.hosp_state ? response.hosp_state : '');
	
						$('#lga').val(response.lga ? response.lga : '');
						$('#hmo').val(response.hmo ? JSON.parse(response.hmo) : '').trigger('change');
						$('#hosp_phone').val(response.hosp_phone ? response.hosp_phone : '');
						// console.log(JSON.parse(response.hmo));
						
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
	
	//viewHospital
	function viewHospital(id)
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
				url:  site_url+'/admin/hospital/'+id,	
				dataType: 'json',
				success: function (response) {
					if(response){
						$('#view_user').modal('show')
						var data = `
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Name</label>
							<label class="col-6">${response.hosp_name ? response.hosp_name : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Email</label>
							<label class="col-6">${response.hosp_email ? response.hosp_email : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Phone</label>
							<label class="col-6">${response.hosp_phone ? response.hosp_phone : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Address</label>
							<label class="col-6">${response.hosp_address ? response.hosp_address : ''} ${response.hosp_state ? response.hosp_state : ''} ${response.hosp_city ? response.hosp_city : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Local Governments</label>
							<label class="col-6">${response.lga ? response.lga : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Type of Facility</label>
							<label class="col-6">${response.type_of_facility ? response.type_of_facility : ''}</label>
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
	//view emp
	function view_emp(id)
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
				url:  site_url+'/admin/employee/'+id,		
				dataType: 'json',
				success: function (response) {
					if(response){
						$('#view_user').modal('show')
						var data = `
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Name</label>
							<label class="col-6">${response.first_name ? response.first_name : ''} ${response.last_name ? response.last_name : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Email</label>
							<label class="col-6">${response.email ? response.email : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Phone</label>
							<label class="col-6">${response.employee_phone ? response.employee_phone : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Address</label>
							<label class="col-6">${response.employee_address ? response.employee_address : ''} ${response.employee_state ? response.employee_state : ''} ${response.employee_city ? response.employee_city : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Gender</label>
							<label class="col-6">${response.employee_gender==0 ? "Male" : 'Female'}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Marital Status</label>
							<label class="col-6">${response.employee_marital_status==0 ? "Single" : 'Married'}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">State of Origin</label>
							<label class="col-6">${response.state_of_origin ? response.state_of_origin : ''}</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group col-12 row">
							<label class="col-6">Position</label>
							<label class="col-6">${response.position ? response.position : ''}</label>
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
	
	//edit emp
	function edit_emp(id)
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
				url:  site_url+'/admin/employee/'+id,
				dataType: 'json',
				success: function (response) {
					if(response){
						$('#add_employee').modal('show')
						$('#empTitle,#submit_emp_btn').html('Edit Employee');
						$('#mode').val('EDIT');
						$('#employee_id').val(response.employee_id);
	
						// $('#passwordDIV').hide();
						$('#employee_title').val(response.employee_title ? response.employee_title : '');
						$('#first_name').val(response.first_name ? response.first_name : '');
						$('#middle_name').val(response.employee_middle_name ? response.employee_middle_name : '');
						$('#surname').val(response.last_name ? response.last_name : '');
						$('#employee_email').val(response.email ? response.email : '');
						$('#employee_phone').val(response.employee_phone ? response.employee_phone : '');
						$('#employee_alternative_phone').val(response.employee_alternative_phone ? response.employee_alternative_phone : '');
						$('#username').val(response.username ? response.username : '');
						$('#emp_address').val(response.employee_address ? response.employee_address : '');
						$('#employee_title').val(response.employee_title ? response.employee_title : '');
						$('#hospital_state_nigeria').val(response.employee_state ? response.employee_state : '');
						$('#employee_city').val(response.employee_city ? response.employee_city : '');
						$('#emp_gender').val(response.employee_gender==0 ? 0 : 1);
						$('#emp_marital_status').val(response.employee_marital_status==0 ? 0 : 1);
						$('#state_of_origin').val(response.state_of_origin ? response.state_of_origin : '');
						$('#position').val(response.position ? response.position : '');
						$('#nextofkin_first_name').val(response.nextofkin_first_name ? response.nextofkin_first_name : '');
						$('#nextofkin_surname').val(response.nextofkin_surname ? response.nextofkin_surname : '');
						$('#nextofkin_phone').val(response.nextofkin_phone ? response.nextofkin_phone : '');
						$('#reference_first_name').val(response.reference_first_name ? response.reference_first_name : '');
						$('#reference_surname').val(response.reference_surname ? response.reference_surname : '');
						$('#reference_phone').val(response.reference_phone ? response.reference_phone : '');
						$('#reference2_first_name').val(response.reference2_first_name ? response.reference2_first_name : '');
						$('#reference2_surname').val(response.reference2_surname ? response.reference2_surname : '');
						$('#reference2_phone').val(response.reference2_phone ? response.reference2_phone : '');
						$('#emp_id').val(response.employee_id ? response.employee_id : '');
						$('#entry_patient_data').val(response.access_to_hospital ? response.access_to_hospital : '');
						$('#access_entry_patient_record').val(response.access_to_patient_record ? response.access_to_patient_record : '');
						$('#select_num').val(response.select_day ? response.select_day : '');
						$('#select_day').val(response.select_month ? response.select_month : '');
						$('#year').val(response.select_year ? response.select_year : '');
						console.log(response.employee_languages);
						var languages = response.employee_languages;
						if(languages){
							var lang = languages.split(",");
							lang.forEach(element => {
								$('.input_tags').find('#top').append('<li><div class="lang">'+element+'</div><span class="delete_lang"><i class="fa fa-close"></i></span></li>')
							});
						}
						$('#employee_education_school').val(response.employee_education_school ? response.employee_education_school : '');
						if(response.employee_picture)
						{
							$('#preview-image').attr("src", site_url+'/employeeimages/'+response.employee_picture);
						}
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
	
	
	function filterDeals(value){
	 if(value != 0 && value != '' && value != null){
		var site_url = $('#site_url').text();
		window.location.href = site_url+'/admin/deals?filter='+value; 
	 }
	}
	function filterAppointment(value){
		if(value != 0 && value != '' && value != null){
		   var site_url = $('#site_url').text();
		   window.location.href = site_url+'/admin/appointment?filter='+value; 
		}
	}
	function filterHealthRecord(value){
		if(value != 0 && value != '' && value != null){
		   var site_url = $('#site_url').text();
		   window.location.href = site_url+'/admin/health-record?filter='+value; 
		}
	}
	var timer;
	$("#doctor_languages").keydown(function(e) {
		clearTimeout(timer);
		var $this = $(this);
		timer = setTimeout(function(event) {
			var input = $this.val();
			var str = input.split(",");
			if (e.keyCode === 13) {
				$this.val('');
				for (var i = 0; i < str.length; i++) {
					var count = 0;
					if ($.trim(str[i]) != "") {
						$("#top").find(".lang").each(function() {
							if ($.trim(str[i]) == $(this).text()) {
								count = 1;
							}
						});
						if (count == 0) {
							$("#top").append("<li><div class='lang'>" + $.trim(str[i]) + "</div><span class='delete_lang'><img src='../../admin/doctor/images/x_tag.svg'></span></li>");
						}
					}
				}
			} else if (e.keyCode === 188) {
				for (var i = 0; i < str.length; i++) {
					var count = 0;
					if ($.trim(str[i]) != "") {
						$("#top").find(".lang").each(function() {
							if ($.trim(str[i]) == $(this).text()) {
								count = 1;
							}
						});
						if (count == 0) {
							$("#top").append("<li><div class='lang'>" + $.trim(str[i]) + "</div><span class='delete_lang'><img src='../../admin/doctor/images/x_tag.svg'></span></li>");
						}
					}
				}
			}
		}, 500);
		if (e.keyCode == 13) {
			return false;
		}
	});
	
	$("#doctor_languages").focusout(function(e) {
		var input = $(this).val();
		var str = input.split(",");
		$(this).val('');
		for (var i = 0; i < str.length; i++) {
			var count = 0;
			if ($.trim(str[i]) != "") {
				$("#top").find(".lang").each(function() {
					if ($.trim(str[i]) == $(this).text()) {
						count = 1;
					}
				});
				if (count == 0) {
					$("#top").append("<li><div class='lang'>" + $.trim(str[i]) + "</div><span class='delete_lang'><img src='../../admin/doctor/images/x_tag.svg'></span></li>");
				}
			}
		}
	});
	
	$('#doctor_languages').keyup(function() {
		var caps = jQuery('#doctor_languages').val();
		caps = caps.charAt(0).toUpperCase() + caps.slice(1);
		caps = capitalize_Words(caps);
		jQuery('#doctor_languages').val(caps);
	});
	
	
	
	
	var timer;
	$(".master_languages").keydown(function(e) {
		clearTimeout(timer);
		var $this = $(this);
		timer = setTimeout(function(event) {
			var input = $this.val();
			var str = input.split(",");
			if (e.keyCode === 13) {
				$this.val('');
				for (var i = 0; i < str.length; i++) {
					var count = 0;
					if ($.trim(str[i]) != "") {
						$(".master_top").find(".lang").each(function() {
							if ($.trim(str[i]) == $(this).text()) {
								count = 1;
							}
						});
						if (count == 0) {
							$(".master_top").append("<li><div class='lang'>" + $.trim(str[i]) + "</div><span class='delete_lang'><img src='../../admin/doctor/images/x_tag.svg'></span></li>");
						}
					}
				}
			} else if (e.keyCode === 188) {
				for (var i = 0; i < str.length; i++) {
					var count = 0;
					if ($.trim(str[i]) != "") {
						$(".master_top").find(".lang").each(function() {
							if ($.trim(str[i]) == $(this).text()) {
								count = 1;
							}
						});
						if (count == 0) {
							$(".master_top").append("<li><div class='lang'>" + $.trim(str[i]) + "</div><span class='delete_lang'><img src='../../admin/doctor/images/x_tag.svg'></span></li>");
						}
					}
				}
			}
		}, 500);
		if (e.keyCode == 13) {
			return false;
		}
	});
	
	$(".master_languages").focusout(function(e) {
		var input = $(this).val();
		var str = input.split(",");
		$(this).val('');
		for (var i = 0; i < str.length; i++) {
			var count = 0;
			if ($.trim(str[i]) != "") {
				$(".master_top").find(".lang").each(function() {
					if ($.trim(str[i]) == $(this).text()) {
						count = 1;
					}
				});
				if (count == 0) {
					$(".master_top").append("<li><div class='lang'>" + $.trim(str[i]) + "</div><span class='delete_lang'><img src='../../admin/doctor/images/x_tag.svg'></span></li>");
				}
			}
		}
	});
	
	$('.master_languages').keyup(function() {
		var caps = jQuery('.master_languages').val();
		caps = caps.charAt(0).toUpperCase() + caps.slice(1);
		caps = capitalize_Words(caps);
		jQuery('.master_languages').val(caps);
	});
	$('.hmo_select').select2({
		placeholder: "Select a HMO",
		allowClear: true,
		width: '100%',
	   
	 });