

<section class="logindiv">

	<img src="images/BlueBackground.jpg" class="blueImageClassCopy"/>
	<img src="images/ChessBackground.jpg" class="chessImageClassCopy"/>
		
	<div class="mainlogindiv">
		<div class="otherlogin">
			<button class="icon facebookicon"></button>
			<button class="icon gmailicon" ></button>
		</div>
		<form id="loginForm" method="get" action="config/login.php">
			<div class="inputdiv" >
				<label class="loginlabel">LOGIN</label>
				
				<input type = "text" id="name" name="name" placeholder="Username" required="true" autofocus="true"/>	
				<label for="name" class="error"></label>		
				<input type = "password" id="password" name="password" placeholder="Password" required="true"/>
				<label for="password" class="error"></label>
	
				<input type="button" value="Login"  class=" btn-sm submitbutton inputbutton"/>
				<input type="button" value="Cancel" formnovalidate  class=" btn-sm cancelbutton inputbutton"/>
			</div>
		</form>
	</div>

	
</section>

<script>
	
	$(function(){
		var user1="" ,user2Sender="",user2reciever="",
			lastModifiedTimeUser2=0,newModifiedTimeUser2=0,
			lastModifiedTimeUser1=0,newModifiedTimeUser1=0,
			firstFileUpdateUser2 = true,
			firstFileUpdateUser1 = true,
			intervalIdUser1,
			intervalIdUser2;
		var loginFunction = function(name, pwd){
			
			$.ajax({
				url:"config/login.php",
				data:{name:name,password:pwd},
				success: function(data){
					if(data != "false"){
						var name = data;	
						if(data.indexOf("Warning")>-1)
						{
							name = data.substring(0, data.indexOf("<br"));									
						}
						$(".contentDiv").load("template/content.php", function(){
							$(".latestNews").click(function(){
								$(".refresh").css("display", "inline");
								$.ajax({url:"config/loggedInUsers.php",data:{name:name}}).done(function(data){	          		
						          	//$(".contentDiv").html(datavalue);
									     	
									user1= name;
									$(".contentDiv").html(data);	
									$(".loggedInUser").click(userClicked);	
									$(".footer-nav-wrapper").css("display","block");				
									intervalIdUser1 = setInterval (requestUser,100);
								});
							});		
						});
						$(".loginSpan").css("display", "none");		
						$(".mainPageSpan").css("display","none");
						$(".registerSpan").css("display","none");
						$(".logoutSpan").css("display", "inline");						
						$(".userNameSpan").css("display", "inline").html("Welcome "+name);		
						$(".logoutSpan").click(function(){	
							
							$.ajax({url:"config/logout.php",data:{name:name}}).done(function(){	          		
					          	window.location.href = 'index.php';
							});
						});
						$(".refresh").click(function () {
						  	$.ajax({url:"config/refreshUsers.php",data:{name:name}}).done(function(datavalue){	          		
					          	$(".contentDiv").html(datavalue);
							});
						});
						$(window).on("beforeunload", function() {					
							$.ajax({url:"config/logout.php",data:{name:name}}).done(function(){	          		
					          	
							});
						});
					} else {
						alert("no such user present");
					}		
				}
			});
		}
		
		
		$(".facebookicon").click(function(){			
			$("<div>").attr("id" ,"fb-root").appendTo("body");
			$.getScript("js/fblogin.js").done(function(){
				loginFunction(name, pwd);
			});
		});
		$(".gmailicon").click(function(){
			$.getScript('js/loginWithGmail.js').done(function(){				
				loginFunction(name, pwd);
			});			
		});
		
		$('#loginForm').validate({
			
    		// ajax submit
    		submitHandler: function (form) {
				var name = $("#name").val();
				var pwd = $("#password").val();
				loginFunction(name, pwd);
							
			 	return false; 
			}
		});
		$(".submitbutton").click(function(){
			
			$("#loginForm").submit();
		});
			/*After a particular user wants to send a request to another user*/
		function userClicked(){
			user2Sender = this.id;
					$.ajax({url:"config/connectionRequest.php",
					data:{user1Name:user1,user2Name:user2Sender},
						success:function(){
							 intervalIdUser2 = setInterval (userResponse,100);
						}
					});
		}
		function requestUser(){		
			$.ajax({
				url:"config/lastModified.php",
				data:{username:user1},
				success:function(modifiedTime){
					if(modifiedTime>newModifiedTimeUser1)
					{
						if(firstFileUpdateUser1){
							newModifiedTimeUser1 = modifiedTime;
						}
						else{
							lastModifiedTimeUser1 = newModifiedTimeUser1;
							newModifiedTimeUser1 = modifiedTime;
						}
					}
				}
			});
			if(newModifiedTimeUser1 && (newModifiedTimeUser1>lastModifiedTimeUser1)&&firstFileUpdateUser1)
			{
				var user1FileName =user1+".txt";
				$.ajax({
				url: "config/readFile.php",
				data:{fileName:user1FileName},
				cache: false,
				success: function(user2Name){	
						if(user2Name != "")
						{
							user2reciever = user2Name;	
							$('.request').append("<div class='userRequest'>"+user2reciever+" want's to play with you. Do you want to join?&nbsp&nbsp<button class='yes'>Yes</button>&nbsp&nbsp<button class='no'>No</button></div>");
							//firstFileUpdate = false;	
							/*lastModifiedTimeUser2 = newModifiedTimeUser2;	*/
							$('.yes').bind("click",onYesClick);
							$('.no').bind("click",onNoClick);
							firstFileUpdateUser1 = false;
						}
			  		}
				});
			}
		}

		function userResponse(){		
			$.ajax({
				url:"config/lastModified.php",
				data:{username:user1+"_"+user2Sender},
				success:function(modifiedTime){
					if(modifiedTime>newModifiedTimeUser2)
					{
						if(firstFileUpdateUser2){
							newModifiedTimeUser2 = modifiedTime;
						}
						else{
							lastModifiedTimeUser2 = newModifiedTimeUser2;
							newModifiedTimeUser2 = modifiedTime;
						}
					}
				}
			});
			if(newModifiedTimeUser2 && (newModifiedTimeUser2>lastModifiedTimeUser2)&& firstFileUpdateUser2==true)
			{
				var combinedFileName = user1+"_"+user2Sender+".txt";
				$.ajax({
				url: "config/readFile.php",
				data:{fileName:combinedFileName},
				cache: false,
				success: function(string){	
					if(string.indexOf("accepted")>-1){
						$.ajax({
							url:"config/removeFile.php",
							data:{fileName:combinedFileName},
							success:function(){
									firstFileUpdateUser2 = false;
						            window.location.href="twoPlayerChess.php?user1="+user1+"&&user2="+user2Sender;								
							}	
						});
					
					}	
					}				  		
				});
			}
		}

		function onYesClick(){
			$.ajax({
				url:"config/connection.php",
				data:{user1:user2reciever,user2:user1},
				cache:false,
				success:function(){
					window.location.href="twoPlayerChess.php?user1="+user2reciever+"&&user2="+user1;
				}
			});
		}
		
		function onNoClick(){
			console.log("No Clicked");
		}
		$(".cancelbutton").click(function(){
			$(".mainPageSpan").click();
		});
	});
</script>
