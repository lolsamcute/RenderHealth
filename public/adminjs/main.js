$(function() {
    if($('#nurse_ph').length){
    getdialcode("nurse_ph");
    }
    if($('#admin_ph').length){
    getdialcode("admin_ph")
    }
    if($('#dr_ph').length){
    getdialcode("dr_ph")
    }
    if($('#patient_phone').length){
    getdialcode("patient_phone");
    }
    if($('#point_phone').length){
        getdialcode("point_phone");
    }
    if($('#point2_phone').length){
        getdialcode("point2_phone");
    }
    if($('#employee_phone').length){
        getdialcode("employee_phone");
    }
    if($('#employee_alternative_phone').length){
        getdialcode("employee_alternative_phone");
    }
    if($('#nextofkin_phone').length){
        getdialcode("nextofkin_phone");
    }
    if($('#reference_phone').length){
        getdialcode("reference_phone");
    }
    if($('#reference2_phone').length){
        getdialcode("reference2_phone");
    }
    $('[data-toggle="tooltip"]').tooltip();
    if ($('input.form-check-custom').length > 0)
        {
            var inputList = $('input.form-check-custom');
            for (var i = inputList.length - 1; i >= 0; i--) {
                $(inputList[i]).prettyCheckable();
            }
        }

    if ($('.datepicker_input').length > 0)
    {
        $('.datepicker_input').datepicker({
            format: 'dd MM yyyy'
        });
    }

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

    /**** Side menu toggle ****/
    $("#menu").click(function(){
        $("body").toggleClass("slide_left");
    });



})
 // View patient Profile
        function ViewPatientProfile(id){
        $('#view_profile').modal('show');
        var site_url = $('#site_url').text();

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        url: site_url+"/admin/getpatientdetail",
        type:'POST',
        data:{patient_id:id},
        success:function(response){  
        //alert(response.success);           

        if(response.success == 1)
        {                     
        $("#view_profile h4").html(response.patients_data.name ) ;  
        $("#view_profile .patient_id_detail").html('PATIENT ID:'+ id ) ; 
        $("#view_profile #language p").html(response.patients_data.languages ) ; 
        $("#view_profile #Birthday p").html(response.patients_data.patient_date_of_birth +"(Birthday)" ) ;
        $("#view_profile #state_of_origin").html(response.patients_data.state_of_origin ) ;
        $("#view_profile #marital_status p").html(response.patients_data.patient_martial_status ) ;
        $("#view_profile h6").html(response.patients_data.patient_age+"y/o "+response.patients_data.gender ) ;
        $("#view_profile #address p").html(response.patients_data.patient_address) ;
        $("#view_profile #blood_group").html(response.patients_data.patient_blood_type) ;
        $("#view_profile .profile_d_image img").attr("src",response.patients_data.patient_profile_img) ;

        }
        else
        {
        /*$('.alert-danger-outline-addhos').show();
        $('.addhos_danger_pop').text(response.message);*/
        }

        }
        });  

        }
function getdialcode (id){
    var input = document.querySelector("#"+id);
    var iti=window.intlTelInput(input, {
    initialCountry: "ng",
    onlyCountries: ['ng'],
    /*geoIpLookup: function(callback) {
    $.get('https://ipinfo.io', function() {}, "jsonp").done(function(resp) {
    var countryCode = (resp && resp.country) ? resp.country : "";
    callback(countryCode);
    return false;
    });
    },*/
    //hiddenInput: "full_number",

    utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
    });
    input.addEventListener("countrychange", function() {
    console.log(iti.getSelectedCountryData().dialCode);
    $("#"+id).val("+"+iti.getSelectedCountryData().dialCode);
    });
}