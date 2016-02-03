
<section class="logindiv">
<!--<form>-->
<!--/*action="src/php/login.php" method="get">-->

	<img src="images/BlueBackground.jpg" class="blueImageClassCopy"/>
	<img src="images/ChessBackground.jpg" class="chessImageClassCopy"/>
	<!--<div id="logo-wrapper-login-page">
		<h1 class="main-logo">ChessWay</h1>
		<h6 class="main-logo-tagline">TM</h6>
	</div>-->	
	<div class="mainlogindiv mainregisterFormDiv">
	<form id="registerForm" method="get"  action="config/login.php">	
		<div class="inputdiv mainregisterdiv">
			<label>Create A new Account</label>
			
			<input type = "text" id="name" name="name" placeholder="Username" required="true" autofocus="true"/></td>
			<label for="name" class="error"></label>
			<input type = "url" id="email" name="e-mail" placeholder="E-Mail" required="true"/></td>
			<label for="e-mail" class="error"></label>
			<input type = "password" id="password" name="password" placeholder="Password" required="true"/></td>
			<label for="password" class="error"></label>
			<input type = "password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required="true"/></td>
			<label for="confirmpassword" class="error"></label>
			
			<input type="button" value="Register" class=" btn-sm registerbutton inputbutton"/>
			<input type="button" value="Cancel" formnovalidate class=" btn-sm cancelbutton inputbutton"/>
		</div>
	</form>
	</div>
	<div class="footer-nav-wrapper-login-page footer-nav-wrapper-login-page-register">
		<nav class="footer-nav" >
	        <ul class="footer-ul-login-page">
	            <li >
	                <a href="#" ><span class="footer-ul-login-span">Home  </span></a>
	            </li>
	            <li>
	                <a href="#" ><span class="footer-ul-login-span">About Us  </span></a>
	            </li>
	            <li>
	                <a href="#" ><span class="footer-ul-login-span">Gallery  </span></a>
	            </li>
	            <li>
	                <a href="#" ><span class="footer-ul-login-span">Blog  </span></a>
	            </li>
	            <li>
	                <a href="#" ><span>Email</span></a>
	            </li>
	        </ul>
	    </nav>
	</div>    
<!--</form>-->
	
	
	
</section>


<script>
	$(function(){
		$('#registerForm').validate({     
			/*
			errorPlacement: function(error, element) {			  
			  $(element).parent("td").next("td").append(error );			    
			},*/
			submitHandler: function (argument) {
			 
				var name = $("#name").val();
				var email = $("#email").val();
				var pwd = $("#password").val();
				var confirmPassword = $("#confirmpassword").val();
				if(pwd === confirmPassword){
					$.ajax({url:"config/RegisterUser.php",data:{name:name,email:email,Password:pwd}}).done(function(data){
						$(".logindiv").html(data);
					});	
				} else {
					$("confirmpassword").append("<span>Passwords do not match.</span>");
				}
				return false; 	 
			}
				
		});
			
		$(".registerbutton").click(function(){
			$('#registerForm').submit();
		});
		$(".cancelbutton").click(function(){
			$(".mainPageSpan").click();
		});
	});
</script>
