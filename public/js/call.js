var myWindow;
setInterval(function(){
	var patient_unique_id = $(".patient_unique_id").val();	
	checkConnect(patient_unique_id);
}, 1000);

$(window).on("unload",function(){
      myWindow.close();
  });



function checkConnect(patient_id){   
  var site_url = $('#site_url').text();  
  var url = site_url+"/patient/check_appoint_connection";  
  $.ajaxSetup({
    headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
  });
  $.ajax({
    url:url,
    type:'POST',
    data:{'patient_id':patient_id},
    success:function(result){     
        if(result['redirect'] == 1){
          parent.location =result['redirect_url'];
          return false;
        }
        
        if(result['status'] ==1){
          $(".doctor_pic").attr("src",site_url+"/admin/doctor/uploads/profile/"+result['doc_pic']);
          $(".doctor_name").text(result['doc_name']);          
          $(".reject_btn").attr("data-appoint_id",result['appoint_det']['appointment_id']);
          $(".accept_btn").attr("data-call_id",result['appoint_det']['call_det'][0]['call_id']);
          $(".accept_btn").attr("data-doc_id",result['appoint_det']['call_det'][0]['doct_id']);
          $(".accept_btn").attr("data-patient_id",result['appoint_det']['call_det'][0]['patient_id']);
          $(".accept_btn").attr("data-type",result['appoint_det']['patient_appoint']['telemedical_type']);
          $(".accept_btn").attr("data-appoint_id",result['appoint_det']['appointment_id']);
          $("#call").modal("show");
        }else if(result['status'] == 2){
          myWindow.close();
          $("#call").modal("hide");
        }else{   
          $("#call").modal("hide");
        }
       
    }
  });
}

function disconnectCall(data){
  var site_url = $('#site_url').val();       
  var a_id = $(data).attr("data-appoint_id");
  var url = site_url+"/patient/disconnect_conn_status";  
  $.ajaxSetup({
    headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
  });
  $.ajax({
    url:url,
    type:'POST',
    data:{"appoint_id":a_id},
    success:function(result){     
        if(result['redirect'] == 1){
          parent.location =result['redirect_url'];
          return false;
        } 
         $(".reject_btn").removeAttr("data-appoint_id");
        $("#call").modal("hide");
    }
  });   
}

function connectCall(data){
  var site_url = $('#site_url').val();       
  var call_id = $(data).attr("data-call_id");
  var doc_id = $(data).attr("data-doc_id");
  var patient_id = $(data).attr("data-patient_id");
  var call_type = $(data).attr("data-type");
  var appoint_id = $(data).attr("data-appoint_id");
  $("#call").modal("hide");
  myWindow = window.open(site_url+"/patient/calling_patient/"+call_id+"/"+appoint_id+"/"+doc_id+"/"+patient_id+"/"+call_type,'Render Health','height='+screen.availHeight+',width='+screen.availWidth);
}