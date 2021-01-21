$(document).ready(function(){
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
					$(".main_history_div").html(result);
				}
			});
		}
			 
	});
});

function historydetail(data){
	var id= $(data).attr("data-id");
	var site_url = $('#site_url').text();
	parent.location = site_url+'/patient/history_detail/'+id;	
}

function sortHealthHistory(data){
	var val = $(".history_mnth option:selected").val();
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

	var url = site_url+"/patient/health_history_list/"+val+"/"+JSON.stringify(spe)+"/"+hosp;	
	$.ajax({				
		type: 'GET',
		url: url,	
		dataType: 'html',
		success: function (response) {			
			$(".main_history_div").html(response);			
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}

function resetfilters(data){	
	$(".doc_speciality").each(function(){
		$(this).prettyCheckable('uncheck');
	});
	$(".hosp_list").val("");
	sortHealthHistory(data);
}


function openAttachmentImage(data){
	var img_path = $(data).attr("data-img_path");	
	var html="<img src='"+img_path+"' class='img_path'>";
	$(".attachment_img").html(html);
	$("#attachment_image").modal("show");
}

// Send records

function sendrecord(history_id){
		var formdata=$( "#send_record_form" ).serialize();
		console.log(formdata);
		var site_url = $('#site_url').text();
		var email=$("#email_record").val();
		if(email==""){
		alert("Email address is required");
		return false;
		}else{
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
		{

		}
		else{
		alert("You have entered an invalid email address!")
		return false;
		}
		}

	var url = site_url+"/patient/send_records";	
		$(".loader-image").show();
		$(".button-record").attr("disabled", true);
	$.ajax({				
		type: 'POST',
		url: url,	
		dataType: 'json',
		data:formdata+'&history_id='+history_id,
		success: function (response) {	
			$(".loader-image").hide();

		alert("Records send successfully");	
		$('#send_record').modal('toggle');
		$("#email_record").val("");
			$(".button-record").attr("disabled", false);
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});

}