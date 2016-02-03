<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="description" content="">
        
        <link rel="stylesheet" media="screen and (max-width: 1365px)" href="css/mobile.css" />
        <link rel="stylesheet" media="screen and (min-width: 1366px)" href="css/main.css" />        
        
		<script src="js/jquery-1.11.2.min.js"> </script>
		<script src="js/jquery.validate.min.js"> </script>
        <title>ChessWay</title>
    </head>
    <body>
    	<header>
    		<div id="login-container">
	    		<div class="container-fluid">
	    			<div id="logo-wrapper">
	    				<h1 class="main-logo">ChessWay</h1>
	    				<h6 class="main-logo-tagline">TM</h6>
	    			</div>
	    			<div id="login-wrapper">
	    				<span class="login refresh"><a href="#">Refresh</a></span>|
	    				&#9812<span class="login registerSpan"><a href="#">Register</a></span>
	    				<span class="login userNameSpan"></span>|
	    				<span class="login loginSpan"><a href="#">Login</a></span>
	    				<span class="login mainPageSpan"><a href="#">Main</a></span>	    				
	    				<span class="login logoutSpan"><a href="#">Logout</a></span>	
	    			</div>
	    		</div>
	    		<div id="primary-nav" class="nav-container">
				    <nav class="nav" >
				    	<label for="menu" class='menuLabel' onclick></label>
				        <ul class="header-lvl1">
				            <li class="active">
				                <a href="#" ><span >HOME</span></a>
				            </li>
				            <li>
				                <a href="#" ><span >ABOUT US</span></a>
				            </li>
				            <li >
				                <a href="#" ><span >GALLERY</span></a>
				            </li>
				            <li >
				                <a href="#" ><span >BLOG</span></a>
				            </li>
				            <li >
				                <a href="#" ><span >EMAIL</span></a>
				            </li>
				        </ul>
				    </nav>
				</div>
	    	</div>

    	</header>
    	
    	<section class="contentDiv">

		</section>
    
       	<footer>
        	<div class="footer-nav-wrapper">
				<nav class="footer-nav" >
			        <ul class="footer-ul">
			            <li >
			                <a href="#" ><span class="footer-ul-span">Home  </span></a>
			            </li>
			            <li>
			                <a href="#" ><span class="footer-ul-span">About Us  </span></a>
			            </li>
			            <li>
			                <a href="#" ><span class="footer-ul-span">Gallery  </span></a>
			            </li>
			            <li>
			                <a href="#" ><span class="footer-ul-span">Blog  </span></a>
			            </li>
			            <li>
			                <a href="#" ><span>Email</span></a>
			            </li>
			        </ul>
			    </nav>
        		<span class="footer-copyright">Copyright 2015 chess</span>
        	</div>
        </footer>

    </body>
	<script>
		$(function(){
			
			<?php 
				DEFINE('WEBSITE_URL', 'http://localhost/Final/config');
				session_start();
				error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
			?>
			$(".contentDiv").load("template/content.php",function(){
	            $(".latestNews").click(function(){				
					$(".loginSpan").click();
				});
	            $(".clubInfo").click(function(){
	                window.location.assign("http://www.chessway.comlu.com/training.php")    
	            }); 
	        });
			
			$(".loginSpan").click(function(){
				$(".loginSpan").css("display","none");
				$(".mainPageSpan").css("display","inline");
				$(".contentDiv").load("template/login.php");	
			});
			$(".mainPageSpan").click(function(){
				$(".loginSpan").css("display","inline");
				$(".mainPageSpan").css("display","none");
				$(".footer-nav-wrapper").css("display","block");			
				$(".contentDiv").load("template/content.php");
			});
			$(".registerSpan").click(function(){
				$(".footer-nav-wrapper").css("display","none");
				$(".contentDiv").load("template/NewUser.php");
			});
			
		});
	</script>
</html>