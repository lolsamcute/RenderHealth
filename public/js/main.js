$(function() {    
    $('[data-toggle="tooltip"]').tooltip();
    if ($('input.form-check-custom').length > 0)
        {
            var inputList = $('input.form-check-custom');
            for (var i = inputList.length - 1; i >= 0; i--) {
                $(inputList[i]).prettyCheckable();
            }
        }
    var date = new Date(); 
    date = date.getDate()-1;
    
    $('.datepicker_input').datepicker({
        startDate: date.toLocaleString(),        
        format: 'DD dd MM yyyy'
        
    });

    $('.datepicker_input_diary').datepicker({
        startDate: date.toLocaleString(),
        endDate: date.toLocaleString(),
        format: 'DD dd MM yyyy',
        todayHighlight:true
    });   

})

$(function() {
  var pgurl = window.location.href; 
  $(".main_menu ul li").removeClass();
  $(".main_menu ul li a").each(function() {   
     if ($(this).attr("href") == pgurl || $(this).attr("href") == '')        
        $(this).parent().addClass("active");
  })
});
// Show original records by swipe
 $("#onboarding").on('shown.bs.modal', function () {
        var swiper = new Swiper('.swiper-container', {
            pagination: {
              el: '.swiper-pagination',
            },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
    });
 // Show select diary
 function appenddiary(id,current){
  $.ajaxSetup({
  headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
  });
  var site_url = $('#site_url').text();
    if($(current).prop("checked") == true){     

  var url = site_url+"/patient/view_diary/"+id;
  $.ajax({        
  type: 'GET',
  url: url,   
  data: {},  
  dataType: 'json',
  success: function (response) {
    if(response['success']=='1'){
    var  html='<div class="healthdirayrow" id="'+response['diary_id']+'"><span class="delete_diary" data-diary="'+response['diary_id']+'" id="diaryto'+response['diary_id']+'"><i class="fa fa-times" aria-hidden="true"></i></span><span class="feeling_pic"><img src="'+site_url+'/'+response['feeling_pic']+'" alt=""></span><h3>'+response['feeling_name']+'</h3><span class="health_date">'+response['created_date']+'</span><p class="symptom word-break">'+response['symptom_details']+'</p></div>';
    $(".attachdoaries").append(html);
                        
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
}
else{
 var value= $(current).val();
 $("#"+value).remove();
 }
}
// Remove diary attachement on appointment on click of X button
$('.attachdoaries').on('click', '.delete_diary', function() {
   
      var data_diary= $(this).attr("data-diary");
   $("#"+data_diary).remove();
  $('input:checkbox[value="' + data_diary + '"]').prop('checked', false);

});

	//Dynamic Textbox
	$('.multi-field-wrapper').each(function() {
    var $wrapper = $('.multi-fields', this);
    var i = 2;
      $(".add-field", $(this)).click(function(e) {
      if($('.multi-field').length < 6){
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
