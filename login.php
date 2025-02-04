<?php 

    use classes\User\UserController as UserController;
    require_once('Autoloader.inc.php');
    // require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'head.php'); 
    // require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_top2.php'); 

	use classes\Issue\IssueView as IssueView;
	// if(!isset($_COOKIE["PHPSESSID"]))
	// 	{
	// 	session_start();
	// 	}
	// 	session_start();

		if (session_status() !== PHP_SESSION_ACTIVE) session_start();

	date_default_timezone_set("America/Toronto");
	$dtime=date("Y-m-d H:i:s");
	$tstamp=strtotime($dtime);


	//Logout
	$logout = $_REQUEST["logout"] ?? "";
	//Confirm Registration Token
	$confirm_token = $_REQUEST["confirm"] ?? 0;
	$_SESSION['counter'] = time();

//echo "VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV".$logout;

    if ($logout == 'true') {
       //session_start();
       session_unset();
       //session_destroy();
	   setcookie("user_id", "", time() - 3600);
	   setcookie("repdata", "", time() - 3600);
	   setcookie("rep_id", "", time() - 3600);
	   setcookie("student", "", time() - 3600);
	   setcookie("user_type", "", time() - 3600);
	   setcookie("basic_profile", "", time() - 3600);
	   setcookie("loggedin", "", time() - 3600);
	   setcookie("assignment", "", time() - 3600);
	   setcookie("loggedin", "", time() - 3600);
	   if (session_status() == PHP_SESSION_ACTIVE) session_destroy();
		// print session_status();
       
    } 

    if ($logout == 'forced') {
        
       // echo "You are not logged in. Please login to access our portal";
        
    } 

	if (!empty($confirm_token)) {
        
        //check if the user is returning to this page from a confirm registration link - if so update userStatus
		$userstat = new UserController();
        $registered = $userstat->confirmUserStatus($confirm_token);
        
    } else {

		$registered = 0;

	}

	

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="robots" content="noindex">
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</head>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'head_login.php'); 
?>
<style>
	 input:-webkit-autofill,
        input:-webkit-autofill:focus {
        transition: background-color 600000s 0s, color 600000s 0s;
        }

		.showpass {
		position: relative;
		}

		.showpass:before {
		font-size:1em;
		position: absolute;
		right: 10px;
		top: .7em;
		bottom: 0;
		width: 20px;
		content: "\e8f4"; 
		font-family: "Material Icons Outlined"; 
		}
		@media only screen and (max-width: 767px) {
		.signin-panel .bg {
display: none;
		}
	}
		input {
		padding: 5px 5px;
		}
</style>
<body>
<div class="signin-panel">
<div class="bg"> 
<img src="<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']  ;?>assets/img/login.jpg">
</div>
      <div class="signin-sidebar">
        <div id="dpSidebarBody" class="signin-sidebar-body">
          <a href="index.php" class="sidebar-logo mg-b-40"><img src="<?php echo $_SERVER['HTTP_MEDIA_LOGOS']  ;?>v2/iMatrLogoEx.jpg" style="width: 150px !important;" class="responsive"  alt="" ></a>

		  <section id="basic_login">
          <h4 class="signin-title">Welcome back!</h4>
          <h5 class="signin-subtitle">Please login to continue.</h5>
		 
          <div style="margin-bottom: 0px;" class="signin-form">
		  
		  <div id="validation_popper" class="alert alert-outline alert-danger" role="alert" style="display: inline-flex;display: none;">
			  <span style="padding: 5px;" id="message_icon" class="material-icons-outlined notranslate" >error_outline</span>
		  		<span id="message"></span>
            </div>

			<div class="form-group">
              <label for="email">Email address</label>
              <input id="email" type="email" class="form-control" onfocus="this.value=''" placeholder="Enter your email address" value="">
            </div>

            <div class="form-group">
				<label class="d-flex justify-content-between">
					<span>Password</span>
					<a href="reset_sendmail.php" class="tx-13">Forgot password?</a>
				</label>
				<div uk-grid>
					<div class="uk-width-5-6">
						<input id="password" type="password" class="form-control" placeholder="Enter your password" value=""></input>
					</div>
	
					<div class="uk-width-1-6" style="float:left;  padding:8px 0 0 0 ;border-bottom:solid 2px #d9dfe7; line-height:20px"><a onclick="pswdVisibility()"><span class="material-icons-outlined notranslate">
						visibility
						</span></a>
					</div>
				</div>
			 
            </div>

            <div style="margin-bottom: 10px;" class="form-group d-flex mg-b-10">
              <a id="btnlogin" onclick="loginUser()" style="color:white;" class="btn btn-brand-01 btn-uppercase flex-fill">Login</a>
              <a href="register.php" class="btn btn-white btn-uppercase flex-fill mg-l-10">Sign Up</a>
            </div>
			</section>

			<!-- Basic Profile section for first time  -->
			<section id="student_profile" style="display:none; margin-top:1em">
				<h4 class="signin-title">Welcome!</h4>
          		<h5 class="signin-subtitle">Please ensure that you enter your first and last name so that your teacher can identify you as being part of their class.</h5>

				  <div class="form-group" style="margin-top:2em">
				  	<label for="first_name">First Name</label>
              		<input id="first_name" type="text" class="form-control" onfocus="this.value=''" placeholder="First Name" value="">
					  <label for="last_name" style="margin-top: 15px;" >Last Name</label>
              		<input id="last_name" type="text" class="form-control" onfocus="this.value=''" placeholder="Last Name" value="">
              		
            	  </div>
				  <section id="student_save" style="display:none; margin-top:1em">

				<button id="btnlogin" onclick="saveStudentInfo()" class="btn btn-brand-01 btn-uppercase flex-fill">Save</button>
				
			</section>
			
			</section><br>
			<section id="basic_profile" style="display:none; margin-top:1em">
				<!-- <h4 class="signin-title">Welcome back!</h4> -->
          		<h5 class="signin-subtitle">By adding your postal code you will have more access to our app</h5>

				  <div class="form-group" style="margin-top:2em">
              		<label for="postalcode">Postal Code</label>
              		<input id="postalcode" type="text" class="form-control" onfocus="this.value=''" placeholder="Enter your postal code" value="">
					<input id="user_id" type="hidden" value="">
            	  </div>
				  <div class="form-group d-flex mg-b-0">
              			
              
            	  </div>


			</section>
			
			<section id="postal_save" style="display:none; margin-top:1em">

				<button id="btnlogin" onclick="savePostal()" class="btn btn-brand-01 btn-uppercase flex-fill">Save</button>
			</section>
			
			
            <!-- <div class="divider-text mg-y-30">Or</div> -->

            <a id="home" href="index.php" class="btn btn-white btn-uppercase btn-block">HOME</a>
          </div>
		 
          <p class="mg-t-auto mg-b-0 tx-sm tx-color-03">By signing in, you agree to our <a href="#modal-page" onclick="getContentModal('terms', 'nav')" uk-toggle>Terms of Use</a> 
		  and <a href="#modal-page" onclick="getContentModal('privacy', 'nav')" uk-toggle>Privacy Policy</a></p>
        </div><!-- signin-sidebar-body -->
      </div><!-- signin-sidebar -->
    </div><!-- signin-panel -->
	
	<div id="modal-page" class="uk-modal" uk-modal>
    <div class="uk-modal-dialog  uk-width-1-1@s uk-width-1-1@m uk-width-3-4@l" style="
    
 border:solid 3px #000; background-color:#ffffff; width: 1308px;">
        <a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
        <div class="uk-grid-collapse uk-flex-middle" uk-grid>

            <div id="pagecontent" class="uk-padding-small" style="width: 100%;">

            </div>

        </div>
    </div>
</div>
	

	<?php 

    	require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'auth_scripts.php'); 
		
	?>
	<script>

		
         
           $.post('../includes/login.inc.php',{'type':'logout'});
           
      $(function(){

        'use strict'

		setCookiebyDuration('login_attempts', '0', 30, 'minutes')
		 var login_attempts = parseInt(getCookie("login_attempts"));
		//alert(login_attempts);
		if (login_attempts > 5) {
							//setCookiebyDuration("locked_out", true, 30, 'minutes');
			var message = "Too many login attempts. Please wait 30 minutes before trying again.";
			$("#validation_popper").show();
			$("#message").html(message); 
			$("#btnlogin").prop('disabled', true);
			$("#btnlogin").prop('class', 'btn');
			$("#btnlogin").text('Sign In Disabled');
							
		}else{
			$("#validation_popper").hide();
			$("#btnlogin").prop('disabled', false);
		}
		const queryString = window.location.search;

		const urlParams = new URLSearchParams(queryString);


		const session = urlParams.get('session');
           if(session === 'Expired') {
               $("#validation_popper").show();
               $("#message").html("Your session has expired. Please log in again.");
			   $('#message_icon').hide();
			   $('.signin-form').attr('style', 'margin-top: 10px;margin-bottom: 0px;');
           }



		
		const logintype = urlParams.get('logintype');
		//alert(logintype);

        feather.replace();

        new PerfectScrollbar('.signin-sidebar', {
          suppressScrollX: true
        });

      })
    </script>


   


<script>

	//AJAX FUNCTIONS

	// $(".close").click(function(){
	// 	//$(this).parent().hide();
	// 	$("#validation_popper").hide();
	// });

	// $(document).ready(function(){
    //     //showStatus();
    // });

	function pswdVisibility() {
			
		var pass = document.getElementById("password");
		
		if (pass.type === "password") {
			pass.type = "text";
		
			
		} else {
			
			pass.type = "password";
			
		}

		
	}

	function savePostal(){
		user_id = getCookie('user_id')
		postalcode = document.getElementById("postalcode").value;
		postalcode =  postalcode.toUpperCase();
		postalcode = postalcode.replace(/ /g,' ');
		postalcode = postalcode.replace(/^(.{3})(.*)$/, "$1 $2");
		//console.log(postalcode)
		//console.log(user_id)


		// addresstest = "Canada";
		// 	const api_url = "//nominatim.openstreetmap.org/search?format=json&q="+addresstest ;

		

		 //alert(postalcode + " userid:"+user_id);
			$.ajax({    
				type: "POST",
				url: "includes/login.inc.php",             
				data: {type:"savepostal", user_id:user_id, postalcode:postalcode},
				dataType: "html",                  
				success: function(data){   
					//console.log(data);                 
					//alert(data.organization);	
					//Success or fail message

						// Swal.fire({
						// 		title: 'Saved',
						// 		text: "You have saved your postal code to your profile!",
						// 		icon: 'success',
								
						// 		confirmButtonColor: '#3085d6',
								
						// 		confirmButtonText: 'OK'
						// 		}).then((result) => {
						// 		if (result.isConfirmed) {
						// 			document.location.href = 'index.php' ;    
						// 		}
						// })
			
						
				},
				complete: function(){
					
					//SAVE city and province and coord to korpf
					findAddressData(postalcode, user_id);
					
				},
				error: function(error){
					console.log("Error:");
					console.log(error);
					$("#error").show();                 
					$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
					
				},
			});



	}

	function gotpostal(){
		$.ajax({    
				type: "POST",
				url: "includes/login.inc.php",             
				data: {type:"savepostal", user_id:user_id, postalcode:postalcode},
				dataType: "html",                  
				success: function(data){   
					//console.log(data);                 
					//alert(data.organization);	
					//Success or fail message

						// Swal.fire({
						// 		title: 'Saved',
						// 		text: "You have saved your postal code to your profile!",
						// 		icon: 'success',
								
						// 		confirmButtonColor: '#3085d6',
								
						// 		confirmButtonText: 'OK'
						// 		}).then((result) => {
						// 		if (result.isConfirmed) {
						// 			document.location.href = 'index.php' ;    
						// 		}
						// })
			
						
				},
				complete: function(){
					
					//SAVE city and province and coord to korpf
					findAddressData(postalcode, user_id);
					
				},
				error: function(error){
					console.log("Error:");
					console.log(error);
					$("#error").show();                 
					$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
					
				},
			});
	}

	function findAddressData(postalcode, user_id){

			$.ajax({
					url: 'includes/geolocation.inc.php',
					type: 'POST',
					data: { type:"address_search", address: postalcode },
					dataType: "json",   
					success: function(data) {
						//console.log(data);    		
						
						// var lat =  data.latitude; 
						// var long = data.longtitude;
						
						// alert(lat + long)
						//confirmLocation();
						//getUserLocation();
						saveBasicProfile(data, user_id);
						
						
					},
						
					error: function(XMLHttpRequest, textStatus, errorThrown) {    
						console.log("Error:");
						console.log(error);
						$("#error").show();                 
						$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data);  

					}
			});



	}

	function findLatLng(postalcode, user_id){

		$.ajax({
				url: 'includes/geolocation.inc.php',
				type: 'POST',
				data: { type:"address_search", address: postalcode },
				dataType: "json",   
				success: function(data) {
					//console.log(data);    
					
									
					let latitude = data.latitude;
					let longitude  = data.longitude;
					// alert(user_id);
					saveLatLng(latitude, longitude, user_id);

										
					
				},
				complete: function(data) {

					
				},
					
				error: function(XMLHttpRequest, textStatus, errorThrown) {    
					console.log("Error:");
					console.log(error);
					$("#error").show();                 
					$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data);  

				}
		});


	}

	function saveLatLng(latitude, longitude, user_id){
		$.ajax({    
							type: "POST",
							url: "includes/login.inc.php",             
							data: {type:"savecoord", latitude:latitude, longitude:longitude, user_id:user_id},
							dataType: "html",                  
							success: function(data){   
								//console.log(data);                 
								
				
							},
							
							error: function(error){
								console.log("Error:");
								console.log(error);
								$("#error").show();                 
								$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
								
							},
					});

	};

	function saveBasicProfile(data, user_id){
		console.log(data);
		var lat =  data.latitude; 
		var long = data.longitude;
		var city = data.city;
		var province = data.province;
		var province_code = data.province_code;
		var county = data.county;
		var district = data.district;
		var street = data.street;
		var country = data.country;
		var country_code = data.country_code;
		var full_address = data.full_address;
		var pcode = data.postal_code;
		
		//console.log(user_id)
		
		$.ajax({    
				type: "POST",
				url: "includes/login.inc.php",             
				data: {type:"saveprofile", user_id:user_id, lat:lat,long:long, city:city, county:county, province_code:province_code, country:country, pcode:pcode },
				dataType: "html",                  
				success: function(data){   
					console.log(data); 

					console.log('here we are')
					
					checkProfile(user_id);//this should save and create the cookie
					
						
			
						
				},
				complete: function(){
					Swal.fire({
								title: 'Saved',
								text: "Your postal code has been saved to your account settings.",
								icon: 'success',
								
								confirmButtonColor: '#3085d6',
								
								confirmButtonText: 'OK'
								}).then((result) => {
								if (result.isConfirmed) {

									document.location.href = 'index.php' ;    
								}
						})
					
				},
				error: function(error){
					console.log("Error:");
					console.log(error);
					$("#error").show();                 
					$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
					
				},
			});



	}


	function checkProfile(user_id){

		postalset = '';
					$.ajax({    
							type: "POST",
							url: "includes/login.inc.php",             
							data: {type:"checkprofile", user_id:user_id},
							dataType: "json",                  
							success: function(data){   

								postal_code= data.postal_code;
								first_name= data.first_name;
								// last_name= data.last_name;
								// latitude= data.latitude;
								longitude= data.longitude;
								student_flag= data.student_flag;
								
								noname_flag = 0;
								if(first_name == null || last_name == null){
									noname_flag = 1;
								}
								
								
								if(student_flag >= 1){									
									setCookiebyDuration("student", "true", 1, "days")
								}
								
								if(postal_code =="" || postal_code == null){
									var postal_code = 1
								}else{
									var postalset = 0;
								}

								if(student_flag >= 1 && noname_flag == 1){
									$("#student_profile").show();
									$("#basic_login").hide();
									$("#student_save").show();
								}
								
								if(postal_code == "" || postal_code == null){
									$("#basic_login").hide();
									$("#basic_profile").show();
									$("#postal_save").show();
									$("#home").html("No Thanks, not right now.");
									$("#user_id").val(user_id);
								}else{
									jsonstr = JSON.stringify(data);
									setCookiebyDuration("basic_profile", jsonstr, 100, 'days');
								}

								if(postal_code =="" || postal_code == null || student_flag == 2){			
									var postalset = true		
								}
								if(student_flag >= 1){ 
									var studentset = true
								}
								if(student_flag >= 1 && noname_flag == 1){ 
									var studentset = true
								}else{
									//basic_profile = getCookie("basic_profile");

									// if (jQuery.isEmptyObject(basic_profile)){
									// 	//DO NOTHING but keep this logic for now
									// } else {
									// 	// We need to add latitude and longitude coords for legacy users 
									// 	//alert(postal_code);
										
									// 	json2 = JSON.parse(basic_profile);
									// 	latitude = json2["latitude"];
									// 	longitude = json2["longitude"];
																
									// 	// so we need to check in coords are in the basic profile 
									// 	if (jQuery.isEmptyObject(latitude)  || jQuery.isEmptyObject(longitude)){
									// 		findLatLng(postal_code, user_id); //find and save the coordinates - this is for legacy users in the korpf table
									// 	}								
									// }

									if (studentset !== true && postalset !== true){
										index = document.location.href = "index.php"
									}
								}
								
							},
							error: function(error){
								console.log("Error:");
								console.log(error);
								$("#error").show();                 
								$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
								
							},
					});
					
				



	}
	function saveStudentInfo(){

		first_name = document.getElementById("first_name").value;
		last_name = document.getElementById("last_name").value;

		basic_profile = getCookie('basic_profile');
		data = JSON.parse(basic_profile);
		data['first_name'] = first_name;
		data['last_name'] = last_name;

		jsonstr = JSON.stringify(data);
		setCookiebyDuration("basic_profile", jsonstr, 100, 'days');

		user_id = getCookie('user_id')

		console.log(first_name)
		console.log(last_name)
		
		$.ajax({    
				type: "POST",
				url: "includes/login.inc.php",             
				data: {type:"savename", user_id:user_id, first_name:first_name, last_name:last_name},
				dataType: "html",                 
				success: function(data){   
					console.log(data);                

						Swal.fire({
								title: 'Saved',
								text: "You have saved your name to your profile!",
								icon: 'success',
								
								confirmButtonColor: '#3085d6',
								
								confirmButtonText: 'OK'
							}).then((result) => {
								if (result.isConfirmed) {

									document.location.href = 'index.php' ;    
								}})
			
						
				},
				error: function(error){
					console.log("Error:");
					console.log(error);
					$("#error").show();                 
					$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
					
				},
			});

	}

function displayPlans(repID, userID, subscription){
	$.ajax({    
				type: "POST",
				url: "admin/org_explain.php",             
				dataType: "html", 
				data: {repID: repID, userID: userID, subscription: subscription},              
				success: function(data){ 

					$('#pagecontent').html(data)


					UIkit.modal('#modal-page').show();

				}})

}
function gotoManager(userID, type){
   

   fetch("../pages/create-manager-session.php", {
	 method: "POST",
	 body: JSON.stringify({ userID: userID, type:type }),	
	 })
	 .then(function (response) {
	   // console.log(response);
   
	 return response.json();
	 })
	 .then(function (session) {
	location.href = session
	 })
	 .then(function (result) {
	 // If redirectToCheckout fails due to a browser or network
	 // error, you should display the localized error message to your
	 // customer using error.message.
	 if (result.error) {
	   alert(result.error.message);
	 }
	 })
	 .catch(function (error) {
	 console.error("Error:", error);
	 });
   
   }
function getContentModal(userID, repID, subscription){
	
	// setCookie('repID', repID);
	// setCookie('userID', userID);
	$.ajax({    
				type: "POST",
				url: "admin/org_purchase_iqs.php",
				data: {userID:userID, repID:repID, subscription: subscription},              
             
				dataType: "html",                  
				success: function(data){ 

					$('#pagecontent').html(data)


				 }})

}
 let validation_status = '';
	function loginUser(){
		
		var email = document.getElementById('email').value;
		var password = document.getElementById('password').value;
	//
		let user_id = 0;
			
		login_attempts = parseInt(getCookie("login_attempts"));
		if(login_attempts == 'NaN') login_attempts = 0;
		login_attempts = ++login_attempts ;
		
		

		//alert(login_attempts);
		

		//deleteCookie("login_attempts", "", 100);	
		//deleteCookie("repdata", "", 1);	
		$("#validation_popper").hide();

			$.ajax({    
				type: "POST",
				url: "includes/login.inc.php",             
				data: {type:"login", email:email, password:password},
				dataType: "json",                  
				success: function(data){  

if(data.subscription == 1 || data.user_type !== "EP"){
					//debugging only
					//$("#message").show();
					var message =  data.message; 

					validation_status = data.status;
					//alert(validation_status)
					user_id = data.user_id;
					utype = data.user_type;

					// saveBasicProfile(data, user)
					// const student_flag =  foo(user_id);
					//alert("user_id"+user_id)
					
            		//alert(checkStudent(user_id));z
					
										
					//$("#login_btn").hide();
					if (validation_status =="fail"){
						//$("#message").html(message); 
						//alert("again");
						if (login_attempts > 5) {
							//setCookiebyDuration("locked_out", true, 30, 'minutes');
							message = message + ".<br> Too many login attempts. Please wait 30 minutes before trying again."
							$("#btnlogin").prop('disabled', true);
							$("#btnlogin").prop('class', 'btn');
							$("#btnlogin").text('Sign In Disabled');
							
						}else{
							message = message + ".<br>"+login_attempts +" failed login attempts. After 5 failed attempts you will be locked out for 30 minutes."
						}
						setCookiebyDuration("login_attempts", login_attempts, 30, 'minutes');
						
						$("#validation_popper").show();
						$("#message").html(message); 


					} else {

						postal_code = data.postal_code
						assignments = data.counter;
						console.log("assignments:" + assignments)
						fullname = data.firstname + " " + data.lastname;
						deleteCookie("repdata", "", 1);		
						deleteCookie("org_id", "", 1);	
						deleteCookie("user_type", "", 1);
						deleteCookie("classname", "", 1);
						deleteCookie("teachername", "", 1);	
						deleteCookie("admin_type", "", 1);
						deleteCookie("iq", "", 1);			
						setCookiebyDuration("user_id", data.user_id, 1, 'days');
						setCookiebyDuration("fullname", fullname , 365, 'days');
						setCookiebyDuration("first_name", data.firstname , 365, 'days');
						if(data.admin_type) setCookiebyDuration("admin_type", data.admin_type, 100, 'days');
						setCookiebyDuration("user_type", data.user_type, 364, 'days');
						setCookiebyDuration("token", data.token, 100, 'days');
						
						setCookiebyDuration("loggedin", Date.now(), 1, 'days');
						localStorage.setItem("loggedin", Date.now());
						if (data.user_type=="EP"){
							repdata = data.repdata;
							const json = {
								
								rep_id: data.rep_id,
								fullname: repdata.fullname,
								organization: repdata.organization,
								districtname: repdata.districtname,
								photourl: repdata.photourl,
								estreet: repdata.estreet,
								city: repdata.city,
								province:repdata.province,
								// website: data.website,
								partyname: repdata.partyname,
								primaryrole: repdata.primaryrole
							};
							jsonstr = JSON.stringify(json);
							setCookiebyDuration("repdata", jsonstr, 100, 'days');
							postalset = 0;
						}

						//POLITICIAN HANDLER
						if (utype == "P" || utype == "S"){
							//checkProfile(user_id)
								basic_profile = data.basic_profile
								jsonstr = JSON.stringify(basic_profile);
								setCookiebyDuration("basic_profile", jsonstr, 100, 'days');
								postal_code= basic_profile.postal_code;
								first_name= basic_profile.first_name;
								last_name= basic_profile.last_name;
								student_flag= basic_profile.student_flag;
								
								
								noname_flag = 0;
								if(first_name == null || last_name == null){
									noname_flag = 1;
								}
								
								if(student_flag >= 1){									
									setCookiebyDuration("student", "true", 1, "days")
									//$.post("../includes/login.inc.php",{"type":"logout"});
								}
								
								if(postal_code =="" || postal_code == null){
									var postal_code = 1
								}else{
									var postalset = 0;
								}

								if(student_flag >= 1 && noname_flag == 1){
									$("#student_profile").show();
									$("#basic_login").hide();
									$("#student_save").show();
									$("#home").hide();

									
									exit();
								}
								
								if(postal_code == "" || postal_code == null){
									$("#basic_login").hide();
									$("#basic_profile").show();
									$("#postal_save").show();
									$("#home").html("No Thanks, not right now.");
									$("#user_id").val(user_id);
									exit();
								}

								if(postal_code =="" || postal_code == null || student_flag == 2){			
									var postalset = true		
								}
								if(student_flag >= 1){ 
									var studentset = true
								}
								if(student_flag >= 1 && noname_flag == 1){ 
									var studentset = true
								}else{			
									if (studentset !== true && postalset !== true){
										//index = document.location.href = "index.php"
									}
								}
							}
							validation();
					}
					
				}else if(data.subscription == 0){
	// subscription invalid
//displayPlans(data.rep_id, data.user_id, data.subscription);
gotoManager(data.user_id, 'login');



// $('#modal-page').modal('show');
}else if(data.subscription == 'undefined'){
// subscripton hasnt started
displayPlans(data.rep_id, data.user_id, data.subscription);


// $('#modal-page').modal('show');

}


					
				},
				complete: function(){
				    
				},
				error: function(error){
					console.log("Error:");
					console.log(error);
					$("#error").show();                 
					$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "); 
					
				},
		});

	}

	function validation(){

		if (validation_status == "pass"){
			setCookiebyDuration("login_attempts", 0, 10, 'days');
			document.location.href = 'index.php';
						

		}
	}

var repdata = 0;

	function getRepData(rep_id){
		// console.log(rep_id)
		//  alert(rep_id)
// console.log("id above")
		$.ajax({    
				type: "POST",
				url: "includes/politician.inc.php",             
				data: {type:"onlogin", rep_id:rep_id},
				dataType: "json",                  
				success: function(data){   
					// console.log(data.photourl);                 
					//alert(data.organization);	


					
					const json = {
							
							rep_id: rep_id,
							fullname: data.fullname,
							organization: data.organization,
							districtname: data.districtname,
							photourl: data.photourl,
							estreet: data.estreet,
							city: data.city,
							province:data.province,
							// website: data.website,
							 partyname: data.partyname,
							 primaryrole: data.primaryrole
						};
						// alert("rep"+json["rep_id"]);
						// alert("photourl"+json["photourl"]);
						// alert("estreet"+json["estreet"]);
						// alert("caddress"+json["caddress"]);
						jsonstr = JSON.stringify(json);
						setCookiebyDuration("repdata", jsonstr, 100, 'days');
						$.ajax({    
							type: "POST",
							url: "includes/politician.inc.php",             
							data: {type:"set_rep_session", repdata:jsonstr},
							dataType: "html",
	
					});
						
						repdata = getCookie("repdata")
						//RETRIEVING COOKIE After setting - if you do not it will only appear after refresh on the next page.
						//getCookie("repdata");
						
						 //json2 = JSON.parse(cookieValue);
					
					//	 document.location.href = 'index.php';
									
						
				},
			
				error: function(error){
					getRepData(rep_id)
					error1 = JSON.stringify(error)
					alert(error1);
					console.log("Error:");
					console.log(error);
					$("#error").show();                 
					$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
					
				},
		});

	
	
	
	};

	
       
	function setCookiebyDuration(cname, cvalue, amt, timetype) {
			
			const d = new Date();
			
			if(timetype == 'days'){
				d.setTime(d.getTime() + (amt*24*60*60*1000));
			}
			if(timetype == 'hours'){
				d.setTime(d.getTime() + (amt*60*60*1000));
			}
			if(timetype == 'minutes'){
				d.setTime(d.getTime() + (amt*60*1000));
			}
			
			let expires = "expires="+ d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
			}

			function deleteCookie(cname, cvalue, exhours) {
			cvalue = "";
			const d = new Date();
			d.setTime(d.getTime() - (exhours*60*60*1000));
			let expires = "expires="+ d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
			}

			function getCookie(cname) {
			let name = cname + "=";
			let decodedCookie = decodeURIComponent(document.cookie);
			let ca = decodedCookie.split(';');
			for(let i = 0; i <ca.length; i++) {
				let c = ca[i];
				while (c.charAt(0) == ' ') {
				c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
				}
			}
			return "";
    }

	new google.translate.TranslateElement({
                                        pageLanguage: 'en',
                                        includedLanguages: 'en,fr',
                                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                    }, 'google_translate_element2');

</script>


</body>
</html>	



