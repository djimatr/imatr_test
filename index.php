<?php
	if (session_status() !== PHP_SESSION_ACTIVE) session_start();

	if (!isset($_SESSION['last_regeneration']) || 
    time() - $_SESSION['last_regeneration'] > 1800) {
    
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

require_once('Autoloader.inc.php');

    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'head.php'); 
	
	require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'topbar.php'); 
	if (session_status() !== PHP_SESSION_ACTIVE) session_start();

	//	if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    	// require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_top2.php'); 

	// ini_set('memory_limit', '444M');

	use classes\Issue\IssueView as IssueView;
	use classes\Engagement\EngagementView as EngagementView;
    use classes\Student\StudentView as StudentView;
	use classes\Politician\PoliticianController as PoliticianController;
	use classes\Organization\OrganizationController as OrganizationController;
	use classes\Geolocation\ZoneController as ZoneController;
	use classes\Payment\StripeController;
	use classes\Politician\PoliticianView as PoliticianView;
	use classes\Encryption\Encryption as Encryption;

	use classes\User\UserController as UserController;

	




	$encryption = new Encryption('');
	$issue = new IssueView('');

	// $issue->updateCompleteRepsIDs();
	
	date_default_timezone_set("America/Toronto");
	$dat=date("Y-m-d H:i:s");
	$dats=strtotime($dat);

	$assignments = $_GET['assignments'] ?? 0;

	if(isset($_GET['assignmentID'])){
	$_SESSION['teacher_assignment_id'] = $_GET['assignmentID'] ?? 0;

	$_SESSION['class_id'] = $_GET['classID'];
}else{
	$_SESSION['teacher_assignment_id'] = 0;

}


	//$page =  $_GET['page']??0;

	if(!isset($_COOKIE['iq']) && isset($_SESSION['user_id'])) {
		
		$view = new EngagementView();  
		if($_SESSION['user_type'] == "EP"){
			$table = "panswers";
		}else {
			$table = "answers";

		}
		$question_id = $view->getLastQuestion($_SESSION['user_id'], $table);
		print ' <script> document.cookie = "iq=' .$question_id . '" </script>';
	  }
	  @ header("Content-Type: text/html; charset=utf8mb4");
	 
	  if (isset( $_SESSION['user_type'])){
		$user_type = $_SESSION['user_type'] ?? "";

	  }
	
	  if (isset($_SESSION['student_flag'])){

		$student_mode = true;
	
	 }else{
		$student_mode = false;
	
	 }
	
	  	

	  if (isset( $_SESSION['rep_id'])){

				
		$rep_id = $_SESSION['rep_id'] ?? 0;
		$repID = $_SESSION['rep_id'];


						
		$pol_controller = new PoliticianController();
		$poly_info = $pol_controller->PullPolticianInfo($rep_id);

		$poly_bridge = $pol_controller->checkPoliBridge($repID);


		if(!empty($poly_bridge)){
			file_get_contents("{$poly_bridge['bridgeURL']}");
		}



		// print " Hi $rep_id";

		// print_r($poly_info['organization']);
		$org_controller = new OrganizationController();


		if($poly_info['primaryrole'] == "Trustee" || $poly_info['primaryrole'] == "Chair"){

			$poly_info['organization'] = $org_controller->pullOrganizationbySchoolboard($poly_info['organization']);
		  }

		$poly_organization = $org_controller->pullOrgbyOrganizationName($poly_info['organization']);
		// print " Hi $rep_id";
// print
		$bla = '';
		$zone_controller = new ZoneController($bla);
		// echo $poly_organization;

		$zone = $zone_controller->pullWardCentrefromOrganizationSpecialID($poly_organization, $poly_info['districtname']);

		// print_r($zone);

		
		$poly = $zone_controller->pullWardGEOMfromOrganizationSpecialID($poly_organization, $poly_info['districtname']);
		$poly = json_decode($poly, true);
		$poly = $poly['coordinates'][0][0];
		
		$zone = $zone[0]['coor'];
		
		$zone = substr($zone, strpos($zone, "(") + 1);
		$zone = substr($zone, 0, strpos($zone, ')'));
		
		$zone = explode(" ", $zone);

		$repdata = $_SESSION['rep_data'];
		$repdatanew = json_decode($repdata, true);
		
		


	  
	  
	  } else {
		$repdata = "Null";
	  }

	  if (isset($_SESSION['basic_profile'])){

		$isbasic = true;

       
        $profile = json_decode($_SESSION['basic_profile'], true);
        //echo  "Is rep: ".$isrep;
		//print_r($profile);
        $first_name = $profile['first_name'] ?? "";
        $last_name = $profile['last_name'] ?? "";
        $fullname = $first_name . " " .  $last_name;
        $city = $profile['city'] ?? "";
        $province = $profile['province'] ?? "";
        $postalcode = $profile['postal_code'] ?? "";
        $latitude = $profile['latitude'] ?? "";
        $longitude = $profile['longitude'] ?? "";
		$coordinates = $profile['coordinates'] ?? "";


// echo $first_name;

        if(!empty($postalcode)){
			$postalset = true;
        }else {
			$postalset = false;

		}
       
     }else {
		$isbasic = false;
		$postalset = false;


	 }




	  require_once('JS/geolocation.php');

	  	  //If unsubscribe is set, unsubscribe the user from the email list
			if(isset($_GET['unsubscribe']) && isset($_GET['token'])){
				if($_GET['unsubscribe'] == 1){
					
					$token = urldecode($_GET['token']);
					$unsubscribe = 1;
					$user = new UserController();
					$user->unsubscribe($token);
					
				}
			}
			if(isset($_GET['token']) && isset($_GET['questID'])){
		
				if($_GET['questID'] !== 0 && $_GET['token'] !== 0){
		
		
				
		
					$user = new UserController();
		
					$user->setTemporaryUserSession($_GET['token']);
		
					?>
						<script>
							tempID = true;
						</script>
					
					
					<?php
		
					
		
				}
			 }else{
				?>
				<script>
				tempID = false;
				</script>
				<?php
				
				
			 }


	//saskFlag: 1 = Registered
	//saskFlag: 2 = Not Registered


	//If newly registered, signed in and clicked on an ask, make it so iQ displays
	  if($_SESSION['saskFlag'] == 1 && isset($_GET['uniq_id'])){
		if($user_type == "EP"){
			$_SESSION['saskFlag'] = 0;

		}

	  }


	   // If uniq_id is in the URL and the politician is not logged in, run autoregistration
	  if(isset($_GET['uniq_id']) && !isset($_SESSION['user_id'])){


		include_once('admin/autoregistration.php');

	  }elseif (isset($_GET['uniq_id']) && isset($_SESSION['user_id'])) {

		$_GET['uniq_id'] = 0;
		# code...
	  }

?>

<meta name="description" content="iMatr brings democracy into the future by providing a social platform for Canadians, 
organizations, and government.">
 <!--jquery-->
 <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

<style>
.spinner {
			margin: auto;
			margin-top: 15px;
    width: 55px;
    height: 55px;
    
    border: 9px solid #0000001a;
    border-radius: 50%;
    border-right-color: #00528A;
    
    animation: spin 1s ease infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
.progress-bar-success {
			background-color: #00528a;
		}
		.progress-striped .progress-bar-success {
			background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
			background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
			background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		}
		.progress-bar-info {
			background-color: #5bc0de;
		}
		.progress-striped .progress-bar-info {
			background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
			background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
			background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		}
		.progress-bar-warning {
			background-color: #f0ad4e;
		}
		.progress-striped .progress-bar-warning {
			background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
			background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
			background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		}
		.progress-bar-danger {
			background-color: #d9534f;
		}
		.progress-striped .progress-bar-danger {
			background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
			background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
			background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		}
	.fbuttons {

		border: solid 1px #1c1c1c;
		float: center;
		color: #fff;
		font-family: 'univers_57_condensedregular';
		font-size: .9rem;
		text-transform: uppercase;
		padding: .5rem 1rem;
		background: #1c1c1c;
		/*margin: .2px 0 0 0;*/
		margin-top: 10px;
	}

	.fbuttons:hover {
		background: #00954C;
		color: #fff;
		border: solid 1px #00954C;
		transition: background-color 0.5s ease;
		text-decoration: none !important;
	}

	.fbuttons:focus {
		border: solid 1px #00954C;
		color: #fff;
		background: #00954C;
	}
	#task p {
		font-weight: 700
	}

	.fbuttons .icheck {
		color: #00964c;
		padding-right: 2px !important;
		float: left
	}

	.fbuttons:hover .icheck {
		color: #fff;
		transition: background-color 0.5s ease;
		text-decoration: none !important;
	}

	.custom_textarea{
		resize:none;
	}


</style>








<!DOCTYPE html>
<!-- MEDIA QUERIES -->
<script language="javascript" type="text/javascript">

//alert('?php echo $_SESSION['postal_code']; ?>')
$(document).ready(function()
{
	/*var side_sec = document.getElementById('dinamic_col_2');
	console.log('sec', side_sec.offsetWidth);
	var elem_width = (side_sec.offsetWidth - 28) + "px";
	var header_el = document.getElementById('headermain');
	console.log('head', header_el.offsetWidth);
	header_el.style.width = elem_width;
	console.log('head', header_el.offsetWidth);
	var child = document.getElementsByClassName('fl_locat');
console.log(child, 'ch');
var gr_par = child.parentElement.parentElement;
gr_par.style.position = 'absolute';

gr_par.style.left = '50%';*/

});



				
// function deleteCookie(cname, cvalue, exhours) {
// 			cvalue = "";
// 			const d = new Date();
// 			d.setTime(d.getTime() - (exhours*60*60*1000));
// 			let expires = "expires="+ d.toUTCString();
// 			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
// 		}

// const mediaQuerys = window.matchMedia('(max-width: 768px)')
// Check if the media query is true

// console.log('<?php echo $_SESSION["country"] ; ?>', 'country');
// console.log('<?php echo $_COOKIE["country"] ; ?>', 'country_cook');


	//deleteCookie("country", "", 1);

/*function confirm_country(country_detect){
	//if (error.code == error.PERMISSION_DENIED)
	//alert('no location')
	//location.reload();

	console.log(country_detect);
	console.log('<php echo $_COOKIE["country"] ; ?>', 'cookie');
	let country_1, country_2;
	var url_country = '';
	var current_url = window.location.href;
	
	var countries = ["Australia","au", "Bahamas", "bs", "Canada", "ca", "Croatia", "hr", "Kenya", "ke", "New Zealand", "nz", "Singapore", "sg", "United Kingdom", "gb","United States", "us"];
	var detectedIndex = countries.indexOf(country_detect);
	if(detectedIndex > -1)
		countries.splice(detectedIndex, 2);

	console.log(countries);
	country_1 = countries[0];
	country_2 = countries[1]; 
	var screen_condition = window.innerWidth >= 768;
	console.log(screen_condition, window.innerWidth);
	var backdrop_set = screen_condition ? 'center/80%': 'top/250% no-repeat';
	var backdrop_imatr = screen_condition ? 'left': 'center';

	var swal_width = screen_condition ? '': '115%';

	let inputOptions = {};
        for (let i = 0; i < countries.length; i += 2) {
            inputOptions[(i / 2 + 1)] = `<span class="fi fi-${countries[i + 1]} fi" ></span>&nbsp;&nbsp;${countries[i]}`;
        }

	Swal.fire({
				title: 'Are you a citizen of ' + country_detect+ '?',
				text: "Our geolocation has located you in " + country_detect + ".",
				backdrop:`url("../../images/iMatr_Logo_80.png") ` + backdrop_imatr + ` top no-repeat,
							url("../../images/select_country_background.jpg") ` + backdrop_set,	
				confirmButtonColor: '#3085d6',
				denyButtonColor: '#00954C',
				showDenyButton: true,
				denyButtonText: 'Choose another country',
				confirmButtonText: 'Confirm detected country',
				didOpen: () => {
					document.documentElement.style.overflow = 'hidden';
					document.body.style.overflow = 'hidden';
					//window.scrollTo(0, -2000);
                },
                willClose: () => {
                    document.documentElement.style.overflow = '';
    				document.body.style.overflow = '';
                },
				customClass:{
					popup: 'custom-popup',          	
					container: 'my-swal-container',
					title: "swal-title",
					confirmButton: 'custom-confirm-button',
					denyButton: 'custom-confirm-button',
					actions: 'custom-confirm-button-container',
					htmlContainer: 'custom-html-container'
					
				}
				//allowOutsideClick: false
				}).then((result) => {
				if (result.isDenied) {
					Swal.fire({
						title: 'Please choose your country',
						backdrop:`url("../../images/iMatr_Logo_80.png") left top no-repeat,
							url("../../images/select_country_background.jpg") ` + backdrop_set,
						input: "radio",
						inputOptions: inputOptions,
						
						//icon: 'warning',
						showConfirmButton: true,
						inputPlaceholder: "Select your country",
						confirmButtonColor: '#00954C',	
						confirmButtonText: 'Confirm chosen country',
						showCloseButton: true,
						width: swal_width,
						customClass: {
							 popup: 'custom-popup-relative',
							 closeButton: 'close-swal-button-x',
							 input: 'swal-radio',
							 title: 'swal-title-second-sw',
							 container: 'my-swal-container',
							 actions: 'custom-confirm-button-container',
							 confirmButton: 'custom-confirm-button',
							 validationMessage: 'swal2-custom-validation-message'
						},
						inputValidator: (value) => {
							if (!value) {
								//console.log(country_1, value);
								return "Please select your country";
							}
						}
				}).then((result) => {
					if (result.isConfirmed) {
						console.log(result.value)
						var selectedCountry = countries[(parseInt(result.value)-1)*2];
						console.log('res', selectedCountry);
						setCookiebyDuration("country", selectedCountry, 1, 'days');
						if(selectedCountry !== "Canada"){
							Swal.fire({
								title: 'Stay tuned. Coming Soon.',
								backdrop:`url("../../images/iMatr_Logo_80.png") left top no-repeat,
									url("../../images/select_country_background.jpg") ` + backdrop_set,
								showConfirmButton: false,
								width: swal_width,
								allowOutsideClick: false,
								customClass: {
									popup: 'custom-popup-relative',	
									title: 'swal-title_tuned',
									container: 'my-swal-container',
									actions: 'custom-confirm-button-container',
									confirmButton: 'custom-confirm-button'

								}
							});
						}

						url_country = getCountryURL(selectedCountry);

						console.log(url_country)
								
						//window.location.href = url_country;
					}else 
						confirm_country('Canada');
				});    
				}else if(result.isConfirmed){
					url_country = getCountryURL(country_detect);
					setCookiebyDuration("country", country_detect, 1, 'days');

					if(url_country !== current_url)
						window.location.href = url_country;
				}
			});
}

function getCountryURL(country){
	var url_country = '';
	switch(country){		
		case 'Canada': url_country = "https://v2.imatr.org/"; break;
		case 'USA': url_country = "https://usadev.imatr.org/"; break;
		case 'Australia': url_country = "https://australiadev.imatr.org/"; break;
	}
	console.log(url_country);

	return url_country;
}*/

$(function(){



	if(window.matchMedia('(max-width: 768px)').matches) {
			$("#iMatr_logo").css('padding-top', '8px');
			$("#iMatr_logo").css('width', '150px');
			}

'use strict'

$('#main-mobile-menu').on('click', function(e) {
  e.preventDefault();

  $('body').addClass('profile-menu-show');
  $('#mainMenu').removeClass('d-none');
  $(this).addClass('d-none');
  $('#profileMenuHide').removeClass('d-none');
})

})





	</script>
<noscript>	
	  <p style="opacity: 0;"><a class="button" href="#popup">Click Me</a></p>
		<!-- lightbox container hidden with CSS -->
		<div id="popup" class="overlay">
	<a class="cancel" href="#"></a>
	<div class="center-screen">
		<div class="popup">
			<h3>We have detected that javascript has been disabled in your browser.</h3>
			<div class="content">
				<h4>This site uses javascript in order to work properly. Please enable it to be able to use this site.</h4>
				<h4>To enable Javascript, please go into your browser settings and enable javascript.</h4>
				
				<style>
					h1 {
	text-align: center;
	font-family: "Trebuchet MS", Tahoma, Arial, sans-serif;
	margin: 50px 0;
}

html {
	overflow: hidden !important;
}
body {
	overflow: hidden !important;
}


#assignmentcontainer {
	/* padding: 20px; */
}
.button {
	font-family: Helvetica, Arial, sans-serif;
	font-size: 13px;
	padding: 5px 10px;
	border: 1px solid #aaa;
	background-color: #eee;
	background-image: linear-gradient(top, #fff, #f0f0f0);
	border-radius: 2px;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
	color: #666;
	text-decoration: none;
	text-shadow: 0 1px 0 #fff;
	cursor: pointer;
	transition: all 0.2s ease-out;
}

/*body background during popup*/
.overlay {
	
	position: fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	background: rgba(0, 0, 0, 0.5);
	transition: opacity 200ms;
	visibility: visible;
	opacity: 1;
}
/*cancel background popup click background*/
.overlay .cancel {
	position: fixed;
	width: 100%;
	height: 100%;
	cursor: default;
}
.overlay:target {
	visibility: hidden;
	opacity: 0;
}
/*popup*/
.swal2-html-container {
	font-size: 1.3rem !important;
}
.right-sec.rs-main{
	position: relative !important;
	z-index: -1 !important;
}
.content {
	padding: 0px !important;
}
.popup {
	
	border: 5px solid black !important;
	display: inline-block;
	margin: auto;
	padding: 20px;
	background: #fff;
	/* border: 1px solid #666; */
	/* box-shadow: 0 0 50px rgba(0, 0, 0, 0.5); */
	position: relative;
}
.light .popup {
	border-color: #aaa;
	box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
}
.popup h2 {
	margin-top: 0;
	color: #666;
	font-family: "Trebuchet MS", Tahoma, Arial, sans-serif;
}
.popup .close {
	z-index: 99999;
	position: absolute;
	width: 20px;
	height: 20px;
	top: 20px;
	right: 20px;
	opacity: 0.8;
	transition: all 200ms;
	font-size: 24px;
	font-weight: bold;
	text-decoration: none;
	color: #666;
}
.popup .close:hover {
	opacity: 1;
}
.center-screen {
  display: flex;
  justify-content: center;
  min-height: 100vh;
}
.popup .content {
	max-height: 400px;
	max-width: 80vw;
	overflow: auto;
}

				</style>
			</div>
		</div>
	</div>
</div>
		<style>
			
		</style>	 
</noscript>
<style> 


#registeredacc .ui-accordion-header {
	background-color: #049037c4;
	color: white;
}

#tabs .ui-accordion-content {
	padding: 5px;


}
#tabs .all-comments{
	margin: 0px;

}
#tabs .user-comment{
	margin: 0px;

}
#tabs .comments-sec2{
	/* margin: 0px; */

}


#task p {
	margin: 0px !important;
}

.contact-us .form {
	width: 100% !important;
}

.questPad {
				padding-top: 2em
			}


	.social i:hover {
		background: #00954C !important;
		
	}
	.fb:hover {
background-color: #cbcccd !important;
	}

.studentcontain #studentassign {
	margin-top: 20px;
	background-color: #63b8df  !important;
}
.studentcontain #studentassign:hover {
	background-color: #91d1ee   !important;

}
.studentcontain .swal2-html-container {
	margin-bottom: 0px;
}
.studentcontain .swal2-actions{
	margin-top: 0px !important;
}
.swal2-actions {
	/* margin-top: 0px; */
}
.swal2-styled {
	box-shadow: 0 0 0 3px rgb(102 168 224 / 50%) !important;
}

.sponsoredText{
	margin-top:auto;
	margin-bottom:auto;
display: flex;
 align-items: center;
}

#sesswarnicon:hover {
	color: #00528A !important;
	cursor: pointer;
}
	html{
		
		padding: 0px !important;
		overflow-y: scroll; /* Add the ability to scroll */}
	body {
		padding-right: 0px !important;
	}
h4 .iqs {
	font-weight: 700 !important;
}
		/*desktops*/

		.swal2-popup {
			border: 3px solid black;
			border-radius: unset !important;
		}

		.post-detail {
				border: solid 0px black !important;
			}
		@media only screen and (min-width: 1281px) {
			#iqbreak {
				display: none;
			}
			.uk-modal-page {
	/* overflow-y: hidden !important; */
	margin-right: 16.9px;
}
			#polidesc {
				width: 12rem !important;
			}
.reviews {
			margin: 0px;
}
#return-to-student {
	display: none !important;
}

.ad-large {
margin-top: 35px;
}

.user-comment .politician #widtext {
	width: 55% !important;
} 
			#iMatr_logo {
				width: 200px;

			}
			.news11 {
				margin-bottom: 25px;
			}
			.questPad {
				/* padding-top:5px; */
			}
			.hide_mobile_top_bar{
				display: none;
			}
			.Navi_Left_tablet{
				display: none;
			}
			.top_right_tablet{
				display: none;
			}
			#dinamic_row{
				display: flex;
			}
			#dinamic_col_1{order: 1;}
			#dinamic_col_2{order: 2;}

			.responsive_width {
				width: 25rem !important;
			}
			#hide_this .right-sec {
				display: flex !important;
			}
		}
		
		/*tablets*/
		@media only screen and (min-width: 767px) and (max-width: 1280px) {
			#iqbreak {
				display: none;
			}
			#modal-contain .container {
				padding: 0px 25px 0px 25px !important;
			}
			
			.questPad {
				/* padding-top:0px; */
			}
	/*	.fl_locat{
			width:15rem !important;
		}*/
			.poli_header{
                    padding: 0px 0px 0px 25px !important;
                }
                .user_header{
                    padding-top: 0 !important;
                }
                .unlog_header{
					padding: 25px !important;
					align-items: center !important;
					text-align: center !important;
                }
                .country{
                    width:14rem !important;
                }

				
			
			
.user-comment .politician #widtext {
	width: 47% !important;
} 
			#hide_this .right-sec {
				display: block !important;
			}
			.col-md-3, .col-md-4, .col-md-5, .col-md-8, .col-md-10, .col-md-12 {
				padding-left: 14px !important;
			}
			.tablettext {
				display: none;
			}
			#dinamic_row{
				display: flex;
			}
			#dinamic_col_1{order: 1;}
			#dinamic_col_2{order: 2;}

			.hide_canadian_flag_on_mobile{
				display: none;
			}
			.hide_mobile_top_bar{
				display: none;
			}
			.Navi_Left_desktop{
				display: none;
			}
			
			.left-sec {
				display: flex;
    			flex-direction: column-reverse;
			}
			#iqContain {
				display: flex;
			}
			.rs-main{
				float: right !important;
				/* width: 300px !important; */
			}
			#iqposts {
				float: left !important;
				width: 100% !important;
			}
			#iMatr_logo {
				width: 200px;

			}
			.reviews {
			margin: 0px;
}
			
		}
		/*smartphones*/

		@media only screen and (max-width: 767px) {

			.questPad {
				padding-top:0px !important;
			}

			.sponsoredText{
				margin-top:auto;
	margin-bottom:auto;
				padding: 5px;
    display: flex;
    flex-direction: column;
	align-items: normal !important;
}


			.listTitle {
				width: 75px;
			}

			.sponsoredMargin {
				margin-right: 50px !important;
			}
			#rc-imageselect, .g-recaptcha {
         transform:scale(0.77);
         -webkit-transform:scale(0.77);
         transform-origin:0 0;
         -webkit-transform-origin:0 0;
    }
	#assignmentcontainer {
		/* padding: 0px !important; */
	}
	#fullassignlist{
		/* padding: 20px; */
	}
#iqbreak {
	display: none;
}
			.detail3 {
				position: unset !important;
			}
			
			#form1 .form-control {
				width: 100% !important;
			}
			#form2 .form-control {
				width: 100% !important;
			}
			#form3 .form-control {
				width: 100% !important;
			}
			#form4 .form-control {
				width: 100% !important;
			}
			#mobilebody {
	margin: 0px 14px !important;
}
.find-me {
	margin: 0px;
}
.news11.right-sec {
	padding-bottom: 0px;
}
.uk-modal-close-full {
	font-size: 25px;
	right: 4px !important;
}
			#iMatr_logo {
				padding-top: 8px;
				width: 150px;
			}
			#paginator, #paginator ul {
				padding-left: 0px !important;
			}
			.container {
				
			}
			.hide_canadian_flag_on_mobile{
				display: none;
			}

			.Navi_Left_desktop{
				display: none;
			}

			.Navi_Left_tablet{
				display: none;
			}

			/* #modal-page{
				z-index: 999;
			} */

			.burger {
				
			}

			#oswaldimg{
				display: none;
			}
			.accordion{
				
			}
			#iqContain {
				display: flex;
        		flex-direction: column-reverse;
			}

			.left-sec {
				display: flex;
    			flex-direction: column-reverse;
			}

			.right-sec {
				margin: 0px 14px;
			}

			.left-sec{
					/* padding: 0px 20px !important; */
			}

			.header {
				display: unset;
			}

			#no-show{
				display: none;
			}

			#oswald{
				text-align: center;
				
			}

			/* #test111{
				display: none;
			} */
			#dinamic_col_2{
				display: none;
			}

			#subheading {
				 margin-top:1rem;
				 padding: 0px!important;
				
			}
			
			#header_row {
				max-height:10px;
				z-index:999999999;
				
				
			}
#student_header {
	/* float: left; */
	/* margin-left: 15px !important; */
	/* margin-bottom: 10px !important; */
}
			#hide_this {
				display: none;
			}

			.responsive_width {
				width: 100%;
			}
			
			
		}
		/* custom smartphone */

		@media only screen and (max-width: 400px) { 
#polidesc, #widtext {
	width: 45% !important;
}


		}

		@media only screen and (max-width: 350px) { 
#polidesc, #widtext {
	width: 35% !important;
}


		}
		
		

	</style>
	<!-- <div id="modal-full" data-bs-focus="false" tabindex="uih" uk-modal>
		<div class="uk-modal-dialog  uk-width-1-1@s uk-width-1-1@m uk-width-3-4@l" aria-label="Close" style="border:solid 3px #000; background-color:#ffffff">
			
			<div class="container">
			
				<div id="modalpanel" class="row justify-content-md-center"></div>
				
				</div>
				<a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
		</div> 
	</div>  -->
<body id="body" style="background:#f6f6f6">
<!-- <div class='IQmaster' id='IQmaster' style='display:none'></div><div class='settings' id='settings' style='display:none'></div><div class='options' id='options' style='display:none'></div><div class='learnmore' id='learnmore' style='display:none; z-index:99999999999 !important'></div> -->
<div id="wrap">
  


 
 
 <section class="content main-content" style="background-color:#f6f6f6; border:none">

       

    <div id="modalcontainshift" class="container" >
	
    	<div class="row" id="dinamic_row">
		
			<div class="col-md-4 col-sm-5" id="dinamic_col_2">
				<?php 
				//print_r($_COOKIE);

				$useragent=$_SERVER['HTTP_USER_AGENT'];
if(!preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||!preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
					print "<div id='side_bar'>";
					require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_right.php'); 
					print "</div>";
}
				?>
			</div>
        	<div class="col-md-8 col-sm-7" id="dinamic_col_1">
				<div class="posts-style1 post-style">
					<!-- //hidden link to trigger content engine on page load if user profile is empty -->
					<a id="student_mode" href="#modal-page" onclick="getContentModal('student_mode', 'nav')" uk-toggle></a>
					<a id="ceauto" href="#modal-page" onclick="getModalPage('contactEngine', 'nav')" uk-toggle></a>
					<a id="shask" href="#modal-page" onclick="getModalPage('shask', 'nav')" uk-toggle></a>
	<a href="#modal-page" id="session" uk-toggle onclick="getContentModal('session', '2')" ></a>
	<a href="#first-page" id="firstvisit" uk-toggle onclick="getContentModal('firstvisit', '2')" ></a>

	<a href="#poli-Signup" id="poliSignup" uk-toggle ></a>

						
					<div id="iqposts" style="margin-bottom:2em"><!-- IQPOSTS --><div class="spinner"></div></div>
					

					<!-- Paginate results -->
					<div class="pagination">
						<ul id="paginator">
								<!-- <li class="arrow left" onclick="showIQPostsbyPage('prev')"><a href="#."><i class="icon-arrow-left2"></i></a></li>
								<li><a href="#." class="sel" onclick="showIQPostsbyPage(this.text)" >1</a></li>
								<li><a href="#." onclick="showIQPostsbyPage(this.text)">2</a></li>
								<li><a href="#." onclick="showIQPostsbyPage(this.text)">3</a></li>
								<li><a href="#." class="dots">.....</a></li>
								<li><a href="#." onclick="showIQPostsbyPage(this.text)">17</a></li>
								<li><a href="#." onclick="showIQPostsbyPage(this.text)">18</a></li>
								<li class="arrow right" onclick="showIQPostsbyPage('next')"><a href="#."><i class="icon-arrow-right2"></i></a></li>-->
						</ul> 
					</div>


				</div>
        	</div> 
        </div>                    
    </div>
</section>
    
    <!-- Latest News End -->
    



<?php 

if(!empty($questID)){
print '<li style="display:none" href="#modal-full" uk-toggle="" tabindex="0" aria-expanded="false"><button id="share" onclick="getModalContent(\''.$_GET['questID'] .'\', \'IQ\')" class="fbutton "></button>
</li>';
}


    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'footer.php'); 

?>


</div>
<!-- </div> -->



	

	

	

			
	<!-- Modal Confirm IQ-->
	<div id="answerModal" uk-modal>
		<div class="uk-modal-dialog">
            <button class="uk-modal-close-default"   type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title"></h2>
            </div>
            <div class="uk-modal-body">
				           <p></p>
           
        	</div>
			<div class="uk-modal-footer uk-text-right">
			<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			<a href="#modal-group-1" class="uk-button uk-button-primary" uk-toggle>Previous</a>
			</div>
    	</div>

	</div>

	<div class="card cookie-alert">
  <div class="card-bodys">
    <!-- <h5 class="card-title">&#x1F36A; Do you like cookies?</h5> -->
    <p class="card-text" style="margin-bottom: 0px;"><span>We use cookies and similar technologies that are necessary to operate the website. Additional cookies are used to perform analysis of website usage.</span> <span style="display: inline-block;">To continue to use our website, please consent to our use of cookies. For more information, please read our <a href="#modal-page" uk-toggle onclick="getContentModal('cookiePolicy', '2')" id="policy">Cookie Policy</a>.</span></p>
    <div  class="btn-toolbar justify-content-end"> 
     
      <a style="margin-top: 10px !important; text-align: center; margin-left: 0px;"   href="#" class="fbutton accept-cookies">Accept</a>
    </div>
  </div>
</div>





	<?php if(!empty($_SESSION['assignment_id']) || isset($_GET['assignmentID'])){?>
<a  style="    display: flex;
    justify-content: center;
    align-items: center;" href="#modal-student" id="return-to-student" uk-toggle="" tabindex="0" aria-expanded="false"><span style="color: white;" class="material-icons">school</span></a>

  <?php } ?>
  
  
  <a href="javascript:" id="return-to-top"><i >
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-up"><polyline points="17 11 12 6 7 11"></polyline><polyline points="17 18 12 13 7 18"></polyline></svg>


  </i></a>
   <a href="javascript:" id="return-to-bottom"><i >
   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-down"><polyline points="7 13 12 18 17 13"></polyline><polyline points="7 6 12 11 17 6"></polyline></svg>

  </i></a>

  <a href="javascript:" id="return-to-topmod"><i >
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-up"><polyline points="17 11 12 6 7 11"></polyline><polyline points="17 18 12 13 7 18"></polyline></svg>


  </i></a>
   <a href="javascript:" id="return-to-bottommod"><i >
   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-down"><polyline points="7 13 12 18 17 13"></polyline><polyline points="7 6 12 11 17 6"></polyline></svg>

  </i></a>

	<!-- <div id="modal-page" class="uk-modal" uk-modal >
		<div class="uk-modal-dialog uk-width-auto">
			<a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
			<div class="uk-grid-collapse uk-flex-middle" uk-grid>
				
				<div id="pagecontent1" class="uk-padding-small" style="width: 100%;">
					
				</div>
				
			</div>
		</div>
	</div> -->
	<!-- <div id="modal-page" class="uk-modal" uk-modal>
    <div class="uk-modal-dialog  uk-width-1-1@s uk-width-1-1@m uk-width-3-4@l" style="
    
 border:solid 5px #000; background-color:#ffffff; width: 1308px;">
        <a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
        <div class="uk-grid-collapse uk-flex-middle" uk-grid>

            <div id="firstcontent" class="uk-padding-small" style="width: 100%;">

            </div>

        </div>
    </div>
</div> -->


<a href="#modal-page" uk-toggle id="togglemodal" target="_blank">
<a href="#modal-full" uk-toggle id="toggleIQ" target="_blank">
	<a href="#first-page" id="firstvisit" uk-toggle onclick="getContentModal('firstvisit', '2')" target="_blank" ></a>
	<script type="text/javascript" src="<?php echo $_SERVER['MAG_TEMPLATE_PATH']  ;?>js/jquery.mmenu.min.all.js"></script>
	<script src="<?php echo $_SERVER['GLOBAL_TEMPLATE_PATH']  ;?>vendor/shared/cookie.js"></script>
	<script src="<?php echo $_SERVER['GLOBAL_TEMPLATE_PATH']  ;?>vendor/shared/modals.js"></script>

	<!-- Bootstrap -->
	<script type="text/javascript" src="<?php echo $_SERVER['MAG_TEMPLATE_PATH']  ;?>js/bootstrap.js"></script>


	<script src="<?php echo $_SERVER['GLOBAL_TEMPLATE_PATH']  ;?>/vendor/uikit/js/uikit.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script> -->
	<!-- Mobile Menu -->

	<!-- Sticky Header -->
	<script type="text/javascript" src="<?php echo $_SERVER['MAG_TEMPLATE_PATH']  ;?>js/jquery-scrolltofixed.js"></script>
	
	
	<script>
     unsubscribe = <?php echo $unsubscribe ?? 0; ?>;

	if(unsubscribe == 1){

swal.fire({
	title: 'Unsubscribed',
	text: 'You have been unsubscribed from the email list.',
	icon: 'success',
	customClass: {
		confirmButton: 'Custom_Confirm'
	}
});
}




		StudentiQModalFlag = 0 

function viewAlertLocation(latitude, longitude){

	swal.fire({
		html: '<div id="mapAlert"></div>',
		customClass: {
							closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
    cancelButton: 'Custom_Cancel'
},
	})

	var L = window.L;





    
///////////////////////////////////
    
const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {

attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">Street Map</a>'
});
// if (map != undefined) { map.remove(); } 
map = L.map('mapAlert', {
center: [latitude, longitude],
zoom: 14,
layers: [osm]
});
    console.log(map)
						var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
							maxZoom: 19,
							attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
						}).addTo(map);
					
					
						var marker = L.marker([latitude, longitude]).addTo(map)
						.bindPopup('<b>This is the location!</b>').openPopup();

						 var circle = L.circle([latitude, longitude], {
							color: 'red',
							fillColor: '#f03',
							fillOpacity: 0.5,
							radius: 75
						}).addTo(map).bindPopup('I am a circle.');
                        map.on('click', onMapClick);

}

function displayAlertCount(){

$.ajax({    
		  type: "POST",
		  url: "../includes/engagement.inc.php",             
		  data: {type:"getAlertData"},
		  dataType: "html",
		  success: function(data){ 


			  $('#headermain').prepend(data)


		  }})
}
if(user_type){
displayAlertCount()
}
function openAlerts(){

  UIkit.modal('#modal-notifications').show();

  $.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"grabAlertPanel"},
			dataType: "html",
            success: function(data){ 


				$('#noticontent').html(data)


			}})
}

function showAlert(alertID){
	$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"showAlert", alertID:alertID},
			dataType: "json",
            success: function(data){ 

				console.log(data)

				$('#alert-body').css('background-color', data.color)
				// $('#alertContainer').html(data.container)

				$('#alertContainer').replaceWith(data.container)

				$('#alert-hover1').replaceWith(data.hover1)
				$('#alert-hover2').replaceWith(data.hover2)
				$('#alert-hover3').replaceWith(data.hover3)
				$('#alert-hover4').css('background-color', data.color)







			}})


}
function deleteAlertMobile(alertID){
	$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"deleteAlert", alertID:alertID},
			dataType: "html",
            complete: function(data){

				
	$.ajax({    
		type: "POST",
		url: 'includes/engagement.inc.php',
		dataType: "HTML",
		data: {type:'pullMobileAlerts'},
		success: function(data) {
	
		$(`#alert-body.${alertID}`).remove()

			$('#noticontent').html(data)
			$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"alertCount"},
			dataType: "html",
            success: function(data){
$('#notiCount').html(data)
			}})
		}
				
				

		
		})

		}})
	}

	function getAlertCount(){
		$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"alertCount"},
			dataType: "html",
            success: function(data){
				// console.log(data)
$('#notiCount').html(data)
			}})
		
	}
	getAlertCount();


	function deleteAlerts(){
		
		items = []
		$(".itemSelect:checkbox:checked").each(function(){
			items.push($(this).val());
});

		if(items.length > 0){

			items.forEach(element => {
				
			console.log(element);
//make foreach and list reload seperate.
			$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"applyDelete", value:element},
			dataType: "html",
			success: function(data){
				$('#deleteButton').css('color', '#f6f6f6')
			$('#deleteButton').css('cursor', 'default')
				$('#alertList').replaceWith(data);
				getAlertCount();
				$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"getAlertData"},
			dataType: "html",
            success: function(data){
				console.log(data)
				$('#alert-body').remove()
				$('#alert-hover1').remove()
				$('#alert-hover2').remove()

				$('#alert-hover3').remove()
				$('#alert-hover4').remove()


$('#alertAccess').prepend(data)


			}})


			}
           })

			});

		}
	}

	function selectItem(alertID){
		event.stopPropagation();	


		selectedItems = $('.itemSelect:checkbox:checked')
		// alert(selectedItems.length);

		if(selectedItems.length > 0){
			$('#deleteButton').css('color', '#00528A')
			$('#deleteButton').css('cursor', 'pointer')


		}else {
			$('#deleteButton').css('color', '#f6f6f6')
			$('#deleteButton').css('cursor', 'default')
		}
	
	}

	function displayAlert(alertID, alertFlag){




		$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"deleteAlert", alertID:alertID, alertFlag:alertFlag},
			dataType: "html",
            success: function(data){
// console.log(data)
				$('#alertList').replaceWith(data);
				$(`.alertItem${alertID}`).css('background-color', '#ececec')

				const mediaQuerys = window.matchMedia('(max-width: 768px)')
			if (mediaQuerys.matches) {
				// alert('hide')
$('#alertList').hide();
			}else {
				document.getElementById("alertList").className = "col-md-5";

			}
				$(".listTitle").css("width", "250px");

		
	$.ajax({    
		type: "POST",
		url: 'includes/engagement.inc.php',
		dataType: "HTML",
		data: {type:'pullAlertData', alertID:alertID, alertFlag:alertFlag},
		success: function(data) {
			console.log(data)

			
			$('#alertBody').remove();
			$('#alertList').after(data);
			getAlertCount();
		
			$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"getAlertData"},
			dataType: "html",
            success: function(data){
				console.log(data)
				$('#alert-body').remove()
				$('#alert-hover1').remove()
				$('#alert-hover2').remove()

				$('#alert-hover3').remove()
				$('#alert-hover4').remove()


$('#alertAccess').prepend(data)


			}})

			}})



		}})
	}

	function closeAlert(alertID){

		$('#alertBody').remove();

		$(`.alertItem${alertID}`).css('background-color', '')


		const mediaQuerys = window.matchMedia('(max-width: 768px)')
			if (mediaQuerys.matches) {

$('#alertList').show();
$(".listTitle").css("width", "75px");

			}else {
				document.getElementById("alertList").className = "col-md-12";
				$(".listTitle").css("width", "100%");

			}
			$('#listTitle').css('width', "100%")

	}

function deleteAlert(alertID){

	$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"deleteAlert", alertID:alertID},
			dataType: "html",
            complete: function(data){

				
	$.ajax({    
			type: "POST",
			url: "../includes/engagement.inc.php",             
			data: {type:"getAlertData"},
			dataType: "html",
            success: function(data){
				console.log(data)
				$('#alert-body').remove()
				$('#alert-hover1').remove()
				$('#alert-hover2').remove()

				$('#alert-hover3').remove()
				$('#alert-hover4').remove()


$('#headermain').prepend(data)


			}})

            }})


}

// var element = document.querySelector('#modalcontainshift');
// // setTimeout(function() {
// //   element.setAttribute('data-text', 'whatever');
// // }, 5000)

// var observer = new MutationObserver(function(mutations) {
//   mutations.forEach(function(mutation) {
//     if (mutation.type === "attributes") {
//       console.log("attributes changed");

//       // Example of accessing the element for which 
//       // event was triggered
//       mutation.target.textContent = "Attribute of the element changed";
//     }
    
//     console.log(mutation.target);
//   });
// });

// observer.observe(element, {
//   attributes: true //configure it to listen to attribute changes
// });


repdata = getCookie("repdata");
				// public_profile = getCookie("basic_profile");
				


				


function closemodal(){
	setTimeout(() => {
		document.querySelector('.swal2-confirm.Custom_Confirm.swal2-styled').click()
	}, 500);
		
	

	}

	function closeIQ(){
		document.getElementById('toggleIQ').click()

	}
	function goto_map(){
				
				
		
				var stop = $('#map').offset()
				window.scrollTo({
				
				top: stop.top- 200,
				behavior: "smooth"
				})
			}

		function goelocation_warning(){
			Swal.fire({
			
				html: 'The government representatives currently being shown are based on your geolocation. If your home location is not accurate, please enter your <a style="font-family: \'Fira Sans\' !important;" onclick="goto_map();closemodal();">address and postal code</a> for better results.',
				
				customClass: {
    confirmButton: 'Custom_Confirm',
    cancelButton: 'Custom_Cancel',
	text: 'Custom_Text'
},
			})
	
	
			}
			function feed_warning(){
			Swal.fire({
			
				html: 'iMatr\'s daily feed provides Canadians up-to-the-minute issues/questions (\"iQs\") that might be of interest in daily events. This information is filtered according to a user\'s preference tags and their scope of view. When news breaks, Canadians can let politicians, organizations, governments, and other citizens know what they think.',
				
				customClass: {
    confirmButton: 'Custom_Confirm',
    cancelButton: 'Custom_Cancel',
	text: 'Custom_Text'
},
			})
	
	
			}


			function session_warning(){
			Swal.fire({
			
				html: 'The iMatr application has been left open and unattended for some time. For security reasons and to protect your account data, a session time out has occurred.  Please login to continue your user experience.',
				
				customClass: {
    confirmButton: 'Custom_Confirm',
    cancelButton: 'Custom_Cancel',
	text: 'Custom_Text'
},
			})
	
	
			}
		
		$(document).ready(function() {
			
const mediaQuerys = window.matchMedia('(max-width: 768px)')
			if (mediaQuerys.matches) {

$('#recaptcha').attr('data-size', 'compact')



}else{
//console.log($('#recaptchay'))

$('#recaptcha').attr('data-size', 'normal')

}

			queryString = window.location.search;
// console.log(queryString);


const urlParams = new URLSearchParams(queryString);
const product = urlParams.get('contact')
// console.log(product);

if (product == 1) {

	document.getElementById("contact").click()

	// console.log(document.getElementById("contact"))
}


var rect = document.getElementById("bottomofpage").getBoundingClientRect()
//console.log(rect.top)

const mediaQuery = window.matchMedia('(max-width: 768px)')
// Check if the media query is true
if (mediaQuery.matches) {
  // Then trigger an alert
  xScroll = 9000
}
else {
	xScroll = 5000
}


$('#modal-page').scroll(function() {
    if ($('#modal-page').scrollTop() <= xScroll) {        // If page is scrolled more than 50px
        $('#return-to-bottommod').fadeIn(200);   
		$('#return-to-bottom').fadeOut(200);   // Fade in the arrow
    } else {
        $('#return-to-bottommod').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-bottommod').click(function() {    

	// When arrow is clicked
    $('#modal-page').animate({ scrollTop: $('#pagecontent').height() }, 500);
});


$('#modal-page').scroll(function() {
    if ($('#modal-page').scrollTop() >= 1000) {        // If page is scrolled more than 50px
        $('#return-to-topmod').fadeIn(200); 
		$('#return-to-top').fadeOut(200); 
		// Fade in the arrow
    } else {
        $('#return-to-topmod').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-topmod').click(function() {      // When arrow is clicked
    $('#modal-page').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

			// ===== Scroll to Top ==== 
$(document).scroll(function() {
    if ($(this).scrollTop() >= 1000) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200); 
		$('#return-to-topmod').fadeOut(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});



// console.log(xScroll)

$(window).scroll(function() {
    if ($(this).scrollTop() <= xScroll) {        // If page is scrolled more than 50px
        $('#return-to-bottom').fadeIn(200);
		$('#return-to-bottommod').fadeOut(200);      // Fade in the arrow
    } else {
        $('#return-to-bottom').fadeOut(200); 
		  // Else fade out the arrow
    }
});
$('#return-to-bottom').click(function() {      // When arrow is clicked
    $('body,html').animate({ scrollTop: $(document).height()-$(window).height() }, 500);
});










(function () {
    "use strict";

    var cookieAlert = document.querySelector(".cookie-alert");
    var acceptCookies = document.querySelector(".accept-cookies");

    cookieAlert.offsetHeight; // Force browser to trigger reflow (https://stackoverflow.com/a/39451131)

    if (!getCookie("acceptCookies")) {
        cookieAlert.classList.add("show");
    }

    acceptCookies.addEventListener("click", function () {
        setCookie("acceptCookies", true, 60);
        cookieAlert.classList.remove("show");
    });
})();

// 9000 for mobile

//5000 for desktop

// Create a media condition that targets viewports at least 768px wide



			

			firstvisit = getCookie('firstvisit')

			if (firstvisit == ""){

				// console.log('This is your first time on the site')
				$(document).ready(function() {
		document.getElementById("firstvisit").click()
		// window.dialog('hi')
	
	})
				// setCookie('firstvisit', 'false')
				setCookiebyDuration('firstvisit', 'false', 365, 'days')
				
			} else {
				// console.log('This is not your first time on the site!')
			}


			if(window.matchMedia('(max-width: 767px)').matches) {
			$("#side_bar").html(''); 
			}

			//check user_id cookie
			uid = getCookie('user_id');
			//alert("uid"+uid);
			// Dock the header to the top of the window when scrolled past the banner.
			// This is the default behavior.

			jQuery('.sticky-header').scrollToFixed();


			// Dock the footer to the bottom of the page, but scroll up to reveal more
			// content if the page is scrolled far enough.



			// Dock each summary as it arrives just below the docked header, pushing the
			// previous summary up the page.

			var summaries = $('.summary');
			summaries.each(function(i) {
				var summary = $(summaries[i]);
				var next = summaries[i + 1];

				summary.scrollToFixed({
					marginTop: $('.sticky-header').outerHeight(true) + 10,
					limit: function() {
						var limit = 0;
						if (next) {
							limit = $(next).offset().top - $(this).outerHeight(true) - 10;
						} else {
							limit = $('.footer').offset().top - $(this).outerHeight(true) - 10;
						}
						return limit;
					},
					zIndex: 999
				});
			});
		});
	</script>

	<!-- Modal Panel -->
		<style>
			.uk-panel {
		
				background: #eee;
				color: #666;
				border: 1px solid #d5d5d5;
		
		
			}
			.uk-margin {    
					margin: 0  !important;    
			}

			.picpanel {
			
				height:50vh;
			
			}
			.qpanel {
			
				height:50vh;
			
			}
			.apanel  {
			
				height:100vh;
			
			}

			#accordionExample .row{
				border-bottom:solid 1px #999;
				margin: 1em;
				padding: .1em 0;	
			}

			#accordionExample h5{
				color:#3366cc;
				
			}
			
			
		</style>

	<!--IQ Posts-->
	
<script>


<?php if($student_mode == true || isset($_GET['assignmentID'])){ ?>

	if( $(window).width() > 1281 )
	{
	$('#hide_this').hide();

	$.ajax({    
					type: "POST",
					url: "../includes/student.inc.php",             
					data: {type: "load_assignment"},
					dataType: "json",                  
					success: function(data){  

						console.log(data)

						$('body').after(data.module)



					 }})

					}

	<?php }?>


	// $(document).ready(function(){
	// 	$("#resources").attr('class', 'collapse');
	// });
	 //AJAX FUNCTIONS
	 $(document).ready(function(){

		const queryString = window.location.search;
  		const urlParams = new URLSearchParams(queryString);
  		const page = urlParams.get('page');
  		const subpage =urlParams.get("subpage");
			//console.log(queryString);
			if(urlParams.get('questID')){
				questID = urlParams.get('questID');
				setTimeout(function(){

					<?php
					//IF CLICKED ON ASK/SHARE AND NOT REGISTERED, OPEN iQ, ELSE, IF CLICKED ON ASK/SHARE AND REGISTERED, DONT OPEN IQ
					 if(isset($_GET['uniq_id'])){
						 if($_SESSION['saskFlag'] !== 1){
							 ?>
					document.getElementById('share').click();
					<?php
				 }}else{
				  ?>
				  $.ajax({    
type: "POST",
url: "../includes/engagement.inc.php",             
data: {type: "update_sask"},
dataType: "html",                  
success: function(data){   
				  					document.getElementById('share').click();
}})
				  <?php } ?>
				}, 500);
				
			}

		
		
		if(page == "modal"){
			//alert(subpage);
		}

		student_mode = getCookie("student");
		//alert("student mode ="+student_mode)
		


		<?php
		
$openassign = new StudentView;
   
// echo $openassign->areThereOpenAssignments();
// print_r($openassign->areThereOpenAssignments());

$comparison = $openassign->areThereOpenAssignments();
		
$totalassign = json_encode($comparison);

		
		?>
comparison = <?php echo $totalassign; ?>


	})

// function pullCoordinatesFromGPS(){



<?php 
if (isset($_COOKIE['student']) && $_COOKIE['student'] == true){
// echo $_SESSION['student'];
$_SESSION['studentvisit'] = "set";
// echo $_SESSION['student'];

}
?>
// setCookie('student', '', -1);
//  setCookie('assignment', '', -1)




						
			


function locationError() {
	console.log("error")
}





async function getRepZone(){

repdata = JSON.parse(<?php if(!empty($repdata)){
	echo (json_encode($repdata));
}
	else {
	echo "null";
} ?>)

console.log(repdata)

let address = repdata.ecity +','+repdata.eprovince+', Canada';//ED FAST
// alert(address);	

const api_url = "//nominatim.openstreetmap.org/search?format=json&q="+address ;
//alert(api_url);	
const response = await fetch(api_url);
const data = await response.json();

latitude = parseFloat(data[0].lat);
longitude = parseFloat(data[0].lon);
coordinates = latitude +','+longitude;


coordinates = {coords:{latitude:latitude, longitude:longitude}}

locationSuccess(coordinates)


};

// 					//Geolocation is not supported by this browser. Use Ottawa coordinates as default;
					
// 					// latitude =  45.444369;

function Copy(url_iq) {
        var url = '<?php echo $_SERVER['HTTP_URL']; ?>' + '/share.php?questid=' + url_iq;
        navigator.clipboard.writeText(url).then(function() {
                Swal.fire({
                	title: "Link for this iQ was copied",
                	timer: 2000,
                	showConfirmButton: false   
            });
        });
        
    }
	
	function add_suggestion(iQ_id){
		var suggestion = "";		
		$('#modal-full').attr('style', 'overflow-y: hidden;overscroll-behavior: contain; display: block;')

		user_id = <?php echo $_SESSION['user_id'] ?? 0 ?>;
		if(!user_id) Swal.fire({
							title: "Please login or sign up",
							timer: 2000,
							showConfirmButton: false   
					});
		else
		Swal.fire({
					title: 'Add suggestion for this iQ',
					showCloseButton: false,
					showDenyButton: false,
					showCancelButton: true,
					confirmButtonText: 'Submit',
					input: 'textarea',
					inputPlaceholder: "Type your suggestion here...",
					inputAttributes: {
						"aria-label": "Type your message here",
						"maxlength": 300
					},
					customClass: {
						confirmButton: 'Custom_Confirm',
						//closeButton: 'uk-modal-close-full icon-cross2',
						input: 'custom_textarea',
						//denyButton: 'Custom_Cancel',
						cancelButton: 'Custom_Cancel'
					},
					didOpen: () => {
						const modalContainer = document.querySelector('.swal2-modal');
						if (modalContainer) {
							modalContainer.style.overflowY = 'hidden';
						}
					},
					preConfirm: (inputValue) => {
						if ((!inputValue)||(inputValue.trim().length < 20)) {
							Swal.showValidationMessage('Please provide your suggestion (minimum 20 symbols).');
							console.log(inputValue.trim().length, 'lenght')

							return false;
						}else {suggestion = inputValue;
							console.log(inputValue.trim().length, 'lenght')

						}
					}
			}).then((result) =>{
				if(result.isConfirmed){
				
				$.ajax({    
					type: "POST",
					url: "../includes/iqposts.inc.php",             
					data: {type: "add_suggestion", user_id:user_id, suggestion:suggestion, questID:iQ_id},
					dataType: "html",                  
					success: function(data){   
				//console.log(data);
						
						Swal.fire({
							title: "Thank you for your suggestion",
							timer: 2000,
							showConfirmButton: false   
					});
					},
					error: function(error){
						console.log("Error:");
						console.log(error);
						$("#error").show();                 
						$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
						
					},
				});
			}
			$('#modal-full').attr('style', 'overflow-y: auto;overscroll-behavior: contain; display: block;')

			});

			
	}

	function getbla(){
		var glob_request;
		var request_search;
		$( "#autocomplete3" ).autocomplete({
			open: function () { $('.ui-autocomplete').css('z-index', 9999999999); },

			source: function( request, response ) {
				glob_request = request;
				request_search = request.term;
			// Fetch data
			// console.log('search ', request_search)
					$.ajax({
						url: "../includes/politician.inc.php",             
						type: 'post',
						dataType: "json",
						data: {
						organization: request_search, type: "municipality_search"
						},
						success: function( data ) {
							
						response(data);
						// console.log(JSON.parse(data));
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log("Status: " + textStatus + errorThrown);
                        alert("Error: " + errorThrown);
                        // alert("Internet Connection issue");
                    }
					});
			},
			select: function (event, ui) {

				// console.log(ui.item.value)
				// Set selection
				$.ajax({
                        type: "post",
                        url: "../includes/politician.inc.php",
                        data: {
                            "type": "municipality_politicians",
                            "search": ui.item.value
                        },
                        dataType: "html",
                        success: function(data) {
							// console.log(data);
                            $("#municipal_results").html(data);
                           // $("#iqposts").prop('style', 'z-index:11');
                        }
                    });
			},
	
		});
	}



	async function saveIQPoliticianAnswer(question, answer){

		

				
			rep_id = <?php echo $_SESSION['rep_id'] ?? 0 ?>;
			user_id = <?php echo $_SESSION['user_id'] ?? 0 ?>;


			$.ajax({    
					type: "POST",
					url: "../includes/politician.inc.php",             
					data: {type: "check_Subscription", iq_id:question},
				//	async: true,
					dataType: "json",                  
					success: function(data){  
						subscription = data.active

					
			if (user_id == ""){
				alert("You must be logged in and verified with a PIN number to contact your politician through imatr ")
			}else {


				$.ajax({    
					type: "POST",
					url: "../includes/engagement.inc.php",             
					data: {type: "checkPoliAnswer", iq_id:question},
					async: true,
					dataType: "html",                  
					success: function(data){  
if(data == 0){
	$.ajax({    
					type: "POST",
					url: "../includes/engagement.inc.php",             
					data: {type: "save_repIQ", user_id:user_id, rep_id:rep_id, answer:answer, question:question},
					dataType: "html",                  
					success: function(data){   

						


						
						if(data == 'Expired'){
							swal_expiry_message()
						}else{

						if(subscription == '1'){

					
							// $.fn.modal.Constructor.prototype._enforceFocus = function() {};
							Swal.fire({
							title: 'Do you want to add your rationale?',
							// html: 'What do you want to do next?',
							focusConfirm: false,

							showDenyButton: true,
								showCancelButton: false,
								confirmButtonText: 'Add',
								denyButtonText: 'Skip',
								// cancelButtonText: 'Go Back to iQ list',
								input: 'textarea',
//   inputLabel: "Message",
  inputPlaceholder: "Type your rationale here...",
  inputAttributes: {
    "aria-label": "Type your message here",
	maxlength: 1000
  },
  customClass: {
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
								}).then((result) => {
// console.log(result)
									if (result.value !== false) {
										rationale_val = result.value.replace(/'/g, "\\'");
									//	console.log(rationale_val);
										$.ajax({    
					type: "POST",
					url: "../includes/engagement.inc.php",             
					data: {type: "save_rationale", user_id:user_id, question:question, rationale:rationale_val },
					dataType: "html",                  
					success: function(data){   


					}})
										
										/// ask for raionale, 

									}



										Swal.fire({
							title: 'Your answer is saved!',
							html: 'What do you want to do next?<br><button style="font-size: 16px;" id="studentassign" onclick = "window.location.href=\'index_dashboard.php?page=politician_dash\';" class="swal2-confirm Custom_Cancel swal2-styled">Go to Dashboard</button>',
							showDenyButton: true,
								showCancelButton: true,
								confirmButtonText: 'See What Constituents Think',
								denyButtonText: 'What Others Think',
								cancelButtonText: 'Go Back to iQ list',
								customClass: {
									popup: 'studentcontain',
									confirmButton: 'Custom_Engage',
									denyButton: 'Custom_WOT',
									cancelButton: 'Custom_Cancel'
								},
								}).then((result) => {
									if (result.isConfirmed) {
											document.location.href = 'index_dashboard.php?page=rep_overview' ; 	    
									} else if (result.isDenied) {
											document.location.href = 'index_dashboard.php?page=wot&subpage=WOT&quest_id='+question ; 
									}else {
																			//CHANGE HERE
																			$('#modal-full').attr('style', 'overscroll-behavior: contain; display: block;')


									element = $('#modal-full');
									UIkit.modal(element).hide();

									$(`#iQ-${question}`).remove();

									//	document.location.href = 'index.php' ;    
									}
							})



									// }
								
								})
						}else if(subscription == 0){

							gotoManager(user_id, 'login');


							}else if(subscription == 'undefined'){
							Swal.fire({
							title: 'Your answer is saved!',
							html: '<div style="padding-bottom: 15px;">To continue using the site, you must purchase a subscription</div>',
							showDenyButton: true,
								showCancelButton: false,
								confirmButtonText: 'Purchase Subscription',
								denyButtonText: 'No thanks',
								customClass: {
									popup: 'studentcontain',
									confirmButton: 'Custom_Engage',
									denyButton: 'Custom_WOT',
									cancelButton: 'Custom_Cancel'
								},
								}).then((result) => {
									if(result.isConfirmed){
									displayPlans(rep_id, user_id, subscription)
									  }else{

                               
              

                window.location.href = 'index.php';

                            }
								})
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



}})
				
				
			}

		}})
	
	}

	function saveIQPublicAnswer(question, answer){
		
		
		if (user_id == ""){
			alert("You must be logged in and verified with a PIN number to contact your politician through imatr ")
		}else {
			
					$.ajax({    
					type: "POST",
					url: "../includes/engagement.inc.php",             
					data: {type: "save_IQ", user_id:user_id, answer:answer, question:question},
					dataType: "html",                  
					success: function(data){   
						// setCookiebyDuration("iq", iq_id, 1, 'hours');
						// iq = getCookie("iq");
						
						Swal.fire({
							title: 'Answer Saved',
							text: "You have saved your answer. Your constituents will now know your stance on this question!",
							icon: 'success',
						
							confirmButtonColor: '#3085d6',
						
							confirmButtonText: 'OK'
							}).then((result) => {
							if (result.isConfirmed) {
								document.location.href = 'admin/index_rep.php' ;    
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
	};

	function set_IQid(IQid){
		document.cookie = "iq=" + IQid;

		$("#yesbutton").prop("disabled", true);

		$('#modal-full').attr('style', 'overflow-y: hidden;overscroll-behavior: contain; display: block;')
	}

	function saveIQAnswerTriage(question, answer){

		uniq_id = '0'

		$("#yesbutton").prop("disabled", true);

		//user_type determines where to save the answer panswers=politician answers=public/student
		<?php if(isset($_GET['uniq_id'])){?>
			uniq_id = '<?php echo $encryption->decrypt(urldecode($_GET['uniq_id'])) ?? '0'; ?>' || '0'


<?php }?>
		assignment_id = getCookie('assignment')
		student = getCookie('student')
		user_type = '<?php echo $_SESSION['user_type'] ?>' ?? "";
		if(uniq_id !== '0'){



$.ajax({    
					type: "POST",
					url: "../includes/politician.inc.php",             
					data: {type: "grabPoliInfo", uniq_id:uniq_id},
					// async: true,
					dataType: "json",                  
					success: function(data){  
// console.log(data);

						user_id = data.userID
						rep_id = data.repID


						

				

	// alert(user_id)
	// alert(rep_id)
			if (user_id == ""){
				alert("You must be logged in and verified with a PIN number to contact your politician through imatr ")
			}else {

// alert(user_id);
// alert(question);

				$.ajax({    
					type: "POST",
					url: "../includes/engagement.inc.php",             
					data: {type: "checkPoliAnswerOut", user_id:user_id, iq_id:question},
					// async: true,
					dataType: "html",                  
					success: function(data){  
if(data == ""){
	$.ajax({    
					type: "POST",
					url: "../includes/engagement.inc.php",             
					data: {type: "save_repIQout", user_id:user_id, rep_id:rep_id, answer:answer, question:question},
					dataType: "html",  
					success: function(data){   

// alert(data)
					}})

			if(userStatus !== "N"){
	
		var x = window.matchMedia("(max-width: 767px)")
			if (x.matches) {
				width = '90%' 
			}else {
				width = "70%";
			}
			Swal.fire({
	
	html: '<div class="flex-container" style="margin-top:0; margin-left:0; margin-bottom:0;">' +
            '<div class="">' +
				
				'' +
					'' +
					'<p style="font-size: 35pt; margin-top: 20px;    line-height: 1.1;">Thank you for responding to your constituent through iMatr.</p><br><p  style="font-size: 18pt; text-align: left !important;">'+
					'Simply create a password and subscribe for $45/month to unlock the full potential of our Constituent Relations Management (CRM) software:<br><br>'+
					'·       Discover what your constituents think on current issues.<br>'+
					'·       Share your stance with them on what you think.<br>'+
					'·       Explore opinions from other groups of Canadians.<br>'+
					'·       Utilize our back-office CRM support.<br>'+
					'·       And much more!</p>'+



					
				'</div><hr style= "color: #e5e6e7;">' +
			'</div>',
           
        width: width,
		allowOutsideClick: false, 
		allowEscapeKey: false,               
		showCloseButton: false,
		showDenyButton: true,
		showCancelButton: false,
		showConfirmButton: true,
		confirmButtonText: "Let's do it!",
						
							
		customClass: {
			closeButton: 'uk-modal-close-full icon-cross2',
			container: 'Custom_Container_Story',
			confirmButton: 'Custom_Confirm',
			cancelButton: 'Custom_Cancel',
			denyButton: 'Custom_Cancel',


			}
		
		
	}


).then((result) => {
		if (result.isConfirmed) { 

		// setTimeout(() => {
		UIkit.modal('#modal-password').show();

		// }, 500);
		}else {
			swal.fire({
				html: '<div class="flex-container" style="margin-top:0; margin-left:0; margin-bottom:0;">' +
            '<div class="">' +
				
				'' +
					'' +
					'<br><p style="font-size: 18pt; margin-top: 20px;    line-height: 1.1;">You have chosen not to create a password for iMatr. By opting out, you will not have access to our tools that enhance citizen engagement and increase your re-election prospects. However, you can still interact with your constituents by responding to their Ask and Share emails.</p><br>'+
					



					
				'</div><hr style= "color: #e5e6e7;">' +
			'</div>',
           
        width: width,
		showCloseButton: false,
		showDenyButton: false,
		showCancelButton: false,
		allowEscapeKey: false,
		allowOutsideClick: false,                

		showConfirmButton: true,
		confirmButtonText: "Alright!",
						
							
		customClass: {
			closeButton: 'uk-modal-close-full icon-cross2',
			container: 'Custom_Container_Story',
			confirmButton: 'Custom_Confirm',
			denyButton: 'Custom_Deny',
cancelButton: 'Custom_Cancel',

			}
			}).then((result) => {
				if (result.isConfirmed) {
location.href = "index.php";
				}})
		}
		
	}




	
)
			}else {
				
				swal.fire({
	html:`<p style="font-size: 16pt; font-weight: 700; text-align: left;">Your response has been saved. Thank you for registering your account. It is currently being activated. To complete the process, please verify your access to ${userEmail} by sending an email to <a href="mailto:contact@mail.imatr.org">contact@mail.imatr.org</a>.</p>`,
target: "body",
	customClass: {
		container: "Custom_Container",
	
			closeButton: 'uk-modal-close-full icon-cross2',
		
			confirmButton: 'Custom_Confirm',
			cancelButton: 'Custom_Cancel',
			denyButton: 'Custom_Cancel',


			
	}

}
	
)
.then((result) => {

					location.href = "index.php";

				})
			}
	}else{
		$.ajax({    
					type: "POST",
					url: "../includes/engagement.inc.php",             
					data: {type: "getAnswerData", answer:data, questID:question},
					// async: true,
					dataType: "html",                  
					success: function(data){ 
console.log(data)

var x = window.matchMedia("(max-width: 767px)")
			if (x.matches) {
				width = '90%' 
			}else {
				width = "70%";
			}
		swal.fire({
				html: '<div class="flex-container" style="margin-top:0; margin-left:0; margin-bottom:0;">' +
            '<div class="">' +
				
				'' +
					'' +
					'<br><p style="font-size: 18pt; margin-top: 20px;    line-height: 1.1;">You have already answered this question.</p>'+
					`<p style="font-size: 18pt; margin-top: 20px;    line-height: 1.1;">You answered:<br> ${data}</p>`+
					`<p style="font-size: 18pt; margin-top: 20px;    line-height: 1.1;">To change your answer, please register with iMatr.</p>`+




					
				'</div><hr style= "color: #e5e6e7;">' +
			'</div>',
           
        // width: width,
		showCloseButton: false,
		showDenyButton: false,
		showCancelButton: false,
		allowEscapeKey: false,
		allowOutsideClick: false,                

		showConfirmButton: true,
		confirmButtonText: "Alright!",
						
							
		customClass: {
			closeButton: 'uk-modal-close-full icon-cross2',
			container: 'Custom_Container_Story',
			confirmButton: 'Custom_Confirm',
			denyButton: 'Custom_Deny',
cancelButton: 'Custom_Cancel',

			}
			}).then((result) => {
				if (result.isConfirmed) {
location.href = "index.php";
				}})

			}})

							}
			
			}})
			}
		}})
	
		}else{
		if (user_type == "EP"){
			saveIQPoliticianAnswer(question, answer) ;

		}else if (student !== "") {
			saveIQStudentAnswer(question, answer);
		}
		else{
			saveIQAnswer(question, answer);

		}
	}
		//alert(user_type);
	
	};

	window.addEventListener('load', function() {
                                // Select all elements with the class 'exclude-translate'
                                var symbolsOutlined = document.querySelectorAll('.material-symbols-outlined');
                                var icons = document.querySelectorAll('.material-icons');
                                var iconsOutlined = document.querySelectorAll('.material-icons-outlined');
								
								 iconsOutlined.forEach(function(iconsOutlined) {
                                    iconsOutlined.classList.add('notranslate');
                                });

                                // Add 'notranslate' class to each selected element
                                icons.forEach(function(icons) {
                                    icons.classList.add('notranslate');
                                });

                                symbolsOutlined.forEach(function(symbolsOutlined) {
                                    symbolsOutlined.classList.add('notranslate');
                                });
								// $('.top-bar').addClass('notranslate');

							
                                function googleTranslateElementInit() {
									if (window.matchMedia("(max-width: 767px)").matches) {
										new google.translate.TranslateElement({
                                        pageLanguage: 'en',
                                        includedLanguages: 'en,fr',
                                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                    }, 'google_translate_element2');
								}else{
                                    new google.translate.TranslateElement({
                                        pageLanguage: 'en',
                                        includedLanguages: 'en,fr',
                                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                    }, 'google_translate_element');

								}
							}

									if(getCookie('googtrans') == '/en/fr'){
                                $('.top-bar .container').attr('style', 'max-width: 1500px !important;');
							}		



								
            googleTranslateElementInit();
        
                            

								
							    const targetElement = document.getElementById('target-element');

    // Function to detect text changes
    function detectTextChanges(element) {
      // Create a MutationObserver to watch for text changes
      const observer = new MutationObserver((mutationsList) => {
        mutationsList.forEach((mutation) => {
          if (mutation.type === 'characterData' || mutation.type === 'childList') {
            console.log('Text changed:', element.textContent);

            // Perform actions based on the new text
            handleTextChange(element);
          }
        });
      });

      // Configure the observer to watch for text and child node changes
      const observerConfig = {
        characterData: true, // Watch for text changes
        childList: true, // Watch for added/removed nodes
        subtree: true, // Watch all descendants
      };

      // Start observing the element
      observer.observe(element, observerConfig);
    }

    // Function to handle text changes
    function handleTextChange(element) {
      if(element.textContent == 'Maison'){
		$('.top-bar .container').attr('style', 'max-width: 1500px !important;');
	  }else{
		$('.top-bar .container').attr('style', 'max-width: 1308px  !important;');
	  }
      // Add your custom logic here
    }

    // Initialize text change detection for the target element
    const homeButtonElement = document.getElementById('home-button');

// Pass the DOM element (not the ID string) to the function
detectTextChanges(homeButtonElement);
						});

					

	function goSignIn(){
		//alert("test");
		location.href = 'register.php';
	};

	function showYNButtons(id){
		//alert(id);
		// $('.yesbutton').hide();
		$('#'+id+"yes").show();
		$('#'+id+"check").show();
		$('#'+id+"card").css("background-color", "#e4e7ec");//change background color to 
		$('#'+id+"card").focusout(function () {
                $(this).css("background-color", "#FFFFFF");
				//$('#'+id+"yes").hide();
				
            });

	};

	
    function showIQPosts(){

        //user_id =650;
		        // var url_string = window.location;
        // var url = new URL(url_string);
        // var assignment_id = url.searchParams.get("assignment_id");
        // var student_id = url.searchParams.get("student_id");
        // var user_id = url.searchParams.get("user_id");
        row =  0;
		user_type = getCookie("user_type");
	
        row =  0;
		logged_in = 1;
		if(user_type == ""){
			logged_in = 0;
		}
		stat = "A";
		//alert(logged_in);
        //alert(assessment_id);

        //alert("class id is:"+assignment_id+" and user_id id is:"+user_id);


        $.ajax({    
                    type: "POST",
                    url: "../includes/iqposts.inc.php",             
                    data: {type:"iqposts", row:row, stat:stat, logged_in:logged_in},
                    dataType: "html",                  
                    success: function(data){   
                        //console.log(data);                 
                        $("#iqposts").html(data); 
                    
                        
                        //debugging only
                        //$("#message").show();
                        //$("#message").html(data);  
                        
                    
                    },
                    error: function(error){
                        console.log("Error:");
                        console.log(error);
                        $("#error").show();                 
                        $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
                        
                    },
                });

    };

	function showPoliticians(organization, primary_role){


		$.ajax({    
					type: "POST",
					url: "../includes/iqposts.inc.php",             
					data: {type:"iqposts", row:row, stat:stat, logged_in:logged_in},
					dataType: "html",                  
					success: function(data){   
						//console.log(data);                 
						$("#iqposts").html(data); 
					
						
						//debugging only
						//$("#message").show();
						//$("#message").html(data);  
						
					
					},
					error: function(error){
						console.log("Error:");
						console.log(error);
						$("#error").show();                 
						$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
						
					},
				});

	};

	function get_smoke_details(content_id, content_type, smoke_type) {


		rep_id = document.getElementById('pick_poli').value;
		$.ajax({    
		type: "POST",
		url: "../includes/modal_generator.inc.php",             
		data: {type:"smokeDetails", content_id:content_id, content_type:content_type, smoke_type:smoke_type, rep_id:rep_id },
		dataType: "html",  
		beforeSend : function() {
			$('#smoke_details').empty();
		},                
		success: function(data){   
			//console.log(data);  
			$('#smoke_details').empty();               
			$('#smoke_details').html(data); 

		},
		// complete: function(){

		// 	//showIQPosts();
		// },
		error: function(error){
			//console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
		});

	}


	function getIQthisHtag(htag_name){
		console.log(htag_name)
		$.ajax({    
			type: "POST",
			url: "includes/iqposts.inc.php",             
			data: {type:"getIQbyHtag", htag:htag_name },
			dataType: "html",            
			success: function(data){   
				console.log(data);  
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
				UIkit.modal('#modal-full').hide();
				$('#iqposts').html(data); 
				$('#paginator').hide();
			},	
			error: function(error){
				console.log(error);
				$("#error").show();                 
				$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
				
			},
		});
	}

	function showIQCategoryPosts(category_id, cattype){

			//alert(category_id)
			row =  0;
			logged_in = 0;
			stat = "A";
			if (cattype == 'sub'){

				qtype = "iqpostsubcat";


			}else {

				qtype = "iqpostcat";

			}

			//alert(assessment_id);

			//alert("class id is:"+assignment_id+" and user_id id is:"+user_id);


			$.ajax({    
						type: "POST",
						url: "../includes/iqposts.inc.php",             
						data: {type: qtype, row:row, stat:stat, logged_in:logged_in, category_id:category_id},
						dataType: "html",                  
						success: function(data){   
							window.scrollTo(0, 0);                
							$("#iqposts").html(data); 
						
							
							//debugging only
							//$("#message").show();
							//$("#message").html(data);  
							
						
						},
						error: function(error){
							console.log("Error:");
							console.log(error);
							$("#error").show();                 
							$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
							
						},
					});

	};

	function saveIQStudentAnswer(question, answer){

		user_id = '<?php echo $user_id ?>';

		student = getCookie("student");
		assignment_id = getCookie('assignment')

		button = ""
			contain = ""

		if (assignment_id > 0){
			contain = "studentcontain"
			// button = '<button id="studentassign" onclick = "window.location.href=\'index_dashboard.php?page=engage&subpage=student\';" style="font-size: 16px;" class="swal2-confirm Custom_Cancel swal2-styled">Finish Assignment</button>'
			button = ''
		}

		if (user_id == ""){
			alert("You must be logged in and verified with a PIN number to contact your politician through imatr ")
		}else {
			$.ajax({    
				type: "POST",
				url: "../includes/engagement.inc.php",             
				data: {type: "save_studentIQ", user_id:user_id, answer:answer, iq_id:question, assignment_id:assignment_id},
				dataType: "html",                  
				success: function(data){ 
					if(data == 'Expired'){  
						swal_expiry_message()
					}else{
					setCookiebyDuration("iq", question, 1, 'days');
					iq = getCookie("iq");
					Swal.fire({
						title: '<h3>Your answer is saved!</h3>',
							html: 'Where do you want to go next?<br>'+button,
							showDenyButton: true,
							showCancelButton: true,
							confirmButtonText: 'Engage with Representatives',
							denyButtonText: 'What Others Think',
							cancelButtonText: 'Go Back to iQ list',
							customClass: {
								cancelButton: 'order-1 right-gap',
								confirmButton: 'order-2',
								denyButton: 'order-3',
							},
							customClass: {
								popup: contain,
								confirmButton: 'Custom_Engage',
								denyButton: 'Custom_WOT',
								cancelButton: 'Custom_Cancel'
								},
							}).then((result) => {
								if (result.isConfirmed) {
									if ( student == "true"){
										document.location.href = 'index_dashboard.php?page=engage&subpage=student' ; 
									}else {
										document.location.href = 'index_dashboard.php?page=engage&subpage=WOT' ; 
									}     
								} else if (result.isDenied) {
									if ( student == "true"){
										document.location.href = 'index_dashboard.php?page=wot&subpage=student&quest_id='+question ; 
									}else {
										document.location.href = 'index_dashboard.php?page=wot&subpage=WOT&quest_id='+question ; 								
									}
								}else {
									document.location.href = 'index.php' ;    
								}
						})
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
}

function swal_expiry_message(){
			Swal.fire({
				title: 'Your session has expired!',
				text: "We value your security and data protection. Please login to continue your user experience. Thank you.",
				icon: 'warning',
				
				confirmButtonColor: '#3085d6',
				
				confirmButtonText: 'OK'
				}).then((result) => {
				if (result.isConfirmed) {
					document.location.href = 'login.php' ;    
				}
			})
			//$.post("../includes/login.inc.php",{"type":"logout"});
			$.ajax({    
				type: "POST",
				url: "../includes/engagement.inc.php",             
				data: {type: "logout"},
				dataType: "html",                  
			});
		}

		function update_contenttask(column_var, taskID){

			
			const inputs = document.querySelectorAll(`#${column_var}${taskID}`);

inputs.forEach(input => {
	input.addEventListener('input', function() {
		const value = this.value;
		inputs.forEach(otherInput => {
			if (otherInput !== this) {
				otherInput.value = value;
			}
		});
	});
});

    content_answer = $(`#${column_var}${taskID}`).val()

    question_id = document.getElementById('question_id').value;
    assignment_id = document.getElementById('assignment_id').value;


	if(question_id == ''){
		question_id = 0
	}

    if(content_answer.length == 0){

      Swal.fire({
        title: 'Saved',
        text: "You can not submit an empty answer",
        icon: 'error',
        
        confirmButtonColor: '#3085d6',
            
        confirmButtonText: 'OK'
      })
      return;
    }

    $.ajax({  
          type: "POST",
          url: "includes/student.inc.php",             
          data: {"type":"content_update", "column":column_var, "content":content_answer, "question_id":question_id, "assignment_id":assignment_id, "taskID":taskID},
          dataType: "html",                  
          success: function(data){   
             if(data == 'Expired'){
                swal_expiry_message()
              }else{
                // Swal.fire({
                //     title: 'Saved',
                //     text: "Success! Your Assignment has been Submitted!",
                //     icon: 'success',
                    
                //     confirmButtonColor: '#3085d6',
                        
                //     confirmButtonText: 'OK'
                //     }).then((result) => {
                //     if (result.isConfirmed) {
                //         document.location.href = 'index.php' ;    
                //     }
                // })               
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

		function update_content(column_var){
//    console.log('hello')

    content_answer = document.getElementById(column_var).value;
    question_id = document.getElementById('question_id').value;
    assignment_id = document.getElementById('assignment_id').value;
	task_id = document.getElementById('').value



    if(content_answer.length == 0){

      Swal.fire({
        title: 'Saved',
        text: "You can not submit an empty answer",
        icon: 'error',
        
        confirmButtonColor: '#3085d6',
            
        confirmButtonText: 'OK'
      })
      return;
    }

    $.ajax({  
          type: "POST",
          url: "includes/student.inc.php",             
          data: {"type":"content_update", "column":column_var, "content":content_answer, "question_id":question_id, "assignment_id":assignment_id},
          dataType: "html",                  
          success: function(data){   
             if(data == 'Expired'){
                swal_expiry_message()
              }else{
                Swal.fire({
                    title: 'Saved',
                    text: "Success! Your Assignment has been Submitted!",
                    icon: 'success',
                    
                    confirmButtonColor: '#3085d6',
                        
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = 'index.php' ;    
                    }
                })               
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
   

   fetch("pages/create-manager-session.php", {
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

function fillAlerts(){
	$.ajax({
		type: "POST",
		url: 'includes/engagement.inc.php',
		dataType: "HTML",
		data: {type:'pullMobileAlerts'},
		success: function(data) {
		console.log(data)
		console.log()
			$('#noticontent').html(data)
		}
	})
}function goLeftModule(a){
	event.preventDefault()

max = parseInt(a)

current = document.getElementById('currentPageModule').innerHTML

next = parseInt(current)

//console.log(next)

//console.log(max)
if(next == 1){
	$('#currentPageModule').text(max)
} else {
	$('#currentPageModule').text(next - 1)

}


//console.log(next)

}
function goRightModule(a){



	
	event.preventDefault()
max = parseInt(a)

current = document.getElementById('currentPageModule').innerHTML

next = parseInt(current)

//console.log(next)

//console.log(max)
if(next == max){
	$('#currentPageModule').text(1)
} else {
	$('#currentPageModule').text(next + 1)

}
}
function goLeft(a){
	event.preventDefault()

max = parseInt(a)

current = document.getElementById('currentPage').innerHTML

next = parseInt(current)

//console.log(next)

//console.log(max)
if(next == 1){
	$('#currentPage').text(max)
} else {
	$('#currentPage').text(next - 1)

}


//console.log(next)

}
function goRight(a){



	
	event.preventDefault()
max = parseInt(a)

current = document.getElementById('currentPage').innerHTML

next = parseInt(current)

//console.log(next)

//console.log(max)
if(next == max){
	$('#currentPage').text(1)
} else {
	$('#currentPage').text(next + 1)

}
}

    function character_count(type){
        characters = document.getElementById(type).value;
		if(type.includes("long")){
			count = 3000
		}else{
			count = 1500
		}
        characters = count - characters.length



        // document.getElementById('character_count_'+type).innerHTML = characters

		const inputs = document.querySelectorAll('#character_count_'+type);
		console.log(inputs)

inputs.forEach(input => {
	// input.addEventListener('input', function() {
	// 	const value = this.value;
		inputs.forEach(otherInput => {
			if (otherInput !== this) {

				otherInput.innerHTML = characters;
			}
		});
	// });
});


    }

	function saveIQAnswer(question, answer){

		$("#yesbutton").prop("disabled", true);






		user_id = '<?php echo $user_id ?>';

		student = getCookie("student");
		
		

		if (user_id == ""){
			alert("You must be logged in and verified with a PIN number to contact your politician through imatr ")
		}else {
			$.ajax({    
					type: "POST",
					url: "../includes/engagement.inc.php",             
					data: {type: "checkAnswer", iq_id:question},
					async: true,
					dataType: "html",                  
					success: function(data){  
if(data == 0){
// alert(data)
// exit();
	$.ajax({    
					type: "POST",
					url: "../includes/engagement.inc.php",             
					data: {type: "save_IQ", user_id:user_id, answer:answer, iq_id:question},
					dataType: "html",                  
					success: function(data){  

						if(tempID){


Swal.fire({
							title: '<h3>Your answer is saved!</h3>',
								text: 'Log-in to engage with representatives',
								showDenyButton: false,
								showCancelButton: false,
								// buttons: "hi",
							
								customClass: {
									confirmButton: 'Custom_Confirm',
								
								},
								}).then((result) => {
									window.location.href = 'index.php'
							})
						}else{
						if(data <= 1){
						setCookiebyDuration("iq", question, 1, 'days');
						iq = getCookie("iq");
						Swal.fire({
							title: '<h3>Your answer is saved!</h3>',
								text: 'Where do you want to go next?',
								showDenyButton: true,
								showCancelButton: true,
								confirmButtonText: 'Engage with Representatives',
								denyButtonText: 'What Others Think',
								cancelButtonText: 'Go Back to iQ list',
								// buttons: "hi",
								customClass: {
									actions: 'my-actions',
									cancelButton: 'order-1 right-gap',
									confirmButton: 'order-2',
									denyButton: 'order-3',
								},
								customClass: {
									confirmButton: 'Custom_Engage',
									denyButton: 'Custom_WOT',
									cancelButton: 'Custom_Cancel'
								},
								}).then((result) => {
									if (result.isConfirmed) {
										if ( student == "true"){
											document.location.href = 'index_dashboard.php?page=engage&subpage=student' ; 
										}else {
											document.location.href = 'index_dashboard.php?page=engage&subpage=WOT' ; 	
										}     
									} else if (result.isDenied) {
										if ( student == "true"){
											document.location.href = 'index_dashboard.php?page=wot&subpage=student&quest_id='+question ; 
										}else {
											document.location.href = 'index_dashboard.php?page=wot&subpage=WOT&quest_id='+question ; 
										}
									}else {
																			//CHANGE HERE
																			$('#modal-full').attr('style', 'overscroll-behavior: contain; display: block;')

										element = $('#modal-full');
									UIkit.modal(element).hide();

									$(`#iQ-${question}`).remove();
										//document.location.href = 'index.php' ;    
									}
							})
						}else{
							swal_expiry_message() 
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


					}})

			


		}

	};

	function lookup_postal(){
		//  alert('hi');
		code = document.getElementById('pcode').value;

		code = code.toUpperCase();
		code = code.replace(/ /g,'');
		if (code.length >= 6){
			the_city = code;
			var regex = /^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i;
			var match = regex.exec(the_city);
			if (match){
				if ( (the_city.indexOf("-") !== -1 || the_city.indexOf(" ") !== -1 ) && code.length == 7 ) {
					got_postal(code);
				} else if (code.length == 6 ) {
					got_postal(code);
				}
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Your postal code doesn\'t Look right',
					footer: 'Example: L8N 1C6'
				})
			}
		}else{
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Your postal code doesn\'t Look right',
				footer: 'Example: L8N 1C6'
			})
		}
		document.getElementById('pcode').value = code;

	}

	function got_postal(pcode){
		$.ajax({
			url: "includes/geolocation.inc.php",             
		type: 'post',
		dataType: "json",
		data: {"type":"get_coor_from_postal", "postal_code":pcode},
		success: function( data ) {

			if(data.district == null){
								district = ", ";
							}else{
								district = " (" + data.district + "), "
							}


			Swal.fire({
							title: 'Confirm your Location Data',
							html: "Based on your postal code: <b>" + pcode + "</b><br> we have you located in <b>" + data.city + ", " + data.prov + ", " + district + ", " + data.district1 + "</b>. <br> Is this correct?",
							icon: 'info',
							showDenyButton: true,
							confirmButtonColor: '#3085d6',
							showCloseButton: true,
							showCancelButton: true,
							focusConfirm: false,
							confirmButtonText:
							'<i class="fa fa-thumbs-up"></i> Yes, that is correct!',
							confirmButtonAriaLabel: 'Thumbs up, Yes, that is correct!',
							denyButtonText:
							'<i class="fa fa-thumbs-down"></i> No, let\'s try that again',
							denyButtonAriaLabel: 'Thumbs down',
							customClass: {
								closeButton: 'uk-modal-close-full icon-cross2',
								confirmButton: 'Custom_Confirm',
								denyButton: 'Custom_Cancel',
								cancelButton: 'Custom_Cancel'
							},
													
						}).then((result) => {
								/* Read more about isConfirmed, isDenied below */
								if (result.isConfirmed) {
									//setcity, province and postal code scope cookies here
									setCookiebyDuration("city", "", -1, "days");
									setCookiebyDuration("province", "", -1, "days");
									setCookiebyDuration("postal", "", -1, "days");

									setCookiebyDuration("city", data.city, 365, "days");
									setCookiebyDuration("province", data.prov, 365, "days");
									setCookiebyDuration("postal", pcode, 365, "days");
									//call the politician zone with findAddress() --> located in right_navbar.php
									findAddress();
								$.ajax({  
									type: "POST",
									url: "includes/user.inc.php",             
									data: {"type":"build_user_korprof1", "city":data.city, "prov":data.prov, "postal":pcode},
									dataType: "html",                  
									success: function(data1){ 
								Swal.fire('Saved!', '', 'success')
									$("#location_details").html("<b>You Live in <b>" + data.city + ", " + data.prov + ", " + data.district + ", " + data.district1 + "</b>. <br>");
									document.location.reload();
								}
								});
								} else if (result.isDenied) {
								Swal.fire('Changes are not saved', '', 'info')
								}
							});
											
		},
		
		});
	}

	function remove_Korprof1(){
		Swal.fire({
					title: 'Remove Location Information',
					html: "Are you sure you want erase and re-enter your location information?",
					icon: 'info',
					// showDenyButton: true,
					// confirmButtonColor: '',
					showCloseButton: true,
					showCancelButton: true,
					focusConfirm: false,
					confirmButtonText:
						'<i class="fa fa-thumbs-up"></i> Yes, let\s start fresh!!',
					confirmButtonAriaLabel: 'Thumbs up, Yes, that is correct!',
					denyButtonText:
						'<i class="fa fa-thumbs-down"></i> Nope,didn\t mean to come here',
						customClass: {
							closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Deny',
    cancelButton: 'Custom_Cancel'
},
					denyButtonAriaLabel: 'Thumbs down'
											
					}).then((result) => {
						/* Read more about isConfirmed, isDenied below */
						if (result.isConfirmed) {
							$.ajax({  
							type: "POST",
							url: "includes/user.inc.php",             
								data: {"type":"delete_user_korprof1"},
							dataType: "html",                  
							success: function(data1){ 
							Swal.fire('Saved!', '', 'success')
							alert('change screen info');
								$("#location_details").html("<b>You Live in <b>" + data.city + ", " + data.prov + "</b>. <br>");
							}
						});
						} else if (result.isDenied) {
							Swal.fire('Location information is unchanged', '', 'info')
						}
					});
					
										
   
      

  	}

	// function openWindow(url){

	// 	window.open(url, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=100,width=1000,height=800");

	// }

	
function follow_poli(repID){

		var foll_button = document.getElementById('follow_div'+repID);
		foll_button.innerHTML = '<a href="#/" id="unfollow_but" style="position: absolute; bottom: 10px; right: 10px;" onclick="unfollow_poli(' + repID + ')"><span class="gowebsite">Unfollow -</span></a>';
		$.ajax({    
			type: "POST",
			url: "includes/user.inc.php",             
			data: {type:"followpoli", repID: repID},
			dataType: "html",
			success: function(data){
				//console.log(data, 'polis')
				if ($('#follow_poli_id').length) {
				$('#follow_poli_id').replaceWith(data);
				} else {
					$('#tabs').append(data);
				}
				$('#follow_poli_id').accordion({
					heightStyle: 'content',
					collapsible: true
					}).accordion("refresh");
                        $('#follow_poli_id .ui-accordion-content').show();
				
				Swal.fire({
					icon: "success",
					title: "Politician Followed",
					showConfirmButton: false,
					timer: 3000
					});
			},
			error: function(xhr, status, error) {
				console.error('AJAX Error:', error);
				console.log(xhr.responseText);
			}
		});
    }

	function unfollow_poli(repID){

		var foll_button = document.getElementById('follow_div'+repID);
		foll_button.innerHTML = '<a href="#/" id="follow_but" style="position: absolute; bottom: 10px; right: 10px;" onclick="follow_poli(' + repID + ')"><span class="gowebsite">Follow +</span></a>';
	
		$.ajax({    
			type: "POST",
			url: "includes/user.inc.php",             
			data: {type:"unfollowpoli", repID: repID},
			dataType: "html",
			success: function(data){
				$('#follow_poli_id').replaceWith(data);

				$('#follow_poli_id').accordion({
					heightStyle: 'content',
					collapsible: true
					}).accordion("refresh");
                        $('#follow_poli_id .ui-accordion-content').show();
				Swal.fire({
					icon: "success",
					title: "Politician Unfollowed",
					showConfirmButton: false,
					timer: 3000
					});
			},
			error: function(xhr, status, error) {
				console.error('AJAX Error:', error);
				console.log(xhr.responseText);
			}
		});
	}


function setSessionTimeout() {
    $.ajax({
        url: 'includes/user.inc.php',
        type: 'POST',
        data: {type: 'get_remaining_time'},
        success: function(remainingTime) {
            var remainingTimeMs = remainingTime;

            // Clear any existing timeout
            if (window.sessionTimeout) {
                clearTimeout(window.sessionTimeout);
            }

            // Set a new timeout
            window.sessionTimeout = setTimeout(() => {
      window.location.href = 'login.php?session=Expired';
    }, remainingTimeMs);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching remaining time:', error);
        }
    });
}

// Set the initial timeout
setSessionTimeout();

// Re-synchronize the timer when the page gains focus
window.addEventListener('focus', setSessionTimeout);

// Update last activity time on user interaction
document.addEventListener('click', updateLastActivity);
document.addEventListener('scroll', updateLastActivity);
document.addEventListener('keypress', updateLastActivity);

function updateLastActivity() {
    $.ajax({
        url: 'includes/user.inc.php',
        type: 'POST',
        data: {type: 'update_last_activity'},
        success: function(data) {
            console.log('Last activity updated');
        },
        error: function(xhr, status, error) {
            console.error('Error updating last activity:', error);
        }
    });
}

// $('#hideload').cssText = 'opacity: 100 !important';

setTimeout(() => {$('#hideload').css({'opacity': '100', 'display': 'block', 'visibility': 'visible'})}, 2000)
// document.getElementById("hideload").style.opacity = "blue";
// $('#hideload').css({'opacity': '100'})
// $('#hideload').html('hihi')
// $('#hideload').css({'opacity': '100'});
// console.log(document.getElementById('hideload'))
// document.getElementById('hideload').setProperty('z-index', '100', 'important');

// document.getElementById('hideload').cssText = 'z-index: 100 !important';



var top  = window.pageYOffset || document.documentElement.scrollTop,
    left = window.pageXOffset || document.documentElement.scrollLeft;

		// $('#main-mobile-menu').css({'top': '243'})
    

	
</script>
<style>

	/* .hideload {
		opacity: 100;
	} */
</style>
	

	


</body>


</html>

<!-- <script>
document.getElementById('hideload').style.display = "block"

</script> -->
