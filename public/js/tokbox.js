var apiKey = $(".api_key").val();
var sessionId = $(".sessionId").val();
var token = $(".token").val();
var call_type = $(".call_type").val();

var a_id = $(".a_id").val();
var p_id = $(".p_id").val();
var session;
var pat_publisher;
var connectionCount = 0;

history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};

$(document).ready(function()
{
    $(window).on("beforeunload", function() {
        disconnectConnectStatus();
        $("#myAudio")[0].pause(); 
    });
});

var isNotIE = function isIE () {
  var userAgent = window.navigator.userAgent.toLowerCase(),
      appName = window.navigator.appName;
 
  return !( appName === 'Microsoft Internet Explorer' ||                        
           (appName === 'Netscape' && userAgent.indexOf('trident') > -1) );     // IE >= 11
};
 
// If the browser is not IE, and it meets the minimum system requirements for the OpenTok platform,
// then create your app

if (isNotIE() && OT.checkSystemRequirements()) {  
    OT.getDevices(function(error, devices) {
      audioInputDevices = devices.filter(function(element) {
        return element.kind == "audioInput";
      });
      videoInputDevices = devices.filter(function(element) {
        return element.kind == "videoInput";
      });
      if(call_type == 1){
        if(audioInputDevices.length > 0){
            connect(); 
        }else{
          alert("Microphone is needed for this call");
          disconnectConnectStatus();  
          $("#myAudio")[0].pause(); 
          window.close();
        }
      }else{
        if(videoInputDevices.length > 0 && audioInputDevices.length > 0){
            connect(); 
        }else if(videoInputDevices.length == 0 && audioInputDevices.length > 0){
          alert("Camera is mandatory for this call");
          disconnectConnectStatus();  
          $("#myAudio")[0].pause(); 
          window.close();
        }else if(videoInputDevices.length > 0  && audioInputDevices.length == 0){
          alert("Microphone is mandatory for this call");
          disconnectConnectStatus();  
          $("#myAudio")[0].pause(); 
          window.close();
        }else if(videoInputDevices.length == 0  && audioInputDevices.length == 0){
          alert("Camera and microphone are mandatory for this call");
          disconnectConnectStatus();  
          $("#myAudio")[0].pause(); 
          window.close();
        }
      }      
    });
       
  // ... continue with your OpenTok application
}else{
  alert("This browser is not compatible");
  disconnectConnectStatus();  
  $("#myAudio")[0].pause(); 
  window.close();
}

var status = 0;

// Handling all of our errors here by alerting them
  function handleError(error) {
    if (error) {   
      disconnectConnectStatus(); 
      
      $("#myAudio")[0].pause();  
      if (error.name == "OT_CONNECT_FAILED") {
        alert("You are not connected to the internet. Check your network connection.");
      }else if(error.name != "OT_USER_MEDIA_ACCESS_DENIED"){
      	alert(error.message);
      }         
      window.close();
    }
  }

/*navigator.mediaDevices.getUserMedia({ audio: true, video: false })
.then(function(stream) {
    alert("allowed");
    connect();
   
})
.catch(function(err) {
  alert("not allowed");
  window.location = 'http://dev.iapptechnologies.com:8080/projects/renderhealth/public/doctor/all_appointments';
});*/

function disconnectConnectStatus(){  
  var site_url = $('#site_url').val();        
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
    }
  });   
}

function disconnectAllowedStatus(){
  var site_url = $('#site_url').val();        
  var url = site_url+"/doctor/disconnect_allowed_status";  
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
    }
  });   
}

function checkConnect(){   
  var site_url = $('#site_url').val();  
  var url = site_url+"/patient/check_connection";  
  $.ajaxSetup({
    headers:{ 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
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
        if(result['appoint'] == 0){  
          $("#myAudio")[0].pause(); 
          alert("Call disconnected");
          window.close();
          status =0;
        }else if(result['appoint'] == 1){
          status =1;
        }else{
          status =0;
        }
    }
  });
}

var inc = 0;
function connect() {
  // Replace apiKey and sessionId with your own values:
  session = OT.initSession(apiKey, sessionId);
  session.on({
    connectionCreated: function (event) {
      connectionCount++;      
      console.log(connectionCount + ' connections.');
    },
    connectionDestroyed: function (event) {
      connectionCount--;     
      inc =1;
      disconnectConnectStatus();      
      $("#myAudio")[0].pause();  
      console.log(connectionCount + ' connections.');      
    },

    sessionDisconnected: function sessionDisconnectHandler(event) {
      // The event is defined by the SessionDisconnectEvent class
      inc =1;      
      disconnectConnectStatus();      
      console.log('Disconnected from the session.');      
      if (event.reason == 'networkDisconnected') {
        alert('Your network connection terminated.')
      }
     
    }
  }); 

  if(inc == 1){
    alert("Call disconnected");
    $("#myAudio")[0].pause();  
    window.close();
  }
  
  if(call_type == 1){
    // Create a publisher      
      pat_publisher = OT.initPublisher('publisher', {
        videoSource:null,
        audioSource:true,
        publishAudio:false, 
        publishVideo:false,        
        insertMode: 'append',
        width: '100%',
        height: '100%',
        enableStereo:false,
        disableAudioProcessing:true,
        style: {buttonDisplayMode: 'off'}
      }, handleError);
   
  }else{
      // Create a publisher
      pat_publisher = OT.initPublisher('publisher', {
        videoSource:true,
        audioSource:true,
        publishAudio:false, 
        publishVideo:true,        
        insertMode: 'append',
        width: '100%',
        height: '100%',
        enableStereo:false,
        disableAudioProcessing:true,
        style: {buttonDisplayMode: 'off'}
      }, handleError);
  }


  pat_publisher.on({
    accessAllowed: function (event) {// Replace token with your own value:
          // Subscribe to a newly created stream       
        $("#myAudio")[0].play();        
          if(call_type == 1){  
            $(".OT_publisher").css("display","none");          
            session.on('streamCreated', function(event) { 
            $("#myAudio")[0].pause();     
            $(".video_ringing").css("display","none");          
              pat_publisher.publishAudio(true);
              session.subscribe(event.stream, 'subscriber', {
                insertMode: 'append',
                width: '100%',
                height: '100%',
                subscribeToAudio:true, 
                subscribeToVideo:false
              }, handleError);
              changeStatus();
            });
          }else{            
            test = session.on('streamCreated', function(event) {
              $("#myAudio")[0].pause();  
              $(".video_ringing").css("display","none");
              pat_publisher.publishAudio(true);
              session.subscribe(event.stream, 'subscriber', {
                insertMode: 'append',
                width: '100%',
                height: '100%',
                subscribeToAudio:true, 
                subscribeToVideo:true
              }, handleError);
              changeStatus();
            });            
          }

          session.on("streamDestroyed", function(event) {
          	disconnectDevice();          	
            if(event.reason == "networkDisconnected"){
              alert("Internet connection problem");
            }else{           
              alert("Call disconnected");
            }              
            window.close();
          });

          session.connect(token, function(error) {
            if (error) {
              console.log('Unable to connect: ', error.message);
              handleError(error);
            
            }else {
              session.publish(pat_publisher, handleError);      
              console.log('Connected to the session.');
              connectionCount = 1;
            }   
          });          
    },
    accessDenied: function accessDeniedHandler(event) {
      disconnectConnectStatus();
      //disconnectAllowedStatus();
      $("#myAudio")[0].pause();  
      window.close();
    }
  });  

  session.on("streamPropertyChanged", function (event) {
      console.log(event.stream);
  });

}

function disconnectDevice() { 
  session.disconnect();
  disconnectConnectStatus(); 
  $("#myAudio")[0].pause();  
}

function disconnect() { 
  session.disconnect();
  disconnectConnectStatus(); 
  $("#myAudio")[0].pause();     
  window.close();
}

function removePatientVideo(){  
  if (pat_publisher.stream.hasVideo == false) {
    pat_publisher.publishVideo(true);
    $(".add_video").css("display","none");
    $(".remove_video").css("display","block");
  }else{
    pat_publisher.publishVideo(false);
    $(".add_video").css("display","block");
    $(".remove_video").css("display","none");
  }
}
function removePatientAudio(){  
  if (pat_publisher.stream.hasAudio == false) {
    pat_publisher.publishAudio(true);
    $(".add_audio").css("display","none");
    $(".remove_audio").css("display","block");
  }else{
    pat_publisher.publishAudio(false);
    $(".add_audio").css("display","block");
    $(".remove_audio").css("display","none");
  }
}

setInterval(function(){                      
	checkConnect();
}, 1000);