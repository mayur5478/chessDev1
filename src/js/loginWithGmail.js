
function login() 
{
  
  var myParams = {

	'clientid' : '211757314132-snar0rtr0v6jokae4ggv2evijkplhbbe.apps.googleusercontent.com',
    'cookiepolicy' : 'single_host_origin',
    //'cookiepolicy' : 'none',
    'callback' : 'loginCallback',
    'approvalprompt':'force',
    'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
    'response_type':'token'
  };
  gapi.auth.signIn(myParams);
  //handleAuthClick();
  
}
function logout(){
		//gapi = window.gapi;
		console.log("logout");
		gapi.client.setApiKey('AIzaSyAFID3FKwzxNr7Q44PU-e5VdRBUkchxHnA');
    	gapi.client.load('plus', 'v1',function(){
    		//document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout";
    		//window.location = "https://mail.google.com/mail/u/0/?logout&hl=en";
    		token = window.token;
  			console.log(token);
    		window.location.href = "https://accounts.google.com/o/oauth2/revoke?token="+token;
    		//auth2.disconnect();
    		console.log("logout 2");
    		//gapi.auth.signOut();
    		//location.reload();
    		
			console.log("done");
    	});
		
	}
function loginCallback(result)
{
	
	var name;
 	console.log("callbK");
	
    if(result['status']['signed_in'])
    {
    	       
		
		var request = gapi.client.plus.people.get(
	        {
	            'userId': 'me'
	        });
	        request.execute(function (resp)
	        { 
	        	gapi.client.load('oauth2', 'v2', function() {
				  gapi.client.oauth2.userinfo.get().execute(function(resp) {
					    
				    var name = JSON.stringify(resp.name);
				    var email = JSON.stringify(resp.email);
				    logout();
				    /*
					$.ajax({url:"src/php/insertuser.php",data:{name:name,mail:email}}).done(function(datavalue){			          		
																							  if(datavalue == 1){
																									  var text = 'src/php/login.php?name='+name+'&password='+'';		           	
																										window.location.href=text;
											  }	
																							 });*/
					
				  });
				});
	       });
    } 
}
function onLoadCallback()
{
	
    gapi.client.setApiKey('AIzaSyAFID3FKwzxNr7Q44PU-e5VdRBUkchxHnA');
    window.setTimeout(checkAuth,1);
    
    /*/gapi.load('auth2',function(){
    	 gapi.client.load('plus', 'v1',function(){
                                //if(window.dologin)
                
                
                login();
    	else
   	    	 logout();	
     });*/
    //});
   
    
}

function checkAuth() {
  console.log(" in authorization");
  gapi.auth.authorize({client_id: '211757314132-snar0rtr0v6jokae4ggv2evijkplhbbe.apps.googleusercontent.com',
   scope:  'https://www.googleapis.com/auth/plus.me', immediate: false}, handleAuthResult);
}
function handleAuthResult(authResult) {
  console.log(authResult);
  var authorizeButton = document.getElementById('authorize-button');
  
  if (authResult && !authResult.error) {
    authorizeButton.style.visibility = 'hidden';
    window.token = authResult.access_token;
    gapi.client.load('plus', 'v1',function(){
                                //if(window.dologin)
                
                
                login();
    		
     });
  } else {
    authorizeButton.style.visibility = '';
    authorizeButton.onclick = handleAuthClick;
  }
}

function handleAuthClick(event) {
  gapi.auth.authorize({client_id: '211757314132-snar0rtr0v6jokae4ggv2evijkplhbbe.apps.googleusercontent.com', 
  scope: 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email', immediate: false}, handleAuthResult);
  return false;
}

 $(function() {

  	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
   	po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
  	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 });
