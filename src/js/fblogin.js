  window.fbAsyncInit = function() {
    FB.init({appId: '956696037708996', status: true, cookie: true, xfbml: true});
    FB.getLoginStatus(fbLoginStatus);
    FB.Event.subscribe('auth.statusChange', fbLoginStatus);
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
	
	function fbLoginStatus(response) {
     if (response && response.status === 'connected') {
        
        testAPI();
        
     } else {
        authUser();
     }
  }
  function testAPI() {
    
    FB.api('/me', function(response) {
      	
		var name = JSON.stringify(response.name);
	    var email = JSON.stringify(response.email);
	    $.ajax({url:"src/php/insertuser.php",data:{name:name,mail:email}}).done(function(datavalue){			          		
      		if(datavalue == 1){      		
	      		var text = 'src/php/login.php?name='+resp.name+'&password='+'';		           	
	   			window.location.href=text;	
      		}	
       	});
	});
  }
function authUser() {
   
   FB.login(fbLoginStatus, {scope: 'public_profile,email'});
}