
setInterval(function(){
	var doctor_id = $(".doctor_id").val();	
	checkConnect(doctor_id);
}, 1000);



function checkConnect(doctor_id){   
  var site_url = $('#site_url').text();  
  var url = site_url+"/client/check_appoint_connection";  
  $.ajaxSetup({
    headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
  });
  $.ajax({
    url:url,
    type:'POST',
    data:{'doctor_id':doctor_id},
    success:function(result){     
        if(result['redirect'] == 1){
          parent.location =result['redirect_url'];
          return false;
        }
        if(result['appoint'] == 1){
            $(".call_btn").attr("disabled",true);      
           // _wasPageCleanedUp = true;     
        }else{
        	$(".call_btn").attr("disabled",false);
        	// _wasPageCleanedUp = false;
        }
    }
  });
}