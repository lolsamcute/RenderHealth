$(document).ready(function(){
	if($(".health_edit_date").length > 0){
		var val = $(".health_edit_date").attr("data-date");	
		var date = new Date(val); 	
	    date = date.getDate()-1;    
		$('.health_edit_date').datepicker({
	        startDate: val.toLocaleString(),
	        endDate: val.toLocaleString(),
	        format: 'dd MM yyyy'	        
	    });
	}
	$(".health_diary_date").find(".prev").removeClass("date_disable");
	if($(".health_diary_date").find(".prev").css("visibility") == "hidden"){
		$(".health_diary_date").find(".prev").addClass("date_disable");
	}else{
		$(".health_diary_date").find(".prev").removeClass("date_disable");
	}

	$(".health_diary_date").find(".next").removeClass("date_disable");
	if($(".health_diary_date").find(".next").css("visibility") == "hidden"){
		$(".health_diary_date").find(".next").addClass("date_disable");
	}else{
		$(".health_diary_date").find(".next").removeClass("date_disable");
	}

	var timer;
    $("#patient_medication").keydown(function(e){
    console.log(000); 
    	clearTimeout(timer);
      	var $this =$(this);      	
      	timer = setTimeout(function (event) {      		
      		var site_url = $('#site_url').text();
	        var input = $this.val();
	        var str = input.split(",");	        
	        if (e.keyCode === 13) {	
	        console.log(111);  
	        	$this.val('');      	       	
		        for(var i =0 ; i< str.length; i++){
		          	var count =0;
		          	if($.trim(str[i]) != ""){
		            	$(".medi_parent").find(".medi").each(function(){		            		
		              		if(ucwords(str[i]) == $(this).text()){
		                	count =1;
		              	}
		            });		            
		            if(count == 0){         
		              $(".medi_parent").append("<li><div class='medi'>"+ ucwords(str[i]) +"</div><span class='delete_medi'><img src='"+site_url+"/admin/doctor/images/x_tag.svg'></span></li>");
		            }
		          }
		        }
      		}else if (e.keyCode === 188) { 
      		console.log(222);     			    			        
		        for(var i =0 ; i< str.length; i++){
		          	var count =0;
		          	if($.trim(str[i]) != ""){
		            	$(".medi_parent").find(".medi").each(function(){   
		              		if(ucwords(str[i]) == $(this).text()){
		                	count =1;
		              	}
		            });
		           
		            if(count == 0){         
		              $(".medi_parent").append("<li><div class='medi'>"+ ucwords(str[i]) +"</div><span class='delete_medi'><img src='"+site_url+"/admin/doctor/images/x_tag.svg'></span></li>");
		            }
		          }
		        }
		    }	       
	        
	      }, 1000);
  	});

  	$(window).on("unload",function(){
    	$(".error_msg_tele").css("display","none");    	
    	if($(".submit_btn").attr("data-click") == "" || typeof $(".submit_btn").attr("data-click") === typeof undefined){
    		$(".add_diary_parent").find(".diary_image_unit").each(function(){    		
	    		if( $(this).attr("data-db") == "" || typeof $(this).attr("data-db") === typeof undefined){
					var val = $(this).attr("data-attach_path");
					var $this = $(this);
					var site_url = $('#site_url').text();
					var url = site_url+"/patient/delete_add_diary_image";
					$.ajaxSetup({
						headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
					});
					$.ajax({				
						type: 'POST',
						url: url,	
						data:{'val':val},
						dataType: 'json',
						success: function (response) {	
							if(response['success'] == 1){		
								$this.remove();							
							}else{
								$(".error_text_tele").text(response['message']);
								$(".error_msg_tele").css("display","block");
							}		
						},
						error: function (response) {
							console.log('Error:', response);
						}
					});
				}
			});
		}
		
	});

  	$(document).on('click','.delete_medi',function(e) {          
        $(this).closest('li').remove();
      	var val = "";
        $(".medi_parent").find(".medi").each(function(){
	       	if(val == ""){
	        	val = $(this).text();
	        }else{
	        	val = val+","+$(this).text();
      		}
      	});
      	$("#patient_medication").val(val);
    });

    var $error_modal_msg = $("#error_msg_tele");
	$error_modal_msg.on("close.bs.alert", function () {
		$error_modal_msg.hide();
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
					$(".main_diary_div").html(result);
				}
			});
		}
			 
	});
	/*$("#add_more_image").change(function() {
	    readURL(this);
	});*/
		
});

/*==================preview Image =============== */
function readURL(input) {
  	if (input.files && input.files[0]) {
    	var reader = new FileReader();
      		reader.onload = function(e) {
      		var site_url = $('#site_url').text();
        	$('.add_diary_parent').append('<div class="diary_image_unit"><img src="'+e.target.result+'" alt="image"><span class="delete_image"><img src="'+site_url+'/admin/doctor/images/delete_image.svg" alt="icon"></span></div>');
      	}
     	reader.readAsDataURL(input.files[0]);
  	}
}	

function deleteAddDiaryImages(data){
	$(".error_msg_tele").css("display","none");			
	var val = $(data).parent(".diary_image_unit").attr("data-attach_path");
	var $this = $(data);
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/delete_add_diary_image";
	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({				
		type: 'POST',
		url: url,	
		data:{'val':val},
		dataType: 'json',
		success: function (response) {	
			if(response['success'] == 1){		
				$this.parent().remove();			
				return false;	
				if($(".diary_image_unit").length < 5){
					$(".add_more_image").css("display","inline-block");
				}
			}else{
				$(".error_text_tele").text(response['message']);
				$(".error_msg_tele").css("display","block");
			}		
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}

function uploadDiaryImage(imageName){	
	var len = imageName.files.length;	
	if((parseInt($(".diary_image_unit").length) + parseInt(len)) <= 5){		
		var file = imageName.files;		
		var form_data = new FormData(); 
		for (var i = 0; i < len ; i++) {
	        form_data.append('attachments'+i+'',imageName.files[i]);
	    }	    
	    form_data.append('imagesLength', len); 
		var site_url = $('#site_url').text();
		var url = site_url+"/patient/upload_diary_attachments";
		$.ajaxSetup({
			headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
		});
		$.ajax({
	      type: "POST",
	      url: url,
	      enctype: 'multipart/form-data',
	      cache: false,
	      data: form_data,
	      processData: false,
	      contentType: false,
	      dataType: 'json',
	      success: function (result) {
	      	for(var i in result['attach_path']){
		      	html = '<div class="diary_image_unit" data-attach_path='+result['attach_path'][i]+' data-image_name='+result['attach_name'][i]+' data-folder_name='+result['folder_name']+'><img src="'+site_url+"/"+result['attach_path'][i]+'" alt="image"><span class="delete_image" onclick="deleteAddDiaryImages(this);return false;"><img src="'+site_url+'/admin/doctor/images/delete_image.svg" alt="icon"></span></div>';
		      	$('.add_diary_parent').append(html);
		      	if($(".diary_image_unit").length == 5){
		      		$(".add_more_image").css("display","none");
		      	}else{
		      		$(".add_more_image").css("display","inline-block");
		      	}
		    }
	      },
	      error: function (data) {
	        console.log('Error:', data);
	      }
	    });
	}else{
		$(".error_text_tele").text("You can upload max 5 attachments");
		$(".error_msg_tele").css("display","block");
		return false;
	}
}


function saveHealthDiary(data){		
	$(".error_msg_tele").css("display","none");	
	var feeling_detail = $(".feeling_detail option:selected").val();
	if(feeling_detail == "" || typeof feeling_detail === typeof undefined){
		$(".error_text_tele").text("Please select a feeling type");
		$(".error_msg_tele").css("display","block");
		return false;
	}	
	var symptoms = $(".symptoms").val();
	if(symptoms == "" || typeof symptoms === typeof undefined){
		$(".error_text_tele").text("Please add some symptoms");
		$(".error_msg_tele").css("display","block");
		return false;
	}
	var medication = "";
	if($(".medi_parent").find(".medi").length > 0){
		$(".medi_parent").find(".medi").each(function(){
			var val = $(this).text();
			
			if(medication == ""){
				medication = val;
			}else{
				medication = medication+","+val;
			}
		});
	}  
	var other_health_diary="";
	if(feeling_detail==6) 
	{
	 other_health_diary = $("#other_health_diary").val();
		if(other_health_diary == "" || typeof other_health_diary === typeof undefined){
		$(".error_text_tele").text("Please Add Feeling");
		$(".error_msg_tele").css("display","block");
		return false;
	}	
	}    
    var attachment_path =[];
    var attachment_name =[];
    var folder_name = [];
    if($(".diary_image_unit").length > 0){
	    $(".diary_image_unit").each(function(){
	        attachment_path.push($(this).attr("data-attach_path"));
	        attachment_name.push($(this).attr("data-image_name"));
	        folder_name.push($(this).attr("data-folder_name"));
	    });
	}
	var edit = 0;
	if($(data).attr("data-type") != "" && typeof $(data).attr("data-type") !== typeof undefined){
		var diary_id = $(data).attr("data-id");
		edit =1;
		var data = {"feeling_details":feeling_detail,"symptom_details":symptoms,"medication_details":medication,"attachment_path":attachment_path,"attachment_name":attachment_name,"folder_name":folder_name,"edit":"1","diary_id":diary_id,"other_health_diary":other_health_diary}
	}else{
		var data = {"feeling_details":feeling_detail,"symptom_details":symptoms,"medication_details":medication,"other_health_diary":other_health_diary,"attachment_path":attachment_path,"attachment_name":attachment_name,"folder_name":folder_name}
	}

	var site_url = $('#site_url').text();
	var url = site_url+"/patient/save_diary_details";	

	$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({				
		type: 'POST',
		url: url,		
		data: data,		
		dataType: 'json',
		success: function (response) {
			if(response['redirect'] == 1){
	 			parent.location =response['redirect_url'];
                return false;
	 		}
			if(response['success'] == '1')
			{		
				if(edit == 1){
					alert("Diary edited successfully");
				}else{
					alert("Diary added successfully");
					
				}
				parent.location =response['redirect_url'];
				$(".submit_btn").attr("data-click","1")
								 				
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
	return false;
	
}

function monthlyHealthDiary(data){
	var val = $("option:selected",data).val();
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/monthly_health_diary/"+val;	
	$.ajax({				
		type: 'GET',
		url: url,	
		dataType: 'html',
		success: function (response) {
			
			$(".main_diary_div").html(response);
			$(".main_diary_div1").remove();
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}

function viewhealthdiary(data){
	var val = $(data).attr("data-id");
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/view_health_diary/"+val;	
	$.ajax({				
		type: 'GET',
		url: url,	
		dataType: 'html',
		success: function (response) {
			$(".diary_content").html(response);
			$("#view_health_diary").modal('show');

			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}

function edithealthdiary(data){
	var id = $(data).attr("data-id");
	var site_url = $('#site_url').text();
	parent.location = site_url+"/patient/edit_health_diary/"+id;
}

function deletehealthdiary(data){
	if (confirm('Are you sure you want to delete this diary?')) {
		$(".error_msg_tele").css("display","none");	
		var id = $(data).attr("data-id");
		var site_url = $('#site_url').text();
		var url = site_url+"/patient/delete_health_diary/"+id;	
		$.ajax({				
			type: 'GET',
			url: url,	
			dataType: 'json',
			success: function (response) {
				if(response['success'] == '1')
				{		
					$("#view_health_diary").modal('hide');
					alert("Diary deleted successfully");
					location.reload(true);
					return false;							 				
				}
				else
				{				
					$(".error_text_tele").text(response['message']);
					$(".error_msg_tele").css("display","block");
				}							
			},
			error: function (response) {
				console.log('Error:', response);
			}
		});
	}
}

function deletehealthdiaryimages(data){
	$(".error_msg_tele").css("display","none");	
	var id = $(data).attr("data-id");
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/delete_diary_images/"+id;	
	$.ajax({				
		type: 'GET',
		url: url,	
		dataType: 'json',
		success: function (response) {		
			if(response['success'] == '1')
			{		
				$(data).parent().remove();	
				if($(".diary_image_unit").length == 5){
		      		$(".add_more_image").css("display","none");
		      	}else{
		      		$(".add_more_image").css("display","inline-block");
		      	}		
				return false;							 				
			}
			else
			{				
				$(".error_text_tele").text(response['message']);
				$(".error_msg_tele").css("display","block");
			}		
						
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}
function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

$('.feeling_detail').change(function(){
	var val=$(this).val();
	if(val==6)
	{
		$('#other_health_diary').show();
	}
	else {
		$('#other_health_diary').hide();
		$('#other_health_diary').val('');
	}
});