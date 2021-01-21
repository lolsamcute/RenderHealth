$(document).ready(function(){
	$(document).on('click',".pagination li",function(){		
		if($(this).hasClass("disable") == false && $(this).hasClass("active") == false){
			 var url1 =$(this).find("a").attr("href");
			 //$(this).find("a").attr("href","javascript:void(0);");			 
			 $.ajax({
				 url:url1,
				 type:'GET',				 
				 success:function(result){
				 	if(result['redirect'] == 1){
			 			parent.location =result['redirect_url'];
		                return false;
			 		}
					$(".main_bill_div").html(result);
				}
			});
		}
			 
	});
});

function monthlyBillingList(data){
	var val = $("option:selected",data).val();
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/monthly_billing_list/"+val;	
	$.ajax({				
		type: 'GET',
		url: url,	
		dataType: 'html',
		success: function (response) {			
			$(".main_bill_div").html(response);			
			return false;			
		},
		error: function (response) {
			console.log('Error:', response);
		}
	});
}

function payWithPaystack(data){
	var amt = $(data).attr("data-amt");
	var bfr_amt = $(data).attr("data-amt");
	amt = parseFloat(amt)*100;	
	var doc_id = $(data).attr("data-doc_id");	
	var pt_id = $(data).attr("data-pt_id");
	var bill_id = $(data).attr("data-bill_id");
	var datetime = new Date()
	var x = Math.random()*10000000000000000;
	x =Math.floor(x/1000000);	
	
	var handler = PaystackPop.setup({		    	
	   	key: 'pk_test_a6adba56deebfcd4e5cb8a4929526844a742537f',
		email: 'shreya.d@iapptechnologies.com',
	  	amount: amt,		
	  	channels:['card','bank'],      	
	  	ref: ''+Math.floor(x + datetime.getTime()/1000), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
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
		var url = site_url+"/patient/pay_billing";	

		$.ajaxSetup({
			headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
		});
		$.ajax({				
			type: 'POST',
			url: url,	
			data: {'transaction_id':response.reference,'billing_id':bill_id,"patient_id":pt_id,"doctor_id":doc_id,"amt":bfr_amt,"cash_card":"card"},	
			dataType: 'json',
			success: function (response) {	
				if(response['redirect'] == 1){
		 			parent.location =result['redirect_url'];
	                return false;
		 		}
		 		if(response['success'] == 1){					
					alert(response["message"]);	
					location.reload(true);				
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


function billingdetail(data){
	var id = $(data).attr("data-id");
	var site_url = $('#site_url').text();
	parent.location = site_url+'/patient/paybill/'+id;
}
// Give option to user to pay by cash or by card

function selectpaytype(event){
	$(".radio_div").css("display","block");
	 var target = event.target;
     target.style.display = 'none';
}
	function getselectedvalue(event){
	var paytype= event.target.value;
	if(paytype==2){
	$("#pay_bill_popup").trigger("click");
	}
	if(paytype==1){
	//$(".radio_div").css("display","none");
		$("#pay_bill_popup").hide();
	$(".cash_input").css("display","block");	
	$('#myModal').modal('show');

	}

	}

	function paybycash(event){
	var site_url = $('#site_url').text();
	var url = site_url+"/patient/pay_billing_cash";		
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
	location.reload(true);				
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
		if (e.target.value > amount
        && e.keyCode !== 46 // keycode for delete
        && e.keyCode !== 8 // keycode for backspace
       ) {
       e.preventDefault();
        $("#pay_amount").val(amount);
    }

	}