<?php 
	
	if (session_status() !== PHP_SESSION_ACTIVE) session_start();

	if (!isset($_SESSION['last_regeneration']) || 
    time() - $_SESSION['last_regeneration'] > 1800) {
    
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

    require_once('Autoloader.inc.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'head.php'); 
 

    // require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_top.php'); 
	// ini_set('display_errors', 1);
	// error_reporting(E_ALL);
	
   

	use classes\Issue\IssueView as IssueView;
    use classes\Organization\OrganizationView as OrganizationView;
	use classes\Organization\OrganizationController as OrganizationController;
	use classes\IQ\IQView as IQView;
	use classes\Utility\Utility as Utility;

	$utility = new Utility();

	$url = $utility->getURL();
	$url_parts = parse_url($url);
 	// Get the query string from the URL
	$query_str = $url_parts['query'];
	// Parse the query string into an array of key/value pairs
	parse_str($query_str, $query_params);
	// Print the array of query parameters
	//print_r($query_params['subpage']);

	
	date_default_timezone_set("America/Toronto");
	$dat=date("Y-m-d H:i:s");
	$dats=strtotime($dat);

    $page =  $query_params['page']??"0";;
	$subpage = $query_params['subpage']??"0";
	$question_id = $_COOKIE["iq"] ?? "" ;
	
	$repID = isset($_SESSION['rep_id']) ? $_SESSION['rep_id'] : null;

	

	file_get_contents('http://imhamilton.ca/email_inbound.php');


?>
<html style="background-color: #f8f8f8;" >
<a href="#modal-page" id="session"  onclick="getContentModal('session', '2')" ></a>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script type="module" src="<?php echo $_SERVER['GLOBAL_TEMPLATE_PATH']  ;?>vendor/shared/cookie.js?v=1"></script>
<script type="module"src="<?php echo $_SERVER['GLOBAL_TEMPLATE_PATH']  ;?>vendor/shared/modals.js"></script>
<!DOCTYPE html>
<span id="pagetop"></span>
<style>

.fbuttons { 
         
		 border:solid 1px #1c1c1c; 
		 float:center; 
		 color:#fff; 
		 font-family: 'univers_57_condensedregular'; 
		 font-size:.9rem; text-transform:uppercase; 
		 padding:.5rem 1rem; 
		 background:#1c1c1c; 
		 margin:.2px 0 0 0;}
	 .fbuttons:hover{ background:#00954C; color:#fff; border:solid 1px #00954C; transition: background-color 0.5s ease; text-decoration: none!important;}
	 .fbuttons:focus {border:solid 1px #00954C;  color:#fff; background:#00954C;  }
	 .fbuttons .icheck{color:#00964c; padding-right:2px!important; float:left}
	 .fbuttons:hover .icheck{ color:#fff; transition: background-color 0.5s ease; text-decoration: none!important;}
	 .fbuttons:disabled { background-color: #ccc; border: #ccc; cursor: not-allowed; }



#iq_htag{
	width:80%;
}

#hashtags_iq{
	width:80%;
}

@media only screen and (max-width: 1280px) {
	#engagement_block{
		padding: 1em;
	}
	#iq_htag{
		width:50% !important;
	}
	#hashtags_iq{
		width:100%;
	}
}


.tag {    
	/*border-radius: 5px;*/
    display: block;
    float: left;
    padding: 10px 10px;
    text-decoration: none;
    margin-right: 5px;
    font-weight: 500;
    margin-bottom: 5px;
    /* font-family: helvetica; */
  
    line-height: 1;
    background: #00528A;
    color: #fff !important;
}

.remove-tag {
    cursor: pointer;
    padding: 5px 7px 5px 0px;
    margin-left: 0px;
	margin-bottom: 3px !important;
}
.remove-tag:hover{
	color:#b2b3b5;
}

div.tx-sans {
	font-size: 15px !important;
	/* font-family: 'univers_57_condensedregular' !important; */
	font-family: "Helvetica Neue", Helvetica, sans-serif;
}
.swal2-styled {
	box-shadow: 0 0 0 3px rgb(102 168 224 / 50%) !important;
}
.media-body span {
	font-size: 15px !important;
	font-family: "Helvetica Neue", Helvetica, sans-serif;
}
body {
		padding-right: 0px !important;
	}
/* Accordion styles */
#ui-datepicker-div {

	width: 17rem !important;
}

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
	
  content: 'Upload Document';
  /* display: inline-block; */
  /* background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3); */
  /* border: 1px solid #999; */
  border-radius: 3px;
  /* padding: 5px 8px; */
  /* outline: none; */
  /* white-space: nowrap; */
  -webkit-user-select: none;
  cursor: pointer;
  /* text-shadow: 1px 1px #fff; */
  /* font-weight: 700; */
  /* font-size: 10pt; */
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}
.custom-file-input {
	opacity: 100 !important;
}
.swal2-title h3 {
    margin-bottom: 0px !important;

}
        .swal2-title {
            font-size: 1.5rem;
            font-weight: normal;
        }
        .swal2-title h3 {
    margin-bottom: 0px !important;

}
        .swal2-title {
            font-size: 1.5rem;
            font-weight: normal;
			color: black !important;

        }
        .swal2-title, .swal2-popup {
			color: black !important;
            font-family: 'Fira Sans', sans-serif !important;
        }
	.Custom_Confirm {
		    font-family: 'univers_57_condensedregular';
		transition: 0.5s;
		 border-radius: 0px !important;
  background-color: #1c1c1c !important;
}
  .Custom_Confirm:hover {
    
    background-color: #00954C !important;
  }

  .Custom_Cancel {
	font-family: 'univers_57_condensedregular';
	transition: 0.5s;
	border-radius: 0px !important;
  background-color: #b2b3b5 !important;
}
  .Custom_Cancel:hover {
    
    background-color: #B0B1B3 !important;
  }
 .tabs {
	 border-radius: 8px;
	 overflow: hidden;
	 box-shadow: 0 4px 4px -2px rgba(0, 0, 0, 0.5);
}
 .tab {
	 width: 100%;
	 color: white;
	 overflow: hidden;
}
 .tab-label {
	 display: flex;
	 justify-content: space-between;
	 padding: 1em;
	 background: #63b8df;
	 font-weight: bold;
	 cursor: pointer;
	/* Icon */
}
#taskdisplay p {
	margin: 0px !important;
}
#thingy .tab-label:hover {
	 background: #3D7CA6 ;
}
#thingy .tab-label::after {
	 content: "\276F";
	 width: 1em;
	 height: 1em;
	 text-align: center;
	 transition: all 0.35s;
}
#thingy .tab-content {
	 max-height: 0;
	 padding: 0 1em;
	 color: #2c3e50;
	 background: white;
	 transition: all 0.35s;
}
#thingy .tab-close {
	 display: flex;
	 justify-content: flex-end;
	 padding: 1em;
	 font-size: 0.75em;
	 background: #2c3e50;
	 cursor: pointer;
}
#thingy .tab-close:hover {
	 background: #1a252f;
}
 #thingy input:checked + .tab-label {
	 background: #1a252f;
}
#thingy input:checked + .tab-label::after {
	 transform: rotate(90deg);
}
#thingy input:checked ~ .tab-content {
	 max-height: 100%;
	 padding: 1em;
}
 

	#button-width {
	width: 100% !important;
	}
	.link-01:hover, .link-01:active {
		color: #00954C  !important;
		text-decoration: underline !important;

	}
	.resp-container {
    position: relative;
    overflow: hidden;
    padding-top: 56.25%;
	}
	.resp-iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		border: 0;
	}

	/* #loadmore:hover {
		color: #00954C !important;
		text-decoration: underline;
	} */

	@media only screen and (min-width:768px){
		#sidemenu{
		margin-top: 51px !important;
	}
	}
/*desktop*/
@media only screen and (min-width: 1080px) {
#startd {
	display: unset !important;
}
	.post-sec {
		width: 844px;
	}
	#scrollbuttons {
		display: none;
	}
	.card-deck {
		padding: 10px !important;
	}
	.poli_name {
		height: 56px;
	}
	#deletemargin {
		margin-top: 115px;
	}
	#button-width{
	margin-bottom: 25px;}
	/* #card-responsive-height {
		height: 590px;
		
	} */

	

	#responsive_height {
		height: 80px;
	}
	
	#top_bar_sticky {
		padding: 0; position: sticky;  top: 51px;   z-index: 100;
	}

	.responsive_title {
		display: none;
	}

	#content_body_responsive_padding_top {
		padding-top: 20px;
	}
	

}

/*smartphones*/
@media only screen and (max-width: 767px) {
	#datet {
		float: unset !important;
	}
	#approve {
	width: 100% !important;
	float: right !important; 
}
	#polimes{
		margin-top: 0px !important;
	}
	/*#card-responsive-height {
		height: 570px;
		
	}*/

	/*#card-responsive-margin {
		margin: 5px;
	}*/

	#content_body_responsive_padding_top {
		padding-top: 25px;
	}

	#more_charts {
		display: block;
		margin: auto;
		float: unset !important;
		margin-bottom: 25px;
	}
	.wotpadding {
		padding: 25px;
	}

	.wotpadding h4 {
		margin: 0px !important;
	}

	.reversecolwot {
		display: flex;
		
		flex-direction: column-reverse;

	}
	.wotbody {
		padding-top: 0px !important;

	}
	

	#responsive_height {
		height: 60px;
	}

	.responsive_padding {
		padding-top: 15px;
	}
	
}

#card-responsive-margin{
	width: 90%;
	position: absolute;
	bottom: 10px;
	left: 46%;
	transform: translateX(-50%);
}
.swal2-popup {
			border: 3px solid black;
			border-radius: unset !important;
		}

/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
html{overflow-y: scroll; /* Add the ability to scroll */}
	

	/*desktops*/
	@media only screen and (min-width: 1281px) {
		.uk-modal-page {
	/* overflow-y: hidden !important; */
	margin-right: 16.9px;
}
		#sharecons {
			white-space: nowrap;
		}

		#engagement_details{
			text-align: center; 
			position:absolute; 
			top:380px; 
			left: 50%; 
			transform: translateX(-50%); 
		}

		#card-responsive-margin{
	width: 90%;
	position: absolute;
	bottom: 10px;
	left: 46%;
	transform: translateX(-50%);
}
		/*#card-responsive-height {
		height: 590px;
		
	}*/

	#responsive_height {
		height: 80px;
	}
		#engagement_block{
			padding-left:2em;
			padding-right:2em; 
			padding-top:2em;
			bottom:2em;
		}
		#top_bar_sticky {
			padding: 0; position: sticky;  top: 51px;   z-index: 100;
		}
		
		.news11 {
			margin-bottom: 25px;
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
		.map_user_body{
			height: 100%; 
    		overflow:hidden  !important;
		}
	}

		.card_resp_marg{
			margin: 10px !important;
			width: unset !important;
		}
	
	/*tablets*/
	@media only screen and (min-width: 768px) and (max-width: 1280px) {

		.card-deck .card {
			flex: 1 0 auto;
			width: 100%;
			margin: 10px 0; 
			box-sizing: border-box;
		}
	
	#polimes{
		margin-top: 0px !important;
	}
	.btn_downl{
		margin: 0px 25px !important;
	}
	.publ_iq{
		height:auto !important;
	}
		#engagement_details{
			text-align: center; 
			position:absolute; 
			top:360px; 
			left: 50%; 
			transform: translateX(-50%); 
		}
		
		

	#responsive_height {
		height: 80px;
	}
		/*#card-responsive-height {
			height: 650px;
		
	}*/

		.hide_canadian_flag_on_mobile{
			display: none;
		}
		.hide_mobile_top_bar{
			display: none;
		}
		.Navi_Left_desktop{
			display: none;
		}
		.top_right_desktop{
			/* display: none; */
		}
		.left-sec {
			display: flex;
			flex-direction: column-reverse;
		}
		.rs-main{
			float: right !important;
			width: 300px !important;
		}
		#iqposts {
			float: left !important;
			width: 400px !important;
		}
		
	}

	
	/*smartphones*/
	@media only screen and (max-width: 767px) {

	.card-deck .card {
			flex: 1 0 auto !important;
			width: 100% !important;
			margin: 10px 0 !important; 
			box-sizing: border-box !important;
		}
		.demo-btn-group, .demo-btn-group #wotbut, .demo-btn-group #engbut {
				width: 100% !important;
			}	
			.demo-btn-group #wotbut {
				margin-top: 10px;
			}

#more_charts.btn {
	width: 21.5rem !important;
}
		#writerheader {
			flex-direction: column !important;
		}

		#writerheader h4.content-title {
			margin-top: 20px;
		}

		#writerheader #approve {
			margin-top: 10px;
			margin-bottom: 10px;

		}

		

		#writertables {
			padding-left: 0px !important;
			padding-right: 0px !important;
		}
		#writertable .table-responsive {
			overflow-x: unset !important;
		}

		#writertables h2 {
			margin-left: 15px !important;
		}


		.nav-item#document {
			margin-top: 0px !important;
			margin-left: 5px !important;

		}
		#profile3, #home3 {
			padding: 20px !important;
		}
		#button-width {
	width: 100% !important;
	margin-bottom: 20px;
 }
			#timeline-flex {
				flex-direction: column-reverse;
			}
		#timeline {
			flex-direction: column-reverse;
		}
		#timeline .form-group {
			
			
		}
		.mg-b-25 {
            padding-top: 10px;
            margin-left: 10px;
          }

		#engagement_details{
			text-align: center; 
			position:absolute; 
			top:330px; 
			left: 50%; 
			transform: translateX(-50%); 
		}

		#card-responsive-margin{
			width: 90%;
			position: absolute;
			bottom: 10px;
			left: 50%;
			transform: translateX(-50%);
		}
		/*#card-responsive-height {
		height: 570px;
		
	}*/
	
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
				padding: 0px 20px !important;
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

		#hide_this {
			display: none;
		}

		.responsive_width {
			width: 100%;
		}
		
		
	}


	

</style>
<div class="card cookie-alert">
  <div class="card-bodys">
    <!-- <h5 class="card-title">&#x1F36A; Do you like cookies?</h5> -->
    <p class="card-text" style="    font-family: 'Source Sans Pro', sans-serif;
    font-weight: 300;
    font-size: 1.0125rem;
    line-height: 27px;
margin-bottom: 0px;"><span>We use cookies and similar technologies that are necessary to operate the website. Additional cookies are used to perform analysis of website usage.</span> <span style="display: inline-block;">To continue to use our website, please consent to our use of cookies. For more information, please read our <a href="#modal-page" uk-toggle onclick="getContentModal('cookiePolicy', '2')" id="policy">Cookie Policy</a>.</span></p>
    <div  class="btn-toolbar justify-content-end"> 
     
      <a style="margin-top: 10px !important; text-align: center; margin-left: 0px; background-color: black; color: white;"   href="#" class="fbutton accept-cookies">Accept</a>
    </div>
  </div>
</div>



<?php 

require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'topbar.php');

?>


<?php   require_once('dashboard.php');  ?>
					
       

<script type="module" src="<?php echo $_SERVER['GLOBAL_TEMPLATE_PATH']  ;?>/vendor/uikit/js/uikit.min.js"></script>
<!-- Resources -->
<!--script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script-->
<script  src="vendor/JS_files/core.js"></script>
<script  src="vendor/JS_files/charts.js"></script>
<script  src="vendor/JS_files/animated.js"></script>

<div id="modal-full"  uk-modal>
		<div class="uk-modal-dialog  uk-width-1-1@s uk-width-1-1@m uk-width-3-4@l" aria-label="Close" style="border:solid 3px #000; background-color:#ffffff">
			
			<div class="container">
			
				<div id="modalpanel" class="row justify-content-md-center"></div>
				
				</div>
				<a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
		</div> 
	</div> 
	
	

			
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

<script>

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
        $('#return-to-bottom').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-bottom').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-bottom').click(function() {      // When arrow is clicked
    $('#modal-page').animate({ scrollTop: $(window).height() }, 500);
});


$('#modal-page').scroll(function() {
    if ($('#modal-page').scrollTop() >= 1000) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200); 
		   // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('#modal-page').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

			// ===== Scroll to Top ==== 
$(document).scroll(function() {
    if ($(this).scrollTop() >= 1000) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});



//console.log($(window).height())

$(window).scroll(function() {
    if ($(this).scrollTop() <= xScroll) {        // If page is scrolled more than 50px
        $('#return-to-bottom').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-bottom').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-bottom').click(function() {      // When arrow is clicked
    $('body,html').animate({ scrollTop: $(window).height() }, 500);
});


	function getModalContent(){
		
	}

                    

					
						

                        

						
						// if(getCookie('googtrans') == '/en/fr'){
                                // $('.top-bar .container').attr('style', 'max-width: 1600px !important;');
							// }		






// function handleLanguageChange(newLang) {
//     console.log('Language changed to:', newLang);

//     // Apply custom styles based on the new language
//     if (newLang === 'fr') {
// 		$('.top-bar .container').attr('style', 'max-width: 1600px !important;');
//     } else {
// 		$('.top-bar .container').attr('style', '');
//     } 
// }
                        
	function getContentModal(content_id, content_type) {
//MAIN FUNCTION DASHBOARD
setCookiebyDuration('contribution_form', content_type , 30, "minutes");

		
			if (content_id == 0){
	
				window.location = ('forbidden.php') 
	
			}else{

				$.ajax({    
				type: "POST",
				url: "/includes/modal_generator.inc.php",             
				data: {type:"general", content_id:content_id , content_type:content_type},
				dataType: "html",  
				beforeSend : function() {
					$('#pagecontent1').empty();
				},                
				success: function(data){   
					console.log(data); 
					// if (page=="org_order"){
					// 	getPaymentPage('Payment', 1, 'IQ');
					// } 
					// getOrgMain();
					//getPurchasedIQs();


					switch (content_id) {
						case 'triage_categories':
						case 'post_alert':
						case 'get_cart':
						$('#storycontent').empty();               

						$('#categorycontent').html(data);
                        break;

							case 'poli_story':
							case 'poli_acomplish':
							case 'poli_platform':
								$('#storycontent').empty();               

							$('#storycontent').html(data);

						


					break;

						default:
						$('#modalcontent').empty();               

						$('#modalcontent').html(data);

					break;
					}
					// $('#pagecontent').empty();               
					// $("#pagecontent").html(data); 
					// checkTime()
				
				},
				complete: function(){
					// if (subpage == 0 || subpage == ""){
					// 	//alert("no subpage");
					// 	getOrgPage("overview");
					 // 	;//if no subpage parameter set to default
					// } else {
					// 	//alert("run getOrgPage() function if index_org");
						// getSubPage(page, subpage);
					// }
					
				
				},
				error: function(error){
					console.log("Error:");
					console.log(error);
					$("#error").show();                 
					$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
					
				},
				});
			}
			
	


		//trackAjaxPage(content_id)
		// $('#modalcontent').scrollTop(0);
		// switch(content_id) {

		// 	case "contribution":
		// 		setCookiebyDuration('contribution_form', content_type , 30, "minutes");
		// 		$('#modalcontent').load('pages/contributions.php');
		// 		break;
			
		// 	case "scope_profile":
		// 		$('#modalcontent').load('pages/scope.php');
		// 		break;

		// 	case "about":
		// 		$('#modalcontent').load('pages/about_us.php');

		// 		break;
		// 	case "faq_general":
		// 		$('#modalcontent').load('pages/faq_1_general.php');
		// 		trackAjaxPage();
		// 		break;
		// 	case "faq_scope":
		// 		$('#modalcontent').load('pages/faq_2_scope.php');
							
		// 		break;
		// 	case "faq_platform":
		// 		$('#modalcontent').load('pages/faq_3_platform.php');
							
		// 		break;
		// 	case "faq_security":
		// 		$('#modalcontent').load('pages/faq_4_security.php');
							
		// 		break;
		// 	case "contact":
		// 		$('#modalcontent').load('pages/contact_choices.php');
				
		// 		break;
		// 	case "politicians":
		// 		$('#modalcontent').load('pages/politicians.php');
				
		// 		break;
		// 	case "myStats":
		// 		$('#modalcontent').load('pages/myStats.php');
				
		// 		break;    
		// 	case "contactEngine":
		// 		$('#modalcontent').load('pages/profile_start.php');
				
		// 		break;   
		// 	case "basicProfile":
		// 		$('#modalcontent').load('pages/basic_profile.phpp');
				
		// 		break;  
		// 	case "organizations":
		// 		$('#modalcontent').load('pages/organizations.php');
				
		// 		break;
		// 	case "location_help":
		// 		$('#modalcontent').load('pages/location_help.php');
				
		// 		break;  
		// 	case "shask":
		// 		$('#modalcontent').load('pages/student_mode.php');
			
		// 		break;  
		// 	case "student_mode":
		// 		$('#modalcontent').load('pages/student_mode.php');
			
		// 		break; 
		// 	case "mobile_search":
		// 		$('#modalcontent').load('pages/mobile_search.php');
			
		// 		break; 
		// 	case "media":
		// 		$('#modalcontent').load('pages/media.php');
			
		// 		break;
		// 	case "privacyPolicy":
		// 		$('#modalcontent').load('pages/privacypolicy.php');
			
		// 		break;
		// 	case "accuracy":
		// 		$('#modalcontent').load('pages/accuracy.php');
			
		// 		break;
		// 	case "premiumServices":
		// 		$('#modalcontent').load('pages/premiumServices.php');
			
		// 		break;
		// 	case "premiumServices":
		// 		$('#modalcontent').load('pages/premiumServices.php');
			
		// 		break;
		// 	case "discsub":
		// 		$('#modalcontent').load('pages/discSub.php');
			
		// 	break;
		// 		case "session":
		// 				$('#pagecontent').load('pages/session.php'); 

		// 		break;
		// 		case "triage_categories":
        //                 $('#categorycontent').load('pages/triage_categories.php');              	
        //                 break;
		// 				case "post_alert":
        //                 $('#categorycontent').load('pages/post_alert.php');              	
        //                 break;
		// 				case "get_cart":
        //                 $('#categorycontent').load('admin/org_purchase_iqs.php');              	
        //                 break;

		// 		case "poli_story":
		// 			$('#storycontent').load('pages/poli_story.php');              	
		// 			break;
		// 		case "poli_acomplish":
		// 			$('#storycontent').load('pages/poli_acomplish.php');              	
		// 			break;

		// 			case "help_videos":
		// 			$('#modalcontent').load('pages/help.php');              	
		// 			break;
		// 		// case "poli_platform":
		// 			// $('#storycontent').load('pages/poli_platform.php');              	
		// 			// break;

		// }	
		
	}

	function getModalPoliticianPage(content_id, content_type, organization, cStatus) {

		$.ajax({  
			
		type: "POST",
		url: "../includes/modal_generator.inc.php",             
		data: {type:"pagepolitician", content_id:content_id, content_type:content_type, organization:organization, cStatus:cStatus },
		dataType: "html",                 
		success: function(data){   
			$('#modalcontent').empty();               
			$("#modalcontent").html(data); 

		},
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
		});

	}

	function getOrganizationPage(page, js_flag, variable) {

		$.ajax({    
		type: "POST",
		url: "../includes/org.inc.php",             
		data: {type:page, variables:variable },
		dataType: "html",                
			success: function(data){                 
				$("#organization_functions").html(data); 
				if(js_flag === 1){
					$.getScript('JS/'+page+'.js', function() {
						console.debug('Script loaded.');
					});
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

	
	var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator

	
	function delete_res(a){
		id = document.getElementById('question_id').value;
		$.ajax({    
						type: "POST",
						url: "../includes/IQWriter.inc.php",             
						data: {"type":"delete_resource", "res_id":a, "IQid":id},
						dataType: "html",                  
						success: function(data){                    
							$("#resources").html(data);
							$(document).ready(function() {
							$(function() {
				$("#new_resource_date")
				.datepicker({
					maxDate: 0,
					defaultDate: "+1w",
					changeYear: true,
					changeMonth: true,
					numberOfMonths: 1,
					dateFormat: 'yy-mm-dd'
				})
		  });
		});
						//window.location.href = 'issuelist.php';
						}
		});
	}


	function jumptoIQ(iq){
		window.location.href = 'https://<?php print $_SERVER['HTTP_HOST']; ?>/index.php?questID='+ iq
	}

	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.display === "block") {
		panel.style.display = "none";
		} else {
		panel.style.display = "block";
		}
	});
	}

	function setPoliCookie(a){
	setCookiebyDuration('politician_id', a, 1, 'days')
}
	function update_content(column_var){

		content_answer = document.getElementById(column_var).value;
		question_id = document.getElementById('question_id').value;
		assignment_id = document.getElementById('assignment_id').value;
		student_id = 23

		if(content_answer.length == 0){
			alert('You can not submit an empty answer');
			return;
		}

		$.ajax({  
			type: "POST",
			url: "includes/student.inc.php",             
			data: {"type":"content_update", "column":column_var, "content":content_answer, "question_id":question_id, "assignment_id":assignment_id},
			dataType: "html",                  
			success: function(data){   
				alert(data);
				if(data == 'Expired'){
					swal_expiry_message()
				}
				Swal.fire({
					title: 'Saved',
					text: "Success! Your answer has been saved!",
					icon: 'success',
					
					confirmButtonColor: '#3085d6',
						
					confirmButtonText: 'OK'
					}).then((result) => {
						if (result.isConfirmed) {
							//document.location.href = 'index.php' ;    
						}
					})               
				//window.location.href = 'IQed_next.php';
			}
			});	
	}

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

								
                                function googleTranslateElementInit() {
                                    new google.translate.TranslateElement({
                                        pageLanguage: 'en',
                                        includedLanguages: 'en,fr',
                                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                    }, 'google_translate_element');


							// 		if(getCookie('googtrans') == '/en/fr'){
                            //     $('.top-bar .container').attr('style', 'max-width: 1600px !important;');
							// }		

								}
                                googleTranslateElementInit();
								
                            	function reloadGoogleTranslateWidget() {
            // Remove the existing widget
            const widgetContainer = document.getElementById('google_translate_element');
            widgetContainer.innerHTML = ''; // Clear the container

            // Reinitialize the widget
            googleTranslateElementInit();
        }
						});

	// function character_count(column){
		
	// 	characters = document.getElementById('descr')
	// 	characters = characters.length
	// 	document.getElementById('character_count_' + column).innerHTML = characters
	// }

	function update_subcat(id){

		subcat_id = document.getElementById('subcat_id');
		subcat_id = subcat_id.options[subcat_id.selectedIndex].value;
		cat_id = document.getElementById('cat_id');
		cat_id = cat_id.options[cat_id.selectedIndex].value;
		$.ajax({    
			type: "POST",
			url: "../includes/IQWriter.inc.php",             
			data: {"type":"subcategory_update", "cat_id":cat_id, "Sub_cat_id":subcat_id, "IQid":id},
			dataType: "html",                  
			success: function(data){                  
				$("#category_change").html(data);
			}
		});
	}
    
	
	var gover_level = "";

	function update_gover_level(id){

		gover_level_id = document.getElementById('gov_level_id');
		gover_level = gover_level_id.options[gover_level_id.selectedIndex].value;
		gover_level_id.innerText = gover_level;

		$.ajax({    
					type: "POST",
					url: "../includes/IQWriter.inc.php",             
					data: {"type":"add_gov_level","gov_level":gover_level, "IQid":id},
					dataType: "html",                  
					success: function(data){                 
				//$("#location_data").html(data);
				//window.location.href = 'issuelist.php';
				$.ajax({    
			type: "POST",
			url: "../includes/IQWriter.inc.php",             
			data: {"type":"gover_level_update", "gover_level_id":gover_level, "IQid":id},
			dataType: "html",                  
			success: function(data){   		
				$("#gover_level_data").html(data);
				//document.getElementById('region_updater')

				//window.location.href = 'issuelist.php';
				
			}
		});
			}
		});
		

		
	}


var multi_gov_level = "";



function checkboxStatusChange(id) {
  //id = 738;

  var multiselect = document.getElementById("mySelectLabel");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("mySelectOptions");
  var allCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]');
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  if(checkedCheckboxes.length >= 3){
    for (const checkbox of allCheckboxes) {
      checkbox.disabled = true;
    }

    for (const checkedCheckbox of checkedCheckboxes) {
      checkedCheckbox.disabled = false;
    }
  } else {
    for (const checkbox of allCheckboxes) {
      checkbox.disabled = false;
    }
  }
  multi_gov_level = values.toString();
  //console.log('mult', multi_gov_level);
  multiselectOption.innerText = dropdownValue;
  //console.log(dropdownValue);
  $.ajax({    
			type: "POST",
			url: "../includes/IQWriter.inc.php",             
			data: {"type":"add_gov_level","gov_level":dropdownValue, "IQid":id},
			dataType: "html",                  
			success: function(data){                 
				$("#location_data").html(data);
			}
		});

    
}

	function update_cat(id){

		cat_id = document.getElementById('cat_id');
		cat_id = cat_id.options[cat_id.selectedIndex].value;

		$.ajax({    
			type: "POST",
			url: "../includes/IQWriter.inc.php",             
			data: {"type":"category_update", "cat_id":cat_id, "IQid":id},
			dataType: "html",                  
			success: function(data){   		
				$("#category_change").html(data);
				//document.getElementById('region_updater')

				//window.location.href = 'issuelist.php';
			}
		});
	}

	function add_resource(a){
	url = document.getElementById('new_resource').value;
	title = document.getElementById('new_resource_title').value;
	source = document.getElementById('new_resource_source').value;
	date = document.getElementById('new_resource_date').value;
	id = document.getElementById('question_id').value;

	// alert('hi')

	url = url.replace(/(\r\n|\n|\r)/gm, "");

  	if(pattern.test(url)){
		$.ajax({    
						type: "POST",
						url: "../includes/IQWriter.inc.php",             
						data: {"type":"add_resource","res_url":url, "title":title, "source":source, "date":date, "IQid":id},
						dataType: "html",                  
						success: function(data){                    
							$("#resources").html(data);

							// $("#new_resource_date").datepicker();
							$(document).ready(function() {
          
		  $(function() {
				$("#new_resource_date")
				.datepicker({
					maxDate: 0,
					defaultDate: "+1w",
					changeYear: true,
					changeMonth: true,
					numberOfMonths: 1,
					dateFormat: 'yy-mm-dd'
				})
		  });
	  })
						//window.location.href = 'issuelist.php';
						}
		});
	}else{
		document.getElementById('new_resource_message').innerHTML = 'Not Saved: You need to provide an exact URL.';
	}	
	$(document).ready(function() {
		$("#new_resource_date").datepicker({maxDate: 0});
		  $(function() {
			  $("#new_resource_date").datepicker({maxDate: 0});
		  });
	  })
	$(function() {
			  $("#new_resource_date").datepicker({maxDate: 0});
		  });
		  $("#new_resource_date").datepicker({maxDate: 0});
}

	




	function update_resource(a, resID){
	url = document.getElementById(a).value;
	id = document.getElementById('id').value;

	url = url.replace(/(\r\n|\n|\r)/gm, "");

	if(pattern.test(url)){
		$.ajax({    
				type: "POST",
				url: "../includes/IQWriter.inc.php",             
				data: {"type":"update_resource","res_url":url, "res_id":resID , "IQid":id},
				dataType: "html",                  
				success: function(data){                    
					//$("#resources").html(data);
				}
		});
	}else{
		document.getElementById('resource_mess_'+resID).innerHTML = 'Not Saved: You need to provide an exact URL.';
	}
		
}

// function delete_res(a){
// 	id = document.getElementById('id').value;
// 	$.ajax({    
// 			        type: "POST",
// 					url: "../includes/IQwriter.inc.php",             
// 			        data: {"type":"delete_resource", "res_id":a, "IQid":id},
// 			        dataType: "html",                  
// 			        success: function(data){                    
// 			        	 $("#resources").html(data);
// 			           //window.location.href = 'issuelist.php';
// 			        }
// 	});
// }

	function update_region(a){
		id = document.getElementById('id').value;
		region_id = document.getElementById('region_id');
		region_id = region_id.options[region_id.selectedIndex].value;
		$.ajax({    
			type: "POST",
			url: "../includes/IQWriter.inc.php",             
			data: {"type":"add_question_region", "region":a, "region_id":region_id, "IQid":id},
			dataType: "html",                  
			success: function(data){                 
				$("#location_data").html(data);

				//window.location.href = 'issuelist.php';
			}
		});
	}
	function scrolltoAssignmnet(){

		var stop = $('#student').offset()
		window.scrollTo({
			top: stop.top - 130,
			behavior: "smooth"
		})
	}

	function update_province(a){
	 id = document.getElementById('question_id').value;
	 prov = document.getElementById('province_id');
	 prov_id = prov.options[prov.selectedIndex].value;
	$.ajax({    
		type: "POST",
		url: "includes/IQWriter.inc.php",             
		data: {"type":"add_question_prov", "region":a, "prov_id":prov_id, "IQid":id},
		dataType: "html",                  
		success: function(data){  
			$("#location_data").html(data);
		}              
	 });
}

	function government_level(a){
		id = document.getElementById('question_id').value;
		gov_level_id = document.getElementById('gov_level_id');
		gov_level = gov_level_id.options[gov_level_id.selectedIndex].value;
		//update_gover_level(id);
		// console.log('gov_level', gov_level);
		$.ajax({    
			type: "POST",
			url: "../includes/IQWriter.inc.php",             
			data: {"type":"add_gov_level","gov_level":gov_level, "IQid":id},
			dataType: "html",                  
			success: function(data){                 
				$("#location_data").html(data);
				//window.location.href = 'issuelist.php';
			}
		});
	}

	function update_scope_type(a){
		id = document.getElementById('question_id').value;
		scope_type = document.getElementById('scope_type');
		scope_type = scope_type.options[scope_type.selectedIndex].value;
		$.ajax({    
			type: "POST",
			url: "../includes/IQWriter.inc.php",             
			data: {"type":"add_scope_type","scope_type":scope_type, "IQid":id},
			dataType: "html",                  
			success: function(data){                 
				$("#location_data").html(data);
				//window.location.href = 'issuelist.php';
			}
		});
	}

	function update(column, type, a){

		data_sub = document.getElementById(column).value;

		if (column == "img1"){
			data_sub = a + ".png"	
		}

		region_id = 'a';

		$.ajax({    
			type: "POST",
			url: "../includes/IQWriter.inc.php",             
			data: {"type":"update_question_elements", "questID":a, "column":column, "value":data_sub, "element_type":type},
			dataType: "html",                  
			success: function(data){  
				document.getElementById('colmessage_' + column).innerHTML = data;
				if(!data.includes('Updated Successfully')) colorpick = 'red';
				else colorpick = 'green';
				document.getElementById('colmessage_' + column).style.color = colorpick;
				if(column == 'IQ_title') document.getElementById('title_'+a).innerHTML = data_sub;//window.location.href = 'issuelist.php';
			}
		});
	}
function markAssigmentasSubmitted(a){

	Swal.fire({
					
					text: "Are you sure you wish to submit your assignment?",
					icon: 'question',
					showCancelButton: true,
					
					confirmButtonColor: '#3085d6',
						
					confirmButtonText: 'Yes'
					}).then((result) => {
						// location.reload()

						if (result.isConfirmed) {
					

	
	$.ajax({    

type: "POST",
url: "../includes/student.inc.php",         
data: {"type":"submitAssignment", assignmentID:a},
dataType: "html",                  
success: function(data){                  


$.ajax({    

type: "POST",
url: "../includes/student.inc.php",         
data: {"type":"removeAssignmentSession", assignmentID:a},
dataType: "html",                  
success: function(data){  
	Swal.fire({
					title: 'Saved',
					text: "Success! Your Assignment has been Submitted!",
					icon: 'success',
					
					confirmButtonColor: '#3085d6',
						
					confirmButtonText: 'OK'
					}).then((result) => {
						location.reload()
					}) 

   }})
}
});
}
}) 
}
	function generate(a){
		$.ajax({    

			type: "POST",
			url: "../includes/org.inc.php",         
			data: {"type":"generate_iq",},
			dataType: "html",                  
			success: function(data){                  
				$("#organization_functions").html(data);
			}
		});
	}	
	function update_contenttask(column_var, taskID){

		

console.log(column_var)
console.log(taskID)


document.cookie = "assignment=delete; expires=Thu, 18 Dec 2013 12:00:00 UTC";


content_answer = document.getElementById(column_var + taskID).value;
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


	function showmore(a){
		$.ajax({    
			type: "GET",
			url: "issuelist.php",             
			data: {"type_id":"showmore","id":a, "price_id":a},
			dataType: "html",                  
			success: function(data){                    
			//  $("#more"a).html(data);
			}
		});
	}


	function hover(a){
			
		c = document.getElementById(a);
		if(selected_row != a) c.style.backgroundColor = 'Lightgreen';

	}

	function hover_out(a){
				c = document.getElementById(a);
				if(selected_row != a) c.style.backgroundColor = '';
	}


	function goapproval(a){
		message=0;
		repID = '<?php echo  $repID;?>';
		qasked = document.getElementById('qasked').value
		if(qasked.length === 0){
			message =1
		}
		descr = document.getElementById('descr').value
		if(descr.length === 0){
			message =1
		}
		c1 = document.getElementById('c1').value
		if(c1.length === 0){
			message =1
		}
		c2 = document.getElementById('c2').value
		if(c2.length === 0){
			message =1
		}
		// img1 = document.getElementById('img1').value
		// if(img1.length === 0){
		// 	message =1
		// }
		res1 = document.getElementById('res1')
		if(res1 == undefined){
			message =1
		}
		res2 = document.getElementById('res2')
		if(res2 == undefined){
			message =1
		}

		src = document.getElementById('cropped1').getAttribute('src')
		if(src == ""){
			message =1
		}
if(!repID){
	multi_lvl = document.getElementById('select_multi_gov_level');
		gover_level_id = document.getElementById('gov_level_id');

	if(gover_level_id){
		gover_level = gover_level_id.options[gover_level_id.selectedIndex].value;
		if(gover_level == ""){
			message = 1
		}
	}else if(multi_lvl){
		multi_lvl_value = multi_lvl.options[multi_lvl.selectedIndex].value;
		console.log(multi_lvl_value);

		if(multi_lvl_value == "")
				message = 1
		}
		
	
	if(gover_level_id || multi_lvl){
		the_message = 'iQ Background, iQ being asked, the level of Government, 1 image and at least 2 answers and resources must be added before submission. ';
	}else {
		the_message = 'iQ Background, iQ being asked, 1 image and at least 2 answers and resources must be added before submission. ';

		}
}else
	the_message = 'iQ Background, iQ being asked, 1 image and at least 2 answers and resources must be added before submission. ';

		if(message === 1){
			Swal.fire(the_message, '', 'error');
		}else{

			$.ajax({    
							type: "POST",
							url: "../includes/IQWriter.inc.php",         	             
							data: {"type":"go_for_approval","IQid":a},
							dataType: "html",                  
							success: function(data){                    
								$("#update").html(data);
								document.getElementById('status').innerHTML = 'Out for Approval';
								document.getElementById('status').style.color = 'red';
								document.getElementById("approve").style.display = "none";
								Swal.fire('Out for Approval', '', 'success');
							//window.location.href = 'issuelist.php';
							}
			});

			gover_level="";
			multi_gov_level="";
		}
	}

	function getContactEngineProfileInf(){
       
	   $.ajax({    
		   type: "POST",
		   url: "includes/user.inc.php",             
		   data: {type:"get_profile_info"},
		   dataType: "json",                  
		   success: function(data){   
			fname = data.fname
			 $('#fname').val(data.fname); 
			 $('#lname').val(data.lname);
			 
			 $('#tel').val(data.tel);
			 $('#tel1').val(data.ctel);
			 $('#sqans').val(data.sqans);
			 $('#squest').val(data.squest);
			 if (data.fname == null && data.lname == null && data.tel == null && data.ctel == null && data.sqans == null){

$('#delconset').attr('style', 'display: none;')

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
	//console.log('hi')
	$(document).ready(function() {
		// getContactEngineProfileInf()
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





function removeCases(){
	
	selected_cases = [];
		$(".iqRow:checkbox:checked").each(function(){
			selected_cases.push($(this).val());
});
	
	if(selected_cases.length > 0){
		var caseIDs = selected_cases.join(', ');
		case_s = (selected_cases.length === 1) ? 'case ' : 'cases ';
		Swal.fire({
		title: "Are you sure you want to delete " + case_s + caseIDs+"?",
		showDenyButton: true,
		denyButtonText: 'No',
		confirmButtonText: 'Yes',
		customClass: {
				confirmButton: 'Custom_Confirm',
				denyButton: 'Custom_Deny',
			},
		}).then((result) => {
			if (result.isConfirmed) {
				selected_cases.forEach(element =>{
					$.ajax({
					url: "includes/cityview.inc.php",             
					type: 'post',
					dataType: "html",
					data: {"type": "delete_cases", "cases": element},
						success: function(data) {
				
				
							document.getElementById('h1_triage_view').html = data.Open;
							document.getElementById('h1_responses').html = data.Responded;
							document.getElementById('h1_timeline').html = data.Full;

							document.getElementById('case_' + element).remove();
							console.log(element)
				
							Swal.fire({
								title: "Cases deleted!",
								showConfirmButton: false,
								icon: "success",
								timer: 1500
							});
							selected_cases = [];
									
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.error("Status: " + textStatus);
							console.error("Error: " + errorThrown);
						}
					});
				});
			} else if (result.isDenied) {
				Swal.close();
			}
		});
	}
	
}

function getTicketReports(a){

	$.ajax({    
		type: "POST",
		url: "../includes/reports.inc.php",             
		data: {type:a},
		dataType: "html",                  
		beforeSend : function() {
				$('#pagecontent1').empty();
			},    
		success: function(data){ 
			$('#pagecontent').empty();               
				$("#pagecontent").html(data); 
		},
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
	});


}



function getTriageView(page){
	$('#spinner').show() 	
	$("#politician_engagements").html(''); 
$.ajax({    
		type: "POST",
		url: "../includes/dashboard.inc.php",             
		data: {type:"admin", page:page },
		dataType: "html",                  
	success: function(data){ 
		//console.log(data);  			
		$("#politician_engagements").html(data); 
		$('#spinner').hide() 	

	},
	error: function(error){
		console.log("Error:");
		console.log(error);
		$("#error").show();                 
		$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
		
	},
});

}

function getDashboardPage(page, subpage) {
	
	//MAIN DASHBOARD PAGE FUNCTION
// alert('hi')

$('#pagecontent').html('<div style="position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;text-align: center;top: 45%;" class="spinner" id="spinner"></div>')
	//Check for last IQ answered and set cookie
	
	
	
		// 	$.ajax({    
		// 		type: "POST",
		// 		url: "../includes/user.inc.php",             
		// 		data: {type:"engage"},
		// 		dataType: "html",              
		// 		success: function(data){   
					 
		// 			setCookiebyDuration("iq", data, 1, "days")
		// // window.reload()
		// 		},
		// 		complete: function(){
		// 			// if (subpage == 0 || subpage == ""){
					
				
		// 		},
		// 		error: function(error){
		// 			console.log("Error:");
		// 			console.log(error);
		// 			$("#error").show();                 
		// 			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
					
		// 		},
		// 		});
		 
		// if(window.matchMedia('(min-width: 990px)').matches) {
	
		// 	var side =  document.getElementsByTagName('BODY')
		// // side.classList.removeClass('.toggle-sidebar')
		// console.log(side)
		//  
		// $(side).addClass('toggle-sidebar');
	
	
		//  } else {
			var side =  document.querySelectorAll('.toggle-sidebar')
		// side.classList.removeClass('.toggle-sidebar')
		// console.log('2')
		$(side).removeClass('toggle-sidebar');
	
		//  }
	
	
			//alert(page);
			//const subpage = urlParams.get('subpage');
			
			getDashboardHeaderContent(page);
			
			// if (page == 0 || page == null){
		
			// 	window.location = ('forbidden.php') 
	
			// }else{
	
				if (page == "politician_profile"){
					document.cookie = "politician_id= "+subpage + ";";
				}
	
				if (page == "constituent_profile"){
					document.cookie = "constituent_user_id= "+subpage + ";";
				}
				$.ajax({    
				type: "POST",
				url: "/includes/dashboard.inc.php",             
				data: {type:"admin", page:page , subpage:subpage},
				dataType: "html",  
				beforeSend : function() {
					$('#pagecontent1').empty();
				},                
				success: function(data){   
					//console.log(data); 
					// if (page=="org_order"){
					// 	getPaymentPage('Payment', 1, 'IQ');
					// } 
					// getOrgMain();
					//getPurchasedIQs();
					$('#pagecontent').empty();               
					$("#pagecontent").html(data); 
					// checkTime()
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
				
				},
				complete: function(){
					// if (subpage == 0 || subpage == ""){
					// 	//alert("no subpage");
					// 	getOrgPage("overview");
					 // 	;//if no subpage parameter set to default
					// } else {
					// 	//alert("run getOrgPage() function if index_org");
						getSubPage(page, subpage);
					// }
					
				
				},
				error: function(error){
					console.log("Error:");
					console.log(error);
					$("#error").show();                 
					$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
					
				},
				});
			// }
			
	
	}
	
</script>





</html>


