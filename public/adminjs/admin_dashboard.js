var myWindow;
$(document).ready(function(){	
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
	 		
		}
	});	

	

		var pageURL = window.location.href;
		var appointment_id=	pageURL.substring(pageURL.lastIndexOf('/') + 1);

	$.ajax({
	 	url: site_url+"/admin/all_appointments_ajax",
	 	type:'GET',
	  	data:{doctor_id:appointment_id},
	 	success:function(result){
	 		console.log(123);
	 		if(result['redirect'] == 1){
	 			parent.location =result['redirect_url'];
                return false;
	 		}
	 		if(result.length){
	 			 	$("#all_appointments").html(result);
	 		}
	 		else{
	 			$("#all_appointments").html("<p>No Appointments</p>");
	 		}
		
		}
	});
	//});

	$(document).on('click',".next2",function(){
		 var url1 =$(this).attr("data-url");
		 $(this).attr("href","javascript:void(0);");
		 var pageURL = window.location.href;
		 var appointment_id="";
		appointment_id=	pageURL.substring(pageURL.lastIndexOf('/') + 1);
		 //~ alert(url1);
		 $.ajax({
			url:url1,
			type:'GET',
			data:{"_token": $('meta[name="csrf-token"]').attr('content'),doctor_id:appointment_id},
			success:function(result){
				
				 if(result['redirect'] == 1){
		 		parent.location =result['redirect_url'];
	                return false;
		 		}
		 	console.log(result,'result');
		 	// return;
		 	$("#all_appointments").html('');
				$("#all_appointments").html(result);
			}
		});
		 
	});
	
	$(document).on('click',".pre2",function(){
		 var url1 =$(this).attr("data-url");
		 $(this).attr("href","javascript:void(0);");
		 var appointment_id="";
		appointment_id=	pageURL.substring(pageURL.lastIndexOf('/') + 1);
		 //~ alert(url1);
		 $.ajax({
			url:url1,
			type:'GET',
			data:{"_token": $('meta[name="csrf-token"]').attr('content'),doctor_id:appointment_id},
			success:function(result){
				if(result['redirect'] == 1){
		 			parent.location =result['redirect_url'];
	                return false;
		 		}
				$("#all_appointments").html(result);
			}
		});
		 
	});		 

	$(document).on('click',".next_bill",function(){
		 var url1 =$(this).attr("data-url");
		 $(this).attr("href","javascript:void(0);");
		 var $this = $(this);
		 var  all_page_no ="";
		 var  out_page ="";
		 var  paid_page ="";

		 var sort_id = $(".sort_active").attr("data-id");
		 
		 if(url1.indexOf("all_page") > -1) {
		 	out_page = $(".out_hidden").val();
		 	paid_page = $(".paid_hidden").val();
		 	var data = {"out_page": out_page, "paid_page":paid_page,'sort_id':sort_id};
		 }else if(url1.indexOf("out_billings") > -1) {
		 	all_page_no = $(".all_hidden").val();
		 	paid_page = $(".paid_hidden").val();
		 	var data = {"all_page_no": all_page_no, "paid_page":paid_page,'sort_id':sort_id};
		 }else if(url1.indexOf("paid_billings") > -1) {
		 	out_page = $(".out_hidden").val();
		 	all_page_no = $(".all_hidden").val();
		 	var data = {"out_page": out_page, "all_page_no":all_page_no,'sort_id':sort_id};
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
	
	$(document).on('click',".pre_bill",function(){
		 var url1 =$(this).attr("data-url");
		 $(this).attr("href","javascript:void(0);");
		 var $this = $(this);
		 var  all_page_no ="";
		 var  out_page ="";
		 var  paid_page ="";
		 var sort_id = $(".sort_active").attr("data-id");
		 if(url1.indexOf("all_page") > -1) {
		 	out_page = $(".out_hidden").val();
		 	paid_page = $(".paid_hidden").val();
		 	var data = {"out_page": out_page, "paid_page":paid_page,'sort_id':sort_id};
		 }else if(url1.indexOf("out_billings") > -1) {
		 	all_page_no = $(".all_hidden").val();
		 	paid_page = $(".paid_hidden").val();
		 	var data = {"all_page_no": all_page_no, "paid_page":paid_page,'sort_id':sort_id};
		 }else if(url1.indexOf("paid_billings") > -1) {
		 	out_page = $(".out_hidden").val();
		 	all_page_no = $(".all_hidden").val();
		 	var data = {"out_page": out_page, "all_page_no":all_page_no,'sort_id':sort_id};
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

	$("#setup_availability").on('shown.bs.modal', function () {		
		//availbilityDateUpdate();			
		$('.availability_date').datepicker('update','');
		$('.start_time').children('option:enabled').eq(0).prop('selected',true);
		$('.end_time').children('option:enabled').eq(0).prop('selected',true);
		var active =$("#setup_availability").find(".tabs_main").find(".active").attr("href");		
		$(active).find(".availability_date").find(".prev").removeClass("date_disable");			
		if($(active).find(".availability_date").find(".prev").css("visibility") == "hidden"){
			$(active).find(".availability_date").find(".prev").addClass("date_disable");
		}else{
			$(active).find(".availability_date").find(".prev").removeClass("date_disable");
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
	$("#setup_availability").on('hidden.bs.modal', function () {	
		$('.availability_date').datepicker('update','');		
		$('.start_time').children('option:enabled').eq(0).prop('selected',true);
		$('.end_time').children('option:enabled').eq(0).prop('selected',true);
	});	

	$(".availability_date").children().on('click',function(e){	
		$('.start_time').children('option:enabled').eq(0).prop('selected',true);
		$('.end_time').children('option:enabled').eq(0).prop('selected',true);
		var $this = $(this);	
		setTimeout(function(){		
			if(e.target.nodeName != 'TD'){					
				if($this.find(".datepicker-days").find("tbody").find(".today").length > 0 && ($this.find(".datepicker-days").css("display") == "block" && $this.find(".datepicker-days").find("tbody").find(".today").css("display") == "table-cell")){							
					$(".hidden_date").val(new Date().toDateString());				
				}
			}
			var active =$("#setup_availability").find(".tabs_main").find(".active").attr("href");	
			$(active).find(".availability_date").find(".prev").removeClass("date_disable");		
			if($(active).find(".availability_date").find(".prev").css("visibility") == "hidden"){			
				$(active).find(".availability_date").find(".prev").addClass("date_disable");
			}else{			
				$(active).find(".availability_date").find(".prev").removeClass("date_disable");
			} 
			//availbilityDateUpdate();
		},100);	
				
	});

	$("#setup_availability").find(".tabs_head").on('click',function(){	
		setTimeout(function(){
			var active =$("#setup_availability").find(".tabs_main").find(".active").attr("href");		
			$(active).find(".availability_date").find(".prev").removeClass("date_disable");		
			if($(active).find(".availability_date").find(".prev").css("visibility") == "hidden"){			
				$(active).find(".availability_date").find(".prev").addClass("date_disable");
			}else{			
				$(active).find(".availability_date").find(".prev").removeClass("date_disable");
			} 
		},100);
				
	});
	
	/*var _wasPageCleanedUp = false;
	$(window).on("beforeunload", function() {
		var doctor_id = $(".doctor_id").val();	   
		checkConnect(doctor_id);		
		if(_wasPageCleanedUp == false){   
			return 'Are you sure you want to leave? This will call all your calls';	
		}else{
			return '';
		}	
    });	
	*/
    $(window).on("unload",function(){
    	myWindow.close();
	});


});

function availbilityDateUpdate(data){		
	var appoint_date = $(data).find("#hidden_date").val();		
	var book_id = $(data).find("#hidden_book_id").val();
	var site_url = $('#site_url').text();
	var url = site_url+"/doctor/reshedule_detail";	
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
			    a=formatDate(event.date);
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

function updateAppointment(data){
	var site_url = $('#site_url').text();
	var url = site_url+"/doctor/update_appointments";
	var  appoint_date = $(data).parents("#reschedule_appointment").find(".hidden_date").val();	
	var patient_id = $(data).parents("#reschedule_appointment").find(".hidden_patient_id").val();
	var  book_id = $(data).parents("#reschedule_appointment").find(".hidden_book_id").val();	
	var  appoint_time = $(data).parents("#reschedule_appointment").find(".appoint_time option:selected").val();
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({				
		type: 'POST',
		url: url,	
		data:{'appoint_date':appoint_date,'book_id':book_id,'appoint_time':appoint_time,"patient_id":patient_id},	
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
function sortDoctorAppointments(data){		
	if($("option:selected",data).val() != "" && typeof $("option:selected",data).val() !== typeof undefined ){
		var appoint_time = $("option:selected",data).val();
	}else{
		var appoint_time = "";
	}
	var pageURL = window.location.href;
		var appointment_id=	pageURL.substring(pageURL.lastIndexOf('/') + 1);
	var site_url = $('#site_url').text();
	if(appoint_time != "" && typeof appoint_time !== typeof undefined ){
		var url = site_url+"/admin/all_appointments_ajax/"+appoint_time+"?doctor_id="+appointment_id;
	}else{
		var url = site_url+"/admin/all_appointments_ajax?doctor_id="+appointment_id;
	}
	$.ajax({				
		type: 'GET',
		url: url,		
		dataType: 'html',
		success: function (response) {		
			if(response['redirect'] == 1){
	 			parent.location =result['redirect_url'];
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

function callPatient(data){
	var status = navigator.onLine;
	if (status) {	
	}else{
	alert("You are not connected to the internet. Check your network connection.");
	return false;
	}
	$(data).attr("disabled",true);
	var doctor_id = $(data).attr("data-doctor_id");
	var call_type = $(data).attr("data-call_type");
	var appoint_id = $(data).attr("data-appoint_id");
	var patient_id = $(data).attr("data-patient_id");
	var site_url = $('#site_url').text();
	var url = site_url+"/doctor/tokbox_connection";	
	myWindow = window.open(site_url+"/doctor/initiating_call/"+appoint_id,'Render Health','height='+screen.availHeight+',width='+screen.availWidth);
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({
		url:url,
		type:'POST',
		data:{"doctor_id": doctor_id,"appoint_id":appoint_id},		
    	async: false,
		success:function(result){	
			if(result['redirect'] == 1){
	 			parent.location =result['redirect_url'];
                return false;
	 		}
	 		setTimeout(function(){ myWindow.open(site_url+"/doctor/calling_patient/"+result['call_id']+"/"+appoint_id+"/"+result['doctor_id']+"/"+patient_id+"/"+call_type,'Render Health','height='+screen.availHeight+',width='+screen.availWidth); }, 1000);
			
						
		},
		
	});
}

function cancelBooking(data){
	var book_id = $(data).attr("data-booking_id");
	var patient_id = $(data).attr("data-patient_id");
	var site_url = $('#site_url').text();
	var url = site_url+"/doctor/cancel_booking";	
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({
		url:url,
		type:'POST',
		data:{"book_id": book_id,"patient_id":patient_id},		
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
function cancelBookingForAdmin(data){
	var book_id = $(data).attr("data-booking_id");
	var patient_id = $(data).attr("data-patient_id");
	var site_url = $('#site_url').text();
	var doctor_id = $(data).attr("data-doctor_id");
	var url = site_url+"/admin/cancel_booking";	
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({
		url:url,
		type:'POST',
		data:{"book_id": book_id,"patient_id":patient_id},		
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

function resheduleBooking(data){	
	var appoint_date = $(data).attr("data-appoint_date");	
	var book_id = $(data).attr("data-booking_id");
	var site_url = $('#site_url').text();
	var url = site_url+"/doctor/reshedule_detail";	
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
			    a=formatDate(event.date);
			    $("#hidden_date").val(a);
			    availbilityDateUpdate($("#reschedule_appointment"));
			});
						
		},
		
	});
	
}

function resheduleBookingForAdmin(data){	
	var appoint_date = $(data).attr("data-appoint_date");	
	var book_id = $(data).attr("data-booking_id");
	var site_url = $('#site_url').text();
	var doctor_id = $(data).attr("data-doctor_id");
	var url = site_url+"/admin/reshedule_detail";	
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({
		url:url,
		type:'POST',
		data:{"book_id": book_id,"appoint_date":appoint_date,'doctor_id':doctor_id},		
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
			    a=formatDate(event.date);
			    $("#hidden_date").val(a);
			    availbilityDateUpdate($("#reschedule_appointment"));
			});
						
		},
		
	});
	
}

function sortbillings(data){
	$(".sort_options").find("a").removeClass("sort_active");
	var sort_id = $(data).attr("data-id");	
	var type= $(".billing_type").find(".active").attr("data-type");
	var sort_text= $(data).text();

	if(type == "all_page"){
		var data = {'sort_id':sort_id,"type":type,"page":1,'out_page':1,"paid_page":1};
	}else if(type == "out_billings"){
		var data = {'sort_id':sort_id,"type":type,"all_page_no":1,'page':1,"paid_page":1}
	}else if(type == "paid_billings"){
		var data = {'sort_id':sort_id,"type":type,"all_page_no":1,'out_page':1,"page":1}
	} 
	
	var site_url = $('#site_url').text();
	$(this).attr("href","javascript:void(0);");
	var $this = $(this); 
	$(data).addClass("sort_active");
	 //~ alert(url1);
	$.ajax({
		url: window.location.href,
		type:'GET',
		data:data,
		success:function(result){
			if(result['redirect'] == 1){
	 			parent.location =result['redirect_url'];
	            return false;
	 		}
			$(".main_div").html(result);
			$(".sort_bill").text(sort_text);
		}
	});

}